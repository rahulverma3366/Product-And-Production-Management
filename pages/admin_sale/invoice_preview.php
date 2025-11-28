<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Products sale');
   define('to', ' Invoice');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   }
   $invoice_no = mysqli_real_escape_string($db,$_REQUEST['invoice_no']);
   if (empty($invoice_no)) {
     echo '<script>window.location.replace("sold_device.php");</script>';
   }else{
      $user_id = $_SESSION['a_id'];
   $so_id = mysqli_real_escape_string($db,$_REQUEST['so_id']);
      $sale_order = $db->query("SELECT * FROM `sale_order` WHERE invoice_no = '$invoice_no' AND user_id = '$user_id' AND so_id = '$so_id'");
      $sale_order_value = $sale_order->fetch_object();
      $so_id = $sale_order_value->so_id;
      $store = $db->query("SELECT * FROM `store_setting` WHERE consumer_id = '$consumer_id' AND user_id = '$a_id'");
      $store_value = $store->fetch_object();
   }
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>

<div class="row invoice-preview">
  <!-- Invoice -->
  <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
          <div class="mb-xl-0 mb-4">
            <div class=" svg-illustration mb-4 gap-2 align-items-center">
              <?php 
                if(!empty($store_value->store_logo)){
              ?>
                <img src="<?=website_name?>/uploads/<?=$store_value->store_logo;?>" class="img-fluid" width="200px" alt="">
              <?php }else{?>
                <h2><?=$store_value->store_name;?></h2>
              <?php } ?>
          
            </div>
            <p class="mb-2"><b><?=$store_value->store_name;?></b></p>
            <p class="mb-2"><?=$store_value->store_address;?></p>
            <p class="mb-2"><?=$store_value->store_email_id;?></p>
            <p class="mb-2"><?=$store_value->store_mobile_no;?></p>
            <p class="mb-0"><?=$store_value->store_gst;?></p>
          </div>
          <div>
            <h4 class="fw-medium mb-2">INVOICE #<?=$invoice_no?></h4>
            <div class="mb-2 pt-1">
              <span>sale Date:</span>
              <span class="fw-medium"><?php echo date_Mdy($sale_order_value->order_date); ?></span>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <div class="row p-sm-3 p-0">
          <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
            <h6 class="mb-3">Invoice To:</h6>
            <p class="mb-1"><?php echo user($db,$sale_order_value->custumer_id,1); ?> </p>
            <p class="mb-1"><?php echo user($db,$sale_order_value->custumer_id,2); ?></p>
            <p class="mb-0"><?php echo user($db,$sale_order_value->custumer_id,3); ?></p>
          </div>
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="mb-4">Bill To:</h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-4">Total Amount :</td>
                  <td class="fw-medium">Rs <?php echo number_format($sale_order_value->total); ?></td>
                </tr>
                <tr>
                  <td class="pe-4">Total Due :</td>
                  <td class="fw-medium">Rs <?php echo number_format($sale_order_value->due_amount); ?></td>
                </tr>
                <tr>
                  <td class="pe-4">Total Paid :</td>
                  <td class="fw-medium">Rs <?php echo number_format($sale_order_value->paid_amount); ?></td>
                </tr>

                <tr>
                  <td class="pe-4">Payment Method :</td>
                  <td class="fw-medium"> <?php echo $sale_order_value->payment_method; ?></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="table-responsive border-top">
        <table class="table m-0">
          <thead>
            <tr>
              <th>Item</th>
              <th>SKU</th>
              <th>Cost</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $order_data = $db->query("SELECT * FROM `sale_data` WHERE so_id = '$so_id'");

              while($order_value = $order_data->fetch_object()){
            ?>
              <tr>
                <td class="text-nowrap"><?=$order_value->product_name;?></td>
                <td class="text-nowrap"><?=$order_value->product_sku;?></td>
                <td>Rs <?=$order_value->product_saling_price;?></td>
                <td><?=$order_value->qty;?></td>
                <td>Rs <?=number_format($order_value->product_saling_price * $order_value->qty);?></td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="3" class="align-top px-4 py-4">
<!--                 <p class="mb-2 mt-3">
                  <span class="ms-3 fw-medium">Salesperson:</span>
                  <span>Alfie Solomons</span>
                </p>
 -->                <span class="ms-3">Thanks for your business</span>
              </td>
              <td class="text-end pe-3 py-4">
                <p class="mb-2 pt-3">Subtotal:</p>
                <!-- <p class="mb-2">Discount:</p> -->
                <p class="mb-2">Tax:</p>
                <p class="mb-0 pb-3">Total:</p>
              </td>
              <td class="ps-2 py-4">
                <p class="fw-medium mb-2 pt-3">Rs <?php echo number_format($sale_order_value->subtotal); ?></p>
                <!-- <p class="fw-medium mb-2">$00.00</p> -->
                <p class="fw-medium mb-2">Rs <?php echo number_format($sale_order_value->tax_amount); ?></p>
                <p class="fw-medium mb-0 pb-3">Rs <?php echo number_format($sale_order_value->total); ?></p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="card-body mx-3">
        <div class="row">
          <div class="col-12">
            <span class="fw-medium">Note:</span>
            <span>This is an electronically generated Invoice, hence does not require a signature. Thank You!</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Invoice -->

  <!-- Invoice Actions -->
  <div class="col-xl-3 col-md-4 col-12 invoice-actions">
    <div class="card">
      <div class="card-body">
        <button class="btn btn-primary d-grid w-100 mb-2" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
          <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-2"></i>Send Invoice</span>
        </button>
        <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank" href="invoice_print?invoice_no=<?=$invoice_no;?>">
          Print
        </a>
        <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank" href="gst_invoice/invoice?invoice_no=<?=$invoice_no;?>">
          GST Invoice
        </a>

        
      </div>
    </div>
  </div>
  <!-- /Invoice Actions -->
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

  <script src="<?=website_name;?>/assets/js/offcanvas-add-payment.js"></script>
<script src="<?=website_name;?>/assets/js/offcanvas-send-invoice.js"></script>
