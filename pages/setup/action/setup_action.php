<?php 
session_start();
require_once '../../../config/config.php';
require_once '../../../config/basic.php';
$action = $_REQUEST['submit'];
switch ($action) {
//department Account Section Start 

    case 'update_fronted':
        $consumer_id = $_SESSION['consumer_id'];
        $shows = mysqli_real_escape_string($db, $_REQUEST['shows']);
        $data = $db->query("SELECT * FROM `setting` WHERE consumer_id = '$consumer_id' AND shows = '$shows'");
        while ($value = $data->fetch_object()) {
          $name = $value->name;
          if ($name == 'logo') {
          
          }else{
          $s_id = $value->s_id;
          $value = trim($_POST[$value->name]);
          $db->query("UPDATE `setting` SET value = '$value' WHERE s_id = $s_id");
          }
        }

        // photoupload
            $logo = $_FILES['logo']['name']; 
             if ($logo == '') {

             }else {
                $expbanner=explode('.',$logo);
                $bannerexptype=$expbanner[1];
                $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF,IMAGETYPE_WEBP,);
                $detectedType = exif_imagetype($_FILES['logo']['tmp_name']);
                    if(!in_array($detectedType, $allowedTypes)) {
                    echo 'Not Match';
                    die();
                    }else{
                        $date = date('m/d/Yh:i:sa', time());
                        $rand=rand(10000,99999);
                        $encname='media-'.$rand;
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath="../../../uploads/".$bannername;
                        $bannername = website_name.'/uploads/'.$bannername;
                        move_uploaded_file($_FILES["logo"]["tmp_name"],$bannerpath);
                        $db->query("UPDATE `setting` SET value = '$bannername' WHERE s_id = '3'");
                    }

                }


        $_SESSION['errormsg'] = ' Update successfully.';
        $_SESSION['errorValue'] = 'success';
        header("location:../setup?msg=" . md5('5') . "");
        break ;

        case 'update_store':
            $user_id = $_SESSION['a_id'];
            $consumer_id = $_SESSION['consumer_id'];
            $store_name =  mysqli_real_escape_string($db, $_REQUEST["store_name"]); 
            $store_mobile_no =  mysqli_real_escape_string($db, $_REQUEST["store_mobile_no"]); 
            $store_email_id =  mysqli_real_escape_string($db, $_REQUEST["store_email_id"]); 
            $store_address =  mysqli_real_escape_string($db, $_REQUEST["store_address"]); 
            $store_gst =  mysqli_real_escape_string($db, $_REQUEST["store_gst"]); 
            $cin =  mysqli_real_escape_string($db, $_REQUEST["cin"]); 
            $bank_details =  mysqli_real_escape_string($db, $_REQUEST["bank_details"]); 
            $state =  mysqli_real_escape_string($db, $_REQUEST["state"]); 

            $data = $db->query("SELECT * FROM `store_setting` WHERE consumer_id = '$consumer_id' AND user_id = '$user_id'");
            if ($data->num_rows == 0) {
                $db->query("INSERT INTO `store_setting`(`ss_id`, `consumer_id`, `user_id`, `store_name`, `store_mobile_no`, `store_email_id`, `store_address`, `store_gst`,`cin`,`state`,`bank_details`, `create_at`)
                  VALUES ('$ss_id','$consumer_id','$user_id','$store_name','$store_mobile_no','$store_email_id','$store_address','$store_gst','$cin','$state','$bank_details','$create_at')");
                $ss_id = $db->insert_id;
            }else{
                $value = $data->fetch_object();
                $ss_id = $value->ss_id;
                $db->query("UPDATE `store_setting` SET  `ss_id`  =  '$ss_id', `consumer_id`  =  '$consumer_id', `user_id`  =  '$user_id', `store_name`  =  '$store_name', `store_mobile_no`  =  '$store_mobile_no', `store_email_id`  =  '$store_email_id', `store_address`  =  '$store_address', `store_gst`  =  '$store_gst',`cin` = '$cin',`state` = '$state',`bank_details`= '$bank_details'  `update_at`  =  '$update_at' WHERE ss_id='$ss_id'");
            }


            $logo = $_FILES['store_logo']['name']; 
             if ($logo == '') {

             }else {
                $expbanner=explode('.',$logo);
                $bannerexptype=$expbanner[1];
                $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF,IMAGETYPE_WEBP,);
                $detectedType = exif_imagetype($_FILES['store_logo']['tmp_name']);
                    if(!in_array($detectedType, $allowedTypes)) {
                    echo 'Not Match';
                    die();
                    }else{
                        $date = date('m/d/Yh:i:sa', time());
                        $rand=rand(10000,99999);
                        $encname='media-'.$rand;
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath="../../../uploads/".$bannername;
                        move_uploaded_file($_FILES["store_logo"]["tmp_name"],$bannerpath);
                        $db->query("UPDATE `store_setting` SET store_logo = '$bannername' WHERE ss_id = '$ss_id'");
                    }

                }



            
                $_SESSION['errormsg'] = ' Update successfully.';
                $_SESSION['errorValue'] = 'success';
                header("location:../setup?msg=" . md5('5') . "");

            break;
        case 'remove_store_logo':
            $user_id = $_SESSION['a_id'];
            $consumer_id = $_SESSION['consumer_id'];
            $store_logo = mysqli_real_escape_string($db,$_REQUEST['store_logo']);
            $url = website_name.'/uploads/'.$store_logo;
            unlink($url);
            $db->query("UPDATE `store_setting` SET store_logo = '' WHERE user_id = '$user_id' AND consumer_id = '$consumer_id'");
            // Unlinking The Images
            $_SESSION['errormsg'] = ' Update successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../setup?msg=" . md5('5') . "");

            break;

    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>