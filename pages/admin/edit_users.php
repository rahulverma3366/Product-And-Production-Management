<?php 
    session_start();
   include '../../config/config.php';
  $a_id = mysqli_real_escape_string($db, $_REQUEST['a_id']);
  $data = $db->query("SELECT * FROM `admin` WHERE a_id = '$a_id'");
  $row = $data->fetch_object();
?>
<form action="action/action.php" enctype="multipart/form-data">
  <input type="hidden" name="sto_id" value="<?=$row->sto_id?>">
        <div class="row" >
          <div class="mb-3">
               <label for="a_name" >  Name</label>
               <input type="text"  id="a_name"  placeholder="A Name"  class="form-control" name="a_name" value="<?php if (!empty($row->a_name)) { echo $row->a_name; }?>"/>
              </div>
              <div class="mb-3">
               <label for="a_email" >  Email</label>
               <input type="text"  id="a_email"  placeholder="A Email"  class="form-control" name="a_email" value="<?php if (!empty($row->a_email)) { echo $row->a_email; }?>"/>
              </div>
              <div class="mb-3">
               <label for="a_phone" >  Phone</label>
               <input type="text"  id="a_phone"  placeholder="A Phone"  class="form-control" name="a_phone" value="<?php if (!empty($row->a_phone)) { echo $row->a_phone; }?>"/>
              </div>
              <div class="mb-3">
               <label for="a_address" >  Address</label>
               <input type="text"  id="a_address"  placeholder="A Address"  class="form-control" name="a_address" value="<?php if (!empty($row->a_address)) { echo $row->a_address; }?>"/>
              </div>
              <div class="mb-3">
               <label for="a_address" >  Type</label>
               <select name="a_type" class="form-select">
                   <option>Select Type</option>
               <option <?php if($row->a_type == 3){echo "selected";}?> value="3">Account</option>
               <option <?php if($row->a_type == 4){echo "selected";}?> value="4">Worker</option>
               </select>
              </div>
              <div class="mb-3">
               <label for="a_vpwd" >  Password</label>
               <input type="text"  id="a_vpwd"  placeholder="A Vpwd"  class="form-control" name="a_vpwd" value="<?php if (!empty($row->a_vpwd)) { echo $row->a_vpwd; }?>"/>
              </div>
      </div>
        <input type="hidden" name="a_id" value="<?= $row->a_id?>">
       <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>