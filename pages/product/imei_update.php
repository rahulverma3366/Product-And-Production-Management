<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Products');
   define('to', 'IMEI Updaet');
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
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Manage IMEI </span></span></button></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <form action="action/manage_imei_update.php" method="">
        
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
                            <th >
                                <input class="form-check-input check-all-js" type="checkbox" value="all">
                            </th>
          <th>Actions</th>
          <th>Product Name</th>
          <th>IMEI No</th>
          <th>UID No</th>
          <th>CCID No</th>
          <th>Sold</th>
          <th>Status</th>
          <th>Create at</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `imei_update` WHERE consumer_id = '$consumer_id' AND trash = 0 ");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td >
                                <input class="form-check-input single-check-js" type="checkbox" name="imei_id[]" value="<?php echo $value->imei_id;?>">
                                <input class="form-check-input single-check-js" type="hidden" value="<?php echo $sl;?>">

            </td>
            <td>
               <div class="d-flex align-items-center">
                  <a href="edit_imei_update.php?imei_id=<?=$value->imei_id;?>" class="text-body openPopup"  ><i class="ti ti-edit ti-sm me-2"></i></a>
                  <a href="action/manage_imei_update?submit=delete&imei_id=<?=$value->imei_id;?>" class="text-body delete-record "><i class="ti ti-trash ti-sm mx-2"></i></a>
               </div>
            </td>
            <td><?php echo  products($db,$value->p_id);?></td>
            <td><?php echo $value->imei_no;?></td>
            <td><?php echo $value->uid_no;?></td>
            <td><?php echo $value->ccid_no;?></td>
            <td><?php echo sold_check($value->sold);?></td>
            <td><?php echo $value->sts;?></td>
            <td><?php echo $value->create_at;?></td>
         </tr>
      <?php } ?>
      </tbody>
    </table>
          <button class="btn btn-danger ml-2" type="submit" name="submit" value="delete_multiple">Delete Check</button>
    </form>

  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add <?=to?></h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/manage_imei_update.php" method="POST" enctype="multipart/form-data" >
        <div class="mb-3">
         <label for="p_id" > Select Product</label>
          <select id="p_id" name="p_id" class="form-select" required>
            <option value="">Select</option>
            <?php 
               $data = $db->query("SELECT * FROM `products` WHERE consumer_id = '$consumer_id'");
               while($data_value = $data->fetch_object()){
            ?>
               <option value="<?=$data_value->p_id?>"><?=$data_value->product_name?></option>
            <?php } ?>
          </select>
        </div>


          <div class="mb-3">
           <label for="product_name" > Upload Excel</label>
           <input type="file"  id="product_name"  placeholder="Product Name"  class="form-control" name="excel" value="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  />
          </div>

        <button type="submit" name="submit" value="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
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

$(function() {
           // check and uncheck all single checkboxes with check-all checkbox
            $('.check-all-js').on('change', function() {
                var single_check = $('.single-check-js');

                single_check.each((index, element) => {
                    element.checked = this.checked;
                })  
            })

            // check and uncheck major (check-all) checkbox with single checkboxes
            $('.single-check-js').on('change', function() { 
                var single_check = $('.single-check-js');
                var all_checked = true;

                single_check.each((index, element) => {
                    if ( element.checked === false ) {
                        all_checked = false;
                    }
                })

                document.querySelector('.check-all-js').checked = all_checked;
            })


        })
</script>

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
