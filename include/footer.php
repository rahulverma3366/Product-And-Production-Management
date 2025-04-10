<style>
  .modal.dtr-bs-modal .modal-body {
    padding: 22px 30px !important;
}
.btn-primary {
    color: #fff;
    background-color: #7367f0 !important; 
    border-color: #7367f0;
}
  .datatable-modal thead, .datatable-modal tbody, .datatable-modal tfoot, .datatable-modal tr, .datatable-modal td, .datatable-modal th {
      border-color: inherit;
    border-style: solid;
    border-width: 0;
    padding: 6px 3px;
    border: 1px solid #eee !important;
}
</style>          

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl">
    <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
      <div>
        © <script>
        document.write(new Date().getFullYear())

        </script>
        , made with ❤️ by <a href="" target="_blank" class="fw-medium">Rahul </a>
      </div>
      <div class="d-none d-lg-inline-block">
        
        <a href="" class="footer-link me-4" target="_blank">License</a>
        
        
        <a href="" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
        
      </div>
    </div>
  </div>
</footer>
<!-- / Footer -->

          
          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    
    
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    
    
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    
  </div>
  <!-- / Layout wrapper -->

  


  

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  
  <script src="../../assets/vendor/libs/popper/popper.js"></script>
  <script src="../../assets/vendor/js/bootstrap.js"></script>
  <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
  <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
  <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
   <script src="../../assets/vendor/js/menu.js"></script>
  
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="../../assets/vendor/libs/moment/moment.js"></script>
  <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" ></script>

  <script src="../../assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
  <script src="../../assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
  <script src="../../assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>

  <script src="../../assets/vendor/libs/cleavejs/cleave.js"></script>
  <script src="../../assets/vendor/libs/cleavejs/cleave-phone.js"></script>

  <!-- Main JS -->
  <script src="../../assets/js/main.js"></script>

  <script src="<?=website_name?>/assets/js/forms-selects.js"></script>

  <!-- Page JS -->

  <?php 
    if ($page_type == 'roles') {
  ?>
      <script src="../../assets/js/app-access-roles.js"></script>
      <script src="../../assets/js/modal-add-role.js"></script>

<?php } ?>

  <?php 
    if ($page_type == 'dashboard') {
  ?>
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

  <script src="../../assets/js/app-ecommerce-dashboard.js"></script>

<?php } ?>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="<?=website_name?>/assets/js/datatables-init.js"></script>

<script src="../../assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>


      <?php include '../../include/toast_msg.php'; ?>


</body>
</html>
