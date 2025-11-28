<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Products Sale');
   define('to', ' Device Sold');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
   if (empty($_REQUEST['invoice_no'])) {
        echo '<script>window.location.replace("sold_device.php");</script>';
   }
   $so_id = mysqli_real_escape_string($db,$_REQUEST['so_id']);
   $invoice_no = mysqli_real_escape_string($db,$_REQUEST['invoice_no']);
   $sdata  = $db->query("SELECT * FROM `sale_order` WHERE invoice_no = '$invoice_no' AND so_id = '$so_id'");
   $svalue = $sdata->fetch_object();
   $so_id = $svalue->so_id;
$user_id = $_SESSION['a_id'];
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>

<?php
    $data = $db->query("SELECT * FROM `sale_data` WHERE so_id = '$so_id' AND sts = 1");
    while($value = $data->fetch_object()){
    $product_id = $value->product_id;
    $custumer_id = $value->custumer_id;
?>
<div class="card">
    <div class="card-header bg-info">
        <h3 class="text-white"><?=$value->product_name;?> (<?=$value->qty;?>)</h3>
    </div>
    <div class="card-body">
    <?php   
        $data2 = $db->query("SELECT * FROM `sale_products` WHERE so_id = '$so_id'");
        if($data2->num_rows == 0){
            $limit = $value->qty;
    ?>
                                    <button  type="button" class="btn btn-warning mt-5 btn-wave " data-bs-toggle="modal" data-bs-target="#modal_select_devices">Choose Devices</button>
             
    <?php }else{
       $added = $data2->num_rows;
       $qty = $value->qty;
       if($qty > $added){
            $limit = $qty - $added;
            echo '<button  type="button" class="btn btn-warning mt-5 btn-wave " data-bs-toggle="modal" data-bs-target="#modal_select_devices">Choose Devices</button>';
       }
    ?>
 <div class="card-datatable table-responsive">
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Distributer Name</th>
          <th>Device Model </th>
          <th>IMEI No</th>
          <th>UID No</th>
          <th>CCID No</th>
          <th>Sold ? </th>
          <th>Status ? </th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `sale_products` WHERE so_id = '$so_id'");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td><?php  custumer($db, $svalue->custumer_id,1);?></td>
            <td><?php echo  products($db, $value->p_id);?></td>
            <td><?=$value->imei_no;?></td>
            <td><?=$value->uid_no;?></td>
            <td><?=$value->ccid_no;?></td>
            <td><?php echo sold_check($value->sts);?></td>
            <td></td>
            <td><?=$value->create_at ?></td>

         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <?php } ?>
  <!-- Offcanvas to add new user -->
                    
    </div>
    
</div>


                                    
          <div class="modal modal-top fade" id="modal_select_devices" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTopTitle">Select Devices</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="action/sale_item.php" enctype="multipart/form-data">
                        <input type="hidden" name="so_id" value="<?=$so_id?>">
                        <input type="hidden" name="product_id" value="<?=$product_id?>">
                        <input type="hidden" name="invoice_no" value="<?=$invoice_no?>">
                        <input type="hidden" name="custumer_id" value="<?=$custumer_id?>">

                                    <div class="row" >
                            
                                      <div class="col-md-12 mb-3">
                                       <label for="froms" > Select Devices</label>
                                        <select id="froms" name="sp_id[]" class="selectpicker " data-live-search="true" data-style="btn-default" data-max-options="<?=$limit;?>" multiple  >
                                          <option value="">Select Devices</option>
                                          <?php 
                                             $data = $db->query("SELECT * FROM `sale_products` WHERE sold = 0 AND p_id = '$product_id' AND custumer_id = '$user_id'");
                                             while($data_value = $data->fetch_object()){
                                          ?>
                                             <option value="<?=$data_value->sp_id;?>"><?=$data_value->imei_no?> </option>
                                          <?php } ?>
                                        </select>
                                      </div>

                                  </div>
                                        <button type="submit" value="update_imei" name="submit" class="btn btn-primary waves-effect waves-light">Assign Devices</button>

                            </form>
                                  

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


<?php } ?>


</div>
<!-- / Content -->

<?php 
   include '../../include/footer.php';
 ?>

<!-- Modal -->
          <div class="modal fade " id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Edit Data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


 <script>
$(document).ready(function(){
    $('.openPopup').on('click',function(e){
        e.preventDefault();
        $('#modalCenter').modal('show').find('.modal-body').load($(this).attr('href'));
          }); 
});


</script>
<style>
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 100% !important;
}
</style>
          
   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
