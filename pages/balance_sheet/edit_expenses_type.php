<?php 
    session_start();
   include '../../config/config.php';
   $consumer_id = $_SESSION['consumer_id'];
  $et_id = mysqli_real_escape_string($db, $_REQUEST['et_id']);
  $data = $db->query("SELECT * FROM `expenses_type` WHERE et_id = '$et_id'");
  $row = $data->fetch_object();
?>
<form action="action/manage_expenses.php" enctype="multipart/form-data">
  <input type="hidden" name="et_id" value="<?=$row->et_id?>">
        <div class="row" >
        <div class="mb-3">
            <label>Type</label>
            <select class="form-control" name="type">
                <option value="">Select Option</option>
                <option <?php if (!empty($row->type)) {  if($row->type == '1'){ echo 'selected'; }; }?> value="1">Income</option>
                <option <?php if (!empty($row->type)) {  if($row->type == '2'){ echo 'selected'; }; }?> value="2">Expenses</option>
            </select>
        </div>
          <div class="mb-3">
           <label for="expenses_name" > Name</label>
           <input type="text"  id="expenses_name"  placeholder="Name"  class="form-control" name="expenses_name" value="<?php if (!empty($row->expenses_name)) { echo $row->expenses_name; }?>"/>
          </div>
      </div>
       <button type="submit" value="update_expenses_type" name="submit" class="btn btn-primary waves-effect waves-light">Update changes</button>

</form>