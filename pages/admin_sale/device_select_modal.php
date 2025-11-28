<?php 
    session_start();
   include '../../config/config.php';
   include '../../config/basic.php';
   $consumer_id = $_SESSION['consumer_id'];
  $product_id = mysqli_real_escape_string($db, $_REQUEST['product_id']);
    
  

?>
<link rel="stylesheet" href="<?=website_name;?>/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"  crossorigin="anonymous"></script>

  <script src="<?=website_name;?>/assets/vendor/libs/popper/popper.js"></script>
  <script src="<?=website_name;?>/assets/vendor/js/bootstrap.js"></script>

    <script src="<?=website_name;?>/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    
  <script src="<?=website_name;?>/assets/js/main.js"></script>

    
  <script src="../../assets/js/forms-selects.js"></script>

<form action="action/manage_delivery_locations.php" enctype="multipart/form-data">
  <input type="hidden" name="product_id" value="<?=$row->product_id?>">
        <div class="row" >

          <div class="mb-3">
           <label for="froms" > Select Devices</label>
            <select id="froms" name="devices" class="selectpicker " data-live-search="true" data-style="btn-default"  >
              <option value="">Select Devices</option>
              <?php 
                 $data = $db->query("SELECT * FROM `imei_update` ");
                 while($data_value = $data->fetch_object()){
              ?>
                 <option value="<?=$data_value->imei_id?>"><?=$data_value->imei_no?> </option>
              <?php } ?>
            </select>
          </div>



      </div>
       <button type="submit" value="update" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>

