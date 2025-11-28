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

switch ($action) {
    case 'submit':

            $p_id = mysqli_real_escape_string($db,$_POST['p_id']);
            $excels = $_FILES['excel']['name'];
            if ($excels == '') {
            } else {
                $expbanner     = explode('.', $excels);
                $bannerexptype = end($expbanner);
                $allowedTypes  = array(
                    'csv',
                    'xlsx'
                );
                $detectedType  = pathinfo($_FILES['excel']['name'], PATHINFO_EXTENSION);
                if (!in_array($detectedType, $allowedTypes)) {
                    echo 'Not Match';
                } else {
                    $date       = date('m/d/Yh:i:sa', time());
                    $rand       = rand(10000, 99999);
                    $encname    = 'GPS-' . $rand;
                    $bannername = $encname . '.' . $bannerexptype;
                    $bannerpath = "../../../uploads/" . $bannername;
                    // move_uploaded_file($_FILES["excel"]["tmp_name"], $bannerpath);
                    // $db->query("INSERT INTO `excel_file`(`ef_id`, `file_name`,`type`,`date`) VALUES (NULL, '$bannername','$data_type' ,'$dates')");
                    $excelstemp = $_FILES["excel"]["tmp_name"];

                    $reader = ReaderFactory::create(Type::XLSX);
                    $reader->open($_FILES["excel"]["tmp_name"]);
                    $sql = "";
                    foreach ($reader->getSheetIterator() as $sheet) {
                        if ($sheet->getIndex() == 0) {
                            foreach ($sheet->getRowIterator() as $row) {
                                set_time_limit(0);
                                
                                $jsonEncodedRow = json_encode($row);
                                $jsonDecodedRow = json_decode($jsonEncodedRow, true);

                                $imei_no = mysqli_real_escape_string($db, $jsonDecodedRow[0]);
                                $uid_no = mysqli_real_escape_string($db, $jsonDecodedRow[1]);
                                $ccid_no = mysqli_real_escape_string($db, $jsonDecodedRow[2]);
                                $check = $db->query("SELECT * FROM `imei_update` WHERE $imei_no = 'imei_no'");
                                if($check->num_rows == 0){
                                    $db->query("INSERT INTO `imei_update`(`imei_id`, `p_id`,`imei_no`,`uid_no`,`ccid_no`,`consumer_id`, `create_at`)
                                      VALUES (NULL,'$p_id','$imei_no','$uid_no','$ccid_no','$consumer_id','$create_at')");
                                }

                            }
                        }
                    }

                }
            }

        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../imei_update?msg=" . md5('5') . "");
        break ;
    case 'delete':
        $imei_id =  mysqli_real_escape_string($db, $_REQUEST["imei_id"]); 
        $db->query("DELETE FROM `imei_update` WHERE imei_id = '$imei_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../imei_update?msg=" . md5('5') . "");
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
            
    case 'delete_multiple':
        
        $imei_ids = $_REQUEST['imei_id'];

        $i = 0;
        
        foreach($imei_ids as $val){
            $imei_id = $_REQUEST['imei_id'][$i];
                $db->query("DELETE FROM `imei_update` WHERE imei_id = '$imei_id' ");
                $db->query("UPDATE `imei_update` SET trash = 1 WHERE imei_id = '$imei_id' ");

            $i ++;
        }
        
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../imei_update?msg=" . md5('5') . "");
            break ;
            
    case 'undo_multiple':
        
        $imei_ids = $_REQUEST['imei_id'];

        $i = 0;
        
        foreach($imei_ids as $val){
            $imei_id = $_REQUEST['imei_id'][$i];
                $db->query("DELETE FROM `imei_update` WHERE imei_id = '$imei_id' ");
                $db->query("UPDATE `imei_update` SET trash = 0 WHERE imei_id = '$imei_id' ");

            $i ++;
        }
        
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../imei_update?msg=" . md5('5') . "");
            break ;

    default:
            $_SESSION['errormsg'] = 'Invalid page access.';
            $_SESSION['errorValue'] = 'warning';

        }


 ?>