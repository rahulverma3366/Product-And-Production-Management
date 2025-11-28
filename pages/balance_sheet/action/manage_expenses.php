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
        $a_id = $_SESSION['a_id'];

switch ($action) {
	case 'submit_expenses_type':
        $expenses_name =  mysqli_real_escape_string($db, $_REQUEST["expenses_name"]); 

        $db->query("INSERT INTO `expenses_type`(`et_id`,`a_id`,`expenses_name`, `create_at`)
          VALUES (NULL,'$a_id','$expenses_name','$create_at')");


        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../expenses_type?msg=" . md5('5') . "");
        break ;
    case 'delete_expenses_type':
        $et_id =  mysqli_real_escape_string($db, $_REQUEST["et_id"]); 
        $db->query("DELETE FROM `expenses_type` WHERE et_id = '$et_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../expenses_type?msg=" . md5('5') . "");
        break ;

    case 'update_expenses_type':

        $consumer_id = $_SESSION['consumer_id'];
        $expenses_name =  mysqli_real_escape_string($db, $_REQUEST["expenses_name"]); 
        $et_id =  mysqli_real_escape_string($db, $_REQUEST["et_id"]); 


        $db->query("UPDATE `expenses_type` SET  `et_id`  =  '$et_id', `expenses_name`  =  '$expenses_name',  `update_at`  =  '$update_at' WHERE et_id='$et_id'");


            $_SESSION['errormsg'] = ' Update successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../expenses_type?msg=" . md5('5') . "");
            break ;

	case 'submit_report':
            $type =  2; 
            $username =  mysqli_real_escape_string($db, $_REQUEST["username"]); 
            $sto_id =  mysqli_real_escape_string($db, $_REQUEST["sto_id"]); 
            $amount =  mysqli_real_escape_string($db, $_REQUEST["amount"]); 
            $date = mysqli_real_escape_string($db, $_REQUEST["date"]);
            $expenditure_name =  mysqli_real_escape_string($db, $_REQUEST["expenditure_name"]); 
            $transaction_no =  mysqli_real_escape_string($db, $_REQUEST["transaction_no"]); 

        $db->query("INSERT INTO `balance_sheet`(`bs_id`,`sto_id`,`a_id`,`type`,`name`,`amount`,`date`,`expenditure_name`,`transaction_no`,`create_at`)
          VALUES (NULL,'$sto_id','$a_id','$type','$username','$amount','$date','$expenditure_name','$transaction_no','$create_at')");
        //   echo "INSERT INTO `balance_sheet`(`bs_id`,`a_id`,`type`,`name`,`amount`,`date`,`expenditure_name`,`transaction_no`,`create_at`)
        //   VALUES (NULL,'$a_id','$type','$username','$amount','$date','$expenditure_name','$transaction_no','$create_at')";
         
   $bs_id = $db->insert_id;
  
        echo $image =  $_FILES['image']['name'];
  
            if ($image == '') { 
                }else { 
                    $expbanner=explode('.',$image);
                    $bannerexptype=$expbanner[1]; 
                    $allowedTypes = array('jpg', 'png', 'pdf', 'JPG', 'JPEG', 'PNG', 'jpeg');


                    $detectedType = exif_imagetype($_FILES['image']['tmp_name']); 
                    if(!in_array($bannerexptype, $allowedTypes)) { 
                        'Not Match'; 
                        die(); 
                    }else{ 
                        $date = date('m/d/Yh:i:sa', time()); 
                        $rand=rand(10000,99999);
                        $encname='media-'.$rand; 
                        $bannername=$encname.'.'.$bannerexptype;
                        $bannerpath='../../../uploads/'.$bannername; 
                        move_uploaded_file($_FILES['image']['tmp_name'],$bannerpath);
                        $db->query("UPDATE `balance_sheet` SET attachment = '$bannername' WHERE bs_id = '$bs_id' ");
                   
                     } 
                } 

            $_SESSION['errormsg'] = ' Suubmit successfully.';
            $_SESSION['errorValue'] = 'success';
            header("location:../manage_report?msg=" . md5('5') . "");
            break ;
    case 'delete_report':
        $bs_id =  mysqli_real_escape_string($db, $_REQUEST["bs_id"]); 
        $db->query("DELETE FROM `balance_sheet` WHERE bs_id = '$bs_id' AND a_id = '$a_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../manage_report?msg=" . md5('5') . "");
        break ;

    default:
            $_SESSION['errormsg'] = 'Invalid page access.';
            $_SESSION['errorValue'] = 'warning';

        }


 ?>