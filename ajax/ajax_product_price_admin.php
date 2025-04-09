<?php 
	session_start();
	include '../config/config.php';
	if (!empty($_REQUEST['product_id'])) {
		$product_id = $_REQUEST['product_id'];
		$products = $db->query("SELECT * FROM `products` WHERE p_id = '$product_id'");
		if ($products->num_rows == 0) {
			echo "No Data Found";
		}else{
			$products_value = $products->fetch_object();
      $p_id = $products_value->p_id;
      $imei = $db->query("SELECT * FROM `imei_update` WHERE p_id = '$p_id' AND sts = 0 AND sold = 0");
?>	

                                <div class="row">
                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Cost</p>
                                        <input type="number" class="form-control invoice-item-price mb-3" value="<?=$products_value->dp?>" name="salling_price" placeholder="0" >
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