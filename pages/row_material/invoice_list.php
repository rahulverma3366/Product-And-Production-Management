<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Products Purchase');
   define('to', ' Purchase Invoice');
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
 <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <!--<div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New  Products</span></span></button></div>-->
       <div class="col-md-8 user_plan">
          <form action="" class="mt-3" method="GET">
                                       <!--<h3>Filter</h3>-->
                                       <div class="row">
                                          <div class="col-md-3"><input type="date" class="form-control" name="start_date" placeholder="date"></div>
                                          <div class="col-md-3"><input type="date"  class="form-control" name="end_date" placeholder="date"></div>
                                          <div class="col-md-6">
                                          <button type="submit" name="submit" class="btn btn-primary">Search Data</button>
                                          <a class="btn btn-primary" href="manage_report">All Data</a>
                                          </div>
                                       </div>
                                       <br>
                                    </form>
      </div>
      <!--<div class="col-md-2 user_status"></div>-->
    </div>
  </div>
<div class="card-datatable table-responsive">
    <table class="table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Actions</th>
          <th>Invoice </th>
          <th>Suplier Name</th>
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
                                             if($a_type==3||$a_type==4){
                                                 
                                                 $data = $db->query("SELECT * FROM `purchae_order` WHERE user_id='$user_id' AND sts = 0");
                                             }else{
                                             $data = $db->query("SELECT * FROM `purchae_order` WHERE sts = 0");
                                             }
                                            //     $data = $db->query("SELECT * FROM `purchae_order` ORDER BY po_id DESC");
                                            //  if(isset($_GET['start_date']) && isset($_GET['end_date'])){
                                            //     $start_date=  $_GET['start_date'];
                                            //     $end_date=  $_GET['end_date'];
                                            //     $data= $db->query("SELECT * FROM `purchae_order` WHERE create_at BETWEEN '$start_date' AND '$end_date'");
                                            //     echo "Start Date: $start_date | ";
                                            //     echo "End Date: $end_date ";
                                            //  }else{
                                            //  $data = $db->query("SELECT * FROM `purchae_order`");

           
            while ($value = $data->fetch_object()) {
                $supplier_id = $value->supplier_id;
                $s_data = $db->query("SELECT * FROM `vendor` WHERE vd_id = '$supplier_id'");
                $s_value = $s_data->fetch_object();
               $sl++;
         ?>
         <tr>
            <td><?= $sl;?></td>
            <td>
               <div class=" align-items-center">
                  <a href="#" class="btn btn-primary btn-sm form-control" onclick="printPage()" >print</a>
                  <?php 
                    if ($value->sts == 0) {
                  ?>
                  <!--<a href="action/action?submit=Cancel&po_id=<?=$value->po_id;?>" class="btn btn-danger btn-sm mt-2 form-control">Cancel</a>-->
                  <a href="action/action?submit=Delete&po_id=<?=$value->po_id;?>" class="btn btn-danger btn-sm mt-2 form-control">Cancel</a>
                <?php } else { ?>
                  <a href="" class="btn btn-danger btn-sm mt-2 form-control">Canceled</a>

                <?php } ?>

               </div>
            </td>
            <td><?=$value->invoice_no;?></td>

            <td><?= $s_value->name?></td>
            <td><?= $s_value->email_id?></td>
            <td><?= $s_value->mobile_no?></td>
            <td><?=$value->total;?></td>
            <td>

              <?php 
                  echo $value->due_amount;
                if ($value->due_amount != 0) {
           ?>
              <br><button class="btn btn-info btn-sm waves-effect waves-light"  data-bs-toggle="modal" data-bs-target="#modalCenter<?=$sl?>">Update</button>
            <?php } ?>                


            </td>
            <td><?=$value->payment_method;?></td>
            <td><?=$value->order_date ?></td>
            <td><?=$value->create_at ?></td>

<div class="modal fade" id="modalCenter<?=$sl?>" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Update Due</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="action/action" enctype="multipart/form-data">
                    <input type="hidden" name="po_id" value="<?=$value->po_id;?>">
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
                         $modal_sl = 0; // Separate variable for modal SL
                        $po_id = $value->po_id;
                        $payment_due = $db->query("SELECT * FROM `purchase_due_amount_collect` WHERE po_id = '$po_id'");
                        while ($payment_due_value = $payment_due->fetch_object()) {
                          $modal_sl++;
                      ?>  
                        <ul class="">
                          <li>Sl - <?=$modal_sl;?></li>
                          <li>Amount - <?=$payment_due_value->amount;?></li>
                          <li>Payment Method - <?=$payment_due_value->payment_method;?></li>
                          <li>Date - <?=$payment_due_value->payment_date;?></li>
                          <li><a href="action/action?submit=due_delete&pdac_id=<?=$payment_due_value->pdac_id;?>&po_id=<?=$value->po_id;?>&amount=<?=$payment_due_value->amount;?>" class="btn btn-danger btn-sm">Delete</a></li>
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
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Supplier</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/action.php" method="POST" enctype="multipart/form-data" >
        <div class="mb-3">
         <label for="name" > Name</label>
         <input type="text"  id="name"  placeholder="Name"  class="form-control" name="name" value=""/>
        </div>
        <div class="mb-3">
         <label for="mobile_no" > Mobile No</label>
         <input type="text"  id="mobile_no"  placeholder="Mobile No"  class="form-control" name="mobile_no" value=""/>
        </div>
        <div class="mb-3">
         <label for="email_id" > Email Id</label>
         <input type="text"  id="email_id"  placeholder="Email Id"  class="form-control" name="email_id" value=""/>
        </div>
        <div class="mb-3">
         <label for="gst_no" > Gst No</label>
         <input type="text"  id="gst_no"  placeholder="Gst No"  class="form-control" name="gst_no" value=""/>
        </div>
        <div class="mb-3">
         <label for="img1" > GST Certificate</label>
         <input type="file"  id="img1"  placeholder="Img1"  class="form-control" name="img1" value=""/>
        </div>
        <div class="mb-3">
         <label for="img2" > Other Documents</label>
         <input type="file"  id="img2"  placeholder="Img2"  class="form-control" name="img2" value=""/>
        </div>
        <div class="mb-3">
         <label for="register_address" > Register Address</label>
         <textarea name="register_address" placeholder="Register Address" class="form-control" id="" ></textarea>
        </div>

        <button type="submit" name="submit" value="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
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



function printPage() {
            window.print(); // Opens the print dialog
        }


</script>

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
