$(document).ready(function () {
    // Checkbox handling
    $(document).on("click", "#checkAll", function () {
        $(".itemRow").prop("checked", this.checked);
    });

    $(document).on("click", ".itemRow", function () {
        $("#checkAll").prop("checked", $(".itemRow:checked").length === $(".itemRow").length);
    });

    var count = 1; // Start with the first row

    // Add new rows
    $(document).on("click", "#addRows", function () {
        count++;

        var htmlRows = `
<tr>
    <td><input class="itemRow" type="checkbox"></td>
    <td>
        <select name="product_name[]" id="productName_${count}" class="form-select" autocomplete="off">
            <option value="">Select Item</option>
            <option value="Dust">Dust</option>
            <option value="Mix Dust">Mix Dust</option>
            <option value="Sand">Sand</option>
            <option value="Fly Ash">Fly Ash</option>
            <option value="6MM">6MM</option>
            <option value="10MM">10MM</option>
            <option value="Cement">Cement</option>
            <option value="Hardener">Hardener</option>
            <option value="Gypsum">Gypsum</option>
        </select>
    </td>
    <td><input type="number" name="qty[]" id="quantity_${count}" class="form-control quantity" autocomplete="off"></td>
    <td>
        <select name="unit[]" id="unit_${count}" class="form-select quantity" autocomplete="off" required>
            <option value="">Select Unit</option>
            <option value="CM">CM</option>
            <option value="K.G">K.G</option>
            <option value="Piece">Piece</option>
        </select>
    </td>
    <td><input type="number" name="product_purchase_price[]" id="price_${count}" class="form-control price" autocomplete="off"></td>
    <td><input type="number" name="total1[]" id="total_${count}" class="form-control total" autocomplete="off" readonly></td>
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

    // Calculate total on input change
    $(document).on("input", "[id^=price_], [id^=quantity_]", function () {
        calculateTotal();
    });

    // Calculate total function
    function calculateTotal() {
        let subTotal = 0;
        let gstAmount = 0;
        let totalAmount = 0;

        $("[id^='price_']").each(function () {
            const id = $(this).attr("id").split("_")[1];
            const price = parseFloat($("#price_" + id).val()) || 0;
            const quantity = parseFloat($("#quantity_" + id).val()) || 0;

            const total = price * quantity;
            $("#total_" + id).val(total.toFixed(2));

            subTotal += total;
        });

        $("#subTotal").val(subTotal.toFixed(2));

        // Calculate tax based on the tax rate
        const taxRate = parseFloat($("#taxRate").val()) || 0;
        gstAmount = subTotal * (taxRate / 100);
        $("#taxAmount").val(gstAmount.toFixed(2));

        totalAmount = subTotal + gstAmount;
        $("#totalAftertax").val(totalAmount.toFixed(2));

        // Calculate Amount Due
        calculateAmountDue();
    }

    // Update total when tax rate changes
    $(document).on("input", "#taxRate", function () {
        calculateTotal();
    });

// Calculate Amount Due function
function calculateAmountDue() {
    const totalAfterTax = parseFloat($("#totalAftertax").val()) || 0;
    const amountPaid = parseFloat($("#amountPaid").val()) || 0;
    const amountDue = totalAfterTax - amountPaid;

    // Update the Amount Due field
    $("#amountDue").val(amountDue.toFixed(2));
}

// Event listener for Amount Paid input
$(document).on("input", "#amountPaid", function () {
    calculateAmountDue();
});

});
