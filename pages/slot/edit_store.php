<?php 
    session_start();
   include '../../config/config.php';
  $sto_id = mysqli_real_escape_string($db, $_REQUEST['sto_id']);
  $data = $db->query("SELECT * FROM `stors` WHERE sto_id = '$sto_id'");
  $row = $data->fetch_object();
?>
<form action="action/action.php" enctype="multipart/form-data">
  <input type="hidden" name="sto_id" value="<?=$row->sto_id?>">
        <div class="row" >
          <div class="mb-3">
           <label for="name" > Store Name</label>
           <input type="text"  id="name"  placeholder="Product Category"  class="form-control" name="name" value="<?php if (!empty($row->name)) { echo $row->name; }?>"/>
          </div>
          <div class="mb-3">
           <label for="gst_no" > Gst No</label>
           <input type="text"  id="gst_no"  placeholder="Gst No"  class="form-control" name="gst_no" value="<?php if (!empty($row->gst_no)) { echo $row->gst_no; }?>"/>
          </div>
          <div class="mb-3">
           <label for="mobile" > Mobile</label>
           <input type="text"  id="mobile"  placeholder="Mobile"  class="form-control" name="mobile" value="<?php if (!empty($row->mobile)) { echo $row->mobile; }?>"/>
          </div>
          <div class="mb-3">
           <label for="email" > Email</label>
           <input type="text"  id="email"  placeholder="Email"  class="form-control" name="email" value="<?php if (!empty($row->email)) { echo $row->email; }?>"/>
          </div>
          <div class="mb-3">
           <label for="address" > Address</label>
           <input type="text"  id="address"  placeholder="Address"  class="form-control" name="address" value="<?php if (!empty($row->address)) { echo $row->address; }?>"/>
          </div>
      </div>
       <button type="submit" value="update_store" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>