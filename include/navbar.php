<body>
   <?php 
      global $curpage;
      $curpage = basename($_SERVER['PHP_SELF']);
      global $parent;

   function active($current_page,$request_page){
      if ($current_page == $request_page) {
         echo 'active';
      }

   }  
   function parent_nav($pages,$curpage){
      $filter = explode(',', $pages);
      if (in_array($curpage,$filter)) {
         echo 'active open';
      }else{
         echo '';
      }
   
   }


    ?>
   <!-- Layout wrapper -->
   <div class="layout-wrapper layout-content-navbar  ">
   <div class="layout-container">
   <!-- Menu -->
   <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo ">
         <a href="../../pages/dashboard/index" class="app-brand-link">
            <?php 
               if (empty(logo)) {
                  echo business_name;
               }else{
            ?>
               <img src="<?=logo?>" alt="" width="150px" height="50px" >
         <?php } ?>
         </a>
         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
         <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
         <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
         </a>
      </div>
      <div class="menu-inner-shadow"></div>
      <ul class="menu-inner py-1">
         <!-- Dashboards -->
         <li class="menu-item <?php active('index.php',$curpage); ?>">
            <a href="../../pages/dashboard/index" class="menu-link ">
               <!-- <i class="menu-icon tf-icons ti ti-smart-home"></i> -->
               <i class="fa-solid fa-gauge menu-icon tf-icons"></i>
               <div data-i18n="Dashboards">Dashboards</div>
               <!-- <div class="badge bg-primary rounded-pill ms-auto">3</div> -->
            </a>
         </li>
         <!-- Layouts -->




         <!-- Apps & Pages -->
         <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Bricks  Manage </span>
         </li>
        

         <?php 
                  $a_type = $user_values->a_type;
                  if ($a_type == 2) {

         ?>
         <li class="menu-item <?php parent_nav('add_users.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <!-- <i class='menu-icon tf-icons ti ti-building-factory'></i> -->
               <i class="fa-solid fa-users menu-icon tf-icons"></i>
               <div data-i18n="User List">User List</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('add_users.php',$curpage); ?>">
                  <a href="../../pages/admin/add_users" class="menu-link">
                     <div data-i18n="Add User">Add User</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item <?php parent_nav('create_store.php,slot_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-building-factory'></i>
               <div data-i18n="Store">Store</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('create_store.php',$curpage); ?>">
                  <a href="../../pages/slot/create_store" class="menu-link">
                     <div data-i18n="Create Store">Create Store</div>
                  </a>
               </li>
            </ul>
         </li>

         <li class="menu-item <?php parent_nav('create_slot.php,slot_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-building-factory'></i>
               <div data-i18n="Slot">Slot</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('create_slot.php',$curpage); ?>">
                  <a href="../../pages/slot/create_slot" class="menu-link">
                     <div data-i18n="Create Slot">Create Slot</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item <?php parent_nav('vendor_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-shopping-cart'></i>
               <div data-i18n="Vender">Vender </div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('vendor_list.php',$curpage); ?>">
                  <a href="../../pages/vendor/vendor_list.php" class="menu-link">
                     <div data-i18n="Vender List">Vender List</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item <?php parent_nav('product_list.php,product_name.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-shopping-cart'></i>
               <div data-i18n="Product">Product </div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('product_name.php',$curpage); ?>">
                  <a href="../../pages/product/product_name.php" class="menu-link">
                     <div data-i18n="Product Name">Product Name</div>
                  </a>
               </li>
               <li class="menu-item <?php active('product_list.php',$curpage); ?>">
                  <a href="../../pages/product/product_list.php" class="menu-link">
                     <div data-i18n="Manage Product">Manage Product</div>
                  </a>
               </li>
            </ul>
         </li>
         <li class="menu-item <?php parent_nav('row_materials.php,invoice_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-building-factory'></i>
               <div data-i18n="Row Material">Row Material</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('row_materials.php',$curpage); ?>">
                  <a href="../../pages/row_material/row_materials.php" class="menu-link">
                     <div data-i18n="Add Row Material">Add Row Material</div>
                  </a>
               </li>
               <li class="menu-item <?php active('invoice_list.php',$curpage); ?>">
                  <a href="../../pages/row_material/invoice_list.php" class="menu-link">
                     <div data-i18n="Purchase Invoice">Purchase Invoice</div>
                  </a>
               </li>
               
            </ul>
         </li>
         
          
         

<li class="menu-item <?php parent_nav('new_sales.php,sale_invoice_list.php,buyers_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti ti-file-dollar'></i>
               <div data-i18n="Sales">Sales</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('buyers_list.php',$curpage); ?>">
                  <a href="../../pages/buyers/buyers_list" class="menu-link">
                     <div data-i18n="New Sales ">New Sales </div>
                  </a>
               </li>
               <!--<li class="menu-item <?php active('new_sales.php,invoice_preview_emi.php',$curpage); ?>">-->
               <!--   <a href="../../pages/sales/new_sales" class="menu-link">-->
               <!--      <div data-i18n="New Sales ">New Sales </div>-->
               <!--   </a>-->
               <!--</li>-->
               
               
               <li class="menu-item <?php active('sale_invoice_list.php',$curpage); ?>">
                  <a href="../../pages/sales/sale_invoice_list" class="menu-link">
                     <div data-i18n="Sales Reposrt"> Sales Reposrt</div>
                  </a>
               </li>


            </ul>
         </li>


         

      <?php } ?>


         <?php 
                  $a_type = $user_values->a_type;
                  if ($a_type == 3 || $a_type==4) {

         ?>

                <li class="menu-item <?php parent_nav('row_materials.php,invoice_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti-building-factory'></i>
               <div data-i18n="Row Material">Row Material</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('row_materials.php',$curpage); ?>">
                  <a href="../../pages/row_material/row_materials.php" class="menu-link">
                     <div data-i18n="Add Row Material">Add Row Material</div>
                  </a>
               </li>
               <li class="menu-item <?php active('invoice_list.php',$curpage); ?>">
                  <a href="../../pages/row_material/invoice_list.php" class="menu-link">
                     <div data-i18n="Purchase Invoice">Purchase Invoice</div>
                  </a>
               </li>
               
            </ul>
         </li>
         
          
         

<li class="menu-item <?php parent_nav('new_sales.php,sale_invoice_list.php,buyers_list.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti ti-file-dollar'></i>
               <div data-i18n="Sales">Sales</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('buyers_list.php',$curpage); ?>">
                  <a href="../../pages/buyers/buyers_list" class="menu-link">
                     <div data-i18n="New Sales ">New Sales </div>
                  </a>
               </li>
               <!--<li class="menu-item <?php active('new_sales.php,invoice_preview_emi.php',$curpage); ?>">-->
               <!--   <a href="../../pages/sales/new_sales" class="menu-link">-->
               <!--      <div data-i18n="New Sales ">New Sales </div>-->
               <!--   </a>-->
               <!--</li>-->
               
               
               <li class="menu-item <?php active('sale_invoice_list.php',$curpage); ?>">
                  <a href="../../pages/sales/sale_invoice_list" class="menu-link">
                     <div data-i18n="Sales Reposrt"> Sales Reporrt</div>
                  </a>
               </li>


            </ul>
         </li>
         <?php } ?>

         <li class="menu-item <?php parent_nav('expenses_type.php,manage_report.php',$curpage); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
               <i class='menu-icon tf-icons ti ti ti-table'></i>
               <div data-i18n="Balance Sheet">Balance Sheet</div>
            </a>
            <ul class="menu-sub">
               <li class="menu-item <?php active('expenses_type.php',$curpage); ?>">
                  <a href="../../pages/balance_sheet/expenses_type" class="menu-link">
                     <div data-i18n="Income & Expenses ">Income & Expenses  </div>
                  </a>
               </li>
               
               
               <li class="menu-item <?php active('manage_report.php',$curpage); ?>">
                  <a href="../../pages/balance_sheet/manage_report" class="menu-link">
                     <div data-i18n="Manage Report"> Manage Report</div>
                  </a>
               </li>


            </ul>
         </li>


         


         
      </ul>
   </aside>
   <!-- / Menu -->