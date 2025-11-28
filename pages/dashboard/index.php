<?php 
   global $page_type;
   $page_type = 'dashboard';

   include '../../include/header.php';
   include '../../include/navbar.php';
   include '../../include/topbar.php';
 ?>



<!-- Content wrapper -->
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

            
<h4 class="py-3 mb-4">
   Dashboard 
</h4>

<div class="row">


<?php
    if($_SESSION['a_type'] == 2){
        include 'admin_dashboard.php';
    }elseif($_SESSION['a_type'] == 3){
        include 'distributer_dashboard.php';
    }elseif($_SESSION['a_type'] == 4){
        include 'retailer_dashboard.php';
    }
?>


  <!-- Revenue Report -->

  <!--/ Revenue Report -->
</div>



</div>
<!-- / Content -->

<?php 
   include '../../include/footer.php';
 ?>