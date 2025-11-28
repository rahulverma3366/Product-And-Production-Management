<?php 
    session_start();
   include '../../config/config.php';
   $consumer_id = $_SESSION['consumer_id'];
  $p_id = mysqli_real_escape_string($db, $_REQUEST['p_id']);
  $data = $db->query("SELECT * FROM `product` WHERE p_id = '$p_id'");
  $row = $data->fetch_object();
?>
<form action="action/manage_product_list.php" enctype="multipart/form-data">
  <input type="hidden" name="p_id" value="<?=$row->p_id?>">
        <div class="row" >

          <div class="mb-3">
           <label for="pn_id" >Select Product</label>
            <select id="pn_id" name="pn_id" class="form-select" >
              <option value="">Select</option>
              <?php 
                 $data = $db->query("SELECT * FROM `product_name`");
                 while($data_value = $data->fetch_object()){
              ?>
                 <option <?php if (!empty($row->pn_id)) { if ($row->pn_id == $data_value->pn_id ) { echo 'selected'; }  }?> value="<?=$data_value->pn_id?>"><?=$data_value->name?> </option>
              <?php } ?>
            </select>
          </div>



          

          <div class="mb-3">
           <label for="qty" > QTY</label>
           <input type="text"  id="qty"  placeholder="Product Qty"  class="form-control" name="qty" value="<?php if (!empty($row->qty)) { echo $row->qty; }?>"/>
          </div>
          <div class="mb-3">
           <label for="unit" > Unit</label>
           <select class="form-select" name="unit">
               <option>Select Unit</option>
               <option <?php if (!empty($row->pn_id)) { if ($row->unit == "cm" ) { echo 'selected'; }  }?> value="cm">CM</option>
               <option  <?php if (!empty($row->pn_id)) { if ($row->unit == "bag" ) { echo 'selected'; }  }?> value="bag">Bag</option>
               
           </select>
          </div>

          
          <div class="mb-3">
           <label for="mp" > Price</label>
           <input type="text"  id="mp"  placeholder="Price"  class="form-control" name="price" value="<?php if (!empty($row->price)) { echo $row->price; }?>"/>
          </div>
         



      </div>
       <button type="submit" value="update_p_list" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>

</form>