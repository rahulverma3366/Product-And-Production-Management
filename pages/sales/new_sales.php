<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Sale');
   define('to', 'New Sale');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 

   $a_id = $_SESSION['a_id'];
   $store = $db->query("SELECT * FROM `store_setting` WHERE user_id = '$a_id'");
   $store_value = $store->fetch_object();

        $datas = $db->query("SELECT * FROM `sales` WHERE user_id = '$a_id'");
        if ($datas->num_rows == 0) {
            $invoice_no = 1;
        }else{
            $invoice_no = $datas->num_rows + 1;
        }
        $view = $_REQUEST['view'];
        // echo "SELECT * FROM `buyers` WHERE bu_id ='$view'";
        $data111 = $db->query("SELECT * FROM `buyers` WHERE bu_id ='$view'");
        $value11 = $data111->fetch_object();
      
if(!empty($_REQUEST['edit'])){
    $po_id = $_REQUEST['edit'];
    $sale_data = $db->query("SELECT * FROM `sales` WHERE po_id= '$po_id'");
    $sale_value = $sale_data->fetch_object();
    $sale_store=$sale_value->sto_id;
    $paid_amount=$sale_value->paid_amount;
    $due_amount=$sale_value->due_amount;
    $invoice_no1=$sale_value->invoice_no;
    $sales_order = $db->query("SELECT * FROM `sales_order` WHERE sal_id = '$po_id'");
    $sales_order_value=$sales_order->fetch_object();
     $total=$sales_order_value->total;
                    $amount=$sales_order_value->amount;
                       $qty=$sales_order_value->quantity;
                      $subtotal = $qty*$amount;
                    $tax_amount = $total-$subtotal;
                    $sales_due = $db->query("SELECT * FROM `sales_due` WHERE po_id = '$po_id'");
    $sales_due_value=$sales_due->fetch_object();
                    $b_data = $db->query("SELECT * FROM `balance_sheet` WHERE po_id = '$po_id'");
    $b_value=$b_data->fetch_object();
    
    
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<form action="action/action.php" enctype="multipart/form-data">
    <input type="hidden" name="po_id" value="<?=$po_id;?>">
    <input type="hidden" name="pdac_id" value="<?=$sales_due_value->pdac_id;?>">
    <input type="hidden" name="so_id" value="<?=$sales_order_value->so_id;?>">
    <input type="hidden" name="bs_id" value="<?=$b_value->bs_id;?>">
   <div class="row invoice-add">
      <!-- Invoice Add-->
      <div class="col-lg-10 col-12 mb-lg-0 mb-4">
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
                     <select name='sl_id' id="slot_id" class="form-select" required>
                                <option>Select Slot</option>
                               <?php 
                                $store_data=$db->query("SELECT * FROM `slot` WHERE status=1");
                                while($store_value=$store_data->fetch_object()){
                               ?>
                                <option <?php if(!empty($_REQUEST['edit'])){
                                    if($store_value->sl_id == $sale_value->sl_id){echo "selected";}
                                }?> value="<?= $store_value->sl_id;?>"><?= $store_value->name;?></option>
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
                              <input type="text" class="form-control" <?php if(empty($_REQUEST['edit'])){?>disabled=""<?php }?> name="invoice_no" placeholder="<?=$invoice_no;?>" value="<?php if(!empty($_REQUEST['edit'])){echo $invoice_no1;}else{echo $invoice_no;}?>" id="invoiceId">
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
                           <select name='sto_id' id="store_id" class="form-select" required>
                                <option>Select</option>
                               <?php 
                                $store_data=$db->query("SELECT * FROM `stors`");
                                while($store_value=$store_data->fetch_object()){
                               ?>
                                <option <?php if(!empty($_REQUEST['edit'])){
                                    if($store_value->sto_id == $sale_value->sto_id){echo "selected";}
                                }?> value="<?= $store_value->sto_id;?>"><?= $store_value->name;?></option>
                               <?php }?>
                           </select>
                        </dd>
                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="fw-normal">Store Details:</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2 mt-4">
                           <div id="section">
                               <?php
                               	if (!empty($_REQUEST['edit'])) {
	    
		$vendor = $db->query("SELECT * FROM `stors` WHERE sto_id = '$sale_store'");
		if ($vendor->num_rows == 0) {
			echo "No Data Found";
		}else{
			$vendor_value = $vendor->fetch_object();
?>	
            <p class="mb-1">Gst NO:<?=$vendor_value->gst_no?></p>
            <p class="mb-1">Name:<?=$vendor_value->name?></p>
            <p class="mb-1">Mobile:<?=$vendor_value->mobile?></p>
            <p class="mb-1">Email:<?=$vendor_value->email?></p>
            <p class="mb-0">Address:<?=$vendor_value->address?></p>
            <?php }}?>
                           </div>
                        </dd>
<!--                         <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                           <span class="fw-normal">Due Date:</span>
                        </dt>
                        <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                           <input type="date" class="form-control w-px-150 date-picker flatpickr-input" placeholder="YYYY-MM-DD" >
                        </dd>
 -->                     </dl>



                  </div>
                <hr class="my-3 mx-n4">
                    <div class="row p-sm-4 p-0">
                      <div class="col-md-12 col-sm-7">
                        <h6 class="mb-4">Sale To:</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php if(!empty($_REQUEST['edit'])){echo $sale_value->name;}else{?><?= $value11->name?><?php }?>" required readonly>
                            </div>
                            <div class="col-md-4">
                                <label>Email Id</label>
                                <input type="email" class="form-control" name="email_id" placeholder="email id" value="<?php if(!empty($_REQUEST['edit'])){echo $sale_value->email_id;}else{?><?= $value11->email?><?php }?>" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label>Phone No</label>
                                <input type="text" class="form-control" name="mobile_no" placeholder="Phone No" value="<?php if(!empty($_REQUEST['edit'])){echo $sale_value->mobile_no;}else{?><?= $value11->phone?><?php }?>" readonly required>
                            </div>

                            <div class="col-md-4">
                                <label>State </label>
                                    <input type="text" class="form-control" name="state" placeholder="State" value="<?php if(!empty($_REQUEST['edit'])){echo $sale_value->state;}else{?><?= $value11->state?><?php }?>" readonly required>
                            </div>
                            <div class="col-md-4">
                                <label>Address</label>
                                <textarea class="form-control" name="address" readonly required><?php if(!empty($_REQUEST['edit'])){echo $sale_value->address;}else{?><?= $value11->address?><?php }?></textarea>
                            </div>
                            <div class="col-md-4">
                                <labe>GST No.</labe>
                                    <input type="text" class="form-control" name="gst_no" placeholder="Gst No" value="<?php if(!empty($_REQUEST['edit'])){echo $sale_value->gst_no;}else{?><?= $value11->gst?><?php }?>" readonly required>
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
                <th width="20%">Item Name</th>
                <th width="10%">Quantity</th>
                <th width="18%">Unit</th>
                <th width="20%">Price</th>
                <th width="17%">GST %</th>
                <th width="20%">Total</th>
            </tr>
            </thead>
            <tbody  id="invoiceItem">
                <?php if ($id && $salesData): ?>
    <tr>
        <td><input class="itemRow" type="checkbox"></td>
        <td>
            <select class="form-select" name="product_name[]" id="productName_1" autocomplete="off" required>
                <option value="">Select Item</option>
                <?php 
                $productQuery = $db->query("SELECT * FROM `product_name`");
                while ($product = $productQuery->fetch_object()) {
                    $selected = ($product->pn_id == $salesData->product_id) ? 'selected' : '';
                ?>
                <option value="<?= $product->pn_id ?>" <?= $selected ?>><?= $product->name ?></option>
                <?php } ?>
            </select>
        </td>
        <td><input type="number" name="qty[]" id="quantity_1" class="form-control quantity" autocomplete="off" value="<?= $salesData->qty ?>" step="0.01"></td>
        <td>
            <select name="unit[]" id="unit_1" class="form-select quantity" autocomplete="off" required>
                <option value="">Select Unit</option>
                <option value="CM" <?= $salesData->unit == 'CM' ? 'selected' : '' ?>>CM</option>
                <option value="K.G" <?= $salesData->unit == 'K.G' ? 'selected' : '' ?>>KG</option>
                <option value="PIC" <?= $salesData->unit == 'PIC' ? 'selected' : '' ?>>PIC</option>
                <option value="BAG" <?= $salesData->unit == 'BAG' ? 'selected' : '' ?>>BAG</option>
            </select>
        </td>
        <td><input type="number" name="unit_price[]" id="price_1" class="form-control price" autocomplete="off" value="<?= $salesData->unit_price ?>" step="0.01"></td>
        <td><input type="number" name="gst[]" id="gst_1" class="form-control price" autocomplete="off" value="<?= $salesData->gst ?>"></td>
        <td class="ps-2 pe-2"><input type="number" name="total1[]" id="total_1" class="form-control total ps-0 pe-0" autocomplete="off" value="<?= $salesData->total ?>" readonly></td>
    </tr>
<?php else: ?>
    <!-- Empty row for new entries -->
    <tr>
        <td><input class="itemRow" type="checkbox"></td>
        <td>
            <select class="form-select" name="product_name[]" id="productName_1" autocomplete="off" required>
                <option value="">Select Item</option>
                <?php 
                $productQuery = $db->query("SELECT * FROM `product_name`");
                while ($product = $productQuery->fetch_object()) {
                ?>
                <option value="<?= $product->pn_id ?>"><?= $product->name ?></option>
                <?php } ?>
            </select>
        </td>
        <td><input type="number" name="qty[]" id="quantity_1" class="form-control quantity" autocomplete="off" step="0.01"></td>
        <td>
            <select name="unit[]" id="unit_1" class="form-select quantity" autocomplete="off" required>
                <option value="">Select Unit</option>
                <option value="CM">CM</option>
                <option value="K.G">KG</option>
                <option value="PIC">PIC</option>
                <option value="BAG">BAG</option>
            </select>
        </td>
        <td><input type="number" name="unit_price[]" id="price_1" class="form-control price" autocomplete="off" step="0.01"></td>
        <td><input type="number" name="gst[]" id="gst_1" class="form-control price" autocomplete="off"></td>
        <td class="ps-2 pe-2"><input type="number" name="total1[]" id="total_1" class="form-control total ps-0 pe-0" autocomplete="off" readonly></td>
    </tr>
<?php endif; ?>

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
                  <input value="<?php if(!empty($_REQUEST['edit'])){ 
                  
                  echo $subtotal;}?>" type="number" class="form-control" name="subtotal" id="subTotal" placeholder="Subtotal">
                </div>
              </div>
              <div class="form-group d-none">
                <label>Tax Rate: &nbsp;</label>
                <div class="input-group">
                  <input  type="number" class="form-control" name="tax"   id="taxRate" placeholder="Tax Rate">
                  <div class="input-group-text">%</div>
                </div>
              </div>
              <div class="form-group">
                <label>Tax Amount: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input value="<?php if(!empty($_REQUEST['edit'])){ 
                 
                  echo $tax_amount;}?>" type="number" class="form-control"  name="tax_amount" id="taxAmount" placeholder="Tax Amount">
                </div>
              </div>              
              <div class="form-group">
                <label>Total: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input  <input value="<?php if(!empty($_REQUEST['edit'])){ 
                 
                  echo $total;}?>" type="number" class="form-control" name="total" id="totalAftertax" placeholder="Total">
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
      </div>
      <!-- /Invoice Add-->
      <!-- Invoice Actions -->
      <div class="col-lg-2 col-12 invoice-actions">
         <div class="card mb-4">
            <div class="card-body">
              <div class="form-group">
                <label>Amount Paid: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input <input value="<?php if(!empty($_REQUEST['edit'])){ 
                 
                  echo $paid_amount;}?>" type="number" class="form-control" name="paid_amount" id="amountPaid" placeholder="Amount Paid">
                </div>
              </div>
              <div class="form-group">
                <label>Amount Due: &nbsp;</label>
                <div class="input-group">
                  <div class="input-group-text currency">₹</div>
                  <input <input value="<?php if(!empty($_REQUEST['edit'])){ 
                    
                  echo $due_amount;}?>" type="number" class="form-control" name="due_amount" id="amountDue" placeholder="Amount Due">
                </div>
              </div>

         <div>
            <p class="mb-2">Accept payments via</p>
            <select name="payment_method" class="form-select mb-4">
               <option <?php if(!empty($_REQUEST['edit'])){if($sales_due_value->payment_method == "Cash"){echo "selected";}}?> value="Cash">Cash</option>
               <option <?php if(!empty($_REQUEST['edit'])){if($sales_due_value->payment_method == "Bank Account"){echo "selected";}}?> value="Bank Account">Bank Account</option>
               <option <?php if(!empty($_REQUEST['edit'])){if($sales_due_value->payment_method == "Paypal"){echo "selected";}}?> value="Paypal">Paypal</option>
               <option <?php if(!empty($_REQUEST['edit'])){if($sales_due_value->payment_method == "Card"){echo "selected";}}?> value="Card">Credit/Debit Card</option>
               <option <?php if(!empty($_REQUEST['edit'])){if($sales_due_value->payment_method == "UPI Transfer"){echo "selected";}}?> value="UPI Transfer">UPI Transfer</option>
            </select>
         </div>


 <?php if(!empty($_REQUEST['edit'])){?>
 <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light" type="submit" value="modify" name="submit">
     
               <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-2"></i>Modify</span>
               </button>
 <?php }else{?>
 
 <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light" type="submit" value="submit" name="submit">
               <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-2"></i>Save</span>
               </button><?php }?>
               
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
    $(document).ready(function () {
    // Handle 'Check All' functionality
    $(document).on("click", "#checkAll", function () {
        $(".itemRow").prop("checked", this.checked);
    });
    $(document).on("click", ".itemRow", function () {
        $("#checkAll").prop(
            "checked",
            $(".itemRow:checked").length === $(".itemRow").length
        );
    });

    let count = $(".itemRow").length;

    // Add new rows
    $(document).on("click", "#addRows", function () {
        count++;
        const htmlRows = `
<tr>
    <td><input class="itemRow" type="checkbox"></td>
    <td>
        <select class="form-select" name="product_name[]" id="productName_${count}" autocomplete="off" required>
            <option value="">Select Item</option>
            <?php 
            $data = $db->query("SELECT * FROM product");
            while ($pvalue = $data->fetch_object()) {
                $pn_id = $pvalue->pn_id;
                $data1 = $db->query("SELECT * FROM product_name WHERE pn_id = '$pn_id'");
                $pvalue1 = $data1->fetch_object();
            ?>
            <option value="<?= $pvalue1->pn_id ?>"><?= $pvalue1->name ?></option>
            <?php } ?>
        </select>
    </td>
    <td><input type="number" name="qty[]" id="quantity_${count}" class="form-control quantity" autocomplete="off"></td>
    <td>
        <select name="unit[]" id="unit_${count}" class="form-select quantity" autocomplete="off" required>
            <option value="">Select Unit</option>
            <option value="CM">CM</option>
            <option value="K.G">KG</option>
            <option value="PIC">PIC</option>
        </select>
    </td>
    <td><input type="number" name="unit_price[]" id="price_${count}" class="form-control price" autocomplete="off"></td>
    <td><input type="number" name="gst[]" id="gst_${count}" class="form-control price" autocomplete="off"></td>
    <td class="ps-2 pe-2"><input type="number" name="total1[]" id="total_${count}" class="form-control total ps-0 pe-0" autocomplete="off" readonly></td>
</tr>`;
        $("#invoiceItem").append(htmlRows);
    });

    // Remove selected rows
    $(document).on("click", "#removeRows", function () {
        $(".itemRow:checked").each(function () {
            $(this).closest("tr").remove();
        });
        $("#checkAll").prop("checked", false);
        calculateTotal();
    });

    // Calculate totals on input change
    $(document).on("input", "[id^=quantity_], [id^=price_], [id^=gst_]", function () {
        calculateTotal();
    });

    // Calculate amount due on amount paid change
    $(document).on("blur", "#amountPaid", function () {
        const amountPaid = parseFloat($(this).val()) || 0;
        const totalAftertax = parseFloat($("#totalAftertax").val()) || 0;
        $("#amountDue").val((totalAftertax - amountPaid).toFixed(2));
    });

    function calculateTotal() {
        let subTotal = 0,
            gstAmount = 0,
            totalAmount = 0;

        $("[id^='price_']").each(function () {
            const id = $(this).attr("id").split("_")[1];
            const price = parseFloat($("#price_" + id).val()) || 0;
            const quantity = parseFloat($("#quantity_" + id).val()) || 0;
            const gst = parseFloat($("#gst_" + id).val()) || 0;

            const total = price * quantity;
            const totalWithGST = total + (total * gst) / 100;

            $("#total_" + id).val(totalWithGST.toFixed(2));

            subTotal += total;
            gstAmount += total * (gst / 100);
        });

        $("#subTotal").val(subTotal.toFixed(2));
        $("#taxAmount").val(gstAmount.toFixed(2));
        totalAmount = subTotal + gstAmount;
        $("#totalAftertax").val(totalAmount.toFixed(2));
    }
});

</script>


