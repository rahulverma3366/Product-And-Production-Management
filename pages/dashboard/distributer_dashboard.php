  <!-- Statistics -->
  <div class="col-xl-12 mb-4 col-lg-12 col-12">
    <div class="card h-100">
      <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="card-title mb-0">Statistics</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-3">
            <?php
                $date = date('Y-m-d');
                $user_id = $_SESSION['a_id'];
                $data = $db->query("SELECT SUM(paid_amount) AS paids FROM `sale_order` WHERE order_date = '$date' AND user_id = '$user_id'");
                $value = $data->fetch_object();
            ?>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
              <div class="card-info">
                <h5 class="mb-0">Rs <?=number_format($value->paids);?></h5>
                <small>Today Sale</small>
              </div>
            </div>
          </div>

          

            <?php
                $date = date('Y-m-d');
                $data = $db->query("SELECT * FROM `sale_products` WHERE sold = 0 AND custumer_id = '$user_id'");
            ?>

          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-danger me-3 p-2"><i class="ti ti-shopping-cart ti-sm"></i></div>
              <div class="card-info">
                <h5 class="mb-0"><?=$data->num_rows;?></h5>
                <small> Devices Stock</small>
              </div>
            </div>
          </div>
            <?php
                $date = date('Y-m-d');
                $data = $db->query("SELECT SUM(paid_amount) AS paids FROM `sale_order` WHERE user_id = '$user_id' AND sts = 0");
                $value = $data->fetch_object();
            ?>

          
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="ti ti-currency-dollar ti-sm"></i></div>
              <div class="card-info">
                <h5 class="mb-0">Rs <?=number_format($value->paids);?></h5>
                <small>Total Earning</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Statistics -->


