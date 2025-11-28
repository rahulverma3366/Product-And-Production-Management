<?php 
session_start();
require_once '../../../config/config.php';
include '../../../include/function.php';

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
        $date = date('Y-m-d');
        
$a_id = $_SESSION['a_id'];
switch ($action) {
	case 'submit':

        $custumer_id =  mysqli_real_escape_string($db, $_REQUEST["custumer_id"]); 
        $custumer_type = custumer_type($db,$custumer_id,1,'');
        $order_date =  mysqli_real_escape_string($db, $_REQUEST["order_date"]); 
        $subtotal =  mysqli_real_escape_string($db, $_REQUEST["subtotal"]); 
        $tax =  mysqli_real_escape_string($db, $_REQUEST["tax"]); 
        $tax_amount =  mysqli_real_escape_string($db, $_REQUEST["tax_amount"]); 
        $total =  mysqli_real_escape_string($db, $_REQUEST["total"]); 
        $paid_amount =  mysqli_real_escape_string($db, $_REQUEST["paid_amount"]); 
        $due_amount =  mysqli_real_escape_string($db, $_REQUEST["due_amount"]); 
        $payment_method =  mysqli_real_escape_string($db, $_REQUEST["payment_method"]); 

        $data = $db->query("SELECT * FROM `sale_order` WHERE user_id = '$user_id' AND consumer_id = '$consumer_id'");
        if ($data->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $data->num_rows + 1;
        }

        $db->query("INSERT INTO `sale_order`(`so_id`, `user_id`, `consumer_id`, `custumer_id`, `order_date`, `invoice_no`, `subtotal`, `tax`, `tax_amount`, `total`, `paid_amount`, `due_amount`, `payment_method`, `create_at`)
          VALUES ('$so_id','$user_id','$consumer_id','$custumer_id','$order_date','$invoice_no','$subtotal','$tax','$tax_amount','$total','$paid_amount','$due_amount','$payment_method','$create_at')");

        $so_id = $db->insert_id;
        $s_ids = $_REQUEST['s_id'];
        $i = 0;
        foreach ($s_ids as $val) {
            $s_id = $_REQUEST['s_id'][$i];
            $product_name = $_REQUEST['product_name'][$i];
            $product_saling_price = $_REQUEST['product_saling_price'][$i];
            $product_id = $_REQUEST['product_id'][$i];
            $qty = $_REQUEST['qty'][$i];
            $cdata = $db->query("SELECT * FROM `sale_products` WHERE custumer_id = '$user_id' AND p_id = '$product_id' AND sold = 0");
            $qty_ihave = $cdata->num_rows;  // Find Out How much device not sold 

            $msgs = '';
            if ($qty_ihave < $qty) {
                $msgs = '& Some Product not checkout';
            }else{

                    $db->query("UPDATE `sale_data` SET sts = 1 , so_id = '$so_id' WHERE s_id = '$s_id'");
            }
          $i++;
         }


        $db->query("INSERT INTO `balance_sheet`(`bs_id`,`a_id`,`type`,`name`,`amount`,`date`,`remark`,`create_at`)
          VALUES (NULL,'$a_id','1','Sale Devices','$paid_amount','$date','Devices Sold','$create_at')");


        $_SESSION['errormsg'] = ' Sale successfully successfully. '.$msgs;
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../sold_device?msg=" . md5('5') . "");
        break;
        
        
        
        
        
        case 'update_imei':
            
        $sp_ids = $_REQUEST['sp_id'];
        $so_id = $_REQUEST['so_id'];

        $product_id = $_REQUEST['product_id'];
        $invoice_no = $_REQUEST['invoice_no'];
        $custumer_id =  mysqli_real_escape_string($db, $_REQUEST["custumer_id"]); 
        $custumer_type = custumer_type($db,$custumer_id,1,'');

        $i = 0;
        foreach ($sp_ids as $val) {
                $sp_id = $_REQUEST['sp_id'][$i];
                $imeidata = $db->query("SELECT * FROM `sale_products` WHERE sp_id = '$sp_id'");
                while($imeivalue = $imeidata->fetch_object()){
                    $imei_no = $imeivalue->imei_no;
                    $uid_no = $imeivalue->uid_no;
                    $ccid_no = $imeivalue->ccid_no;
                    $db->query("UPDATE `sale_products` SET sold = 1  WHERE sp_id = '$sp_id'");
                    $db->query("INSERT INTO `sale_products`(`sp_id`, `so_id`,`user_id`, `custumer_id`, `custumer_type`, `imei_no`, `uid_no`, `ccid_no`, `sts`,`p_id`, `create_at`) VALUES (NULL,'$so_id','$user_id','$custumer_id','$custumer_type','$imei_no','$uid_no','$ccid_no','0','$product_id','$create_at')");
                }
          $i++;

        }

        $_SESSION['errormsg'] = ' Sale successfully successfully. '.$msgs;
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../device_sold?invoice_no=".$invoice_no."&so_id=".$so_id);

        break;
        
        
        
        
        
        
        
        
        
        
        
        
        
        case 'add_products':
            $custumer_id = mysqli_real_escape_string($db,$_REQUEST['custumer_id']);
            $p_id = mysqli_real_escape_string($db,$_REQUEST['p_id']);
            $product = $db->query("SELECT * FROM `products` WHERE p_id = '$p_id'");
            $product_value = $product->fetch_object();
            $product_name = $product_value->product_name;
            $mrp = $product_value->mrp;
            $product_sku = $product_value->product_sku;
            $expiry_date = $product_value->expiry_date;
            $salling_price = mysqli_real_escape_string($db,$_REQUEST['salling_price']);
            if ($salling_price < $mrp) {

            $qty = mysqli_real_escape_string($db,$_REQUEST['qty']);
            $imei = $db->query("SELECT * FROM `imei_update` WHERE p_id = '$p_id' AND sts = 0 AND sold = 0");
            $stock = $imei->num_rows;
            if ($stock > $qty) {
   
            $db->query("INSERT INTO `sale_data`(`s_id`,`consumer_id`,`user_id`,`custumer_id`,`product_id`,`so_id`, `product_name`, `mrp`,`product_saling_price`, `product_sku`, `qty`, `create_at`) VALUES (NULL,'$consumer_id','$user_id','$custumer_id','$p_id','$so_id','$product_name','$mrp','$salling_price','$product_sku','$qty','$create_at')");

            $_SESSION['errormsg'] = ' Added successfully.';
            $_SESSION['errorValue'] = 'success';
        }else{
            $_SESSION['errormsg'] = 'Stock is less then order Quantity.';
            $_SESSION['errorValue'] = 'warning';
        }
    }else{
            $_SESSION['errormsg'] = 'Price More then MRP.';
            $_SESSION['errorValue'] = 'warning';

    }
            header("location:../sale_device?cs_id=".$custumer_id);

        break;

        case 'delete_sale_product':
            
                $s_id = mysqli_real_escape_string($db,$_REQUEST['s_id']);
                $c_id = mysqli_real_escape_string($db,$_REQUEST['c_id']);
                $db->query("DELETE FROM `sale_data` WHERE s_id = '$s_id' ");

                $_SESSION['errormsg'] = 'Product deleted.';
                $_SESSION['errorValue'] = 'danger';
                header("location:../sale_device?cs_id=".$c_id);

            break;


        case 'due_update':
            
            $so_id = mysqli_real_escape_string($db, $_REQUEST['so_id']);
            $amount = mysqli_real_escape_string($db, $_REQUEST['amount']);
            $payment_date = mysqli_real_escape_string($db, $_REQUEST['payment_date']);
            $payment_method = mysqli_real_escape_string($db, $_REQUEST['payment_method']);
                
            $po_data = $db->query("SELECT * FROM `sale_order` WHERE so_id = '$so_id'");
            $po_value = $po_data->fetch_object();

            $amount_before = $po_value->due_amount;

            if ($amount_before < $amount) {
                $_SESSION['errormsg'] = ' Amount Greater Then Due Amount.';
                $_SESSION['errorValue'] = 'warning';
                $_SESSION['msg'] = md5('5');
                header("location:../sold_device?msg=" . md5('5') . "");
            }else{
                $db->query("INSERT INTO `sale_due_amount_collect`(`pdac_id`, `so_id`, `amount`, `payment_method`, `payment_date`, `create_at`) VALUES ('$pdac_id','$so_id','$amount','$payment_method','$payment_date','$create_at')");

                $rest_amount = $amount_before - $amount;

                $db->query("UPDATE `sale_order` SET due_amount = '$rest_amount' WHERE so_id = '$so_id'");
        $db->query("INSERT INTO `balance_sheet`(`bs_id`,`a_id`,`type`,`name`,`amount`,`date`,`remark`,`create_at`)
          VALUES (NULL,'$a_id','1','Sale Devices','$amount','$date','Due Amount Update','$create_at')");

                $_SESSION['errormsg'] = ' Added successfully.';
                $_SESSION['errorValue'] = 'success';
                $_SESSION['msg'] = md5('5');
                header("location:../sold_device?msg=" . md5('5') . "");
            }

            break;

        case 'due_delete':
            $pdac_id = mysqli_real_escape_string($db,$_REQUEST['pdac_id']);
            $so_id = mysqli_real_escape_string($db,$_REQUEST['so_id']);
            $amount = mysqli_real_escape_string($db,$_REQUEST['amount']);

            $po_data = $db->query("SELECT * FROM `sale_order` WHERE so_id = '$so_id'");
            $po_value = $po_data->fetch_object();

            $amount_before = $po_value->due_amount;

            $total = $amount_before + $amount;

            $db->query("UPDATE `sale_order` SET due_amount = '$total' WHERE so_id = '$so_id'");
            $db->query("DELETE FROM `sale_due_amount_collect` WHERE pdac_id = '$pdac_id'");
        $db->query("INSERT INTO `balance_sheet`(`bs_id`,`a_id`,`type`,`name`,`amount`,`date`,`remark`,`create_at`)
          VALUES (NULL,'$a_id','2','Sale Devices Cancelled','$amount','$date','Due Amount Delete','$create_at')");

                $_SESSION['errormsg'] = 'Deleted successfully.';
                $_SESSION['errorValue'] = 'danger';
                $_SESSION['msg'] = md5('5');
                header("location:../sold_device?msg=" . md5('5') . "");

            break;

        case 'Cancel':

            $so_id = mysqli_real_escape_string($db,$_REQUEST['so_id']);
           $db->query("UPDATE `sale_order` SET sts = 1 WHERE so_id = '$so_id'");
         $db->query("SELECT * FROM `sale_data` WHERE so_id = '$so_id'");
            $data = $db->query("SELECT * FROM `sale_products`  WHERE so_id = '$so_id'");
            while($value = $data->fetch_object()){
                $sp_id = $value->sp_id;
                $imei_no = $value->imei_no;

              $db->query("UPDATE `sale_products` SET sold = 0 WHERE imei_no = '$imei_no' AND custumer_id = '$a_id' ");
               $db->query("UPDATE `sale_products` SET sts = 3 WHERE so_id = '$so_id'");
                
            }

  

            $_SESSION['errormsg'] = ' Invoice Cancel successfully.';
            $_SESSION['errorValue'] = 'success';
                header("location:../sold_device?msg=" . md5('5') . "");

            break;


    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>