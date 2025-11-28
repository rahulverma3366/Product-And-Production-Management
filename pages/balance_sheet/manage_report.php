<?php 
   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
   include '../../include/function.php';
   define('from', 'Balance Sheet');
   define('to', 'Manage Report');
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
      <div class="col-md-4 user_role"><button class="btn btn-secondary add-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New</span></span></button></div>
      <div class="col-md-8 user_plan">
          <form action="" class="mt-3" method="GET">
                                       <!--<h3>Filter</h3>-->
                                       <div class="row">
                                          <div class="col-md-3"><input type="date" class="form-control" name="start_date" placeholder="date"></div>
                                          <div class="col-md-3"><input type="date"  class="form-control" name="end_date" placeholder="date"></div>
                                          <div class="col-md-6">
                                          <button type="submit" name="submit" class="btn btn-primary">Search Data</button>
                                          <a class="btn btn-primary" href="manage_report">All Data</a>
                                          </div>
                                       </div>
                                       <br>
                                    </form>
      </div>
      <!--<div class="col-md-2 user_status"></div>-->
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class=" table" id="datatable">
      <thead class="border-top">
        <tr>
          <th>Sl No</th>
          <th>Actions</th>
          <th>Type</th>
          <th>Store Name</th>
          <th>Name</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Attachment</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody>
         <?php
          
                                                $sl = 0;
                                                $a_id = $_SESSION['a_id'];
                                               
                                             if(isset($_GET['start_date']) && isset($_GET['end_date'])){
                                                $start_date=  $_GET['start_date'];
                                                $end_date=  $_GET['end_date'];
                                                   if($a_type==3 || $a_type==4){
                                                      $a_id = $_SESSION['a_id'];
                                                $data= $db->query("SELECT * FROM `balance_sheet` WHERE a_id = '$a_id' AND create_at BETWEEN '$start_date' AND '$end_date'");}
                                                else{
                                                   $data= $db->query("SELECT * FROM `balance_sheet` WHERE create_at BETWEEN '$start_date' AND '$end_date'"); 
                                                }
                                                echo "Start Date: $start_date | ";
                                                echo "End Date: $end_date ";
                                             }else{
                                                 if($a_type==3 || $a_type==4){
                                                      $a_id = $_SESSION['a_id'];
                                                      $data = $db->query("SELECT * FROM `balance_sheet` WHERE a_id = '$a_id' ORDER BY bs_id DESC");
                                                 }else{
                                             $data = $db->query("SELECT * FROM `balance_sheet` ORDER BY bs_id DESC");
}
                                             }
           
            while ($value = $data->fetch_object()) {
            
                $sto_id=$value->sto_id;
                $sto_data= $db->query("SELECT * FROM `stors` WHERE sto_id='$sto_id'");
                $sto_value=$sto_data->fetch_object();
                
               $sl++;
         ?>
         <tr>
            <td><?=$sl;?></td>
            <td>
               <div class="d-flex align-items-center">
                  <!--<a href="edit_expenses_type.php?et_id=<?=$value->et_id;?>" class="text-body openPopup"  ><i class="ti ti-edit ti-sm me-2"></i></a>-->
                  <a href="action/manage_expenses?submit=delete_report&bs_id=<?=$value->bs_id;?>" class="text-body delete-record "><i class="ti ti-trash ti-sm mx-2"></i></a>
               </div>
            </td>
            <td><?php if($value->type == 1){echo 'Income'; } else { echo 'Expenses'; } ?></td>
            <td><?=$sto_value->name;?></td>
            <td><?=$value->name;?></td>
            <td><?=$value->amount;?></td>
            <td><?=$value->date;?></td>
            <td>
                <?php
                    if(!empty($value->attachment)){
                ?>
                <a href="../../uploads/<?= $value->attachment;?>" class= "btn btn-success" target="_blank">View</a>
                <?php } else { echo 'N/A'; }?>
        </td>
            <td><?=$value->remark;?></td>
         </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- Offcanvas to add new user -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Balance Sheet Report</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
      <form class="add-new-user pt-0" action="action/manage_expenses.php" method="POST" enctype="multipart/form-data" >
        <div class="mb-3">
            <label>Select Store</label>
            <select class="form-select" name="sto_id" id="type" required>
                <option value="">Select Store</option>
                <?php 
                    $sto_data=$db->query("SELECT * FROM `stors`");
                    while($sto_value=$sto_data->fetch_object()){?>
                        <option value="<?= $sto_value->sto_id;?>"><?= $sto_value->name;?></option>
                    <?php }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="expenditure_date">Expenditure Date</label>
             <input type="date"  id="expenditure_date"  placeholder="Expenditure Date"  class="form-control" name="date" value="<?php echo date('Y-m-d');?>"/>
        </div>
        <div class="mb-3">
            <label for="expenditure_name">Expenditure Name</label>
             <input type="text"  id="expenditure_name"  placeholder="Expenditure Name"  class="form-control" name="expenditure_name" value=""/>
        </div>

          
        <div class="mb-3">
         <label for="amount" > Amount</label>
         <input type="number"  id="amount"  placeholder="Amount"  class="form-control" name="amount" value=""/>
        </div>
        
        
        <div class="mb-3">
         <label for="Transaction" > Transaction No. / Bill No.</label>
         <input type="text"  id="Transaction"  placeholder="Transaction No. / Bill No."  class="form-control" name="transaction_no" value=""/>
        </div>
        <div class="mb-3">
         <label for="attachment" > Attachment</label>
         <input type="file"  id="attachment"  placeholder="attachment"  class="form-control" name="image"/>
        </div>
        <div class="mb-3">
         <label for="username" > User Name</label>
         <input type="text"  id="username"  placeholder="User Name"  class="form-control" name="username" value=""/>
        </div>


        <button type="submit" name="submit" value="submit_report" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#type').on('change', function(){
              var type = $(this).val();
           
              if(type){
                  $.ajax({
                      type:'POST',
                      url:'<?=website_name?>/ajax/balance_sheet_type.php',
                      data:'types='+type,
                      success:function(html){
                          $('#names').html(html);
                      }
                  }); 
              }else{
                  $('#type').html('Please Select Currectly');
              }
          });
});

</script>