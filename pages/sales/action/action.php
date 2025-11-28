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
        $date =  date('Y-m-d');
        $consumer_id = $_SESSION['consumer_id'];
        $user_id = $_SESSION['a_id'];

switch ($action) {
    case 'modify':
       echo '<br>$po_id='.$po_id = mysqli_real_escape_string($db, $_REQUEST["po_id"]); 
        echo '<br>$pdac_id='.$pdac_id = mysqli_real_escape_string($db, $_REQUEST["pdac_id"]); 
        echo '<br>$so_id='.$so_id= mysqli_real_escape_string($db, $_REQUEST["so_id"]); 
        echo '<br>$so_id='.$bs_id= mysqli_real_escape_string($db, $_REQUEST["bs_id"]); 

        echo '<br>$name='.$name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        echo '<br>$mobile_no='.$mobile_no =  mysqli_real_escape_string($db, $_REQUEST["mobile_no"]); 
        echo '<br>$email_id='.$email_id =  mysqli_real_escape_string($db, $_REQUEST["email_id"]); 
        echo '<br>$state='.$state =  mysqli_real_escape_string($db, $_REQUEST["state"]); 
        echo '<br>$address='.$address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 
        echo '<br>$supplier_id='.$supplier_id =  mysqli_real_escape_string($db, $_REQUEST["supplier_id"]); 
        echo '<br>$order_date='.$order_date =  mysqli_real_escape_string($db, $_REQUEST["order_date"]); 
        echo '<br>$subtotal='.$subtotal =  mysqli_real_escape_string($db, $_REQUEST["subtotal"]); 
        echo '<br>$tax='.$tax =  mysqli_real_escape_string($db, $_REQUEST["tax"]); 
        echo '<br>$tax_amount='.$tax_amount =  mysqli_real_escape_string($db, $_REQUEST["tax_amount"]); 
        echo '<br>$total='.$total =  mysqli_real_escape_string($db, $_REQUEST["total"]); 
        // $total1 =  mysqli_real_escape_string($db, $_REQUEST["total"]); 
        echo '<br>$product_name='.$product_name =  mysqli_real_escape_string($db, $_REQUEST["product_name"]); 
        echo '<br>$paid_amount='.$paid_amount =  mysqli_real_escape_string($db, $_REQUEST["paid_amount"]); 
        echo '<br>$due_amount='.$due_amount =  mysqli_real_escape_string($db, $_REQUEST["due_amount"]); 
        echo '<br>$payment_method='.$payment_method =  mysqli_real_escape_string($db, $_REQUEST["payment_method"]); 
        echo '<br>$sto_id='.$sto_id =  mysqli_real_escape_string($db, $_REQUEST["sto_id"]); 
        echo '<br>$sl_id='.$sl_id =  mysqli_real_escape_string($db, $_REQUEST["sl_id"]); 
        echo '<br>$gst_no='.$gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        echo '<br>$unit='.$unit =  mysqli_real_escape_string($db, $_REQUEST["unit"]); 
        echo '<br>$invoice_no='.$invoice_no =  mysqli_real_escape_string($db, $_REQUEST["invoice_no"]); 

        $db->query("UPDATE `sales` SET  `po_id`  =  '$po_id', `sto_id`  =  '$sto_id', `sl_id`  =  '$sl_id', `gst_no`  =  '$gst_no', `user_id`  =  '$user_id', `name`  =  '$name', `mobile_no`  =  '$mobile_no', `email_id`  =  '$email_id', `state`  =  '$state', `address`  =  '$address', `supplier_id`  =  '$supplier_id', `order_date`  =  '$order_date', `invoice_no`  =  '$invoice_no', `subtotal`  =  '$subtotal', `tax`  =  '$tax', `tax_amount`  =  '$tax_amount', `total`  =  '$total', `paid_amount`  =  '$paid_amount', `due_amount`  =  '$due_amount', `payment_method`  =  '$payment_method', `update_at`  =  '$update_at' WHERE po_id='$po_id'");


        
        $db->query("UPDATE `sales_due` SET  `pdac_id`  =  '$pdac_id', `po_id`  =  '$po_id', `amount`  =  '$payment_method', `payment_method`  =  '$payment_method', `payment_date`  =  '$payment_date', `update_at`  =  '$update_at' WHERE pdac_id='$pdac_id'");

          $product_names = $_REQUEST['product_name'];
        $i = 0;
        foreach ($product_names as $val) {
            $product_name = $_REQUEST['product_name'][$i];
            $amount = $_REQUEST['unit_price'][$i];
            $qty = $_REQUEST['qty'][$i];
            $total = $_REQUEST['total1'][$i];
            $unit = $_REQUEST['unit'][$i];
    
            
            $db->query("UPDATE `sales_order` SET  `so_id`  =  '$so_id', `sal_id`  =  '$po_id', `unit`  =  '$unit', `user_id`  =  '$user_id', `item_name`  =  '$product_name', `quantity`  =  '$qty', `amount`  =  '$amount', `total`  =  '$total', `update_at`  =  '$update_at' WHERE so_id='$so_id'");

          $i++;
         }

                
$invoice = 'invoice_no_'.$po_id;
$name1 = 'sale';
$db->query("UPDATE `balance_sheet` SET  `bs_id`  =  '$bs_id', `sto_id`  =  '$sto_id', `type`  =  '1', `a_id`  =  '$user_id', `name`  =  '$name1', `amount`  =  '$paid_amount', `date`  =  '$date', `remark`  =  '$remark', `transaction_no`  =  '$transaction_no', `create_at`  =  '$create_at', `update_at`  =  '$update_at' WHERE bs_id='$bs_id'");



        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../sale_invoice_list.php?msg=" . md5('5') . "");
    break;

	case 'submit':
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $mobile_no =  mysqli_real_escape_string($db, $_REQUEST["mobile_no"]); 
        $email_id =  mysqli_real_escape_string($db, $_REQUEST["email_id"]); 
        $state =  mysqli_real_escape_string($db, $_REQUEST["state"]); 
        $address =  mysqli_real_escape_string($db, $_REQUEST["address"]); 
        $supplier_id =  mysqli_real_escape_string($db, $_REQUEST["supplier_id"]); 
        $order_date =  mysqli_real_escape_string($db, $_REQUEST["order_date"]); 
        $subtotal =  mysqli_real_escape_string($db, $_REQUEST["subtotal"]); 
        $tax =  mysqli_real_escape_string($db, $_REQUEST["tax"]); 
        $tax_amount =  mysqli_real_escape_string($db, $_REQUEST["tax_amount"]); 
        $total =  mysqli_real_escape_string($db, $_REQUEST["total"]); 
        // $total1 =  mysqli_real_escape_string($db, $_REQUEST["total"]); 
        $product_name =  mysqli_real_escape_string($db, $_REQUEST["product_name"]); 
        $paid_amount =  mysqli_real_escape_string($db, $_REQUEST["paid_amount"]); 
        $due_amount =  mysqli_real_escape_string($db, $_REQUEST["due_amount"]); 
        $payment_method =  mysqli_real_escape_string($db, $_REQUEST["payment_method"]); 
        $sto_id =  mysqli_real_escape_string($db, $_REQUEST["sto_id"]); 
        $sl_id =  mysqli_real_escape_string($db, $_REQUEST["sl_id"]); 
        $gst_no =  mysqli_real_escape_string($db, $_REQUEST["gst_no"]); 
        $unit =  mysqli_real_escape_string($db, $_REQUEST["unit"]); 
        $gst =  mysqli_real_escape_string($db, $_REQUEST["gst"]); 

        $data = $db->query("SELECT * FROM `sales` WHERE user_id = '$user_id'");
        if ($data->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $data->num_rows + 1;
        }

        $db->query("INSERT INTO `sales`(`po_id`,`sto_id`,`sl_id`,`gst_no`, `user_id`, `name`, `mobile_no`, `email_id`, `state`, `address`, `supplier_id`, `order_date`, `invoice_no`, `subtotal`, `tax`, `tax_amount`, `total`, `paid_amount`, `due_amount`, `payment_method`, `create_at`)
          VALUES ('$po_id','$sto_id','$sl_id','$gst_no','$user_id','$name','$mobile_no','$email_id','$state','$address','$supplier_id','$order_date','$invoice_no','$subtotal','$tax','$tax_amount','$total','$paid_amount','$due_amount','$payment_method','$create_at')");
           

        $po_id = $db->insert_id;
        $db->query("INSERT INTO `sales_due`(`pdac_id`, `po_id`, `amount`, `payment_method`, `payment_date`, `create_at`) VALUES ('$pdac_id','$po_id','$paid_amount','$payment_method','$payment_date','$create_at')");

          $product_names = $_REQUEST['product_name'];
        $i = 0;
        foreach ($product_names as $val) {
            $product_name = $_REQUEST['product_name'][$i];
            $amount = $_REQUEST['unit_price'][$i];
            $qty = $_REQUEST['qty'][$i];
            $total = $_REQUEST['total1'][$i];
            $unit = $_REQUEST['unit'][$i];
            $gst = $_REQUEST['gst'][$i];
    
            
            $db->query("INSERT INTO `sales_order`(`so_id`, `sal_id`,`unit`, `gst`,`user_id`, `item_name`, `quantity`, `amount`, `total`, `create_at`)
              VALUES (NULL,'$po_id','$unit','$gst','$user_id','$product_name','$qty','$amount','$total','$create_at')");
          $i++;
         }

                
$invoice = 'invoice_no_'.$po_id;
$name1 = 'sale';
$db->query("INSERT INTO `balance_sheet`(`bs_id`,`po_id`,`sto_id`, `type`, `a_id`, `name`, `amount`,`date`, `remark`,`transaction_no`, `create_at`, `update_at`)
  VALUES ('$bs_id','$po_id','$sto_id',1,'$user_id','$name1','$paid_amount','$date','$invoice','$po_id','$create_at','$update_at')");


        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../new_sales?msg=" . md5('5') . "");
        break ;

        case 'due_update':
            
            $po_id = mysqli_real_escape_string($db, $_REQUEST['po_id']);
            $amount = mysqli_real_escape_string($db, $_REQUEST['amount']);
            $payment_date = mysqli_real_escape_string($db, $_REQUEST['payment_date']);
            $payment_method = mysqli_real_escape_string($db, $_REQUEST['payment_method']);
                
            $po_data = $db->query("SELECT * FROM `sales` WHERE po_id = '$po_id'");
            $po_value = $po_data->fetch_object();

            $amount_before = $po_value->due_amount;

            if ($amount_before < $amount) {
                $_SESSION['errormsg'] = ' Amount Greater Then Due Amount.';
                $_SESSION['errorValue'] = 'warning';
                $_SESSION['msg'] = md5('5');
                header("location:../purchase_invoices?msg=" . md5('5') . "");
            }else{
                $db->query("INSERT INTO `sales_due`(`pdac_id`, `po_id`, `amount`, `payment_method`, `payment_date`, `create_at`) VALUES ('$pdac_id','$po_id','$amount','$payment_method','$payment_date','$create_at')");
                $pdac_id = $db->insert_id;
                $rest_amount = $amount_before - $amount;
                
                $data = $db->query("SELECT * FROM `sales_due` WHERE po_id = '$po_id'");
                
                $total_due_invoice = $data->num_rows;
                
                $db->query("UPDATE `sales_due` SET invoice_no = '$total_due_invoice' WHERE pdac_id = '$pdac_id'");
                
                $db->query("UPDATE `sales` SET due_amount = '$rest_amount' WHERE po_id = '$po_id'");

$invoice = 'invoice_no_'.$po_id.'_update_invoice_no_'.$total_due_invoice;
$name1 = 'sale_update';
$db->query("INSERT INTO `balance_sheet`(`bs_id`, `type`, `a_id`, `name`, `amount`,`date`, `remark`,`transaction_no`, `create_at`, `update_at`)
  VALUES ('$bs_id',1,'$user_id','$name1','$amount','$date','$invoice','$po_id','$create_at','$update_at')");
  
                $_SESSION['errormsg'] = ' Added successfully.';
                $_SESSION['errorValue'] = 'success';
                $_SESSION['msg'] = md5('5');
                header("location:../sale_invoice_list?msg=" . md5('5') . "");
            }

            break;

        case 'due_delete':
            $pdac_id = mysqli_real_escape_string($db,$_REQUEST['pdac_id']);
            $po_id = mysqli_real_escape_string($db,$_REQUEST['po_id']);
            $amount = mysqli_real_escape_string($db,$_REQUEST['amount']);

            $po_data = $db->query("SELECT * FROM `sales` WHERE po_id = '$po_id'");
            $po_value = $po_data->fetch_object();

            $amount_before = $po_value->due_amount;

            $total = $amount_before + $amount;

            $db->query("UPDATE `sales` SET due_amount = '$total' WHERE po_id = '$po_id'");
            $db->query("DELETE FROM `sales_due` WHERE pdac_id = '$pdac_id'");

                $_SESSION['errormsg'] = 'Deleted successfully.';
                $_SESSION['errorValue'] = 'danger';
                $_SESSION['msg'] = md5('5');
                header("location:../sale_invoice_list?msg=" . md5('5') . "");

            break;

        case 'Cancel':

            $po_id = mysqli_real_escape_string($db,$_REQUEST['po_id']);
            $db->query("UPDATE `sales` SET sts = 1 WHERE po_id = '$po_id'");
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
                header("location:../sale_invoice_list?msg=" . md5('5') . "");

            break;
            case "Delete":
                    $po_id = mysqli_real_escape_string($db,$_REQUEST['po_id']);
                    $db->query("DELETE FROM `sales` WHERE po_id = '$po_id'");
                    $_SESSION['errormsg'] = ' Invoice Deleted successfully.';
            $_SESSION['errorValue'] = 'success';
                header("location:../sale_invoice_list?msg=" . md5('5') . "");
            break;


    default:
        $_SESSION['errormsg'] = 'Invalid page access.';
        $_SESSION['errorValue'] = 'warning';

        }


 ?>