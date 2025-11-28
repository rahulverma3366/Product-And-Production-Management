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

switch ($action) {
	case 'submit':
        $pc_name =  mysqli_real_escape_string($db, $_REQUEST["pc_name"]); 

        $db->query("INSERT INTO `product_category`(`pc_id`, `pc_name`,`consumer_id`, `create_at`)
          VALUES (NULL,'$pc_name','$consumer_id','$create_at')");


        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../product_category?msg=" . md5('5') . "");
        break ;
    case 'delete':
        $pc_id =  mysqli_real_escape_string($db, $_REQUEST["pc_id"]); 
        $db->query("DELETE FROM `product_category` WHERE pc_id = '$pc_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../product_category?msg=" . md5('5') . "");
        break ;

    case 'update':

        $consumer_id = $_SESSION['consumer_id'];
        $pc_name =  mysqli_real_escape_string($db, $_REQUEST["pc_name"]); 
        $area_pincode =  mysqli_real_escape_string($db, $_REQUEST["area_pincode"]); 
        $pc_id =  mysqli_real_escape_string($db, $_REQUEST["pc_id"]); 


        $db->query("UPDATE `product_category` SET  `pc_id`  =  '$pc_id', `pc_name`  =  '$pc_name', `consumer_id`  =  '$consumer_id',  `update_at`  =  '$update_at' WHERE pc_id='$pc_id'");


            $_SESSION['errormsg'] = ' Update successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../product_category?msg=" . md5('5') . "");
            break ;
    default:
            $_SESSION['errormsg'] = 'Invalid page access.';
            $_SESSION['errorValue'] = 'warning';

        }


 ?>