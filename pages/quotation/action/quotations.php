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
        $user_id = $_SESSION['a_id'];

switch ($action) {
	case 'submit':

        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $mobile_no =  mysqli_real_escape_string($db, $_REQUEST["mobile_no"]); 
        $email_id =  mysqli_real_escape_string($db, $_REQUEST["email_id"]); 
        $state =  mysqli_real_escape_string($db, $_REQUEST["state"]); 
        $address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 
        $order_date =  mysqli_real_escape_string($db, $_REQUEST["order_date"]); 
        $invoice_no =  mysqli_real_escape_string($db, $_REQUEST["invoice_no"]); 
        $subtotal =  mysqli_real_escape_string($db, $_REQUEST["subtotal"]); 
        $tax =  mysqli_real_escape_string($db, $_REQUEST["tax"]); 
        $tax_amount =  mysqli_real_escape_string($db, $_REQUEST["tax_amount"]); 
        $total =  mysqli_real_escape_string($db, $_REQUEST["total"]); 
        $paid_amount =  mysqli_real_escape_string($db, $_REQUEST["paid_amount"]); 
        $due_amount =  mysqli_real_escape_string($db, $_REQUEST["due_amount"]); 
        $payment_method =  mysqli_real_escape_string($db, $_REQUEST["payment_method"]); 
        $sto_id =  mysqli_real_escape_string($db, $_REQUEST["sto_id"]); 
        $sl_id =  mysqli_real_escape_string($db, $_REQUEST["sl_id"]); 
        $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 


        $data = $db->query("SELECT * FROM `quotation` WHERE user_id = '$user_id' ");
        if ($data->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $data->num_rows + 1;
        }
  
        $db->query("INSERT INTO `quotation`(`qt_id`,`sto_id`,`sl_id`,`gst_no`,`user_id`, `name`, `mobile_no`, `email_id`, `state`, `address`, `order_date`, `invoice_no`, `subtotal`, `tax`, `tax_amount`, `total`, `paid_amount`, `due_amount`, `payment_method`, `sts`, `create_at`) VALUES ('$qt_id','$sto_id','$sl_id','$gst_no','$user_id','$name','$mobile_no','$email_id','$state','$address','$order_date','$invoice_no','$subtotal','$tax','$tax_amount','$total','$paid_amount','$due_amount','$payment_method','$sts','$create_at')");

        $qt_id = $db->insert_id;
        $product_names = $_REQUEST['product_name'];
        $i = 0;
        foreach ($product_names as $val) {
            $product_name = $_REQUEST['product_name'][$i];
            $amount = $_REQUEST['amount'][$i];
            $qty = $_REQUEST['qty'][$i];
            $total = $_REQUEST['total'][$i];
 
            $db->query("INSERT INTO `quotation_order`(`qo_id`, `qt_id`, `user_id`, `item_name`, `quantity`, `amount`, `total`, `create_at`)
              VALUES ('$qo_id','$qt_id','$user_id','$product_name','$qty','$amount','$total','$create_at')");
          $i++;
         }




        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../quotations?msg=" . md5('5') . "");
        break ;

        case 'due_update':
            
            $po_id = mysqli_real_escape_string($db, $_REQUEST['po_id']);
            $amount = mysqli_real_escape_string($db, $_REQUEST['amount']);
            $payment_date = mysqli_real_escape_string($db, $_REQUEST['payment_date']);
            $payment_method = mysqli_real_escape_string($db, $_REQUEST['payment_method']);
                
            $po_data = $db->query("SELECT * FROM `purchae_order` WHERE po_id = '$po_id'");
            $po_value = $po_data->fetch_object();

            $amount_before = $po_value->due_amount;

            if ($amount_before < $amount) {
                $_SESSION['errormsg'] = ' Amount Greater Then Due Amount.';
                $_SESSION['errorValue'] = 'warning';
                $_SESSION['msg'] = md5('5');
                header("location:../purchase_invoices?msg=" . md5('5') . "");
            }else{
                $db->query("INSERT INTO `purchase_due_amount_collect`(`pdac_id`, `po_id`, `amount`, `payment_method`, `payment_date`, `create_at`) VALUES ('$pdac_id','$po_id','$amount','$payment_method','$payment_date','$create_at')");

                $rest_amount = $amount_before - $amount;

                $db->query("UPDATE `purchae_order` SET due_amount = '$rest_amount' WHERE po_id = '$po_id'");

                $_SESSION['errormsg'] = ' Added successfully.';
                $_SESSION['errorValue'] = 'success';
                $_SESSION['msg'] = md5('5');
                header("location:../purchase_invoices?msg=" . md5('5') . "");
            }

            break;

        case 'due_delete':
            $pdac_id = mysqli_real_escape_string($db,$_REQUEST['pdac_id']);
            $po_id = mysqli_real_escape_string($db,$_REQUEST['po_id']);
            $amount = mysqli_real_escape_string($db,$_REQUEST['amount']);

            $po_data = $db->query("SELECT * FROM `purchae_order` WHERE po_id = '$po_id'");
            $po_value = $po_data->fetch_object();

            $amount_before = $po_value->due_amount;

            $total = $amount_before + $amount;

            $db->query("UPDATE `purchae_order` SET due_amount = '$total' WHERE po_id = '$po_id'");
            $db->query("DELETE FROM `purchase_due_amount_collect` WHERE pdac_id = '$pdac_id'");

                $_SESSION['errormsg'] = 'Deleted successfully.';
                $_SESSION['errorValue'] = 'danger';
                $_SESSION['msg'] = md5('5');
                header("location:../purchase_invoices?msg=" . md5('5') . "");

            break;

        case 'Cancel':

            $po_id = mysqli_real_escape_string($db,$_REQUEST['po_id']);
            $db->query("UPDATE `purchae_order` SET sts = 1 WHERE po_id = '$po_id'");
            $data = $db->query("SELECT * FROM `purchase_data` WHERE po_id = '$po_id'");
            while ($value = $data->fetch_object()) {
                $p_id = $value->p_id;
                $product_id = $value->product_id;
                $product = $db->query("SELECT * FROM `products` WHERE p_id = '$product_id'");
                $product_value = $product->fetch_object();
                $before_qty = $product_value->qty;
                $purchase_qty = $value->qty;
                $rest_qty = $before_qty + $purchase_qty;
                $db->query("UPDATE `products` SET qty = '$rest_qty' WHERE p_id = '$product_id'");
                $db->query("UPDATE `purchase_data` SET sts = '1' WHERE p_id = '$p_id'");
            }


            $_SESSION['errormsg'] = ' Invoice Cancel successfully.';
            $_SESSION['errorValue'] = 'success';
                header("location:../purchase_invoices?msg=" . md5('5') . "");

            break;


    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>