<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Store');
   define('to', 'Store List');
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
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New User</span></span></button></div>
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
          <th>Name</th>
          
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Password</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `admin` ORDER BY a_id DESC");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td>
               <div class="d-flex align-items-center">
                  <a href="edit_users.php?a_id=<?=$value->a_id;?>" class="text-body openPopup"  ><i class="ti ti-edit ti-sm me-2"></i></a>
                  <a href="action/action?submit=delete_admin&a_id=<?=$value->a_id;?>" class="text-body delete-record "><i class="ti ti-trash ti-sm mx-2"></i></a>
               </div>
            </td>
            <td><a href="../../pages/profile/store_profile?store=<?= $value->a_id;?>"><?=$value->a_name;?></a></td>
            
            <td><?=$value->a_email;?></td>
            <td><?=$value->a_phone;?></td>
            <td><?=$value->a_address;?></td>
           <td><?=$value->a_vpwd;?></td>
         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add New User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/action.php" method="" enctype="multipart/form-data" >
        <div class="mb-3">
         <label for="name" > Name</label>
         <input type="text"  id="name"  placeholder="Enter Name"  class="form-control" name="a_name" value=""/>
        </div>
        <div class="mb-3">
           <label for="gst_no" > Password</label>
           <input type="password"  id="gst_no"  placeholder="Enter Password"  class="form-control" name="a_vpwd" value=""/>
          </div>
          <div class="mb-3">
           <label for="mobile" > Mobile</label>
           <input type="text"  id="mobile"  placeholder="Mobile"  class="form-control" name="a_phone" value=""/>
          </div>
          <div class="mb-3">
           <label for="email" > Email</label>
           <input type="text"  id="email"  placeholder="Email"  class="form-control" name="a_email" value=""/>
          </div>
          <div class="mb-3">
           <label for="address" > Address</label>
           <input type="text"  id="address"  placeholder="Address"  class="form-control" name="a_address" value=""/>
          </div>
          <div class="mb-3">
           <label for="address" > User Type</label>
          <select name="a_type" class="form-control">
              <option value="3">Accounts</option>
              <option value="4">Worker</option>
          </select>
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


</script>

   <script src="<?=website_name;?>/assets/js/app-user-list.js"></script>
