<?php 
    if (empty($_REQUEST['cs_id'])) {
        $_SESSION['errormsg'] = ' warning !! Please Select Custumer.';
        $_SESSION['errorValue'] = 'warning';
        $_SESSION['msg'] = md5('5');
       header("location:select_custumers?msg=" . md5('5') . "");
    }
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Sale Item');
   define('to', 'Sale Goods');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 

   $a_id = $_SESSION['a_id'];
   $store = $db->query("SELECT * FROM `store_setting` WHERE user_id = '$a_id'");
   $store_value = $store->fetch_object();

        $datas = $db->query("SELECT * FROM `sale_order` WHERE user_id = '$a_id' AND consumer_id = '$consumer_id'");
        if ($datas->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $datas->num_rows + 1;
        }
    $c_id = mysqli_real_escape_string($db,$_REQUEST['cs_id']);
    $cst = $db->query("SELECT * FROM `admin` WHERE a_id = '$c_id'");
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


<form action="action/sale_item" enctype="multipart/form-data">
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
                      <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
                        <h6 class="mb-4">From:</h6>
                        <p class="mb-1">  <?=$store_value->store_name?></p>
                        <p class="mb-1"><?=$store_value->store_address?></p>
                        <p class="mb-1"><?=$store_value->store_email_id?></p>
                        <p class="mb-1"><?=$store_value->store_mobile_no?></p>
                        <p class="mb-0"><?=$store_value->store_gst?></p>
                      </div>
                      <div class="col-md-6 col-sm-7">
                        <h6 class="mb-4">Bill To:</h6>
                        <p class="mb-1"><?=$cst_value->a_name;?></p>
                        <p class="mb-1"><?=$cst_value->a_address;?></p>
                        <p class="mb-1"><?=$cst_value->a_phone;?></p>
                        <p class="mb-1"><?=$cst_value->a_email;?></p>
                        <p class="mb-0"><?=$cst_value->a_gst;?></p>
                      </div>
                    </div>               
                        <hr class="my-3 mx-n4">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="invoiceItem"> 
                          <tr>
                            <th width="5%"></th>
                            <th width="18%">SKU No</th>
                            <th width="25%">Item Name</th>
                            <th width="10%">Quantity</th>
                            <th width="20%">Price</th>                
                            <th width="20%">Total</th>
                          </tr>
                          <?php 
                                $sl = 0;
                                $sdata = $db->query("SELECT * FROM `sale_data` WHERE user_id = '$a_id' AND custumer_id = '$c_id' AND sts = 0");
                                while($svalue = $sdata->fetch_object()){
                                    $sl++;
                                    global $totals;
                                    $totals += $svalue->product_saling_price * $svalue->qty;

                                ?> 
                              <tr>
                                <td>
                                    <input type="hidden" name="s_id[]" value="<?=$svalue->s_id;?>">
                                    <input type="hidden" name="product_id[]" value="<?=$svalue->product_id;?>">
                                      <a href="action/sale_item?submit=delete_sale_product&s_id=<?=$svalue->s_id;?>&c_id=<?=$c_id;?>" class="text-body btn btn-danger p-1 btn-sm  form-control "><i class="ti ti-trash ti-sm mx-2 text-white"></i></a>
                                </td>
                                <td><input type="text" name="product_sku[]" readonly id="productCode_<?=$sl;?>" class="form-control" value="<?=$svalue->product_sku;?>" autocomplete="off"></td>
                                <td><input type="text" name="product_name[]" readonly id="productName_<?=$sl;?>" class="form-control" autocomplete="off" value="<?=$svalue->product_name;?>"></td>      
                                <td><input type="number" name="qty[]" id="quantity_<?=$sl;?>" class="form-control quantity" autocomplete="off" value="<?=$svalue->qty;?>"></td>
                                <td><input type="number" name="product_saling_price[]" id="price_<?=$sl;?>" class="form-control price" value="<?=$svalue->product_saling_price;?>" autocomplete="off"></td>
                                <td><input type="number" name="total[]" id="total_<?=$sl;?>" value="<?=$svalue->product_saling_price * $svalue->qty?>" class="form-control total" autocomplete="off"></td>
                              </tr>  
                            <?php } ?>
                          <tr>
                              <td colspan="6"><button type="button" data-bs-toggle="modal" data-bs-target="#fullscreenModal" class="btn btn-success btn-wave center">Select Product</button></td>
                          </tr>



                        </table>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                        <!-- <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button> -->
                        <!-- <button class="btn btn-success" id="addRows" type="button">+ Add More</button> -->
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
                  <input value="<?=$totals?>" type="number" class="form-control" name="subtotal" id="subTotal" placeholder="Subtotal">
                </div>
              </div>
              <div class="form-group">
                <label>Tax Rate: &nbsp;</label>
                <div class="input-group">
                  <input value="" type="number" class="form-control" name="tax" id="taxRate" placeholder="Tax Rate">
                  <div class="input-group-text">%</div>
                </div>
              </div>
              <div class="form-group">
                <label>Tax Amount: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="" type="number" class="form-control" name="tax_amount" id="taxAmount" placeholder="Tax Amount">
                </div>
              </div>              
              <div class="form-group">
                <label>Total: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="<?=$totals?>" type="number" class="form-control" name="total" id="totalAftertax" placeholder="Total">
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
                  <input value="" type="number" class="form-control" name="paid_amount" id="amountPaid" placeholder="Amount Paid">
                </div>
              </div>
              <div class="form-group">
                <label>Amount Due: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="<?=$totals?>" type="number" class="form-control" name="due_amount" id="amountDue" placeholder="Amount Due">
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
                                $user_id = $_SESSION['a_id'];
                                $data = $db->query("SELECT * FROM `sale_data` WHERE consumer_id = '$consumer_id' AND custumer_id = '$user_id' GROUP BY product_id");
                                while($value = $data->fetch_object()){
                            ?>
                              <option value="<?=$value->product_id?>"><?=$value->product_name?>(<?=$value->product_sku?>)</option>
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


 <script>
$(document).ready(function(){
    $('.openPopup').on('click',function(e){
        e.preventDefault();
        $('#modalCenter').modal('show').find('.modal-body').load($(this).attr('href'));
          }); 
});


</script>
   <script src="<?=website_name;?>/assets/js/purchase_invoice.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#select_product').on('change', function(){
              var select_product = $(this).val();
              if(select_product){
                  $.ajax({
                      type:'POST',
                      url:'<?=website_name?>/ajax/ajax_product_price_dealer.php',
                      data:'product_id='+select_product,
                      success:function(html){
                          $('#amount').html(html);
                      }
                  }); 
              }else{
                  $('#select_product').html('Please Select Currectly');
              }
          });
});

</script>

