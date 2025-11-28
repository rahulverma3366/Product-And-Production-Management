<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Sales Item');
   define('to', 'Dealer ');
   function label($label)
   {
      $title =  str_replace('_', ' ', $label);
      echo ucwords($title);

   } 
?>
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light"><?=from;?> /</span> <?=to;?>
</h4>


<div class="card">
  <div class="card-datatable p-5">
    <div class="row">
      <div class="col-md-6">
        <form action="sale_device.php" method="GET" enctype="multipart/form-data">
            <div class="form-group">
              <label for="">Select Dealer</label>
              <select name="cs_id" class=" form-select" id="" data-allow-clear="true">
                <option value="">Select Dealer</option>
                <?php 
                  $user_id = $_SESSION['a_id'];
                  $cs = $db->query("SELECT * FROM `admin` WHERE consumer_id = '$consumer_id' AND a_id != '$user_id' AND a_type = 4");
                  while ($cs_value = $cs->fetch_object()) {
                ?>
                  <option value="<?=$cs_value->a_id;?>"><?=$cs_value->a_name;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-wave mt-3">Proceed</button>
            </div>
        </form>
      </div>
      <div class="col-md-6">
          <div class="d-flex justify-content-between align-items-center row mt-4 gap-3 gap-md-0">
            <div class=" "><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New  Dealer</span></span></button></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
          </div>
      </div>
    </div>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Dealer</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/manage_custumer.php" method="POST" enctype="multipart/form-data" >
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
         <label for="register_address" > Register Address</label>
         <textarea name="register_address" placeholder="Register Address" class="form-control" id="" ></textarea>
        </div>

        <button type="submit" name="submit" value="submit_select_custumer" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
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
