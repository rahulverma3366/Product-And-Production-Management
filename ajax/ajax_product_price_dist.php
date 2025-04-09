<?php 
	session_start();
	include '../config/config.php';
	if (!empty($_REQUEST['product_id'])) {
		$product_id = $_REQUEST['product_id'];
    $a_id = $_SESSION['a_id'];
    $products = $db->query("SELECT * FROM `sale_data` WHERE product_id = '$product_id' AND custumer_id = '$a_id'");
		if ($products->num_rows == 0) {
			echo "No Data Found";
		}else{
			$products_value = $products->fetch_object();
      $p_id = $products_value->product_id;
      $imei = $db->query("SELECT * FROM `sale_products` WHERE p_id = '$p_id' AND sts = 0 AND sold = 0 AND custumer_id = '$a_id'");
?>	

                                <div class="row">
                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Cost</p>
                                        <input type="number" class="form-control invoice-item-price mb-3" value="<?=$products_value->product_saling_price?>" name="salling_price" placeholder="0" >
                                  </div>
                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Stock</p>
                                    <input type="number" name="stock" readonly class="form-control invoice-item-qty" value="<?=$imei->num_rows?>" placeholder="1" min="1" max="">
                                  </div>

                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Order Quantity</p>
                                    <input type="number" name="qty" class="form-control invoice-item-qty" value="1" placeholder="1" min="1" max="">
                                  </div>

                                </div>


<?php 
	} 
}



?>