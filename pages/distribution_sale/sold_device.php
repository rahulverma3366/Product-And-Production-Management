<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Products Sale');
   define('to', ' Sale Invoice');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<div class="card">
<!--   <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New  Products</span></span></button></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
 -->  <div class="card-datatable table-responsive">
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Actions</th>
          <th>Invoice </th>
          <th>Custumer  Name</th>
          <th>Mobile No</th>
          <th>Email Id</th>
          <th>Total Payment </th>
          <th>Payment Due</th>
          <th>Payment Method</th>
          <th>Order Date</th>
          <th> Date</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $sl = 0;
            $data = $db->query("SELECT * FROM `sale_order` WHERE consumer_id = '$consumer_id' AND user_id = '$a_id' ORDER BY so_id DESC");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td>
               <div class=" align-items-center">
                  <a href="invoice_preview?invoice_no=<?=$value->invoice_no;?>&so_id=<?=$value->so_id;?>" class="btn btn-primary btn-sm form-control"  >Preview</a>
                  <a href="device_sold?invoice_no=<?=$value->invoice_no;?>&so_id=<?=$value->so_id;?>" class="btn btn-info btn-sm form-control mt-2"  >Devices </a>
                  <?php 
                    if ($value->sts == 0) {
                  ?>
                  <a href="action/sale_item?submit=Cancel&so_id=<?=$value->so_id;?>" class="btn btn-danger btn-sm mt-2 form-control">Cancel</a>
                <?php } else { ?>
                  <a href="" class="btn btn-danger btn-sm mt-2 form-control">Canceled</a>

                <?php } ?>

               </div>
            </td>
            <td>#<?=$value->invoice_no;?></td>

            <td><?php  custumer($db, $value->custumer_id,1);?></td>
            <td><?php  custumer($db, $value->custumer_id,2);?></td>
            <td><?php  custumer($db, $value->custumer_id,3);?></td>
            <td><?=$value->total;?></td>
            <td>

              <?php 
                  echo $value->due_amount;
                if ($value->due_amount != 0) {
           ?>
              <button class="btn btn-info btn-sm waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#modalCenter<?=$value->invoice_no;?>">Update</button>
            <?php } ?>                


            </td>
            <td><?=$value->payment_method;?></td>
            <td><?=$value->order_date ?></td>
            <td><?=$value->create_at ?></td>

<div class="modal fade" id="modalCenter<?=$value->invoice_no;?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Update Due </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="action/sale_item" enctype="multipart/form-data">
                    <input type="hidden" name="so_id" value="<?=$value->so_id;?>">
                    <div class="row">
                      <div class="col-md-6 ">
                        <label for="amount" class="form-label">Update Amount</label>
                        <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter Amount">
                      </div>
                      <div class="col-md-6 ">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" id="date" name="payment_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter Name">
                      </div>
                      <div class="col-md-12">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select mb-4">
                           <option value="Cash">Cash</option>
                           <option value="Bank Account">Bank Account</option>
                           <option value="Paypal">Paypal</option>
                           <option value="Card">Credit/Debit Card</option>
                           <option value="UPI Transfer">UPI Transfer</option>
                        </select>
                      </div>
                    </div>
                      <button type="submit" value="due_update" name="submit" class="btn btn-primary waves-effect waves-light">Due Update</button>
                  </form>


                  <div class="row g-2 mt-2">
                      <?php 
                        $mysl = 0;
                        $so_id = $value->so_id;
                        $payment_due = $db->query("SELECT * FROM `sale_due_amount_collect` WHERE so_id = '$so_id'");
                        while ($payment_due_value = $payment_due->fetch_object()) {
                          $mysl++;
                      ?>  
                        <ul class="">
                          <li>Sl - <?=$mysl;?></li>
                          <li>Amount - <?=$payment_due_value->amount;?></li>
                          <li>Payment Method - <?=$payment_due_value->payment_method;?></li>
                          <li>Date - <?=$payment_due_value->payment_date;?></li>
                          <li><a href="action/sale_item?submit=due_delete&pdac_id=<?=$payment_due_value->pdac_id;?>&so_id=<?=$value->so_id;?>&amount=<?=$payment_due_value->amount;?>" class="btn btn-danger btn-sm">Delete</a></li>
                        </ul>
                        <hr>
                    <?php } ?>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- Offcanvas to add new user -->

</div>



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

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
