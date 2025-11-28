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
        $email =  mysqli_real_escape_string($db, $_REQUEST["email"]); 
        $phone =  mysqli_real_escape_string($db, $_REQUEST["phone"]); 
        $state =  mysqli_real_escape_string($db, $_REQUEST["state"]); 
        $address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 
        $gst =  mysqli_real_escape_string($db, $_REQUEST["gst"]); 

        $db->query("INSERT INTO `buyers`(`bu_id`, `name`, `email`, `phone`, `state`, `address`, `gst`, `create_at`, `update_at`)
        VALUES ('$bu_id','$name','$email','$phone','$state','$address','$gst','$create_at','$update_at')");
        
        $bu_id = $db->insert_id;
        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../buyers_list?msg=" . md5('5') . "");
        break ;
    case 'delete':
        $bu_id =  mysqli_real_escape_string($db, $_REQUEST["bu_id"]); 
        $db->query("DELETE FROM `buyers` WHERE bu_id = '$bu_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../buyers_list?msg=" . md5('5') . "");
        break ;

    case 'update':
        $bu_id =  mysqli_real_escape_string($db, $_REQUEST["bu_id"]); 
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $email =  mysqli_real_escape_string($db, $_REQUEST["email"]); 
        $phone =  mysqli_real_escape_string($db, $_REQUEST["phone"]); 
        $state =  mysqli_real_escape_string($db, $_REQUEST["state"]); 
        $address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 
        $gst =  mysqli_real_escape_string($db, $_REQUEST["gst"]); 

       $db->query("UPDATE `buyers` SET  `bu_id`  =  '$bu_id', `name`  =  '$name', `email`  =  '$email', `phone`  =  '$phone', `state`  =  '$state', `address`  =  '$address', `gst`  =  '$gst', `update_at`  =  '$update_at' WHERE bu_id='$bu_id'");


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
                        $db->query("UPDATE `buyers` SET img1 = $bannername WHERE bu_id = '$bu_id' ");
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
        //                 $db->query("UPDATE `buyers` SET img2 = $bannername WHERE bu_id = '$bu_id' ");
        //              } 
        //         } 



        $_SESSION['errormsg'] = ' Update successfully.';
        $_SESSION['errorValue'] = 'success';
        header("location:../buyers_list?msg=" . md5('5') . "");
        break ;


    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>