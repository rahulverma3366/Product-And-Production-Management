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
        $mobile_no =  mysqli_real_escape_string($db, $_REQUEST["mobile_no"]); 
        $email_id =  mysqli_real_escape_string($db, $_REQUEST["email_id"]); 
        $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        $img1 =  mysqli_real_escape_string($db, $_REQUEST["img1"]); 
        $img2 =  mysqli_real_escape_string($db, $_REQUEST["img2"]); 
        $register_address =  mysqli_real_escape_string($db, $_REQUEST["register_address"]); 

        $db->query("INSERT INTO `vendor`(`vd_id`, `name`, `mobile_no`, `email_id`, `gst_no`, `register_address`, `create_at`)
          VALUES (NULL,'$name','$mobile_no','$email_id','$gst_no','$register_address','$create_at')");
        $vd_id = $db->insert_id;

        $img1 =  $_FILES['img1']['name'];
  
            if ($img1 == '') { 
                }else { 
                    $expbanner=explode('.',$img1);
                    $bannerexptype=$expbanner[1]; 
                    $allowedTypes = array('jpg', 'png', 'pdf', 'JPG', 'JPEG', 'PNG', 'jpeg');


                    $detectedType = exif_imagetype($_FILES['img1']['tmp_name']); 
                    if(!in_array($bannerexptype, $allowedTypes)) { 
                        'Not Match'; 
                        die(); 
                    }else{ 
                        $date = date('m/d/Yh:i:sa', time()); 
                        $rand=rand(10000,99999);
                        $encname='media-'.$rand; 
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath='../../../uploads/'.$bannername; 
                        move_uploaded_file($_FILES['img1']['tmp_name'],$bannerpath);
                        $db->query("UPDATE `vendor` SET img1 = '$bannername' WHERE vd_id = '$vd_id' ");
                     } 
                } 

                



        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../vendor_list?msg=" . md5('5') . "");
        break ;
    case 'delete':
     
        $vd_id =  mysqli_real_escape_string($db, $_REQUEST["vd_id"]); 
        $db->query("DELETE FROM `vendor` WHERE vd_id = '$vd_id'");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../vendor_list?msg=" . md5('5') . "");
        break ;

    case 'update':

        $consumer_id = $_SESSION['consumer_id'];
        $vd_id =  mysqli_real_escape_string($db, $_REQUEST["vd_id"]); 
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $mobile_no =  mysqli_real_escape_string($db, $_REQUEST["mobile_no"]); 
        $email_id =  mysqli_real_escape_string($db, $_REQUEST["email_id"]); 
        $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        $register_address =  mysqli_real_escape_string($db, $_REQUEST["register_address"]); 
        $update_at =  mysqli_real_escape_string($db, $_REQUEST["update_at"]); 



        $db->query("UPDATE `vendor` SET  `vd_id`  =  '$vd_id', `consumer_id`  =  '$consumer_id', `name`  =  '$name', `mobile_no`  =  '$mobile_no', `email_id`  =  '$email_id', `gst_no`  =  '$gst_no', `register_address`  =  '$register_address', `update_at`  =  '$update_at' WHERE vd_id='$vd_id'");

        $img1 =  $_FILES['img']['name'];
            if ($img1 == '') { 
                }else { 
                    $expbanner=explode('.',$img1);
                    $bannerexptype=$expbanner[1]; 
                    $allowedTypes = array('jpg', 'png', 'pdf', 'JPG', 'JPEG', 'PNG', 'jpeg');
                    $detectedType = exif_imagetype($_FILES['img1']['tmp_name']); 
                    if(!in_array($bannerexptype, $allowedTypes)) { 
                        'Not Match'; 
                        die(); 
                    }else{ 
                        $date = date('m/d/Yh:i:sa', time()); 
                        $rand=rand(10000,99999);
                        $encname='media-'.$rand; 
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath='../../../uploads/'.$bannername; 
                        move_uploaded_file($_FILES['img1']['tmp_name'],$bannerpath);
                        $db->query("UPDATE `vendor` SET img1 = $bannername WHERE vd_id = '$vd_id' ");
                     } 
                } 


        // $img2 =  $_FILES['img']['name'];
        //     if ($img2 == '') { 
        //         }else { 
        //             $expbanner=explode('.',$img2);
        //             $bannerexptype=$expbanner[1]; 
        //             $allowedTypes = array('jpg', 'png', 'pdf', 'JPG', 'JPEG', 'PNG', 'jpeg');
        //             $detectedType = exif_imagetype($_FILES['img2']['tmp_name']); 
        //             if(!in_array($bannerexptype, $allowedTypes)) { 
        //                 'Not Match'; 
        //                 die(); 
        //             }else{ 
        //                 $date = date('m/d/Yh:i:sa', time()); 
        //                 $rand=rand(10000,99999);
        //                 $encname='media-'.$rand; 
        //                 $bannername=$encname.'.'.$bannerexptype;
        //                 $bannerpath='../../../uploads/'.$bannername; 
        //                 move_uploaded_file($_FILES['img2']['tmp_name'],$bannerpath);
        //                 $db->query("UPDATE `vendor` SET img2 = $bannername WHERE vd_id = '$vd_id' ");
        //              } 
        //         } 



        $_SESSION['errormsg'] = ' Update successfully.';
        $_SESSION['errorValue'] = 'success';
        header("location:../vendor_list?msg=" . md5('5') . "");
        break ;


    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>