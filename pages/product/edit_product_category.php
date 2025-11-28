<?php 
    session_start();
   include '../../config/config.php';
   $consumer_id = $_SESSION['consumer_id'];
  $pc_id = mysqli_real_escape_string($db, $_REQUEST['pc_id']);
  $data = $db->query("SELECT * FROM `product_category` WHERE pc_id = '$pc_id'");
  $row = $data->fetch_object();
?>
<form action="action/manage_product_category.php" enctype="multipart/form-data">
  <input type="hidden" name="pc_id" value="<?=$row->pc_id?>">
        <div class="row" >
          <div class="mb-3">
           <label for="pc_name" > Product Category</label>
           <input type="text"  id="pc_name"  placeholder="Product Category"  class="form-control" name="pc_name" value="<?php if (!empty($row->pc_name)) { echo $row->pc_name; }?>"/>
          </div>
      </div>
       <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>