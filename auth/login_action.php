<?php
session_start();
require_once '../config/config.php';
require_once '../config/basic.php';

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
 function getBrowser()
 {
   $user_agent = $_SERVER['HTTP_USER_AGENT'];
   $browser = "N/A";

   $browsers = [
     '/msie/i' => 'Internet explorer',
     '/firefox/i' => 'Firefox',
     '/safari/i' => 'Safari',
     '/chrome/i' => 'Chrome',
     '/edge/i' => 'Edge',
     '/opera/i' => 'Opera',
     '/mobile/i' => 'Mobile browser',
   ];

   foreach ($browsers as $regex => $value) {
     if (preg_match($regex, $user_agent)) {
       $browser = $value;
     }
   }

   return $browser;
 }
    $currentdatetime = date('d-m-Y H:i:s');


$action = $_REQUEST['submit'];

switch ($action) {
  case 'Login':
      
    $a_email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $a_password = md5($_POST['password']);
    //get total number of records
    $results = $db->query("SELECT * FROM `admin` WHERE a_email='$a_email' AND a_password='$a_password' AND a_status = '1'");
    if ($results->num_rows > 0) {

      $ip = getUserIpAddr();
      $browser = getBrowser();
      $session = session_id();  
      $value = $db->query("SELECT a_id, a_email, a_usertype, a_pagepermission , a_type , consumer_id  FROM `admin` WHERE a_email='$a_email'");
      $row = $value->fetch_object();

      $a_id = $row->a_id;

      $db->query("INSERT INTO `login_history`(`lh_id`, `a_id`, `ip_address`, `browser`, `login_time`, `session`, `sts`, `date`) VALUES (NULL,'$a_id','$ip','$browser','$currentdatetime','$session','0','$currentdatetime')");

          $db->query("UPDATE `admin` SET active = 1 WHERE a_email = '$a_email'");
          //MySqli Select Query
          session_regenerate_id();
          $a_id = session_id();
          $_SESSION[SESSVAR] = $a_id;
          $_SESSION['a_id'] = $row->a_id;
          $_SESSION['a_email'] = $row->a_email;
          $_SESSION['a_usertype'] = $row->a_usertype;
          $_SESSION['a_pagepermission'] = $row->a_pagepermission;
          $_SESSION['a_type'] = $row->a_type;
          $_SESSION['consumer_id'] = $row->consumer_id;
          $_SESSION['logintype'] = 'Admin'; // set user type    
          header("Location:../pages/dashboard");
    }else{
              $_SESSION['errormsg'] = 'Email or password does not match.';
              $_SESSION['errorValue'] = 'warning';
              header("Location:../index?msg=" . md5('2') . "");
      }
    break;
  case 'logout':

    $a_id = $_SESSION['a_id'];
    $db->query("UPDATE `admin` SET active = 0 WHERE a_id = '$a_id'");
    $db->query("UPDATE `login_history` SET sts = 0 , logout_time = '$currentdatetime' WHERE a_id = '$a_id' AND logout_time = ''");
    unset($_SESSION[SESSVAR]);
    unset($_SESSION['logintype']); // set user type		
    unset($_SESSION['a_id']);
    unset($_SESSION['a_email']);
    unset($_SESSION['a_usertype']);
    unset($_SESSION['a_pagepermission']);
    unset($_SESSION['consumer_id']);
    unset($_SESSION['a_type']);


    $_SESSION['msg'] = md5('1');
    $_SESSION['errormsg'] = 'Logout Successfully';
    $_SESSION['errorValue'] = 'success';
    header("Location:../index?msg=" . md5('logout') . "");
    exit();
    break;

  case 'updatesetting':

    $data = $db->query("SELECT * FROM `setting`");
    while ($value = $data->fetch_object()) {
      $name = $value->name;
      if ($name == 'logo') {
      
      }else{
      $s_id = $value->s_id;
      $value = $_POST[$value->name];
      $db->query("UPDATE `setting` SET value = '$value' WHERE s_id = $s_id");
      }
    }

        // photoupload
            $logo = $_FILES['logo']['name']; 
             if ($logo == '') {

             }else {
                $expbanner=explode('.',$logo);
                $bannerexptype=$expbanner[1];
                $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                $detectedType = exif_imagetype($_FILES['logo']['tmp_name']);
                    if(!in_array($detectedType, $allowedTypes)) {
                    echo 'Not Match';
                    die();
                    }else{
                        $date = date('m/d/Yh:i:sa', time());
                        $rand=rand(10000,99999);
                        $encname='img-'.$rand;
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath="../upload/".$bannername;
                        $bannername = website_name.'/upload/'.$bannername;
                        move_uploaded_file($_FILES["logo"]["tmp_name"],$bannerpath);
                        $db->query("UPDATE `setting` SET value = '$bannername' WHERE s_id = '3'");
                    }

                }


    $_SESSION['errormsg'] = 'Setting Update Success.';
    $_SESSION['errorValue'] = 'success';
    header("Location:../Account/setting?msg=" . md5('setting') . "");

    break;

    case 'submit_bug':

      $bg_id =  mysqli_real_escape_string($db, $_REQUEST["bg_id"]); 
      $a_id =  $_SESSION['a_id']; 
      $school_id =  $_SESSION['consumer_id']; 
      if (empty($school_id)) {
        $school_id = $_SESSION['a_id'];
      }
      $bugs_name =  mysqli_real_escape_string($db, $_REQUEST["bugs_name"]); 
      $bugs_desription =  mysqli_real_escape_string($db, $_REQUEST["bugs_desription"]); 
      $status =  'Pendding'; 
      $version =  version; 
      $create_at =  date('Y-m-d h:i:s'); 

      $db->query("INSERT INTO `bug_reports`(`bg_id`, `a_id`, `school_id`, `bugs_name`, `bugs_desription`, `status`, `version`, `create_at`) VALUES (NULL,'$a_id','$school_id','$bugs_name','$bugs_desription','$status','$version','$create_at')");

      $bg_id = $db->insert_id;

        // photoupload
            $bugs_attachments = $_FILES['bugs_attachments']['name']; 
             if ($bugs_attachments == '') {

             }else {
                $expbanner=explode('.',$bugs_attachments);
                $bannerexptype=$expbanner[1];
                $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
                $detectedType = exif_imagetype($_FILES['bugs_attachments']['tmp_name']);
                    if(!in_array($detectedType, $allowedTypes)) {
                    echo 'Not Match';
                    die();
                    }else{
                        $date = date('m/d/Yh:i:sa', time());
                        $rand=rand(10000,99999);
                        $encname='img-'.$rand;
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath="../uploads/".$bannername;
                        move_uploaded_file($_FILES["bugs_attachments"]["tmp_name"],$bannerpath);
                        $db->query("UPDATE `bug_reports` SET bugs_attachments = '$bannername' WHERE bg_id = '$bg_id'");
                    }

                }


      $_SESSION['errormsg'] = 'Bug Update Success.';
      $_SESSION['errorValue'] = 'success';
      header("Location:../Account/bug_report?msg=" . md5('setting') . "");


      break;


  default:
    $_SESSION['errormsg'] = 'Invalid page access.';
    $_SESSION['errorValue'] = 'danger';
    header("Location: ../404?msg=" . md5('11') . "");
}