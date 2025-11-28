<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Profile');
   define('to', ' Store profile');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
   $a_id = $_SESSION['a_id'];
   $a_data= $db->query("SELECT * FROM `admin` WHERE a_id = '$a_id'");
   $a_value=$a_data->fetch_object();
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<div class="content-wrapper">

        <!-- Content -->
        
          <div class="container-xxl flex-grow-1 container-p-y">
            
            
<div class="row">
  <!-- User Sidebar -->
  <div class="col-xl-4 col-lg-5 order-1 order-md-0">
    <!-- User Card -->
    <div class="card mb-6">
      <div class="card-body pt-12">
        <div class="user-avatar-section">
          <div class=" d-flex align-items-center flex-column">
            <img class="img-fluid rounded mb-4" src="../../uploads/<?= $a_value->a_image;?>" height="120" width="120" alt="User avatar">
            <div class="user-info text-center">
              <h5><?= $a_value->a_name;?></h5>
              <span class="badge bg-label-secondary"></span>
            </div>
          </div>
        </div>
        <!--<div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">-->
        <!--  <div class="d-flex align-items-center me-5 gap-4">-->
        <!--    <div class="avatar">-->
        <!--      <div class="avatar-initial bg-label-primary rounded">-->
        <!--        <i class="ti ti-checkbox ti-lg"></i>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--    <div>-->
        <!--      <h5 class="mb-0">1.23k</h5>-->
        <!--      <span>Task Done</span>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--  <div class="d-flex align-items-center gap-4">-->
        <!--    <div class="avatar">-->
        <!--      <div class="avatar-initial bg-label-primary rounded">-->
        <!--        <i class="ti ti-briefcase ti-lg"></i>-->
        <!--      </div>-->
        <!--    </div>-->
        <!--    <div>-->
        <!--      <h5 class="mb-0">568</h5>-->
        <!--      <span>Project Done</span>-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <h5 class="pb-4 border-bottom mb-4">Profile Details</h5>
        <div class="info-container">
          <ul class="list-unstyled mb-6">
            <li class="mb-2">
              <span class="h6">Username:</span>
              <span><?= $a_value->a_name?></span>
            </li>
            <li class="mb-2">
              <span class="h6">Email:</span>
              <span><?= $a_value->a_email?></span>
            </li>
            <li class="mb-2">
              <span class="h6">Status:</span>
              <span>Active</span>
            </li>
            <li class="mb-2">
              <span class="h6">Role:</span>
              <span><?= $a_value->a_type_name?></span>
            </li>
            <!--<li class="mb-2">-->
            <!--  <span class="h6">Tax id:</span>-->
            <!--  <span>Tax-8965</span>-->
            <!--</li>-->
            <li class="mb-2">
              <span class="h6">Contact:</span>
              <span><?= $a_value->a_phone?></span>
            </li>
            <li class="mb-2">
              <span class="h6">Country:</span>
              <span><?= $a_value->a_address?></span>
            </li>
          </ul>
          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-primary me-4 waves-effect waves-light" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
            <!--<a href="javascript:;" class="btn btn-label-danger suspend-user waves-effect">Suspend</a>-->
          </div>
        </div>
      </div>
    </div>
    <!-- /User Card -->
    <!-- Plan Card -->
    <!--<div class="card mb-6 border border-2 border-primary rounded primary-shadow">-->
    <!--  <div class="card-body">-->
    <!--    <div class="d-flex justify-content-between align-items-start">-->
    <!--      <span class="badge bg-label-primary">Standard</span>-->
    <!--      <div class="d-flex justify-content-center">-->
    <!--        <sub class="h5 pricing-currency mb-auto mt-1 text-primary">$</sub>-->
    <!--        <h1 class="mb-0 text-primary">99</h1>-->
    <!--        <sub class="h6 pricing-duration mt-auto mb-3 fw-normal">month</sub>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--    <ul class="list-unstyled g-2 my-6">-->
    <!--      <li class="mb-2 d-flex align-items-center"><i class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span>10 Users</span></li>-->
    <!--      <li class="mb-2 d-flex align-items-center"><i class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span>Up to 10 GB storage</span></li>-->
    <!--      <li class="mb-2 d-flex align-items-center"><i class="ti ti-circle-filled ti-10px text-secondary me-2"></i><span>Basic Support</span></li>-->
    <!--    </ul>-->
    <!--    <div class="d-flex justify-content-between align-items-center mb-1">-->
    <!--      <span class="h6 mb-0">Days</span>-->
    <!--      <span class="h6 mb-0">26 of 30 Days</span>-->
    <!--    </div>-->
    <!--    <div class="progress mb-1 bg-label-primary" style="height: 6px;">-->
    <!--      <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>-->
    <!--    </div>-->
    <!--    <small>4 days remaining</small>-->
    <!--    <div class="d-grid w-100 mt-6">-->
    <!--      <button class="btn btn-primary waves-effect waves-light" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">Upgrade Plan</button>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
    <!-- /Plan Card -->
  </div>
  <!--/ User Sidebar -->


  <!-- User Content -->
  <div class="col-xl-8 col-lg-7 order-0 order-md-1">
    <!-- User Pills -->
    <div class="nav-align-top">
      <ul class="nav nav-pills flex-column flex-md-row mb-6 row-gap-2">
        
        <li class="nav-item"><a class="nav-link waves-effect waves-light" href="javascript:void(0);"><i class="ti ti-lock me-1_5 ti-sm"></i>Update Plofile</a></li>
      </ul>
    </div>
    <!--/ User Pills -->

    <!-- Change Password -->
    <div class="card mb-6">
      <h5 class="card-header">Change Password</h5>
      <div class="card-body">
        <form method="POST" action="action/action.php"  class="fv-plugins-bootstrap5 fv-plugins-framework">
          <!--<div class="alert alert-warning alert-dismissible" role="alert">-->
          <!--  <h5 class="alert-heading mb-1">Ensure that these requirements are met</h5>-->
          <!--  <span>Minimum 8 characters long, uppercase &amp; symbol</span>-->
          <!--  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
          <!--</div>-->
          <div class="row gx-6">
            <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
              <label class="form-label" for="newPassword">New Password</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="············">
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>

            <div class="mb-4 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
              <label class="form-label" for="confirmPassword">Confirm New Password</label>
              <div class="input-group input-group-merge has-validation">
                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············">
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
            </div>
            <div>
              <button type="submit" name="submit" value="update_password" class="btn btn-primary me-2 waves-effect waves-light">Change Password</button>
            </div>
          </div>
        <input type="hidden"></form>
      </div>
    </div>
    <!--/ Change Password -->

 
  </div>
  <!--/ User Content -->
</div>

<!-- Modals -->
<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Edit Profile</h4>
        </div>
        <form  class="row g-6 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" enctype="multipart/form-data" action="action/action.php">
          <!--<div class="col-12 col-md-6 fv-plugins-icon-container">-->
          <!--  <label class="form-label" for="modalEditUserFirstName">First Name</label>-->
          <!--  <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="John">-->
          <!--<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>-->
          <!--<div class="col-12 col-md-6 fv-plugins-icon-container">-->
          <!--  <label class="form-label" for="modalEditUserLastName">Last Name</label>-->
          <!--  <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" value="Doe">-->
          <!--<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>-->
          <div class="col-12 fv-plugins-icon-container">
            <label class="form-label" for="modalEditUserName">Username</label>
            <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" placeholder="johndoe007" value="<?= $a_value->a_name?>" readonly>
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserEmail">Email</label>
            <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="example@domain.com" value="<?= $a_value->a_email?>" readonly>
          </div>
          <!--<div class="col-12 col-md-6">-->
          <!--  <label class="form-label" for="modalEditUserStatus">Status</label>-->
          <!--  <div class="position-relative"><select id="modalEditUserStatus" name="modalEditUserStatus" class="select2 form-select select2-hidden-accessible" aria-label="Default select example" data-select2-id="modalEditUserStatus" tabindex="-1" aria-hidden="true">-->
          <!--    <option selected="" data-select2-id="2">Status</option>-->
          <!--    <option value="1">Active</option>-->
          <!--    <option value="2">Inactive</option>-->
          <!--    <option value="3">Suspended</option>-->
          <!--  </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-modalEditUserStatus-container"><span class="select2-selection__rendered" id="select2-modalEditUserStatus-container" role="textbox" aria-readonly="true" title="Status">Status</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div>-->
          <!--</div>-->
          <!--<div class="col-12 col-md-6">-->
          <!--  <label class="form-label" for="modalEditTaxID">Tax ID</label>-->
          <!--  <input type="text" id="modalEditTaxID" name="modalEditTaxID" class="form-control modal-edit-tax-id" placeholder="123 456 7890" value="123 456 7890">-->
          <!--</div>-->
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserPhone">Phone Number</label>
            <div class="input-group">
              <span class="input-group-text">IND (+91)</span>
              <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" value="<?= $a_value->a_phone?>">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserPhone">Profile Photo</label>
            <div class="input-group">
              <input type="file" id="modalEditUserProfilePhoto" name="a_image" class="form-control">
            </div>
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="address">Address</label>
              <textarea type="text" id="address" name="address" class="form-control" placeholder="Enter Address Here" value=""><?= $a_value->a_address?></textarea>
          </div>
          
          
          <div class="col-12 text-center">
              <input type="hidden" name="a_id" value="<?= $a_value->a_id;?>">
              <input type="hidden" name="a_image" value="<?= $a_value->a_id;?>">
              
            <button type="submit" name="submit" value="update_profile" class="btn btn-primary me-3 waves-effect waves-light">Submit</button>
            <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        <input type="hidden"></form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->

<!-- Enable OTP Modal -->
<div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Enable One Time Password</h4>
          <p>Verify Your Mobile Number for SMS</p>
        </div>
        <p>Enter your mobile phone number with country code and we will send you a verification code.</p>
        <form id="enableOTPForm" class="row g-5 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
          <div class="col-12 fv-plugins-icon-container">
            <label class="form-label" for="modalEnableOTPPhone">Phone Number</label>
            <div class="input-group has-validation">
              <span class="input-group-text">US (+1)</span>
              <input type="text" id="modalEnableOTPPhone" name="modalEnableOTPPhone" class="form-control phone-number-otp-mask" placeholder="202 555 0111">
            </div><div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Submit</button>
            <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        <input type="hidden"></form>
      </div>
    </div>
  </div>
</div>
<!--/ Enable OTP Modal -->

<!-- Add New Credit Card Modal -->
<div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
    <div class="modal-content">
      <div class="modal-body p-4">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Upgrade Plan</h4>
          <p>Choose the best plan for user.</p>
        </div>
        <form id="upgradePlanForm" class="row g-4" onsubmit="return false">
          <div class="col-sm-9">
            <label class="form-label" for="choosePlan">Choose Plan</label>
            <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
              <option selected="">Choose Plan</option>
              <option value="standard">Standard - $99/month</option>
              <option value="exclusive">Exclusive - $249/month</option>
              <option value="Enterprise">Enterprise - $499/month</option>
            </select>
          </div>
          <div class="col-sm-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Upgrade</button>
          </div>
        </form>
      </div>
      <hr class="mx-4 my-2">
      <div class="modal-body p-4">
        <p class="mb-0">User current plan is standard plan</p>
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <div class="d-flex justify-content-center me-2 mt-1">
            <sup class="h6 pricing-currency pt-1 mt-2 mb-0 me-1 text-primary">$</sup>
            <h1 class="mb-0 text-primary">99</h1>
            <sub class="pricing-duration mt-auto mb-5 pb-1 small text-body">/month</sub>
          </div>
          <button class="btn btn-label-danger cancel-subscription waves-effect">Cancel Subscription</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Add New Credit Card Modal -->

<!-- /Modals -->
          </div>
          <!-- / Content -->



          
          <div class="content-backdrop fade"></div>
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
