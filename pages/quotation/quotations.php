<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Sale');
   define('to', ' Sale List');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
   $a_id = $_SESSION['a_id'];
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<div class="card">
<!--   <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New  Products</span></span></button></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
 -->  <div class="card-datatable table-responsive">
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Actions</th>
          <th>Sale No </th>
          <th>Details</th>
          <th>Total Payment </th>
          <th>Sale Date</th>
          <th> Date</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `quotation` WHERE  user_id = '$a_id'");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td>
               <div class=" align-items-center">
                  <a href="quotation_preview?quotation_no=<?=$value->invoice_no;?>" class="btn btn-primary btn-sm form-control"  >print</a>

               </div>
            </td>
            <td># <?=$value->invoice_no;?></td>

            <td>
                <p class="mb-0"><?=$value->name;?></p>
                <p class="mb-0"><?=$value->mobile_no;?></p>
                <p class="mb-0"><?=$value->email_id;?></p>
            </td>
            <td><?=$value->total;?></td>
            <td><?=$value->order_date ?></td>
            <td><?=$value->create_at ?></td>


         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
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

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
