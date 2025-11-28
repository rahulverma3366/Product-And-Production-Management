<?php 
    session_start();
   include '../../config/config.php';
   $consumer_id = $_SESSION['consumer_id'];
  $bu_id = mysqli_real_escape_string($db, $_REQUEST['bu_id']);
  $data = $db->query("SELECT * FROM `buyers` WHERE bu_id = '$bu_id'");
  $row = $data->fetch_object();
  $a_type = $value->a_type;
  function selected($type,$a_type){
    if ($type == $a_type) {
        echo 'selected';
    }else{
      echo $a_type;
    }
  }
?>
<form action="action/manage_buyers.php" enctype="multipart/form-data">
  <input type="hidden" name="bu_id" value="<?=$row->bu_id?>">
<div class="row" >
 
  <div class="form-group col-lg-12">
   <label for="name" > Name</label>
   <input type="text"  id="name"  placeholder="Name"  class="form-control" name="name" value="<?php if (!empty($row->name)) { echo $row->name; }?>"/>
  </div>
  <div class="form-group col-lg-12">
   <label for="email" > Email</label>
   <input type="text"  id="email"  placeholder="Email"  class="form-control" name="email" value="<?php if (!empty($row->email)) { echo $row->email; }?>"/>
  </div>
  <div class="form-group col-lg-12">
   <label for="phone" > Phone</label>
   <input type="text"  id="phone"  placeholder="Phone"  class="form-control" name="phone" value="<?php if (!empty($row->phone)) { echo $row->phone; }?>"/>
  </div>
  <div class="form-group col-lg-12">
   <label for="state" > State</label>
   <input type="text"  id="state"  placeholder="State"  class="form-control" name="state" value="<?php if (!empty($row->state)) { echo $row->state; }?>"/>
  </div>
  <div class="form-group col-lg-12">
   <label for="address" > Address</label>
   <input type="text"  id="address"  placeholder="Address"  class="form-control" name="address" value="<?php if (!empty($row->address)) { echo $row->address; }?>"/>
  </div>
  <div class="form-group col-lg-12">
   <label for="gst" > Gst</label>
   <input type="text"  id="gst"  placeholder="Gst"  class="form-control" name="gst" value="<?php if (!empty($row->gst)) { echo $row->gst; }?>"/>
  </div>
  
</div>
                  <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>