<?php 
    session_start();
   include '../../config/config.php';
//   $consumer_id = $_SESSION['consumer_id'];
  $pn_id = mysqli_real_escape_string($db, $_REQUEST['pn_id']);
  $data = $db->query("SELECT * FROM `product_name` WHERE pn_id = '$pn_id'");
  $row = $data->fetch_object();
?>
<form action="action/manage_product_list.php" enctype="multipart/form-data">
  <input type="hidden" name="pn_id" value="<?=$row->pn_id?>">
        <div class="row" >
          <div class="mb-3">
           <label for="name" > Product Name (Model Name)</label>
           <input type="text"  id="name"  placeholder="Product Category"  class="form-control" name="name" value="<?php if (!empty($row->name)) { echo $row->name; }?>"/>
          </div>
      </div>
       <button type="submit" value="update_p_name" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>