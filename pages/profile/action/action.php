<?php 
session_start();
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
require_once '../../../library/spout/src/Spout/Autoloader/autoload.php';
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
        $a_id = $_SESSION['a_id'];

switch ($action) {
    case 'update_password':
        
                    $newPassword = mysqli_real_escape_string($db,$_POST['newPassword']);
                   $confirmPassword = mysqli_real_escape_string($db,$_POST['confirmPassword']);
                   $a_password = md5($newPassword);
                    // echo "UPDATE `admin` SET a_password='$a_password',a_vpwd='$newPassword' WHERE a_id = '$a_id'";
                    // die();
                 if($newPassword == $confirmPassword){
                     $db->query("UPDATE `admin` SET a_password='$a_password',a_vpwd='$newPassword' WHERE a_id = '$a_id'");
                     $_SESSION['errorValue'] = 'success';
                        $_SESSION['errormsg'] = ' Password changed successfully.';
                        $_SESSION['msg'] = md5('7');
                        header("location:../profile?msg=" . md5('5') . "");
                 }else{
                     $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Password and confirm Password Not Matching.';
        $_SESSION['msg'] = md5('7');
        header("location:../profile?msg=" . md5('5') . "");
                 }
          
         break ;
    case 'update_profile':
        
                     $modalEditUserName = mysqli_real_escape_string($db,$_POST['modalEditUserName']);
                     $modalEditUserEmail = mysqli_real_escape_string($db,$_POST['modalEditUserEmail']);
                     $modalEditUserPhone = mysqli_real_escape_string($db,$_POST['modalEditUserPhone']);
                    $address = mysqli_real_escape_string($db,$_POST['address']);
             
                     $db->query("UPDATE `admin` SET a_phone='$modalEditUserPhone',a_name='$modalEditUserName',a_email='$modalEditUserEmail',a_address='$address' WHERE a_id = '$a_id'");
                     
     
		if (!empty($_FILES['a_image']['name'])) {

			$old_img = $_FILES['a_image']['name'];
			$devid = explode('.',$old_img);
			$current_name = current($devid);
			$extension = end($devid);
			$allow = ['jpg','png','jpeg','svg'];

			if (in_array($extension,$allow)) {

				$rand = rand(111,99999);
				$new_image = $current_name.'_'.$rand.'.'.$extension;
				$path = '../../../uploads/'.$new_image;
				$tmp_name = $_FILES['a_image']['tmp_name'];
				move_uploaded_file($tmp_name, $path);

				$db->query("UPDATE `admin` SET `a_image` = '$new_image' WHERE `a_id` = '$a_id'");
			}else{
						echo 'Faild For Mismatch';
					}
		}else{
				echo 'Failed for not Found image';
			}
                     $_SESSION['errorValue'] = 'success';
                        $_SESSION['errormsg'] = ' Profile Updated successfully.';
                        $_SESSION['msg'] = md5('7');
                        header("location:../profile?msg=" . md5('5') . "");
                
             
          
         break ;
    case 'update_store_profile':
        
                     $modalEditUserPhone = mysqli_real_escape_string($db,$_POST['modalEditUserPhone']);
                    $address = mysqli_real_escape_string($db,$_POST['address']);
                     $modalEditUserName = mysqli_real_escape_string($db,$_POST['modalEditUserName']);
                    $modalEditUserEmail = mysqli_real_escape_string($db,$_POST['modalEditUserEmail']);
                    $store = mysqli_real_escape_string($db,$_POST['store']);
                    $gst_no = mysqli_real_escape_string($db,$_POST['gst_no']);
            
                     $db->query("UPDATE `stors` SET mobile='$modalEditUserPhone',name='$modalEditUserName',email='$modalEditUserEmail',gst_no='$gst_no',address='$address' WHERE sto_id = '$store'");
                     $_SESSION['errorValue'] = 'success';
                        $_SESSION['errormsg'] = ' Profile Updated successfully.';
                        $_SESSION['msg'] = md5('7');
                        header("location:../store_profile?store=".$store);
                
             
          
         break ;

    default:
            $_SESSION['errormsg'] = 'Invalid page access.';
            $_SESSION['errorValue'] = 'warning';

        }


 ?>