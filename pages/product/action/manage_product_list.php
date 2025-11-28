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
    case 'p_submit':
        $pn_id =  mysqli_real_escape_string($db, $_REQUEST["pn_id"]); 
        $unit =  mysqli_real_escape_string($db, $_REQUEST["unit"]); 
        $price =  mysqli_real_escape_string($db, $_REQUEST["price"]); 
        $qty =  mysqli_real_escape_string($db, $_REQUEST["qty"]); 
        $add_date =  mysqli_real_escape_string($db, $_REQUEST["add_date"]); 
        $db->query("INSERT INTO `product`(`p_id`, `pn_id`, `qty`,`unit`, `price`, `create_at`, `update_at`,`add_date`)
        VALUES ('$p_id','$pn_id','$qty','$unit','$price','$create_at','$update_at','$add_date')");
        
        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../product_list?msg=" . md5('5') . "");
    break;
    
    case 'p_delete':
        $p_id =  mysqli_real_escape_string($db, $_REQUEST["p_id"]); 
        $db->query("DELETE FROM `product` WHERE p_id = '$p_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../product_list?msg=" . md5('5') . "");
    break ;
    case 'update_p_list':
        $pn_id =  mysqli_real_escape_string($db, $_REQUEST["pn_id"]); 
        $p_id =  mysqli_real_escape_string($db, $_REQUEST["p_id"]); 
        $unit =  mysqli_real_escape_string($db, $_REQUEST["unit"]); 
        $price =  mysqli_real_escape_string($db, $_REQUEST["price"]); 
        $qty =  mysqli_real_escape_string($db, $_REQUEST["qty"]); 
        // echo "UPDATE `product` SET  `p_id`  =  '$p_id', `qty`='$qty', `name`  =  '$name', `unit`  =  '$unit', `price`  =  '$price', `update_at`  =  '$update_at' WHERE p_id='$p_id'";
        // die();
        $db->query("UPDATE `product` SET  `p_id`  =  '$p_id', `qty`='$qty', `pn_id`  =  '$pn_id', `unit`  =  '$unit', `price`  =  '$price', `update_at`  =  '$update_at' WHERE p_id='$p_id'");

        $_SESSION['errormsg'] = ' Updated successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../product_list?msg=" . md5('5') . "");
    break;
    case 'p_name_submit':
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]); 
        $slug =  clean($name);
        $db->query("INSERT INTO `product_name`(`pn_id`, `name`, `slug`, `create_at`, `update_at`)
  VALUES ('$pn_id','$name','$slug','$create_at','$update_at')");
  
     $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../product_name?msg=" . md5('5') . "");
    break;
    case 'update_p_name':
        $pn_id =  mysqli_real_escape_string($db, $_REQUEST["pn_id"]); 
        $name =  mysqli_real_escape_string($db, $_REQUEST["name"]);
        $slug =  clean($name);
        $db->query("UPDATE `product_name` SET  `pn_id`  =  '$pn_id', `name`  =  '$name', `slug`  =  '$slug', `update_at`  =  '$update_at' WHERE pn_id='$pn_id'");
        
        $_SESSION['errormsg'] = ' Updated successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../product_name?msg=" . md5('5') . "");
    break;
	case 'submit':
        $po_id =  mysqli_real_escape_string($db, $_REQUEST["po_id"]); 
        $user_id =  mysqli_real_escape_string($db, $_REQUEST["user_id"]); 
        $pc_id =  mysqli_real_escape_string($db, $_REQUEST["pc_id"]); 
        $product_name =  mysqli_real_escape_string($db, $_REQUEST["product_name"]); 
        $mp =  mysqli_real_escape_string($db, $_REQUEST["mp"]); 
        $dp =  mysqli_real_escape_string($db, $_REQUEST["dp"]); 
        $mrp =  mysqli_real_escape_string($db, $_REQUEST["mrp"]); 
        $product_purchase_price =  mysqli_real_escape_string($db, $_REQUEST["product_purchase_price"]); 
        $product_saling_price =  mysqli_real_escape_string($db, $_REQUEST["product_saling_price"]); 
        $product_sku =  mysqli_real_escape_string($db, $_REQUEST["product_sku"]); 
        $qty =  mysqli_real_escape_string($db, $_REQUEST["qty"]); 
        $unit =  mysqli_real_escape_string($db, $_REQUEST["unit"]); 
        $expiry_date =  mysqli_real_escape_string($db, $_REQUEST["expiry_date"]); 
        $hsn_sac =  mysqli_real_escape_string($db, $_REQUEST["hsn_sac"]); 

       
        $db->query("INSERT INTO `products`(`p_id`, `po_id`, `user_id`, `consumer_id`, `pc_id`, `product_name`, `mp`, `dp`, `mrp`, `product_purchase_price`, `product_saling_price`, `product_sku`, `qty`, `unit`, `expiry_date`,`hsn_sac`, `create_at`)
          VALUES (NULL,'$po_id','$user_id','$consumer_id','$pc_id','$product_name','$mp','$dp','$mrp','$product_purchase_price','$product_saling_price','$product_sku','$qty','$unit','$expiry_date','$hsn_sac','$create_at')");


        $_SESSION['errormsg'] = ' Added successfully.';
        $_SESSION['errorValue'] = 'success';
        $_SESSION['msg'] = md5('5');
        header("location:../product_list?msg=" . md5('5') . "");
        break ;
    case 'delete':
        $p_id =  mysqli_real_escape_string($db, $_REQUEST["p_id"]); 
        echo "DELETE FROM `products` WHERE p_id = '$p_id'";
        $db->query("DELETE FROM `products` WHERE p_id = '$p_id' ");
        $_SESSION['errorValue'] = 'danger';
        $_SESSION['errormsg'] = ' Delete successfully.';
        $_SESSION['msg'] = md5('7');
        header("location:../product_list?msg=" . md5('5') . "");
        break ;

    case 'update':

        $p_id =  mysqli_real_escape_string($db, $_REQUEST["p_id"]); 
        $po_id =  mysqli_real_escape_string($db, $_REQUEST["po_id"]); 
        $user_id =  mysqli_real_escape_string($db, $_REQUEST["user_id"]); 
        $consumer_id =  mysqli_real_escape_string($db, $_REQUEST["consumer_id"]); 
        $pc_id =  mysqli_real_escape_string($db, $_REQUEST["pc_id"]); 
        $product_name =  mysqli_real_escape_string($db, $_REQUEST["product_name"]); 
        $mp =  mysqli_real_escape_string($db, $_REQUEST["mp"]); 
        $dp =  mysqli_real_escape_string($db, $_REQUEST["dp"]); 
        $mrp =  mysqli_real_escape_string($db, $_REQUEST["mrp"]); 
        $product_purchase_price =  mysqli_real_escape_string($db, $_REQUEST["product_purchase_price"]); 
        $product_saling_price =  mysqli_real_escape_string($db, $_REQUEST["product_saling_price"]); 
        $product_sku =  mysqli_real_escape_string($db, $_REQUEST["product_sku"]); 
        $qty =  mysqli_real_escape_string($db, $_REQUEST["qty"]); 
        $unit =  mysqli_real_escape_string($db, $_REQUEST["unit"]); 
        $expiry_date =  mysqli_real_escape_string($db, $_REQUEST["expiry_date"]); 
        $hsn_sac =  mysqli_real_escape_string($db, $_REQUEST["hsn_sac"]); 


        $db->query("UPDATE `products` SET  `p_id`  =  '$p_id', `po_id`  =  '$po_id', `user_id`  =  '$user_id', `consumer_id`  =  '$consumer_id', `pc_id`  =  '$pc_id', `product_name`  =  '$product_name', `mp`  =  '$mp', `dp`  =  '$dp', `mrp`  =  '$mrp', `product_purchase_price`  =  '$product_purchase_price', `product_saling_price`  =  '$product_saling_price', `product_sku`  =  '$product_sku', `qty`  =  '$qty', `unit`  =  '$unit', `expiry_date`  =  '$expiry_date',`hsn_sac` = '$hsn_sac', `update_at`  =  '$update_at' WHERE p_id='$p_id'");


        $_SESSION['errormsg'] = ' Update successfully.';
        $_SESSION['errorValue'] = 'success';
        header("location:../product_list?msg=" . md5('5') . "");
    break ;
    default:
            $_SESSION['errormsg'] = 'Invalid page access.';
            $_SESSION['errorValue'] = 'warning';

        }


 ?>