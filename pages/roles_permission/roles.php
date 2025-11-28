<?php 
   global $page_type;
   $page_type = 'roles';
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   define('from', 'Setup');
   define('to', 'Setup Your Account');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
?>


<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="mb-4">Roles List</h4>
   <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role an administrator can have access to what user needs.</p>
   <!-- Role cards -->
   <div class="row g-4">
      <?php 
         $data = $db->query("SELECT * FROM `roles` WHERE consumer_id = '$consumer_id'");
         while($value = $data->fetch_object()){
            $r_id = $value->r_id;
            $admins = $db->query("SELECT * FROM `admin` WHERE r_id = '$r_id' AND consumer_id = '$consumer_id'");
      ?>
      <div class="col-xl-4 col-lg-6 col-md-6">
         <div class="card">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <h6 class="fw-normal mb-2">Total <?=$admins->num_rows?> users</h6>
                  <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                     <?php 
                        $admins = $db->query("SELECT * FROM `admin` WHERE r_id = '$r_id' AND consumer_id = '$consumer_id' LIMIT 6");
                        if ($admins->num_rows == 0) {
                           // code...
                        }else{
                        while($admins_value = $admins->fetch_object()){
                     ?>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                           <img class="rounded-circle" src="<?=website_name;?>/uploads/<?=$admins_value->img1;?>" alt="Avatar">
                        </li>
                     <?php } } ?>
                  </ul>
               </div>
               <div class="d-flex justify-content-between align-items-end mt-1">
                  <div class="role-heading">
                     <h4 class="mb-1"><?=$value->roles_name;?></h4>
                     <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editrole_model<?=$value->r_id;?>" class="role-edit-modal"><span>Edit Role</span></a>
                  </div>
                  <a href="<?=website_name?>/pages/roles_permission/action/manage_roles?submit=delete_roles&roles_id=<?=$value->r_id;?>" class="text-muted"><i class="ti ti-trash-filled ti-md text-danger"></i></a>
               </div>
            </div>
         </div>
      </div>
   <?php } ?>






      <div class="col-xl-4 col-lg-6 col-md-6">
         <div class="card h-100">
            <div class="row h-100">
               <div class="col-sm-5">
                  <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                     <img src="<?=website_name;?>/assets/img/illustrations/add-new-roles.png" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                  </div>
               </div>
               <div class="col-sm-7">
                  <div class="card-body text-sm-end text-center ps-sm-0">
                     <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Role</button>
                     <p class="mb-0 mt-1">Add role, if it does not exist</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/ Role cards -->
   <!-- Add Role Modal -->
   <!-- Add Role Modal -->
   <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
         <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
               <div class="text-center mb-4">
                  <h3 class="role-title mb-2">Add New Role</h3>
                  <p class="text-muted">Set role permissions</p>
               </div>
               <!-- Add role form -->
               <form id="" class="row g-3" action="<?=website_name?>/pages/roles_permission/action/manage_roles.php" >
                  <div class="col-12 mb-4">
                     <label class="form-label" for="modalRoleName">Role Name</label>
                     <input type="text" id="modalRoleName" name="roles_name" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                  </div>
                  <div class="col-12">
                     <h5>Role Permissions</h5>
                     <!-- Permission table -->
                     <div class="table-responsive">
                        <table class="table table-flush-spacing">
                           <tbody>
<!--                               <tr>
                                 <td class="text-nowrap fw-medium">Administrator Access <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                 <td>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="selectAll" />
                                       <label class="form-check-label" for="selectAll">
                                       Select All
                                       </label>
                                    </div>
                                 </td>
                              </tr>
 -->                              <?php
                                 $sl = 0;
                                 $page = $db->query("SELECT * FROM `pages` WHERE consumer_id = '$consumer_id'");
                                 while ($page_value = $page->fetch_object()) {
                                    $sl++;
                              ?>
                              <tr>
                                 <td class="text-nowrap fw-medium"><?=$page_value->name;?>
                                    <input type="hidden" name="p_id[]" value="<?=$page_value->p_id;?>">
                                    <input type="hidden" name="sl[]" value="<?=$sl;?>">
                                 </td>
                                 <td>
                                    <div class="d-flex">
                                       <div class="form-check me-3 me-lg-5">
                                          <input class="form-check-input" type="checkbox" name="reads[]" value="1" id="userManagementRead<?=$sl?>" />
                                          <label class="form-check-label" for="userManagementRead<?=$sl?>">
                                          Read
                                          </label>
                                       </div>
                                       <div class="form-check me-3 me-lg-5">
                                          <input class="form-check-input" type="checkbox" name="writes[]" value="1" id="userManagementWrite<?=$sl?>" />
                                          <label class="form-check-label" for="userManagementWrite<?=$sl?>">
                                          Write
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="creates[]" value="1" id="userManagementCreate<?=$sl?>" />
                                          <label class="form-check-label" for="userManagementCreate<?=$sl?>">
                                          Create
                                          </label>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           <?php } ?>


                           </tbody>
                        </table>
                     </div>
                     <!-- Permission table -->
                  </div>
                  <div class="col-12 text-center mt-4">
                     <button type="submit" name="submit" value="add_roles" class="btn btn-primary me-sm-3 me-1">Submit</button>
                     <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
               </form>
               <!--/ Add role form -->
            </div>
         </div>
      </div>
   </div>
   <!--/ Add Role Modal -->







<?php 
   $edit_role = $db->query("SELECT * FROM `roles` WHERE consumer_id = '$consumer_id'");
   while($edit_role_value = $edit_role->fetch_object()){
      $r_id = $edit_role_value->r_id;
?>

   <!-- Edit Role Modal -->
   <div class="modal fade" id="editrole_model<?=$edit_role_value->r_id;?>" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
         <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
               <div class="text-center mb-4">
                  <h3 class="role-title mb-2">Update <?=$edit_role_value->roles_name;?></h3>
                  <p class="text-muted">Set role permissions</p>
               </div>
               <!-- Add role form -->
               <form class="row g-3" action="<?=website_name?>/pages/roles_permission/action/manage_roles.php" >
                  <div class="col-12 mb-4">
                     <input type="hidden" name="r_id" value="<?=$edit_role_value->r_id;?>">
                     <label class="form-label" for="modalRoleName">Role Name</label>
                     <input type="text" id="modalRoleName" name="roles_name" class="form-control" placeholder="Enter a role name" tabindex="-1" value="<?=$edit_role_value->roles_name;?>" />
                  </div>
                  <div class="col-12">
                     <h5>Role Permissions</h5>
                     <!-- Permission table -->
                     <div class="table-responsive">
                        <table class="table table-flush-spacing">
                           <tbody>
<!--                               <tr>
                                 <td class="text-nowrap fw-medium">Administrator Access <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                 <td>
                                    <div class="form-check">
                                       <input class="form-check-input" type="checkbox" id="selectAll<?=$edit_role_value->r_id;?>" />
                                       <label class="form-check-label" for="selectAll<?=$edit_role_value->r_id;?>">
                                       Select All
                                       </label>
                                    </div>
                                 </td>
                              </tr>
 -->                              <?php
                                 $sl = 0;
                                 $page = $db->query("SELECT * FROM `pages` WHERE consumer_id = '$consumer_id'");
                                 while ($page_value = $page->fetch_object()) {
                                    $sl++;
                                    $p_id = $page_value->p_id;
                                    $access_data = $db->query("SELECT * FROM `access` WHERE p_id = '$p_id' AND r_id = '$r_id'");
                                    $access_value = $access_data->fetch_object();
                                    $reads = $access_value->reads;
                                    $writes = $access_value->writes;
                                    $creates = $access_value->creates;
                                    if ($reads == 1) {
                                       $reads =  'checked';
                                    }else{
                                       $reads = '';
                                    }

                                    if ($writes == 1) {
                                       $writes =  'checked';
                                    }else{
                                       $writes = '';
                                    }

                                    if ($creates == 1) {
                                       $creates =  'checked';
                                    }else{
                                       $creates = '';
                                    }


                              ?>
                              <tr>
                                 <td class="text-nowrap fw-medium"><?=$page_value->name;?>
                                    <input type="hidden" name="p_id[]" value="<?=$page_value->p_id;?>">
                                    <input type="hidden" name="sl[]" value="<?=$sl;?>">
                                    <input type="hidden" name="acs_id[]" value="<?=$access_value->acs_id;?>">
                                 </td>
                                 <td>
                                    <div class="d-flex">
                                       <div class="form-check me-3 me-lg-5">
                                          <input class="form-check-input" type="checkbox" name="reads[]" <?=$reads;?> value="1" id="<?=label($page_value->name)?>Read<?=$sl?>" />
                                          <label class="form-check-label" for="<?=label($page_value->name)?>Read<?=$sl?>">
                                          Read
                                          </label>
                                       </div>
                                       <div class="form-check me-3 me-lg-5">
                                          <input class="form-check-input" type="checkbox" name="writes[]" <?=$writes;?> value="1" id="<?=label($page_value->name)?>Write<?=$sl?>" />
                                          <label class="form-check-label" for="<?=label($page_value->name)?>Write<?=$sl?>">
                                          Write
                                          </label>
                                       </div>
                                       <div class="form-check">
                                          <input class="form-check-input" type="checkbox" name="creates[]" <?=$creates;?>   value="1" id="<?=label($page_value->name)?>Create<?=$sl?>" />
                                          <label class="form-check-label" for="<?=label($page_value->name)?>Create<?=$sl?>">
                                          Create
                                          </label>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           <?php } ?>


                           </tbody>
                        </table>
                     </div>
                     <!-- Permission table -->
                  </div>
                  <div class="col-12 text-center mt-4">
                     <button type="submit" name="submit" value="update_roles" class="btn btn-primary me-sm-3 me-1">Update</button>
                     <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                  </div>
               </form>
               <!--/ Add role form -->
            </div>
         </div>
      </div>
   </div>
   <!--/ Add Role Modal -->

<?php } ?>







   <!-- / Add Role Modal -->
</div>
<!-- / Content -->


<?php 
   include '../../include/footer.php';
 ?>