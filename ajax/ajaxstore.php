<?php 
	session_start();
	include '../config/config.php';
	if (!empty($_REQUEST['store_id'])) {
		$store_id = $_REQUEST['store_id'];
		$vendor = $db->query("SELECT * FROM `stors` WHERE sto_id = '$store_id'");
		if ($vendor->num_rows == 0) {
			echo "No Data Found";
		}else{
			$vendor_value = $vendor->fetch_object();
?>	
            <p class="mb-1">Gst NO:<?=$vendor_value->gst_no?></p>
            <p class="mb-1">Name:<?=$vendor_value->name?></p>
            <p class="mb-1">Mobile:<?=$vendor_value->mobile?></p>
            <p class="mb-1">Email:<?=$vendor_value->email?></p>
            <p class="mb-0">Address:<?=$vendor_value->address?></p>

<?php 
	} 
}



?>