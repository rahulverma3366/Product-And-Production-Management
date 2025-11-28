<?php 
   session_start();
   include_once '../../config/config.php';
   include_once '../../config/basic.php';
   include '../../include/function.php';
      $invoice_no = mysqli_real_escape_string($db,$_REQUEST['invoice_no']);
      $so_id = mysqli_real_escape_string($db,$_REQUEST['so_id']);
   if (empty($invoice_no)) {
     echo '<script>window.location.replace("purchase_invoices.php");</script>';
   }else{
      $user_id = $_SESSION['a_id'];
      $consumer_id = $_SESSION['consumer_id'];
      $sale_order = $db->query("SELECT * FROM `sale_order` WHERE invoice_no = '$invoice_no' AND user_id = '$user_id' AND so_id = '$so_id'");
      $sale_order_value = $sale_order->fetch_object();
      $so_id = $sale_order_value->so_id;
      $store = $db->query("SELECT * FROM `store_setting` WHERE consumer_id = '$consumer_id' AND user_id = '$user_id'");
      $store_value = $store->fetch_object();
   }
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-wide " dir="ltr" data-theme="theme-bordered" data-assets-path="<?=website_name?>/assets/" data-template="vertical-menu-template-bordered">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <title>Invoice </title>
      <!-- Canonical SEO -->
      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="<?=website_name?>/assets/img/favicon/favicon.ico" />
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet">
      <!-- Icons -->
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/fonts/fontawesome.css" />
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/fonts/tabler-icons.css"/>
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/fonts/flag-icons.css" />
      <!-- Core CSS -->
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/css/rtl/theme-bordered.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="<?=website_name?>/assets/css/demo.css" />
      <!-- Vendors CSS -->
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/libs/node-waves/node-waves.css" />
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/libs/typeahead-js/typeahead.css" />
      <!-- Page CSS -->
      <link rel="stylesheet" href="<?=website_name?>/assets/vendor/css/pages/app-invoice-print.css" />
      <!-- Helpers -->
      <script src="<?=website_name?>/assets/vendor/js/helpers.js"></script>
      <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
      <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
      <script src="<?=website_name?>/assets/vendor/js/template-customizer.js"></script>
      <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
      <script src="<?=website_name?>/assets/js/config.js"></script>
   </head>
   <body>
      <!-- Content -->
      <div class="invoice-print p-5">
         <div class="d-flex justify-content-between flex-row">
            <div class="mb-4">
               <div class="d-flex svg-illustration mb-3 gap-2">
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
                 <span>Purchase Date:</span>
                 <span class="fw-medium"><?php echo date_Mdy($sale_order_value->order_date); ?></span>
               </div>
             </div>
         </div>
         <hr />
         <div class="row d-flex justify-content-between mb-4">
            <div class="col-sm-6 w-50">
               <h6>Invoice To:</h6>
                  <p class="mb-1"><?php echo user($db,$sale_order_value->custumer_id,1); ?> </p>
                  <p class="mb-1"><?php echo user($db,$sale_order_value->custumer_id,2); ?></p>
                  <p class="mb-0"><?php echo user($db,$sale_order_value->custumer_id,3); ?></p>
                  <p class="mb-0"><?php echo user($db,$sale_order_value->custumer_id,4); ?></p>
                  <p class="mb-0"><?php echo user($db,$sale_order_value->custumer_id,5); ?></p>
            </div>
            <div class="col-sm-6 w-50">
               <h6>Bill To:</h6>
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
         <div class="table-responsive">
            <table class="table m-0">
               <thead class="table-light">
                  <tr>
              <th width="30%">Item</th>
              <th width="">SKU</th>
              <th width="30%">Cost</th>
              <th width="10%">Qty</th>
              <th width="30%">Price</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                    $order_data = $db->query("SELECT * FROM `sale_data` WHERE so_id = '$so_id'");
                    while($order_value = $order_data->fetch_object()){
                  ?>
                       <tr>
                         <td class="text-nowrap"><?=$order_value->product_name;?>
                <?php 
                    $product_id = $order_value->product_id;
                    $so_id = $so_id;
                    $imei = $db->query("SELECT * FROM `sale_products` WHERE p_id = '$product_id' AND  so_id = '$so_id'");
                    while($imei_value = $imei->fetch_object()){
                ?>
                    <?=$imei_value->imei_no;?> , <br>
                <?php } ?>
                         
                         </td>
                         <td class="text-nowrap"><?=$order_value->product_sku;?></td>
                         <td>Rs <?=$order_value->product_saling_price;?></td>
                         <td><?=$order_value->qty;?></td>
                         <td>Rs <?=number_format($order_value->product_saling_price * $order_value->qty);?></td>
                       </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="3" class="align-top px-4 py-3">
<!--                         <p class="mb-2">
                           <span class="me-1 fw-medium">Salesperson:</span>
                           <span>Alfie Solomons</span>
                        </p>
 -->                        <span>Thanks for your business</span>
                     </td>
                     <td class="text-end px-4 py-3">
                        <p class="mb-2">Subtotal:</p>
                        <!-- <p class="mb-2">Discount:</p> -->
                        <p class="mb-2">Tax:</p>
                        <p class="mb-0">Total:</p>
                     </td>
                     <td class="px-4 py-3">
                         <p class="fw-medium mb-2 pt-3">Rs <?php echo number_format($sale_order_value->subtotal); ?></p>
                         <!-- <p class="fw-medium mb-2">$00.00</p> -->
                         <p class="fw-medium mb-2">Rs <?php echo number_format($sale_order_value->tax_amount); ?></p>
                         <p class="fw-medium mb-0 pb-3">Rs <?php echo number_format($sale_order_value->total); ?></p>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="row">
            <div class="col-12">
               <span class="fw-medium">Note:</span>
            <span>This is an electronically generated Invoice, hence does not require a signature. Thank You!</span>
            </div>
         </div>
      </div>
      <!-- / Content -->
      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="<?=website_name?>/assets/vendor/libs/jquery/jquery.js"></script>
      <script src="<?=website_name?>/assets/vendor/libs/popper/popper.js"></script>
      <script src="<?=website_name?>/assets/vendor/js/bootstrap.js"></script>
      <script src="<?=website_name?>/assets/vendor/libs/node-waves/node-waves.js"></script>
      <script src="<?=website_name?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
      <script src="<?=website_name?>/assets/vendor/libs/hammer/hammer.js"></script>
      <script src="<?=website_name?>/assets/vendor/libs/i18n/i18n.js"></script>
      <script src="<?=website_name?>/assets/vendor/libs/typeahead-js/typeahead.js"></script>
      <script src="<?=website_name?>/assets/vendor/js/menu.js"></script>
      <!-- endbuild -->
      <!-- Vendors JS -->
      <!-- Main JS -->
      <script src="<?=website_name?>/assets/js/main.js"></script>
      <!-- Page JS -->
      <script src="<?=website_name?>/assets/js/app-invoice-print.js"></script>
   </body>
</html>
<!-- beautify ignore:end -->