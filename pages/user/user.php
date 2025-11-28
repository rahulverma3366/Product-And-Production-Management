<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Setup');
   define('to', 'Setup Your Account');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
   $user_id = $_SESSION['a_id'];
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
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
          <th>Name</th>
          <th>Mob. No</th>
          <th>Email</th>
          <th>Type</th>
          <th>Role</th>
          <th>Password</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $Sl = 0;
            $data = $db->query("SELECT * FROM `admin` WHERE consumer_id = '$consumer_id'");
            while ($value = $data->fetch_object()) {
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td><?=$value->a_name;?></td>
            <td><?=$value->a_phone?></td>
            <td><?=$value->a_email?></td>
            <td><?php  type_of_user($value->a_type)?></td>
            <td><span class="badge bg-label-info"><?php  type_of_roles($db, $value->r_id)?></span></td>
            <td>
              <input id="password-field<?=$sl;?>" type="password" readonly class="" name="password" value="<?=$value->a_vpwd?>">
              <span toggle="#password-field<?=$sl;?>" class="fa fa-fw fa-eye field-icon toggle-password<?=$sl;?>"></span>
              <script type="text/javascript">
                    $(".toggle-password<?=$sl;?>").click(function() {

                    $(this).toggleClass("fa-eye fa-eye-slash");
                    var input<?=$sl;?> = $($(this).attr("toggle"));
                    if (input<?=$sl;?>.attr("type") == "password") {
                      input<?=$sl;?>.attr("type", "text");
                    } else {
                      input<?=$sl;?>.attr("type", "password");
                    }
                  });
              </script>


            </td>
            <td>
               <div class="d-flex align-items-center">
                  <a href="edit_modal.php?a_id=<?=$value->a_id;?>" class="text-body openPopup"  ><i class="ti ti-edit ti-sm me-2"></i></a>

                         <a href="action/manage_user?submit=delete&a_id=<?=$value->a_id;?>" class="text-body delete-record "><i class="ti ti-trash ti-sm mx-2"></i></a>
           
                  <a href="javascript:;" class="text-body dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="true"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
                  
                  <div class="dropdown-menu dropdown-menu-end m-0 " data-popper-placement="bottom-end" >
                     <a href="#" class="dropdown-item">View</a>
                     <?php 
                        if ($value->a_status == 1) {
                     ?>
                     <a href="action/manage_user?submit=suspend&a_id=<?=$value->a_id;?>" class="dropdown-item">Suspend</a>
                  <?php } else { ?>
                     <a href="action/manage_user?submit=unblock&a_id=<?=$value->a_id;?>" class="dropdown-item">Unblock</a>

                  <?php } ?>
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
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/manage_user.php" >
        <div class="mb-3">
          <label class="form-label" for="add-user-fullname">Full Name</label>
          <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="a_name" aria-label="John Doe" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-email">Email</label>
          <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="a_email" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-contact">Contact</label>
          <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+91 9888-444-111" aria-label="john.doe@example.com" name="a_phone" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-user-company">Company</label>
          <input type="text" id="add-user-company" class="form-control" placeholder="Techzex" aria-label="jdoe1" name="a_company" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="a_password">Password</label>
          <input type="password" id="a_password" class="form-control" placeholder="*******" aria-label="jdoe1" name="a_password" />
        </div>



        <div class="mb-3">
          <label class="form-label" for="country">User Type</label>
          <select id="country" name="a_type" class=" form-select" required>
            <option value="">Select</option>
            <option value="2">Manufactorer </option>
            <option value="3">Distributer</option>
            <option value="4">Dealer</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="user-role">User Role</label>
          <select id="user-role" name="r_id" class="form-select" required>
            <option value="">Select</option>
            <?php 
               $role = $db->query("SELECT * FROM `roles` WHERE consumer_id = '$consumer_id'");
               while($role_value = $role->fetch_object()){
            ?>
               <option value="<?=$role_value->r_id?>"><?=$role_value->roles_name?></option>
            <?php } ?>
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
