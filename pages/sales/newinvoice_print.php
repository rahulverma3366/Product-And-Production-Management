<?php 
   session_start();
   include_once '../../config/config.php';
   include_once '../../config/basic.php';
   include '../../include/function.php';
   $pdac_id = mysqli_real_escape_string($db,$_REQUEST['pdac_id']);
   if (empty($pdac_id)) {
     echo '<script>window.location.replace("sale_invoice_list.php");</script>';
   }else{
      $user_id = $_SESSION['a_id'];
     $purchae_order1 = $db->query("SELECT * FROM `sales_due` WHERE pdac_id = '$pdac_id'");
      $purchae_order_value1 = $purchae_order1->fetch_object();
      $po_id1 = $purchae_order_value1->po_id;
     $purchae_order = $db->query("SELECT * FROM `sales` WHERE po_id = '$po_id1'");
      $purchae_order_value = $purchae_order->fetch_object();
      $po_id = $purchae_order_value->po_id;
      $sto_id = $purchae_order_value->sto_id;
      $invoice_no = $purchae_order_value1->pdac_id;
      $store_data=$db->query("SELECT * FROM `stors` WHERE sto_id = '$sto_id'");
      $store_data_value = $store_data->fetch_object();
      $store = $db->query("SELECT * FROM `store_setting` WHERE  user_id = '$user_id'");
      $store_value = $store->fetch_object();
   }
?>
<!DOCTYPE html>
<html lang="zxx" dir="ltr">
<head>
    <style>
    
        img
      {
margin-top: -35px;
        }

    </style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Digital Invoica</title>
	<link href="assets/images/favicon/icon.png" rel="icon">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="custom.css">
	<link rel="stylesheet" href="media-query.css">
</head>
<body>
	<!--Invoice wrap start here -->
	<div class="invoice_wrap agency1">
		<div class="invoice-container">
			<div class="invoice-content-wrap" style="background:url('bg.png'); background-repeat: no-repeat; background-position:center; 
			 background-size: cover; background-image:url('bg.png');"  id="download_section">
				<!--Header start Here -->
			 <div style="background-color: rgba(255, 255, 255, 0.731);">
				<header class="invoice-header "  id="invo_header">
					<div class="invoice-logo-content bg-black " style="background-color:rgb(183,162,82);">
						<div class="invoice-logo">
							<div class="agency-logo">
								<a href="#" style="
                                display: flex;
                                justify-content: center;
                            "><img src="logo.png" width="130"  alt="logo"></a>
						</div>
					</div>
					<div class="invo-cont-wrap invo-contact-wrap">
						<div class="invo-social-icon">
							<div class="display-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_6_94)"><path d="M5 4H9L11 9L8.5 10.5C9.57096 12.6715 11.3285 14.429 13.5 15.5L15 13L20 15V19C20 19.5304 19.7893 20.0391 19.4142 20.4142C19.0391 20.7893 18.5304 21 18 21C14.0993 20.763 10.4202 19.1065 7.65683 16.3432C4.8935 13.5798 3.23705 9.90074 3 6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 7C15.5304 7 16.0391 7.21071 16.4142 7.58579C16.7893 7.96086 17 8.46957 17 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 3C16.5913 3 18.1174 3.63214 19.2426 4.75736C20.3679 5.88258 21 7.4087 21 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_6_94"><rect width="24" height="24" fill="white"></rect></clipPath></defs></svg>
								<a href="tel:<?= $store_data_value->mobile;?>" class="font-18"><?= $store_data_value->mobile;?></a>
							
							
								<div class="invo-social-name">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_6_108)"><path d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3 7L12 13L21 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_6_108"><rect width="24" height="24" fill="white"></rect></clipPath></defs></svg>
									<a href="mailto:<?= $store_data_value->email;?>" class="font-18"><?= $store_data_value->email;?></a>
								</div>
						</div>
					</div>
						
					
					<!-- <div class="container">
						<div class="invoice-agency-details">
							<div class="invo-head-wrap">
								<div class="color-light-black font-md wid-40">Invoice No:</div>
								<div class="font-md-grey color-grey wid-20">#DI56789</div>
							</div>
							<div class="invo-head-wrap invoi-date-wrap invoi-date-wrap-agency">
								<div class="color-light-black font-md wid-40">Invoice Date:</div>
								<div class="font-md-grey color-grey wid-20">15/12/2024</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
				</header>
				<!--Header end Here -->
				<!--Invoice content start here -->
				<section class="agency-service-content" id="agency_service">
					<div class="container">
						<!--Invoice owner name content start -->
						<div class="invoice-owner-conte-wrap pt-40">
							<div class="invo-to-wrap">
								<div class="invoice-to-content">
									<br><p class="mb-2 color-grey" ><b><?=$store_data_value->name;?></b></p>
                  <p class="mb-2 color-grey"><?=$store_data_value->address;?></p>
                  <p class="mb-2 color-grey"><?=$store_data_value->email;?></p>
                  <p class="mb-2 color-grey"><?=$store_data_value->mobile;?></p>
                  <p class="mb-0 color-grey"><?=$store_data_value->gst;?></p>
									<hr color="#000"    />
									<div class="invoice-to-content">
									<br><p class="mb-1 color-grey"><b><?=$purchae_order_value->name;?></b> </p>
            <p class="mb-1 color-grey"><?=$purchae_order_value->mobile_no;?> </p>
            <p class="mb-1 color-grey"><?=$purchae_order_value->email_id;?> </p>
            <p class="mb-1 color-grey"><?=$purchae_order_value->address;?> </p>
            <p class="mb-1 color-grey"><?=$purchae_order_value->state;?> </p>

									</div>
								</div>						
							</div>
							
						
							<div class="invo-pay-to-wrap">
								<div class="invoice-pay-content">
									<h2 class="font-lg color-blue pt-10">Invoice #<?=$purchae_order_value->invoice_no;?>.<?=$purchae_order_value1->invoice_no?></h2>
									<p class="font-md-grey color-grey pt-10" style="color:black;">Invoice Date: <?php echo date_Mdy($purchae_order_value->order_date); ?></p>
								</div>
							</div>
						</div>
						<!--Invoice owner name content End -->
						<!--Invoice table data start here -->
						<div class="table-wrapper agency-service-table pt-32">
							<table class="invoice-table agency-table">
								<thead>
									<tr class="invo-tb-header bg-black"  style="background: #ededed;">
										<th class="serv-wid pl-10 font-md" style="color:black;">SL NO</th>
										<th class="desc-wid font-md" style="color:black;">ITEM</th>
										<th class="qty-wid font-md" style="color:black;">COST</th>
										<th class="pric-wid font-md" style="color:black;">QTY</th>
										<th class="tota-wid pr-10 font-md text-right " style="color:black;">PRICE</th>
									</tr>
								</thead>
								<tbody class="invo-tb-body">
								        <?php 
                $sl = 0;
              $order_data = $db->query("SELECT * FROM `sales_order` WHERE sal_id = '$po_id'");
              while($order_value = $order_data->fetch_object()){
                 $due_data = $db->query("SELECT sum(amount) AS `total` FROM `sales_due` WHERE po_id ='$po_id'");
                  $due_value = $due_data->fetch_object();
                  $item_name = $order_value->item_name;
                  $item_date= $db->query("SELECT * FROM `product_name` WHERE `pn_id`='$item_name'");
                     $item_value = $item_date->fetch_object();
                  $sl++;
            ?>
									<tr class="invo-tb-row">
										<td class="font-sm pl-10"><?=$sl;?></td>
										<td class="font-sm"><?=$item_value->name;?></td>
										<td class="font-sm">Rs <?=$order_value->amount;?></td>
										<td class="font-sm"><?=$order_value->quantity;?></td>
										<td class="font-sm text-right pr-10">Rs <?=$order_value->amount * $order_value->quantity;?></td>
									</tr>
									<?php } ?>
          
								
									
								</tbody>
							</table>
						</div>
						<!--Invoice table data end here -->
						<!--Invoice additional info start here -->
						<div class="invo-addition-wrap pt-20">
							<div class="invo-add-info-content">
								<h3 class="font-md color-light-black">Thanks for your business</h3>
								<p class="font-sm pt-10"><b>Note:</b>This is computer generated Invoice. Thank You!</p>
							</div>
							<div class="invo-bill-total width-30">
								<table class="invo-total-table">
									<tbody>
										<tr>
											<td class="font-md color-light-black ">Subtotal:</td>
											<td class="font-md-grey color-grey text-right pr-10 ">Rs <?php echo number_format($purchae_order_value->subtotal); ?></td>
										</tr>
										<tr>
											<td class="font-md color-light-black ">Tax:</td>
											<td class="font-md-grey color-grey text-right pr-10 ">Rs <?php echo number_format($purchae_order_value->tax_amount); ?></td>
										</tr>
											<tr>
											<td class="font-md color-light-black">Total:</td>
											<td class="font-md-grey color-grey text-right pr-10 ">Rs <?php echo number_format($purchae_order_value->total); ?></td>
										</tr>
										<tr>
											<td class="font-md color-light-black ">Paied Amount:</td>
											<td class="font-md-grey color-grey text-right pr-10 ">Rs <?php echo number_format($purchae_order_value1->amount); ?></td>
										</tr>
										<tr class="tax-row">
											<td class="font-md color-light-black ">Due Amount</td>
											<td class="font-md-grey color-grey text-right pr-10 ">Rs <?php echo number_format($purchae_order_value->total - $purchae_order_value1->amount); ?></td>
										</tr>
									
									</tbody>
								</table>
							</div>
						</div>
						<!--Invoice additional info end here -->
					</div>
					<!--Contact details start here -->
					<div class="agency-contact-sec bg-black" style="background-color:rgb(183,162,82);">
						<div class="invoice-header-contact">
							<!-- <div class="invo-cont-wrap invo-contact-wrap">
								<div class="invo-social-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_6_94)"><path d="M5 4H9L11 9L8.5 10.5C9.57096 12.6715 11.3285 14.429 13.5 15.5L15 13L20 15V19C20 19.5304 19.7893 20.0391 19.4142 20.4142C19.0391 20.7893 18.5304 21 18 21C14.0993 20.763 10.4202 19.1065 7.65683 16.3432C4.8935 13.5798 3.23705 9.90074 3 6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 7C15.5304 7 16.0391 7.21071 16.4142 7.58579C16.7893 7.96086 17 8.46957 17 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 3C16.5913 3 18.1174 3.63214 19.2426 4.75736C20.3679 5.88258 21 7.4087 21 9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_6_94"><rect width="24" height="24" fill="white"></rect></clipPath></defs></svg>
								</div>
								<div class="invo-social-name">
									<a href="tel:12345678899" class="font-18">+1 234 567 8899</a>
								</div>
							</div> -->
							<!-- <div class="invo-cont-wrap">
								<div class="invo-social-icon">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_6_108)"><path d="M19 5H5C3.89543 5 3 5.89543 3 7V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V7C21 5.89543 20.1046 5 19 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M3 7L12 13L21 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_6_108"><rect width="24" height="24" fill="white"></rect></clipPath></defs></svg>
								</div>
								<div class="invo-social-name">
									<a href="mailto:contact@invoice.com" class="font-18">contact@invoice.com</a>
								</div>
							</div> -->
						</div>
					</div>
					<!--Contact details end here -->
				</section>
				<!--Invoice content end here -->
			</div>
		</div>
			<!--Bottom content start here -->
			<section class="agency-bottom-content d-print-none" id="agency_bottom">
				<!--Print-download content start here -->
				<div class="invo-buttons-wrap">
					<div class="invo-print-btn invo-btns">
						<a href="javascript:window.print()" class="print-btn">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<g clip-path="url(#clip0_10_61)">
									<path d="M17 17H19C19.5304 17 20.0391 16.7893 20.4142 16.4142C20.7893 16.0391 21 15.5304 21 15V11C21 10.4696 20.7893 9.96086 20.4142 9.58579C20.0391 9.21071 19.5304 9 19 9H5C4.46957 9 3.96086 9.21071 3.58579 9.58579C3.21071 9.96086 3 10.4696 3 11V15C3 15.5304 3.21071 16.0391 3.58579 16.4142C3.96086 16.7893 4.46957 17 5 17H7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M17 9V5C17 4.46957 16.7893 3.96086 16.4142 3.58579C16.0391 3.21071 15.5304 3 15 3H9C8.46957 3 7.96086 3.21071 7.58579 3.58579C7.21071 3.96086 7 4.46957 7 5V9" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M7 15C7 14.4696 7.21071 13.9609 7.58579 13.5858C7.96086 13.2107 8.46957 13 9 13H15C15.5304 13 16.0391 13.2107 16.4142 13.5858C16.7893 13.9609 17 14.4696 17 15V19C17 19.5304 16.7893 20.0391 16.4142 20.4142C16.0391 20.7893 15.5304 21 15 21H9C8.46957 21 7.96086 20.7893 7.58579 20.4142C7.21071 20.0391 7 19.5304 7 19V15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</g>
								<defs>
									<clipPath id="clip0_10_61">
										<rect width="24" height="24" fill="white"/>
									</clipPath>
								</defs>
							</svg>
							<span class="inter-700 medium-font">Print</span>
						</a>
					</div>
					<!--<div class="invo-down-btn invo-btns">-->
					<!--	<a class="download-btn" id="generatePDF">-->
					<!--		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_5_246)">-->
					<!--			<path d="M4 17V19C4 19.5304 4.21071 20.0391 4.58579 20.4142C4.96086 20.7893 5.46957 21 6 21H18C18.5304 21 19.0391 20.7893 19.4142 20.4142C19.7893 20.0391 20 19.5304 20 19V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 11L12 16L17 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 4V16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_5_246"><rect width="24" height="24" fill="white"/></clipPath></defs>-->
					<!--		</svg>-->
					<!--		<span class="inter-700 medium-font">Download</span>-->
					<!--	</a>-->
					<!--</div>-->
				</div>
				<!--Print-download content end here -->
				<!--Note content start -->
				<div class="invo-note-wrap">
					<div class="note-title">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_8_240)"><path d="M14 3V7C14 7.26522 14.1054 7.51957 14.2929 7.70711C14.4804 7.89464 14.7348 8 15 8H19" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M17 21H7C6.46957 21 5.96086 20.7893 5.58579 20.4142C5.21071 20.0391 5 19.5304 5 19V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H14L19 8V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21Z" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 7H10" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 13H15" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M13 17H15" stroke="#12151C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_8_240"><rect width="24" height="24" fill="white"/>
						</clipPath></defs></svg>
						<span class="font-md color-light-black">Note:</span>
					</div>
					<h3 class="font-md-grey color-grey note-desc">This is computer generated receipt and does not require physical signature.</h3>
				</div>
				<!--Note content end -->
			</section> 
			<!--Bottom content end here -->
		</div>
	</div>
	<!--Invoice wrap End here -->
	<script src="assets/js/jquery.min.js"></script> 
	<script src="assets/js/jspdf.min.js"></script>
	<script src="assets/js/html2canvas.min.js"></script>
	<script src="assets/js/custom.js"></script> 
</body>
</html>