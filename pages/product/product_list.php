<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Products');
   define('to', 'Manage Product List');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from?> /</span> <?=to?>
</h4>
<div class="card">
  <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add Product</span></span></button></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Actions</th>
      
          <th>Product Name</th>
          <th>Qty</th>
          <th>unit</th>
          <th>Price</th>
          <th>Add Date</th>
          <th>Create at</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `product`");
            while ($value = $data->fetch_object()) {
                $pn_id = $value->pn_id;
                $data1 = $db->query("SELECT * FROM `product_name` WHERE pn_id='$pn_id'");
                $value1 = $data1->fetch_object();
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td>
               <div class="d-flex align-items-center">
                  <a href="edit_product_list.php?p_id=<?=$value->p_id;?>" class="text-body openPopup"  ><i class="ti ti-edit ti-sm me-2"></i></a>
                  <a href="action/manage_product_list?submit=p_delete&p_id=<?=$value->p_id;?>" class="text-body delete-record "><i class="ti ti-trash ti-sm mx-2"></i></a>
               </div>
            </td>
          
            <td><?php echo $value1->name;?></td>
            <td><?php echo $value->qty;?></td>
            <td><?php echo $value->unit;?></td>
            <td><?php echo $value->price;?></td>
            <td><?php echo $value->add_date;?></td>
            <td><?php echo $value->create_at;?></td>
         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add <?=to?></h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/manage_product_list.php" method="POST" enctype="multipart/form-data" >
          <div class="mb-3">
           <label for="product_name" > Product  Name (Model Name)</label>
          <select name="pn_id" class="form-select">
                <option value="">Select Product Name (Model Name)</option>
               <?php
                $data=$db->query("SELECT * FROM `product_name`");
                while($value = $data->fetch_object()){
               ?>
               <option value="<?= $value->pn_id?>"><?= $value->name?></option>
               <?php }?>
            </select>
          </div>
          <div class="mb-3">
           <label for="Quantity" > Product Quantity</label>
           <input type="text"  id="Quantity"  placeholder="Product Quantity"  class="form-control" name="qty" value=""/>
          </div>
          <div class="mb-3">
           <label for="hsn_sac" > Unit</label>
            <select name="unit" class="form-select">
                <option value="" disabled selected>Select unit</option>
                <option value="cm">CM</option>
                <option value="bag">Bag</option>
            </select>
          </div>
          <div class="mb-3">
           <label for="mrp" > MRP</label>
           <input type="text"  id="mrp"  placeholder="MRP"  class="form-control" name="price" value=""/>
          </div>
             <!-- New Date Input -->
            <div class="mb-3">
                <label for="create_date">Date</label>
                <input type="date" id="create_date" class="form-control" name="add_date" value="<?= date('Y-m-d') ?>" />
            </div>
        <button type="submit" name="submit" value="p_submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>


<!--Stock Management (Total vs Sold vs Remaining)-->
<div class="card mt-3">
  <div class="card-header border-bottom">
    <h5>Stock Update</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="table" id="stockManagementTable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Product Name</th>
          <th>Unit</th>
          <th>Total Stock</th>
          <th>Sold</th>
          <th>Remaining Stock</th>
        </tr>
      </thead>
      <tbody>
<?php
$sl = 0;
$data = $db->query("
  SELECT 
    pn.name AS product_name, 
    p.unit, 
    SUM(p.qty) AS total_quantity, 
    COALESCE(sales.total_sold, 0) AS total_sold, 
    (SUM(p.qty) - COALESCE(sales.total_sold, 0)) AS remaining_stock 
  FROM 
    product p 
  JOIN 
    product_name pn ON p.pn_id = pn.pn_id 
  LEFT JOIN (
    SELECT 
      item_name, 
      unit, 
      SUM(quantity) AS total_sold 
    FROM 
      sales_order 
    GROUP BY 
      item_name, unit
  ) sales ON p.pn_id = sales.item_name AND p.unit = sales.unit 
  GROUP BY 
    pn.name, p.unit
");

while ($value = $data->fetch_object()) {
    $sl++;
?>
<tr>
  <td><?= $sl; ?></td>
  <td><?= htmlspecialchars($value->product_name); ?></td>
  <td><?= htmlspecialchars($value->unit); ?></td>
  <td><?= number_format($value->total_quantity, 2); ?></td>
  <td><?= number_format($value->total_sold, 2); ?></td>
  <td><?= number_format($value->remaining_stock, 2); ?></td>
</tr>
<?php } ?>



      </tbody>
    </table>
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

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
