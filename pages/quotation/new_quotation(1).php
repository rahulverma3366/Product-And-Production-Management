<?php 

   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Sale ');
   define('to', 'New Sale');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 

   $a_id = $_SESSION['a_id'];
   $store = $db->query("SELECT * FROM `store_setting` WHERE user_id = '$a_id'");
   $store_value = $store->fetch_object();

        $datas = $db->query("SELECT * FROM `quotation` WHERE user_id = '$a_id' ");
        if ($datas->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $datas->num_rows + 1;
        }
    $c_id = mysqli_real_escape_string($db,$_REQUEST['cs_id']);
    $cst = $db->query("SELECT * FROM `admin` WHERE a_id = '1'");
    $cst_value = $cst->fetch_object();

?>
<style>
    .center{
        margin-right: auto !important;
        margin-left: auto !important; 
        display: block !important; 
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<form action="action/quotations.php" enctype="multipart/form-data">
    <input type="hidden" name="custumer_id" value="<?=$c_id;?>">
   <div class="row invoice-add">
      <!-- Invoice Add-->
      <div class="col-lg-9 col-12 mb-lg-0 mb-4">
         <div class="card invoice-preview-card">
            <div class="card-body">
               <div class="row m-sm-4 m-0">
                  <div class="col-md-6 mb-md-0 mb-4 ps-0">
                     <div class="d-flex svg-illustration mb-4  align-items-center">
                        <span class="app-brand-text fw-bold fs-4" style="margin-left: 0px !important;">
                          <?=$store_value->store_name?>
                        </span>
                     </div>
                     
                        <p class="mb-1">  <?=$store_value->store_name?></p>
                        <p class="mb-1"><?=$store_value->store_address?></p>
                        <p class="mb-1"><?=$store_value->store_email_id?></p>
                        <p class="mb-1"><?=$store_value->store_mobile_no?></p>
                        <p class="mb-0"><?=$store_value->store_gst?></p>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                        <span class="fw-normal"><b>Slot Name:</b></span>
                     <select name='sl_id' id="slot_id" class="form-select">
                                <option>Select Slot</option>
                               <?php 
                                $store_data=$db->query("SELECT * FROM `slot` WHERE status=1");
                                while($store_value=$store_data->fetch_object()){
                               ?>
                                <option value="<?= $store_value->sl_id;?>"><?= $store_value->name;?></option>
                               <?php }?>
                           </select>
                           </div>
                           </div>
                  </div>
                  <div class="col-md-6">
                     <dl class="row mb-2">
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                           <div class="input-group input-group-merge disabled w-px-150">
                              <span class="input-group-text">#</span>
                              <input type="text" class="form-control" disabled="" name="invoice_no" placeholder="<?=$invoice_no;?>" value="<?=$invoice_no;?>" id="invoiceId">
                           </div>
                        </dd>
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="fw-normal">Date:</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                           <input type="date" name="order_date" value="<?php echo date('Y-m-d'); ?>" class="form-control w-px-150 date-picker flatpickr-input" placeholder="YYYY-MM-DD" >
                        </dd>
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="fw-normal">Store:</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                           <select name='sto_id' id="store_id" class="form-select">
                                <option>Select</option>
                               <?php 
                                $store_data=$db->query("SELECT * FROM `stors`");
                                while($store_value=$store_data->fetch_object()){
                               ?>
                                <option value="<?= $store_value->sto_id;?>"><?= $store_value->name;?></option>
                               <?php }?>
                           </select>
                        </dd>
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="fw-normal">Store Details:</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2 mt-4">
                           <div id="section"></div>
                        </dd>
<!--                         <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="fw-normal">Due Date:</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                           <input type="date" class="form-control w-px-150 date-picker flatpickr-input" placeholder="YYYY-MM-DD" >
                        </dd>
 -->                     </dl>



                  </div>
               </div>
               <hr class="my-3 mx-n4">
                    <div class="row p-sm-4 p-0">
                      <div class="col-md-12 col-sm-7">
                        <h6 class="mb-4">Sale To:</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-4">
                                <label>Email Id</label>
                                <input type="email" class="form-control" name="email_id" placeholder="email id">
                            </div>
                            <div class="col-md-4">
                                <label>Phone No</label>
                                <input type="text" class="form-control" name="mobile_no" placeholder="Phone No">
                            </div>

                            <div class="col-md-4">
                                <label>State </label>
                                    <select name="state" id="state" class="selectpicker" data-live-search="true" data-style="btn-default">
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option selected value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                    </select>

                            </div>
                            <div class="col-md-4">
                                <label>Address</label>
                                <textarea class="form-control" name="address"></textarea>
                            </div>
                            <div class="col-md-4">
                                <labe>GST No.</labe>
                                                                <input type="text" class="form-control" name="gst_no" placeholder="Gst No">
                            </div>
                            
                            
                            
                        </div>
                      </div>
                    </div>               
               <hr class="my-3 mx-n4">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="invoiceItem"> 
                          <tr>
                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                            <th width="30%">Item Name</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Price</th>                
                            <th width="20%">Total</th>
                          </tr>             
                          <tr>
                            <td><input class="itemRow" type="checkbox"></td>
                            <td>
                                <input type="text" name="product_name[]" id="productName_1" class="form-control" autocomplete="off"></td>      
                            <td><input type="number" name="qty[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                            <td><input type="number" name="amount[]" id="price_1" class="form-control price" autocomplete="off"></td>
                            <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                          </tr>           
                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                        <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                        <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
                      </div>
                    </div>

               <hr class="my-3 mx-n4">

               <div class="row">
                 
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
          </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
          </div>

          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
            <span class="form-inline">
                

                
              <div class="form-group">
                <label>Subtotal: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="<?=$totals?>" type="text" class="form-control" name="subtotal" id="subTotal" placeholder="Subtotal">
                </div>
              </div>
              
              
              <div class="form-group">
                <label>Tax Rate: &nbsp;</label>
                <div class="input-group">
                  <input value="" type="text" class="form-control" name="tax" id="taxRate" placeholder="Tax Rate">
                  <div class="input-group-text">%</div>
                </div>
              </div>
              <div class="form-group">
                <label>Tax Amount: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="" type="text" class="form-control" name="tax_amount" id="taxAmount" placeholder="Tax Amount">
                </div>
              </div>              
              <div class="form-group">
                <label>Total: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="<?=$totals?>" type="text" class="form-control" name="total" id="totalAftertax" placeholder="Total">
                </div>
              </div>
            </span>
          </div>
               </div>

               <hr class="my-3 mx-n4">
               <div class="row px-0 px-sm-4">
                  <div class="col-12">
                     <div class="mb-3">
                        <label for="note" class="form-label fw-medium">Note:</label>
                        <textarea class="form-control" rows="2" id="note" placeholder="Invoice note"></textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /Invoice Add-->
      <!-- Invoice Actions -->
      <div class="col-lg-3 col-12 invoice-actions">
         <div class="card mb-4">
            <div class="card-body">
              <div class="form-group">
                <label>Amount Paid: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="" type="text" class="form-control" name="paid_amount" id="amountPaid" placeholder="Amount Paid">
                </div>
              </div>
              <div class="form-group">
                <label>Amount Due: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="<?=$totals?>" type="text" class="form-control" name="due_amount" id="amountDue" placeholder="Amount Due">
                </div>
              </div>

                 <div>
                    <p class="mb-2">Accept payments via</p>
                    <select name="payment_method" class=" form-select mb-4" >
                       <option value="Cash">Cash</option>
                       <option value="Bank Account">Bank Account</option>
                       <option value="Paypal">Paypal</option>
                       <option value="Card">Credit/Debit Card</option>
                       <option value="UPI Transfer">UPI Transfer</option>
                    </select>
                 </div>



               <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light" type="submit" value="submit" name="submit">
               <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-2"></i>Save</span>
               </button>
               <!-- <a href="" class="btn btn-label-secondary d-grid w-100 mb-2 waves-effect">Draft</a> -->
            </div>
         </div>
      </div>
      <!-- /Invoice Actions -->
   </div>
   <!-- Offcanvas -->
   <!-- /Offcanvas -->
</form>










<div class="modal fade" id="fullscreenModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalFullTitle">Select Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="action/sale_item" enctype="multipart/form-data">
                        <input type="hidden" name="custumer_id" value="<?=$c_id?>" >
                        <div class="row w-100 p-3">
                          <div class="col-md-12 col-12 mb-md-0 mb-3">
                            <p class="mb-2 repeater-title">Item</p>
                            <select name="p_id" class="form-select item-details mb-3" id="select_product" required>
                                <option value="">Select Item</option>
                            <?php 
                                $data = $db->query("SELECT * FROM `products` WHERE consumer_id = '$consumer_id'");
                                while($value = $data->fetch_object()){
                            ?>
                              <option value="<?=$value->p_id?>"><?=$value->product_name?>(<?=$value->product_sku?>)</option>
                            <?php } ?>
                            </select>
                          </div>
                            <div id="amount">
                                <div class="row">
                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Distributer Price</p>
                                        <input type="number" name="salling_price" class="form-control invoice-item-price mb-3" value="" placeholder="0" >
                                  </div>
                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Stock</p>
                                    <input type="number" name="qty" readonly class="form-control invoice-item-qty" value="0" placeholder="1" min="1" max="">
                                  </div>

                                  <div class="col-md-4 col-12 mb-md-0 mb-3">
                                    <p class="mb-2 repeater-title">Qty</p>
                                    <input type="number" name="qty" class="form-control invoice-item-qty" value="0" placeholder="1" min="1" max="">
                                  </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="submit" value="add_products">Add </button>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
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
          
          
          
          
          
                           

          
          
          
<style>
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 100% !important;
}
</style>
          


 <script>
$(document).ready(function(){
    $('.openPopup').on('click',function(e){
        e.preventDefault();
        $('#modalCenter').modal('show').find('.modal-body').load($(this).attr('href'));
          }); 
});

$(document).ready(function(){
    $('.modal_select_devices').on('click',function(e){
        e.preventDefault();
        $('#modal_select_devices').modal('show').find('.modal-body').load($(this).attr('href'));
          }); 
});

</script>
   <script src="<?=website_name;?>/assets/js/quotation_invoice.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#store_id').on('change', function(){
              var store_id = $(this).val();
              if(store_id){
                  $.ajax({
                      type:'POST',
                      url:'<?=website_name?>/ajax/ajaxstore.php',
                      data:'store_id='+store_id,
                      success:function(html){
                          $('#section').html(html);
                      }
                  }); 
              }else{
                  $('#store_id').html('Please Select Currectly');
              }
          });
});

</script>

