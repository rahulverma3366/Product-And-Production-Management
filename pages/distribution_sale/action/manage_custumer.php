<?php 
session_start();
require_once '../../../config/config.php';
$action = $_REQUEST['submit'];
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = strtolower($string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
        $create_at =  date('Y-m-d H:i:s');
        $update_at =  date('Y-m-d H:i:s');
        $consumer_id = $_SESSION['consumer_id'];
        $user_id = $_SESSION['a_id'];
switch ($action) {


    case 'submit_select_custumer':
        $consumer_id = $_SESSION['consumer_id'];
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $mobile_no =  mysqli_real_escape_string($db, $_REQUEST["mobile_no"]); 
        $email_id =  mysqli_real_escape_string($db, $_REQUEST["email_id"]); 
        $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        $register_address =  mysqli_real_escape_string($db, $_REQUEST["register_address"]); 
        $password = 'gps'.rand(11,999);
        $md5password = md5($password);

        $db->query("INSERT INTO `admin`(`a_id`,`consumer_id`, `a_name`, `a_phone`, `a_email`,`a_type`, `a_gst`, `a_address`,`a_password`,`a_vpwd`,`create_at`)
          VALUES (NULL,'$consumer_id','$name','$mobile_no','$email_id','4','$gst_no','$register_address','$md5password','$password','$create_at')");

        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../select_custumers?msg=" . md5('5') . "");




        break;



    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>