<?php 
	session_start();
	include '../config/config.php';
	if (!empty($_REQUEST['vendor_id'])) {
		$vendor_id = $_REQUEST['vendor_id'];
		$vendor = $db->query("SELECT * FROM `vendor` WHERE vd_id = '$vendor_id'");
		if ($vendor->num_rows == 0) {
			echo "No Data Found";
		}else{
			$vendor_value = $vendor->fetch_object();
?>	
            <p class="mb-1"><?=$vendor_value->name?></p>
            <p class="mb-1"><?=$vendor_value->register_address?></p>
            <p class="mb-1"><?=$vendor_value->mobile_no?></p>
            <p class="mb-1"><?=$vendor_value->email_id?></p>
            <p class="mb-0"><?=$vendor_value->gst_no?></p>

<?php 
	} 
}



?>