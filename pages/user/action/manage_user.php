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
        $a_name = mysqli_real_escape_string ($db, $_REQUEST['a_name']);
        $a_email = mysqli_real_escape_string ($db, $_REQUEST['a_email']);
        $a_phone = mysqli_real_escape_string ($db, $_REQUEST['a_phone']);
        $a_company = mysqli_real_escape_string ($db, $_REQUEST['a_company']);
        $a_type = mysqli_real_escape_string ($db, $_REQUEST['a_type']);
        $r_id = mysqli_real_escape_string ($db, $_REQUEST['r_id']);
        $a_vpwd = $_REQUEST['a_password'];
        $a_password = md5($_REQUEST['a_password']);
        $consumer_id = $_SESSION['consumer_id'];
        $db->query("INSERT INTO `admin`(`a_id`, `a_name`,`consumer_id`,`a_email`,`a_phone`,`a_company`,`a_type`,`r_id`,`active`,`a_password`,`a_vpwd`,`create_at`) VALUES (NULL ,'$a_name','$consumer_id','$a_email','$a_phone','$a_company','$a_type','$r_id',1,'$a_password','$a_vpwd','$create_at')");

        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../user?msg=" . md5('5') . "");
        break ;
    case 'delete':
        $consumer_id = $_SESSION['consumer_id'];
        $a_id = mysqli_real_escape_string ($db, $_REQUEST['a_id']);
        $db->query("DELETE FROM `admin` WHERE a_id ='$a_id' AND consumer_id = '$consumer_id'");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../user?msg=" . md5('5') . "");
        break ;

    case 'suspend':
        $consumer_id = $_SESSION['consumer_id'];
        $a_id = mysqli_real_escape_string ($db, $_REQUEST['a_id']);
        $db->query("UPDATE `admin` SET a_status = 0 WHERE a_id = '$a_id'");
        $_SESSION['errorValue'] = 'warning';
        $_SESSION['errormsg'] = ' Account Suspended successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../user?msg=" . md5('5') . "");
        break ;

    case 'unblock':
        $consumer_id = $_SESSION['consumer_id'];
        $a_id = mysqli_real_escape_string ($db, $_REQUEST['a_id']);
        $db->query("UPDATE `admin` SET a_status = 1 WHERE a_id = '$a_id'");
        $_SESSION['errorValue'] = 'success';
        $_SESSION['errormsg'] = ' Account Unblock successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../user?msg=" . md5('5') . "");
        break ;


    case 'update':

        $consumer_id = $_SESSION['consumer_id'];
        $a_name = mysqli_real_escape_string ($db, $_REQUEST['a_name']);
        $a_email = mysqli_real_escape_string ($db, $_REQUEST['a_email']);
        $a_phone = mysqli_real_escape_string ($db, $_REQUEST['a_phone']);
        $a_company = mysqli_real_escape_string ($db, $_REQUEST['a_company']);
        $a_type = mysqli_real_escape_string ($db, $_REQUEST['a_type']);
        $r_id = mysqli_real_escape_string ($db, $_REQUEST['r_id']);
        $a_id = mysqli_real_escape_string ($db, $_REQUEST['a_id']);
        $consumer_id = $_SESSION['consumer_id'];
        $a_vpwd = $_REQUEST['a_password'];
        $a_password = md5($_REQUEST['a_password']);


        $db->query("UPDATE `admin` SET a_name = '$a_name' , a_email = '$a_email' ,a_phone = '$a_phone',a_company = '$a_company',a_type= '$a_type', r_id = '$r_id' , a_password = '$a_password' , a_vpwd = '$a_vpwd'  WHERE a_id = '$a_id' AND consumer_id = '$consumer_id'");


        $_SESSION['errormsg'] = ' Update successfully.';
        $_SESSION['errorValue'] = 'success';
        header("location:../user?msg=" . md5('5') . "");
        break ;

    case 'addusertype':
        $name = mysqli_real_escape_string ($db, $_REQUEST['name']);
        $acess = implode(',', $_REQUEST['asign']);
        $alias = clean($name);
        $db->query("INSERT INTO `user_type`(`ut_id`, `name`, `acess`) VALUES (NULL ,'$name','$acess')");

        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['msg'] = md5('5');
        header("location:../usertype?msg=" . md5('5') . "");
        
        break;

    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>