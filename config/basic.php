<?php 
	include 'config.php';
	$data = $db->query("SELECT * FROM `setting`");
	while ($value = $data->fetch_object()) {
		define($value->name, $value->value);
	}

 ?>