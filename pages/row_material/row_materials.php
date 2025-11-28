<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Purchase Item');
   define('to', 'Purchase Goods');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 

   $a_id = $_SESSION['a_id'];
   $store = $db->query("SELECT * FROM `store_setting` WHERE user_id = '$a_id'");
   $store_value = $store->fetch_object();

        $datas = $db->query("SELECT * FROM `purchae_order` WHERE user_id = '$a_id' AND consumer_id = '$consumer_id'");
        if ($datas->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $datas->num_rows + 1;
        }

?>

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<form action="action/action.php" enctype="multipart/form-data">

   <div class="row invoice-add">
      <!-- Invoice Add-->
      <div class="col-lg-9 col-12 mb-lg-0 mb-4">
         <div class="card invoice-preview-card">
            <div class="card-body">
               <div class="row m-sm-4 m-0">
                  <div class="col-md-7 mb-md-0 mb-4 ps-0">
                     <div class="d-flex svg-illustration mb-4  align-items-center">
                        <span class="app-brand-text fw-bold fs-4" style="margin-left: 0px !important;">
                          <?=$store_value->store_name?>
                        </span>
                     </div>
                     <p class="mb-2"><?=$store_value->store_address?></p>
                     <p class="mb-2"><?=$store_value->store_email_id?></p>
                     <p class="mb-2"><?=$store_value->store_mobile_no?></p>
                     <p class="mb-3"><?=$store_value->store_gst?></p>
                  </div>
                  <div class="col-md-5">
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
                  <div class="col-md-12 col-sm-12 col-12 mb-sm-0 mb-4">
                                           <h6 class="mb-4">Purchase from To:</h6>
                      <div class="row justify-content-between">
                          <div class="col-md-6 ">

                     <label for="">Select Supplier</label>
                     <select name="supplier_id" class="form-select" id="vendor_id" required="">
                        <option>Select</option>
                        <?php 
                          $data = $db->query("SELECT * FROM `vendor`");
                          while ($value = $data->fetch_object()) {
                        ?>
                          <option value="<?=$value->vd_id;?>"><?=$value->name;?></option>

                      <?php } ?>
                     </select>
                     
                     </div>
                     <div class="col-md-6 ">
                         <label for="">Select Slot</label>
                     <select name="sl_id" class="form-select" id="vendor_id" required="">
                        <option>Select</option>
                        <?php 
                          $data1 = $db->query("SELECT * FROM `slot` WHERE status = 1");
                          while ($value1 = $data1->fetch_object()) {
                        ?>
                          <option value="<?=$value1->sl_id;?>"><?=$value1->name;?></option>

                      <?php } ?>
                     </select>
                     </div>
                     
                  <div class="col-md-6 col-sm-7">
                     <h6 class="mb-4"></h6>
                     <div id="section"></div>

                  </div>
                     </div>
                  </div>
                  
               </div>
               <hr class="my-3 mx-n4">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead> 
                          <tr>
                            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                            <th width="30%">Item Name</th>
                            <th width="10%">Quantity</th>
                            <th width="18%">Unit</th>
                            <th width="20%">Price</th>                
                            <th width="20%">Total</th>
                          </tr>
                          </tbody>
                          <tbody id="invoiceItem">
                          <tr>
                            <td><input class="itemRow" type="checkbox"></td>
                            <!--<td><input type="text" name="product_name[]" id="productName_1" class="form-control" autocomplete="off"></td>-->
                            <td>
                                <select name="product_name[]" id="productName_1" class="form-select" autocomplete="off">
                                    <option value="">Select Item</option>
                                    <option value="Armlet">Armlet</option>
                                    <option value="Bangle">Bangle</option>
                                    <option value="Bracelet">Bracelet</option>
                                    <option value="Engagement ring">Engagement ring</option>
                                    <option value="chain">chain</option>
                                    <option value="Earring">Earring</option>
                                    <option value="Necklace">Necklace</option>
                                    <option value="Amulet">Amulet</option>
                                    <option value="Locket">Locket</option>
                                    <option value="Pendant">Pendant</option>
                                </select>
                            </td>
                            <td><input type="number" name="qty[]" id="quantity_1" class="form-control quantity" autocomplete="off" step="0.01"></td>
                            <td><select name="unit[]" id="unit_1" class="form-select quantity" autocomplete="off" required="">
                                    <option value="">Select Unit</option>
                                    <option value="Milligram">Milligram</option>
                                    <option value="Gram">Gram</option>
                                    <option value="Piece">Piece</option>
                                </select></td>
                            <td><input type="number" name="product_purchase_price[]" id="price_1" class="form-control price" autocomplete="off"  step="0.01"></td>
                            <td><input type="number" name="total1[]" id="total_1" class="form-control total" autocomplete="off"></td>
                          </tr>
                          </tbody>
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
                 
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right"></div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right"></div>
        
                  <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 pull-right">
                    <span class="form-inline">
                      <div class="form-group">
                        <label>Subtotal: &nbsp;</label>
                        <div class="input-group">
                          <div class="input-group-text currency">₹</div>
                          <input value="" type="number" class="form-control" name="subtotal" id="subTotal" placeholder="Subtotal">
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
                          <input value="" type="text" class="form-control" name="total" id="totalAftertax" placeholder="Total">
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
                  <input value="" type="text" class="form-control" name="due_amount" id="amountDue" placeholder="Amount Due">
                </div>
              </div>

         <div>
            <p class="mb-2">Accept payments via</p>
            <select name="payment_method" class="form-select mb-4">
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

</div>
<!-- / Content -->

<?php 
   include '../../include/footer.php';
 ?>



 <script>
    $(document).ready(function(){
        $('.openPopup').on('click',function(e){
            e.preventDefault();
            $('#modalCenter').modal('show').find('.modal-body').load($(this).attr('href'));
              }); 
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#vendor_id').on('change', function(){
              var vendor_id = $(this).val();
              if(vendor_id){
                  $.ajax({
                      type:'POST',
                      url:'<?=website_name?>/ajax/ajaxfilter.php',
                      data:'vendor_id='+vendor_id,
                      success:function(html){
                          $('#section').html(html);
                      }
                  }); 
              }else{
                  $('#vendor_id').html('Please Select Currectly');
              }
          });
});

</script>

   <script src="<?=website_name;?>/assets/js/purchase_invoice1.js"></script>
