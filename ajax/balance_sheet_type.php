<?php 
// Include the database config file 
    include '../config/config.php';
 
if(!empty($_POST["types"])){ 
    // Fetch state data based on the specific country 
    $type = trim($_POST["types"]);
    $query = "SELECT * FROM expenses_type WHERE type = ".$type.""; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select   Option</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['expenses_name'].'">'.$row['expenses_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value=""> Not Availble</option>'; 
    } 



}
?>