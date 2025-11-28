<?php 
    session_start();
   include '../../config/config.php';
   $consumer_id = $_SESSION['consumer_id'];
  $vd_id = mysqli_real_escape_string($db, $_REQUEST['vd_id']);
  $data = $db->query("SELECT * FROM `vendor` WHERE vd_id = '$vd_id'");
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
<form action="action/manage_vendor.php" enctype="multipart/form-data">
  <input type="hidden" name="vd_id" value="<?=$row->vd_id?>">
<div class="row" >
  <div class="mb-3">
   <label for="name" > Name</label>
   <input type="text"  id="name"  placeholder="Name"  class="form-control" name="name" value="<?php if (!empty($row->name)) { echo $row->name; }?>"/>
  </div>
  <div class="mb-3">
   <label for="mobile_no" > Mobile No</label>
   <input type="text"  id="mobile_no"  placeholder="Mobile No"  class="form-control" name="mobile_no" value="<?php if (!empty($row->mobile_no)) { echo $row->mobile_no; }?>"/>
  </div>
  <div class="mb-3">
   <label for="email_id" > Email Id</label>
   <input type="text"  id="email_id"  placeholder="Email Id"  class="form-control" name="email_id" value="<?php if (!empty($row->email_id)) { echo $row->email_id; }?>"/>
  </div>
  <div class="mb-3">
   <label for="gst_no" > Gst No</label>
   <input type="text"  id="gst_no"  placeholder="Gst No"  class="form-control" name="gst_no" value="<?php if (!empty($row->gst_no)) { echo $row->gst_no; }?>"/>
  </div>
  <div class="mb-3">
   <label for="img1" > Img1</label>
   <input type="file"  id="img1"  placeholder="Img1"  class="form-control" name="img1" value="<?php if (!empty($row->img1)) { echo $row->img1; }?>"/>
  </div>
  
</div>
                  <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>