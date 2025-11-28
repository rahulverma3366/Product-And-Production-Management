<?php 
    session_start();
   include '../../config/config.php';
  $sl_id = mysqli_real_escape_string($db, $_REQUEST['sl_id']);
  $data = $db->query("SELECT * FROM `slot` WHERE sl_id = '$sl_id'");
  $row = $data->fetch_object();
?>
<form action="action/action.php" enctype="multipart/form-data">
  <input type="hidden" name="sl_id" value="<?=$row->sl_id?>">
        <div class="row" >
          <div class="mb-3">
           <label for="name" > Slot Name</label>
           <input type="text"  id="name"  placeholder="Product Category"  class="form-control" name="name" value="<?php if (!empty($row->name)) { echo $row->name; }?>"/>
          </div>
          <div class="mb-3">
           <label for="name" > Slot Name</label>
          <select class="form-select" name="status">
             <option value="">Select Slot Status</option>
             <option value="1" <?php if($row->status == 1){echo "selected";}?>>Active</option>
             <option value="2" <?php if($row->status == 2){echo "selected";}?>>De-active</option>
         </select>
          </div>
      </div>
       <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>