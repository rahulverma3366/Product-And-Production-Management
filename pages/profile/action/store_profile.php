<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Profile');
   define('to', 'Store profile');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
   $store = $_REQUEST['store'];
   $a_data= $db->query("SELECT * FROM `stors` WHERE sto_id = '$store'");
   $a_value=$a_data->fetch_object();
      $create_at = date("Y-m-d");
    $month = date("m");
    $last_month = $month - 1;

    $data = $db->query("SELECT * FROM `sales` WHERE sto_id='$store' AND create_at like '%$create_at%'");
    $today_total = $data->num_rows;
    $today_paid_amount = $db->query("SELECT sum(paid_amount) AS today_paid_total FROM `sales` WHERE sto_id='$store' AND create_at like '%$create_at%'");
    $today_paid_value = $today_paid_amount->fetch_object();
    $today_paid_price = $today_paid_value->today_paid_total;
   
   
    $data1 = $db->query("SELECT * FROM sales WHERE sto_id='$store' AND  MONTH(create_at)='$month'");
    $month_total = $data1->num_rows; 
    $monthly_data = $db->query("SELECT sum(paid_amount) AS new_paid_price FROM sales WHERE sto_id='$store' AND MONTH(create_at)='$month'");
    $monthly_value = $monthly_data->fetch_object();
    $monthly_price = $monthly_value->new_paid_price;
    






    $data2 = $db->query("SELECT * FROM sales WHERE sto_id='$store' AND MONTH(create_at)='$last_month'");
    $last_month_total = $data2->num_rows; 
    $last_month_paid_amount = $db->query("SELECT SUM(paid_amount) AS total_paid_monthly FROM sales WHERE sto_id='$store' AND MONTH(create_at)='$last_month'");
    $last_month_paid_value = $last_month_paid_amount->fetch_object();
    $last_month_paid_price= $last_month_paid_value->total_paid_monthly
  
    // $paid_price2=$today_value2->total_paid_monthly;
    // $price2 += $paid_price2;
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
            <img class="img-fluid rounded mb-4" src="../../assets/img/avatars/1.png" height="120" width="120" alt="User avatar">
            <div class="user-info text-center">
              <h5><?= $a_value->name;?></h5>
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
              <span class="h6">GST NO:</span>
              <span><mark><?= $a_value->gst_no?></mark></span>
            </li>
            <li class="mb-2">
              <span class="h6">Username:</span>
              <span><?= $a_value->name?></span>
            </li>
            <li class="mb-2">
              <span class="h6">Email:</span>
              <span><?= $a_value->email?></span>
            </li>
            <li class="mb-2">
              <span class="h6">Status:</span>
              <span>Active</span>
            </li>
            <li class="mb-2">
              <span class="h6">Role:</span>
              <span>Store</span>
            </li>
            <!--<li class="mb-2">-->
            <!--  <span class="h6">Tax id:</span>-->
            <!--  <span>Tax-8965</span>-->
            <!--</li>-->
            <li class="mb-2">
              <span class="h6">Contact:</span>
              <span><?= $a_value->mobile?></span>
            </li>
            <li class="mb-2">
              <span class="h6">Country:</span>
              <span><?= $a_value->address?></span>
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
        
        <li class="nav-item"><a class="nav-link waves-effect waves-light" href="javascript:void(0);"><i class="ti ti-lock me-1_5 ti-sm"></i>Statistics</a></li>
      </ul>
    </div>
    <!--/ User Pills -->

    <!-- Change Password -->
   <div class="row">
       <div class="col-lg-4 col-sm-6">
    <div class="card card-border-shadow-primary h-100">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-truck ti-28px"></i></span>
          </div>
          <p class="mb-0"> Sale No <?= $today_total;?> </p>
                <h5 class="mb-0"> Rs. <?php if(empty($today_paid_price)){echo "0";}else{echo $today_paid_price;}?> </h5>
        </div>
        <p class="mb-1">Today Sale </p>
        <!--<p class="mb-0">-->
        <!--  <span class="text-heading fw-medium me-2">+18.2%</span>-->
       
        <!--</p>-->
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-6">
    <div class="card card-border-shadow-warning h-100">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-package ti-26px"></i></span>
          </div>
          
         <p class="mb-0"> Sale No. <?= $month_total;?> </p>
                <h5 class="mb-0"> Rs. <?php if(empty($monthly_price)){echo "0";}else{echo $monthly_price;}?>  </h5>
        </div>
        <p class="mb-1"> Monthly Sale</p>
        <!--<p class="mb-0">-->
        <!--  <span class="text-heading fw-medium me-2">-8.7%</span>-->
       
        <!--</p>-->
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-sm-6">
    <div class="card card-border-shadow-info h-100">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <div class="avatar me-4">
            <span class="avatar-initial rounded bg-label-info"><i class="ti ti-clock ti-28px"></i></span>
          </div>
            <p class="mb-0"> Sale No. <?= $last_month_total;?> </p>
                <h5 class="mb-0"> Rs. <?php if(empty($last_month_paid_price)){echo "0";}else{echo $last_month_paid_price;}?></h5>
        </div>
        <p class="mb-1">Last Month Sale</p>
        <!--<p class="mb-0">-->
        <!--  <span class="text-heading fw-medium me-2">-2.5%</span>-->
         
        <!--</p>-->
      </div>
    </div>
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
        <form  class="row g-6 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="action/action.php">
          <!--<div class="col-12 col-md-6 fv-plugins-icon-container">-->
          <!--  <label class="form-label" for="modalEditUserFirstName">First Name</label>-->
          <!--  <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName" class="form-control" placeholder="John" value="John">-->
          <!--<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>-->
          <!--<div class="col-12 col-md-6 fv-plugins-icon-container">-->
          <!--  <label class="form-label" for="modalEditUserLastName">Last Name</label>-->
          <!--  <input type="text" id="modalEditUserLastName" name="modalEditUserLastName" class="form-control" placeholder="Doe" value="Doe">-->
          <!--<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>-->
          <div class="col-12 col-md-6 fv-plugins-icon-container">
            <label class="form-label" for="modalEditUserName">Username</label>
            <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control" placeholder="johndoe007" value="<?= $a_value->name?>">
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserEmail">Email</label>
            <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control" placeholder="example@domain.com" value="<?= $a_value->email?>">
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
              <input type="text" id="modalEditUserPhone" name="modalEditUserPhone" class="form-control phone-number-mask" placeholder="202 555 0111" value="<?= $a_value->mobile?>">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="gst_no">GST NO</label>
            <input type="text" id="gst_no" name="gst_no" class="form-control" placeholder="Enter GST No" value="<?= $a_value->gst_no?>">
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label" for="address">Address</label>
              <textarea type="text" id="address" name="address" class="form-control" placeholder="Enter Address Here" value=""><?= $a_value->address?></textarea>
          </div>
          
          
          
          <div class="col-12 text-center">
              <input type="hidden" value="<?= $store;?>" name="store">
            <button type="submit" name="submit" value="update_store_profile" class="btn btn-primary me-3 waves-effect waves-light">Submit</button>
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
