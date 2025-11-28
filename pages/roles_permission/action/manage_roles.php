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
//department Account Section Start 
	case 'add_roles':
        $roles_name = mysqli_real_escape_string ($db, $_REQUEST['roles_name']);
        $db->query("INSERT INTO `roles`(`r_id`, `roles_name`,`consumer_id`,`create_at`) VALUES (NULL ,'$roles_name','$consumer_id','$create_at')");
        $r_id = $db->insert_id;
        for ($i=0; $i <= count($_REQUEST['sl']) ; $i++) { 
            $p_id = $_REQUEST['p_id'][$i];
            if (!empty($p_id)) {
            $reads = $_REQUEST['reads'][$i];
            $writes = $_REQUEST['writes'][$i];
            $creates = $_REQUEST['creates'][$i];
            $db->query("INSERT INTO `access`(`acs_id`,`r_id`,`p_id`,`reads`,`writes`,`creates`,`create_at`) VALUES (NULL ,'$r_id','$p_id','$reads','$writes','$creates','$create_at')");
            }

        }

        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../roles?msg=" . md5('5') . "");
        break ;
    case 'delete_roles':
        $consumer_id = $_SESSION['consumer_id'];
        $roles_id = mysqli_real_escape_string ($db, $_REQUEST['roles_id']);
        $db->query("DELETE FROM `roles` WHERE r_id ='$roles_id'");
        $db->query("DELETE FROM `access` WHERE r_id ='$roles_id'");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../roles?msg=" . md5('5') . "");
        break ;
    case 'update_roles':

        $consumer_id = $_SESSION['consumer_id'];
         $roles_name = mysqli_real_escape_string ($db, $_REQUEST['roles_name']);
        $r_id = mysqli_real_escape_string ($db, $_REQUEST['r_id']);
        $db->query("UPDATE `roles` SET roles_name = '$roles_name' WHERE r_id = '$r_id' ");

        for ($i=0; $i <= count($_REQUEST['sl']) ; $i++) { 
            $p_id = $_REQUEST['p_id'][$i];
            $acs_id = $_REQUEST['acs_id'][$i];
            if (!empty($acs_id)) {
            $reads = $_REQUEST['reads'][$i];
            $writes = $_REQUEST['writes'][$i];
            $creates = $_REQUEST['creates'][$i];
            $db->query("UPDATE `access` SET  `r_id` = '$r_id' , `p_id` = '$p_id' , `reads` = '$reads' , `writes` = '$writes' ,`creates` = '$creates', `update_at` = '$update_at' WHERE `acs_id` = '$acs_id'");
            }

        }


        $_SESSION['errormsg'] = ' Update successfully.';
        $_SESSION['errorValue'] = 'success';
        header("location:../roles?msg=" . md5('5') . "");
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