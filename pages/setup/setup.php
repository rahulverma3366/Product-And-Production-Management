<?php 
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



<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
   <h4 class="py-3 mb-4"><span class="text-muted fw-light"><?=from?>/</span> <?=to?></h4>
<div class="row">
   <div class="col">
      <div class="card mb-3">
         <div class="card-header pt-2">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
               <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#store-setup" role="tab" aria-selected="true">Store Setup </button>
               </li>

               <?php 
                  $a_type = $user_values->a_type;
                  if ($a_type == 2) {

               ?>
               <li class="nav-item">
                  <button class="nav-link " data-bs-toggle="tab" data-bs-target="#form-tabs-personal" role="tab" aria-selected="true">Fronted Setup </button>
               </li>
            <?php } ?>


            </ul>
         </div>
         <div class="tab-content">
            <!-- Personal Info -->




            <!-- Account Details -->
            <div class="tab-pane active show" id="store-setup" role="tabpanel">
               <form enctype="multipart/form-data" action="<?=website_name?>/pages/setup/action/setup_action.php" method="POST">
                  <input type="hidden" value="4" name="shows">
                  <div class="row g-3">
                     <?php 
                        $data = $db->query("SELECT * FROM `store_setting` WHERE consumer_id = '$consumer_id' AND user_id = '$a_id'");
                        if ($data->num_rows == 0) {
                           $store_name = '';
                           $store_mobile_no = '';
                           $store_email_id = '';
                           $store_address = '';
                           $store_gst = '';
                           $store_logo = '';
                           $bank_details = '';
                           $state = '';
                           $cin = '';
                        }else{
                           $value = $data->fetch_object();
                           $store_name = $value->store_name;
                           $store_mobile_no = $value->store_mobile_no;
                           $store_email_id = $value->store_email_id;
                           $store_address = $value->store_address;
                           $store_gst = $value->store_gst;
                           $store_logo = $value->store_logo;
                           $bank_details =  $value->bank_details;
                           $state = $value->state;
                           $cin = $value->cin;

                        }
                     ?>

                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="store_logo">Store Logo</label>
                           <div class="col-sm-10">
                              <input type="file" id="store_logo" class="form-control" name="store_logo" value="<?=$store_name;?> "placeholder="store_logo" />
                           </div>
                        </div>
                     </div>
                     <?php 
                        if (!empty($store_logo)) {
                      ?>
                      <div class="col-md-12">
                         <img src="<?=website_name?>/uploads/<?=$store_logo;?>" class="img-thumbnail " width="300px" alt="">
                         <a href="<?=website_name?>/pages/setup/action/setup_action.php?submit=remove_store_logo&store_logo=<?=$store_logo;?>" class="btn btn-danger btn-wave mt-2">Remove</a>
                      </div>
                   <?php } ?>

                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="store_name">Store Name</label>
                           <div class="col-sm-10">
                              <input type="text" id="store_name" class="form-control" name="store_name" value="<?=$store_name;?> "placeholder="" />
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="store_mobile_no">Store Mobile No</label>
                           <div class="col-sm-10">
                              <input type="text" id="store_mobile_no" class="form-control" name="store_mobile_no" value="<?=$store_mobile_no;?> "placeholder="" />
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="store_email_id">Store Email id</label>
                           <div class="col-sm-10">
                              <input type="text" id="store_email_id" class="form-control" name="store_email_id" value="<?=$store_email_id;?> "placeholder="" />
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="store_address">Store Address</label>
                           <div class="col-sm-10">
                              <textarea name="store_address" class="form-control" id="store_address" ><?=$store_address;?></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="store_gst">Store GST</label>
                           <div class="col-sm-10">
                              <input type="text" id="store_gst" class="form-control" name="store_gst" value="<?=$store_gst;?> "placeholder="" />
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="cin">Store CIN</label>
                           <div class="col-sm-10">
                              <input type="text" id="cin" class="form-control" name="cin" value="<?=$cin;?> "placeholder="" />
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="state">State</label>
                           <div class="col-sm-10">
                              <input type="text" id="state" class="form-control" name="state" value="<?=$state;?> "placeholder="" />
                           </div>
                        </div>
                     </div>

                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="state">Bank Account Details</label>
                           <div class="col-sm-10">
                               <textarea class="form-control" name="bank_details"><?=$bank_details;?></textarea>
                           </div>
                        </div>
                     </div>

                     


                  </div>
                  <div class="row mt-4">
                     <div class="col-md-6">
                        <div class="row justify-content-end">
                           <div class="col-sm-9">
                              <button type="submit" name="submit" value="update_store" class="btn btn-primary me-sm-3 me-1">Update</button>
                              <button type="reset" class="btn btn-label-secondary">Cancel</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>

            <!-- Social Links -->



            <div class="tab-pane fade " id="form-tabs-personal" role="tabpanel">
               <form enctype="multipart/form-data" action="<?=website_name?>/pages/setup/action/setup_action.php" method="POST">
                  <input type="hidden" value="1" name="shows">
                  <div class="row g-3">
                     <?php 
                        $data = $db->query("SELECT * FROM `setting` WHERE shows = 1 AND consumer_id = '$consumer_id'");
                        while ($value = $data->fetch_object()) {
                     ?>
                     <div class="col-md-12">
                        <div class="row">
                           <label class="col-sm-2 col-form-label " for="<?=$value->name?>"><?=label($value->name);?></label>
                           <div class="col-sm-10">
                              <?php 
                                 if ($value->name == 'shop_address') {
                                   echo '<textarea class="form-control" name="'.$value->name .'">'.$value->value.'</textarea>';
                                 }else{
                              ?>
                              <input type="<?php if ($value->name == 'logo') {
                                 echo 'file';
                              } else { echo 'text'; } ?>" id="<?=$value->name?>" class="form-control" name="<?=$value->name;?>" value="<?=$value->value;?> " <?php if ($value->name == 'website_name') {
                                 echo 'readonly';
                              } ?>  placeholder="" />
                           <?php } ?>
                           </div>
                        </div>
                     </div>
                  <?php } ?>



                  </div>
                  <div class="row mt-4">
                     <div class="col-md-6">
                        <div class="row justify-content-end">
                           <div class="col-sm-9">
                              <button type="submit" name="submit" value="update_fronted" class="btn btn-primary me-sm-3 me-1">Update</button>
                              <button type="reset" class="btn btn-label-secondary">Cancel</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>










         </div>
      </div>
   </div>
</div>
</div>
<!-- / Content -->

<?php 
   include '../../include/footer.php';
 ?>