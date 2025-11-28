<?php 
   session_start();
   include_once '../../../config/config.php';
   include_once '../../../config/basic.php';
   include '../../../include/function.php';
      $invoice_no = mysqli_real_escape_string($db,$_REQUEST['invoice_no']);
   if (empty($invoice_no)) {
     echo '<script>window.location.replace("purchase_invoices.php");</script>';
   }else{
      $user_id = $_SESSION['a_id'];
      $consumer_id = $_SESSION['consumer_id'];
      $sale_order = $db->query("SELECT * FROM `sale_order` WHERE invoice_no = '$invoice_no' AND user_id = '$user_id'");
      $sale_order_value = $sale_order->fetch_object();
      $so_id = $sale_order_value->so_id;
      $custumer_id = $sale_order_value->custumer_id;
      $store = $db->query("SELECT * FROM `store_setting` WHERE consumer_id = '$consumer_id' AND user_id = '$user_id'");
      $store_value = $store->fetch_object();
      
      $cst_store = $db->query("SELECT * FROM `store_setting` WHERE consumer_id = '$consumer_id' AND user_id = '$custumer_id'");
      $cst_store_value = $cst_store->fetch_object();

      
   }
   
   
 function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . ' ' : '') . $paise;
}

   
   
   
   
   
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>GST Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="invoice.min.css">

</head>

<body>

<center>
        <table style="border-collapse:collapse;margin-left:5.47pt" cellspacing="0">
            <tr style="height:90pt">
                <td class="t1"
                    colspan="10">
                    <p class="s1 p1"><b>GSTIN : <?=$store_value->store_gst;?></b> </p>
                    <p class="s2 p2"> <b>TAX INVOICE</b> </p>
                    <p class="s3 p3"><b><?=$store_value->store_name;?></b></p>
                    <p class="s4 p4"> <?=$store_value->store_address;?> </p>
                    <p class="s4 p5"> CIN : <?=$store_value->cin;?> </p>
                    <p class="s5 p6"> Tel. : <?=$store_value->store_mobile_no;?> email : <?=$store_value->store_email_id;?> </p>
                </td>
            </tr>
            <tr style="height:59pt">
                <td class="t2"
                    colspan="4">
                    <p class="s4 p7"> Invoice No. : <?=$invoice_no?> <br> Dated : <?php echo date_Mdy($sale_order_value->order_date); ?> <br> Place of Supply : <?=$store_value->state;?> <br> Reverse Charge : N <br> </p>
                </td>
               
                <td class="t3"
                    colspan="9">
                    <p class="s4 p7"> Invoice No. : <?=$invoice_no?> <br> Dated : <?php echo date_Mdy($sale_order_value->order_date); ?> <br> Place of Supply : <?=$store_value->state;?>  <br> Reverse Charge : N <br></p>
                </td>
            </tr>
            <tr style="height:118pt">
                <td class="t4"
                    colspan="4">
                    <p class="s1 p14"> <b>Billed to :</b> </p>
                    <p class="s4 p19">Party Name : <?php echo user($db,$sale_order_value->custumer_id,1); ?>  </p>

                    <p class="s4 p20">Party Mobile No : <?php echo user($db,$sale_order_value->custumer_id,2); ?>  GSTIN / UIN : <?php echo user($db,$sale_order_value->custumer_id,5); ?>
                                        <p class="s4 p16"><?php echo user($db,$sale_order_value->custumer_id,4); ?> </p>
                </td>
                <td class="t5"
                    colspan="6">
                    <p class="s1 p21"> <b>Shipped to :</b> </p>
                    <p class="s4 p19">Party Name : <?php echo user($db,$sale_order_value->custumer_id,1); ?>  </p>

                    <p class="s4 p20">Party Mobile No : <?php echo user($db,$sale_order_value->custumer_id,2); ?>  GSTIN / UIN : <?php echo user($db,$sale_order_value->custumer_id,5); ?>
                                        <p class="s4 p16"><?php echo user($db,$sale_order_value->custumer_id,4); ?> </p>

                </td>
            </tr>
            <tr style="height:23pt">
                <td class="t6"
                    colspan="10">
                    <p class="s4 p27"> </p>
                </td>
            </tr>
            <tr style="height:35pt">
                <th  class="t7">
                    <p class="s6 p28">S.N<span class="s7">.</span></p>
                    <p class="s8 p29"> </p>
                </th>
                <th  class="t8">
                    <p class="s8 p30">Description of Goods </p>
                    <p class="s8 p31"> </p>
                </th>
                <th  class="t9">
                    <p class="s8 p32">HSN/SAC</p>
                    <p class="s8 p33">Code </p>
                </th>
                <th  class="t10">
                    <p class="s8 p34"> Qty.</p>
                    <p class="s8 p35"> </p>
                </th>
                <th  class="t11">
                    <p class="s8 p37">Unit </p>
                    <p class="s8 p38"> </p>
                </th>
                <th  class="t12">
                    <p class="s8 p39"> List Price</p>
                    <p class="s8 p40"> </p>
                </th>
                <th  class="t13">
                    <p class="s8 p41">Discount </p>
                    <p class="s8 p411"> </p>
                </th>
                <th  class="t14">
                    <p class="s8 p42"> SGST </p>
                    <p class="s8 p43"> Rate </p>
                </th>
                <th  class="t15">
                    <p class="s8 p44"> SGST Amount </p>
                </th>
                <th  class="t16">
                    <p class="s8 p45"> Amount(<span class="s9">` </span>)</p>
                    <p class="s8 p46"> </p>
                </th>
            </tr>
            <?php
            $sl = 0;
                $data = $db->query("SELECT * FROM `sale_data` WHERE so_id = '$so_id'");
                while($value = $data->fetch_object()){
                    $sl++;
            ?>
            <tr>
                <td  class="t17">
                    <p class="s10 p47"> 1.</p>
                </td>
                <td  class="t18">
                    <p class="s10 p50"><?=$value->product_name;?></p>
                    

                    
                </td>
                <td  class="t19">
                    <p class="s10 p52"> </p>
                </td>
                <td  class="t20">
                    <p class="s10 p53"> <?=$value->qty;?></p>
                </td>
                <td  class="t21">
                    <p class="s10 p54">PCS </p>
                </td>
                <td  class="t22">
                    <p class="s10 p55"> <?=$value->product_saling_price;?></p>
                </td>
                <td  class="t23">
                    <p class="s10 p56">0.00 % </p>
                </td>
                <td  class="t24">
                    <p class="s10 p57"><?=$sale_order_value->tax;?> %</p>
                </td>
                <td  class="t25">
                    <p class="s10 p58"> <?=$sale_order_value->tax_amount;?></p>
                </td>
                <td  class="t26">
                    <p class="s10 p59"> <?=$value->product_saling_price;?></p>
                </td>
            </tr>
            <?php } ?>
            <tr style="height:22pt">
                <td class="t261"
                    colspan="4">
                    <p class="s10 p60"> <span class="s8">Grand Total</span></p>
                </td>
                <td class="t27" colspan="2">
                    <p class="s12 p61"> <span class="s8"> </span></p>
                </td>
                <td class="t28"
                    colspan="3">
                    <p class="s8 p62"> <span class="s13">`</span></p>
                </td>
                <td  class="t29">
                    <p class="s8 p63"> <?=$sale_order_value->total;?> </p>
                </td>
            </tr>
            <tr style="height:60pt">
                <td class="t30"
                    colspan="10">
                    <p class="s10 p64"> </p>
                    <!--<p class="s8 p65"> HSN/SAC Tax Rate <span class="s14">Taxable Amt.</span> <span class="s14">IGST-->
                    <!--        Amt.</span> Total Tax <span class="s10">998422 18% 5,000.00 900.00 900.00</span></p>-->
                    <p class="s1 p66">Rupees <?=getIndianCurrency($sale_order_value->total)?> </p>
                </td>
            </tr>
            <tr style="height:24pt">
                <td class="t31"
                    colspan="10">
                    <p class="s1 p67">Bank Details : <span class="s4"><?=$store_value->bank_details;?></span></p>
                </td>
            </tr>
            <tr style="height:34pt">
                <td class="t32"
                    colspan="4" rowspan="2">
                    <p class="s6 p68"> Terms &amp; Conditions<span class="s10"> E.&amp; O.E. </span></p>
                    <ol id="l1">
                        <li data-list-text="1.">
                            <p class="s10 p69"> Goods once sold will not be taken back. </p>
                        </li>
                        <li data-list-text="2.">
                            <p class="s10 p70"> Interest @ 18% p.a. will be charged if the payment is not made with in
                                the stipulated time. </p>
                        </li>
                        <li data-list-text="3.">
                            <p class="s10 p71">Subject to &#39;Odisha&#39; Jurisdiction only. </p>
                        </li>
                    </ol>
                    <p class="s10 p72"> </p>
                </td>
                <td class="t33"
                    colspan="6">
                    <p class="s6 p73"> Receiver&#39;s Signature<span class="s7"> :</span></p>
                </td>
            </tr>
            <tr style="height:59pt">
                <td class="t34"
                    colspan="6">
                    <p class="s1 p74"> For <?=$store_value->store_name;?></p>
                    <p class="s1 p75"> Authorised Signatory</p>
                </td>
            </tr>
        </table>
        
        <div class="container">
            
            <?php
            $sl = 0;
                $data = $db->query("SELECT * FROM `sale_data` WHERE so_id = '$so_id'");
                while($value = $data->fetch_object()){
                    $sl++;
            ?>

        
        <table class="table table-bordered mb-2 mt-2">
            <tr>
                <th>
                    IMEI NO
                </th>
            </tr>
                            <?php 
                    $product_id = $value->product_id;
                    $so_id = $so_id;
                    $imei = $db->query("SELECT * FROM `sale_products` WHERE p_id = '$product_id' AND  so_id = '$so_id'");
                    while($imei_value = $imei->fetch_object()){
                ?>


            <tr>
                <td>
                    <?=$imei_value->imei_no;?>
                </td>
            </tr>
            
                <?php } ?>
            
        </table>
        
        <?php } ?>
                </div>

                        <p>This is computer generated invoice. not required for any signature</p>

    </center>
    <p style="text-indent: 0pt;text-align: left;" >
    <p style="text-indent: 0pt;text-align: left;" >
    <p style="text-indent: 0pt;text-align: left;" >
    <p style="text-indent: 0pt;text-align: left;" >
    <p style="text-indent: 0pt;text-align: left;" >
    <p style="text-indent: 0pt;text-align: left;" >
</body>

</html>