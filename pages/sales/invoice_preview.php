<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Sale');
   define('to', ' Sale Preview');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   }
   $invoice_no = mysqli_real_escape_string($db,$_REQUEST['quotation_no']);
   if (empty($invoice_no)) {
     echo '<script>window.location.replace("sale_invoice_list.php");</script>';
   }else{
      $user_id = $_SESSION['a_id'];
      $purchae_order = $db->query("SELECT * FROM `sales` WHERE invoice_no = '$invoice_no' AND user_id = '$user_id'");
      $purchae_order_value = $purchae_order->fetch_object();
      $po_id = $purchae_order_value->po_id;
      $sto_id = $purchae_order_value->sto_id;
      $store_data=$db->query("SELECT * FROM `stors` WHERE sto_id = '$sto_id'");
      $store_data_value = $store_data->fetch_object();
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
            <h4 class="fw-medium mb-2">Invoice #<?=$invoice_no?></h4>
            <div class="mb-2 pt-1">
              <span>Invoice Date:</span>
              <span class="fw-medium"><?php echo date_Mdy($purchae_order_value->order_date); ?></span>
            </div>
            <div class="mb-2 pt-1">
               <h4 class="fw-medium mb-2">Store Details:</h4>
              <span class="fw-medium">
              <p class="mb-2">Name: <b><?=$store_data_value->name;?></b></p>
            <p class="mb-2">Gst No: <?=$store_data_value->gst_no;?></p>
            <p class="mb-2">Email: <?=$store_data_value->email;?></p>
            <p class="mb-2">Phone: <?=$store_data_value->mobile;?></p>
            <p class="mb-0">Address: <?=$store_data_value->address;?></p></span>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <div class="row p-sm-3 p-0">
          <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
            <h6 class="mb-3">Invoice To:</h6>
            <p class="mb-1"><?=$purchae_order_value->name;?> </p>
            <p class="mb-1"><?=$purchae_order_value->mobile_no;?> </p>
            <p class="mb-1"><?=$purchae_order_value->email_id;?> </p>
            <p class="mb-1"><?=$purchae_order_value->address;?> </p>
            <p class="mb-1"><?=$purchae_order_value->state;?> </p>
          </div>
          <div class="col-xl-6 col-md-12 col-sm-7 col-12">
            <h6 class="mb-4"></h6>
            <table>
              <tbody>
                <tr>
                  <td class="pe-4">Total Amount :</td>
                  <td class="fw-medium">Rs <?php echo number_format($purchae_order_value->total); ?></td>
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
              <th>Sl no</th>
              <th>Item</th>
              <th>Cost</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $sl = 0;
              $order_data = $db->query("SELECT * FROM `sales_order` WHERE sal_id = '$po_id'");
              while($order_value = $order_data->fetch_object()){
                 
                  $due_data = $db->query("SELECT sum(amount) AS `total` FROM `sales_due` WHERE po_id ='$po_id'");
                  $due_value = $due_data->fetch_object();
                  $sl++;
            ?>
              <tr>
                <td class="text-nowrap"><?=$sl;?></td>
                <td class="text-nowrap"><?=$order_value->item_name;?></td>
                <td>Rs <?=$order_value->amount;?></td>
                <td><?=$order_value->quantity;?></td>
                <td>Rs <?=$order_value->amount * $order_value->quantity;?></td>
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
                <p class="mb-2">Tax:</p>
                <p class="mb-2">Total:</p>
                
                <p class="mb-2 pt-3">Paid Amount:</p>
                <!-- <p class="mb-2">Discount:</p> -->
                
                <p class="mb-0 pb-3">Due Amount:</p>
              </td>
              <td class="ps-2 py-4">
                <p class="fw-medium mb-2 pt-3">Rs <?php echo number_format($purchae_order_value->subtotal);?></p>
                <p class="fw-medium mb-2">Rs <?php echo number_format($purchae_order_value->tax_amount); ?></p>
                 <p class="fw-medium mb-0 pb-3">Rs <?php echo number_format($purchae_order_value->total); ?></p>
                <!-- <p class="fw-medium mb-2">$00.00</p> -->
                <p class="fw-medium mb-2">Rs <?php echo number_format($due_value->total);?></p>
                <p class="fw-medium mb-0 pb-3">Rs <?php echo number_format($purchae_order_value->total - $due_value->total); ?></p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="card-body mx-3">
        <div class="row">
          <div class="col-12">
            <span class="fw-medium">Note:</span>
            <span>This is computer generated Quotation. </span>
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
        <a class="btn btn-label-secondary d-grid w-100 mb-2" target="_blank" href="sale_invoice_print?sale_print=<?=$invoice_no;?>">
          Print
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
