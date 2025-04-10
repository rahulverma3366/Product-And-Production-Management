<?php 
	global $curpage;
$curpage = basename($_SERVER['PHP_SELF']);

	function type_of_user($type){
		if ($type == 2) {
			echo '<span class="badge bg-label-primary">Manufacturer</span>';
		}elseif ($type == 3) {
			echo '<span class="badge bg-label-success">Distributer</span>';
		}elseif ($type == 4) {
			echo '<span class="badge bg-label-info">Dealer</span>';
		}elseif($type == 4){
		    
			echo '<span class="badge bg-label-warning">Custumer</span>';

		}else{
			echo 'Oops Not Found';
		}
	}


	function type_of_roles($db, $roll_id){
		$data = $db->query("SELECT * FROM `roles` WHERE r_id = '$roll_id'");
		$value = $data->fetch_object();
		echo $value->roles_name;
	}
	function user($db,$a_id,$type){
		$data = $db->query("SELECT * FROM `admin` WHERE a_id = '$a_id'");
		if ($data->num_rows == 0) {
			echo 'No Found';
		}else{
			$value = $data->fetch_object();
			if ($type == 1) {
				return $value->a_name;
			}elseif($type == 2){
				return $value->a_phone;
			}elseif($type == 3){
				return $value->a_email;
			}elseif($type == 4){
				return $value->a_address;
			}elseif($type == 5){
				return $value->a_gst;
			}else{
				return 'Unknown';
			}
		}

	}
	function vender($db,$vd_id,$type){
		$data = $db->query("SELECT * FROM `vendor`");
		if ($data->num_rows == 0) {
			echo 'Unknown';
		}else{
			$value = $data->fetch_object();
			if ($type == 1) {
				echo $value->name;
			}elseif($type == 2){
				echo $value->mobile_no;
			}elseif($type == 3){
				echo $value->email_id;
			}else{
				echo 'Unknown';
			}
		}

	}
	function product_category($db,$pc_id){
		$data = $db->query("SELECT * FROM `product_category` WHERE pc_id = '$pc_id'");
		if ($data->num_rows == 0) {
			return 'Unknown';
		}else{
			$value = $data->fetch_object();
			return $value->pc_name;
		}
	}

	function products($db,$p_id){
		$data = $db->query("SELECT * FROM `products` WHERE p_id = '$p_id'");
		if ($data->num_rows == 0) {
			return 'Unknown';
		}else{
			$value = $data->fetch_object();
			return $value->product_name;
		}
	}

	function custumer_type($db,$a_id,$type,$a_type){
		$cdata = $db->query("SELECT * FROM `admin` WHERE a_id = '$a_id'");
		if ($cdata->num_rows == 0) {
			return 'Not Found';
		}else{
			$cvalue = $cdata->fetch_object();
			if ($type == 1) {
				return $cvalue->a_type;
			}elseif ($type == 2) {
				if ($a_type == 1) {
					return 'Super Admin';
				}elseif ($a_type == 2) {
					return 'Manufacturer';
				}elseif ($a_type == 3) {
					return 'Distributer';
				}elseif ($a_type == 4) {
					return 'Dealer';
				}elseif ($a_type == 5) {
					return 'Custumer';
				}else{
					return 'Unknown';
				}
			}
		}
	}


	function admin_device($db,$consumer_id,$p_id,$type){
		if ($type == 1) {
			$data = $db->query("SELECT * FROM `imei_update` WHERE consumer_id = '$consumer_id'");  //Total Device We Have Check
			require $data->num_rows;
		}elseif($type == 2){
			$data = $db->query("SELECT * FROM `imei_update` WHERE consumer_id = '$consumer_id' AND p_id = '$p_id'");  //Total Device We Have Check With particular product
			require $data->num_rows;
		}elseif($type == 3){
			$data = $db->query("SELECT * FROM `imei_update` WHERE consumer_id = '$consumer_id' AND p_id = '$p_id' AND sold = 0");  //Total Device We Have Check With particular product not Sold
			require $data->num_rows;
		}elseif($type == 3){
			$data = $db->query("SELECT * FROM `imei_update` WHERE consumer_id = '$consumer_id' AND sold = 0");  //Total Device We Have Check With  not Sold
			require $data->num_rows;
		}
	}

	function sold_check($slod_id){
		if ($slod_id == 0) {
			return 'Not Solds';
		}elseif($slod_id == 3){
			return 'Canceled';
		}else{
		    return 'Sold';
		}
	}



	function custumer($db,$a_id,$type){
		$cdata = $db->query("SELECT * FROM `admin` WHERE a_id = '$a_id'");
		if ($cdata->num_rows == 0) {
			echo 'Unknown';
		}else{
			$cvalue = $cdata->fetch_object();
			if ($type == 1) {
				echo $cvalue->a_name;
			}elseif($type == 2){
				echo $cvalue->a_phone;
			}elseif($type == 3){
				echo $cvalue->a_email;
			}else{
				echo 'Not Found';
			}
		}

	}


	function delivery_zone($db,$from,$type_data){
		$data = $db->query("SELECT * FROM `delivery_zone` WHERE dz_id = '$from'");
		$value = $data->fetch_object();
		if ($type_data == 1) {
			echo $value->area_name;
		}elseif($type_data == 2){
			echo $value->area_name .'('.$value->area_pincode.')';
		}elseif($type_data == 3){
			echo $value->area_pincode;
		}

	}

	function type_of_vehicle($db,$tov_id,$type){
		$data = $db->query("SELECT * FROM `type_of_vehicle` WHERE tov_id = '$tov_id'");
		if ($data->num_rows == 0) {
			echo 'N/A';
		}else{
			$value = $data->fetch_object();
				if ($type == 1) {
					echo $value->vehicle_type;
				}elseif($type == 2){
					echo $value->vehicle_type;
				}
		}

	}

	function date_Mdy($date){
		$date = strtotime($date);
		$date = date('M d,Y',$date);
		return $date;
	}

 ?>