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
        

switch ($action) {
	case 'submit':
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
         $status =  mysqli_real_escape_string($db, $_REQUEST["status"]); 

        $db->query("INSERT INTO `slot`(`sl_id`, `name`,`status`, `create_at`)
          VALUES (NULL,'$name','$status','$create_at')");


        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../create_slot?msg=" . md5('5') . "");
        break ;
	case 'add_store':
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $slug = clean($name);
        $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        $mobile =  mysqli_real_escape_string($db, $_REQUEST["mobile"]); 
        $email =  mysqli_real_escape_string($db, $_REQUEST["email"]); 
        $address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 
      $db->query("INSERT INTO `stors`(`sto_id`, `name`, `gst_no`, `mobile`, `email`, `address`, `slug`, `create_at`, `update_at`)
  VALUES (NULL,'$name','$gst_no','$mobile','$email','$address','$slug','$create_at','$update_at')");


        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../create_store?msg=" . md5('5') . "");
        break ;
    case 'delete':
        $sl_id =  mysqli_real_escape_string($db, $_REQUEST["sl_id"]); 
        $db->query("DELETE FROM `slot` WHERE sl_id = '$sl_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../create_slot?msg=" . md5('5') . "");
        break ;

    case 'update':

        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
         $status =  mysqli_real_escape_string($db, $_REQUEST["status"]);
        $sl_id =  mysqli_real_escape_string($db, $_REQUEST["sl_id"]); 


        $db->query("UPDATE `slot` SET  `sl_id`  =  '$sl_id', `name`  =  '$name', `status`  =  '$status',  `update_at`  =  '$update_at' WHERE sl_id='$sl_id'");


            $_SESSION['errormsg'] = ' Update successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../create_slot?msg=" . md5('5') . "");
            break ;
    case 'delete_store':
        $sto_id =  mysqli_real_escape_string($db, $_REQUEST["sto_id"]); 
        $db->query("DELETE FROM `stors` WHERE sto_id = '$sto_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../create_store?msg=" . md5('5') . "");
        break ;


    case 'update_store':

        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]);
        $sto_id =  mysqli_real_escape_string($db, $_REQUEST["sto_id"]); 
        $slug =  clean($name); 
 $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        $mobile =  mysqli_real_escape_string($db, $_REQUEST["mobile"]); 
        $email =  mysqli_real_escape_string($db, $_REQUEST["email"]); 
        $address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 

       $db->query("UPDATE `stors` SET  `sto_id`  =  '$sto_id', `name`  =  '$name', `gst_no`  =  '$gst_no', `mobile`  =  '$mobile', `email`  =  '$email', `address`  =  '$address', `slug`  =  '$slug',  `update_at`  =  '$update_at' WHERE sto_id='$sto_id'");

            $_SESSION['errormsg'] = ' Update successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../create_store?msg=" . md5('5') . "");
            break ;
                case 'status':

        $sts =  mysqli_real_escape_string($db, $_REQUEST["sts"]);
        $sl_id =  mysqli_real_escape_string($db, $_REQUEST["sl_id"]);
        

       $db->query("UPDATE `slot` SET  `status`  =  '$sts',`update_at`  =  '$update_at' WHERE sl_id='$sl_id'");

            $_SESSION['errormsg'] = ' Update successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../create_slot?msg=" . md5('5') . "");
            break ;
            
    default:
            $_SESSION['errormsg'] = 'Invalid page access.';
            $_SESSION['errorValue'] = 'warning';

        }


 ?>