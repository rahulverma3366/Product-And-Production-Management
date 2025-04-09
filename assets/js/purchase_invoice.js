$(document).ready(function(){
    $(document).on('click', '#checkAll', function() {          	
        $(".itemRow").prop("checked", this.checked);
    });	
    $(document).on('click', '.itemRow', function() {  	
        if ($('.itemRow:checked').length == $('.itemRow').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    });  
    var count = $(".itemRow").length;
    $(document).on('click', '#addRows', function() { 
        count++;
        var htmlRows = '';
        htmlRows += '<tr>';
        htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
        htmlRows += '<td><select class="form-select" name="product_name[]" id="productName_'+count+'" autocomplete="off" required>'+
                                    '<option value="">Select Item</option>'+
                                    '<?php '+
                                        '$data=$db->query("SELECT * FROM `product`");'+
                                        'while($pvalue=$data->fetch_object()){'+
                                            '$pn_id = $pvalue->pn_id;'+
                                            '$data1 = $db->query("SELECT * FROM `product_name` WHERE pn_id = '+"'$pn_id'"+'");'+
                                            '$pvalue1=$data1->fetch_object();?>'+
                                    '<option value="<?= $pvalue1->pn_id?>"><?= $pvalue1->name?></option>'+
                                    '<?php }?>'+
                                '</select>';	
        htmlRows += '<td><input type="number" name="qty[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
        htmlRows += '<td><select name="unit[]" id="quantity_'+count+'" class="form-select quantity" autocomplete="off" required><option value="">Select Unit</option><option value="KG">KG</option><option value="PIC">PIC</option></select></td>';   		
        htmlRows += '<td><input type="number" name="unit_price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
        htmlRows += '<td><input type="number" name="gst[]" id="gst_'+count+'" class="form-control price" autocomplete="off"></td>';		 
        htmlRows += '<td><input type="number" name="total1[]" id="total_'+count+'" class="form-control total" autocomplete="off" readonly></td>';          
        htmlRows += '</tr>';
        $('#invoiceItem').append(htmlRows);
    }); 
    $(document).on('click', '#removeRows', function(){
        $(".itemRow:checked").each(function() {
            $(this).closest('tr').remove();
        });
        $('#checkAll').prop('checked', false);
        calculateTotal();
    });		
    $(document).on('blur', "[id^=quantity_], [id^=price_], [id^=gst_]", function(){
        calculateTotal();
    });	
    $(document).on('blur', "#amountPaid", function(){
        var amountPaid = $(this).val();
        var totalAftertax = $('#totalAftertax').val();	
        if(amountPaid && totalAftertax) {
            totalAftertax = totalAftertax - amountPaid;			
            $('#amountDue').val(totalAftertax);
        } else {
            $('#amountDue').val(totalAftertax);
        }	
    });	
});
function calculateTotal(){
    var subTotal = 0; 
    var gstAmount = 0;
    var totalAmount = 0;
    var amountDue = 0;
    $("[id^='price_']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("price_", '');
        var price = parseFloat($('#price_'+id).val()) || 0;
        var quantity  = parseFloat($('#quantity_'+id).val()) || 0;
        var gst = parseFloat($('#gst_'+id).val()) || 0;

        var total = price * quantity;
        var totalWithGST = total + (total * (gst / 100));
        $('#total_'+id).val(totalWithGST.toFixed(2));
        
        subTotal += total;
        gstAmount += (total * (gst / 100));
    });
    $('#subTotal').val(subTotal.toFixed(2));	
    $('#taxAmount').val(gstAmount.toFixed(2));
    totalAmount = subTotal + gstAmount;
    $('#totalAftertax').val(totalAmount.toFixed(2));
    var amountPaid = parseFloat($('#amountPaid').val()) || 0;
    amountDue = totalAmount - amountPaid;
    $('#amountDue').val(amountDue.toFixed(2));
}
