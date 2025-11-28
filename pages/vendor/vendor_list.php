<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Vendor Section');
   define('to', 'Vendor List');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
?>
<div class="container-xxl flex-grow-1 container-p-y">

<div class="card">
  <div class="card-header border-bottom">
    <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New  Vendor</span></span></button></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Name</th>
          <th>Mob. No</th>
          <th>Email Id</th>
          <th>GST No</th>
          <th>GST Cerfiticate </th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `vendor`");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td><?=$value->name;?></td>
            <td><?=$value->mobile_no?></td>
            <td><?=$value->email_id ?></td>
            <td><?=$value->gst_no ?></td>
            <td>
              <?php 
                if (!empty($value->img1)) {
              ?>
                  <a href="<?=website_name?>/uploads/<?=$value->img1?>" target="_blank" class="btn btn-primary">view</a>
              <?php } ?>
            </td>
            
            <td>
               <div class="d-flex align-items-center">
                  <a href="edit_vendor_list.php?vd_id=<?=$value->vd_id;?>" class="text-body openPopup"  ><i class="ti ti-edit ti-sm me-2"></i></a>

                  <a href="action/manage_vendor?submit=delete&vd_id=<?=$value->vd_id;?>" class="text-body delete-record "><i class="ti ti-trash ti-sm mx-2"></i></a>

                  <a href="javascript:;" class="text-body dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
                  <div class="dropdown-menu dropdown-menu-end m-0 " data-popper-placement="bottom-end" >
                     <a href="#" class="dropdown-item">View</a>
                  </div>
               </div>
            </td>
         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Vendor</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/manage_vendor.php" method="POST" enctype="multipart/form-data" >
        <div class="mb-3">
         <label for="name" > Name</label>
         <input type="text"  id="name"  placeholder="Name"  class="form-control" name="name" value=""/>
        </div>
        <div class="mb-3">
         <label for="mobile_no" > Mobile No</label>
         <input type="text"  id="mobile_no"  placeholder="Mobile No"  class="form-control" name="mobile_no" value=""/>
        </div>
        <div class="mb-3">
         <label for="email_id" > Email Id</label>
         <input type="text"  id="email_id"  placeholder="Email Id"  class="form-control" name="email_id" value=""/>
        </div>
        <div class="mb-3">
         <label for="gst_no" > Gst No</label>
         <input type="text"  id="gst_no"  placeholder="Gst No"  class="form-control" name="gst_no" value=""/>
        </div>
        <div class="mb-3">
         <label for="img1" > Gst Image</label>
         <input type="file"  id="img1"  placeholder="Img1"  class="form-control" name="img1" value=""/>
        </div>
        <!--<div class="mb-3">-->
        <!-- <label for="register_address" > Register Address</label>-->
        <!-- <textarea name="register_address" placeholder="Register Address" class="form-control" id="" ></textarea>-->
        <!--</div>-->

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


</script>

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
