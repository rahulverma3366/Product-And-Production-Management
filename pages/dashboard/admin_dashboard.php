    <!-- Statistics -->
  <?php 
     $create_at = date("Y-m-d");
    $month = date("m");
    $last_month = $month - 1;

    $data = $db->query("SELECT * FROM `sales` WHERE  create_at like '%$create_at%'");
    $today_total = $data->num_rows;
    $today_paid_amount = $db->query("SELECT sum(paid_amount) AS today_paid_total FROM `sales` WHERE create_at like '%$create_at%'");
    $today_paid_value = $today_paid_amount->fetch_object();
    $today_paid_price = $today_paid_value->today_paid_total;
   
   
    $data1 = $db->query("SELECT * FROM sales WHERE MONTH(create_at)='$month'");
    $month_total = $data1->num_rows; 
    $monthly_data = $db->query("SELECT sum(paid_amount) AS new_paid_price FROM sales WHERE MONTH(create_at)='$month'");
    $monthly_value = $monthly_data->fetch_object();
    $monthly_price = $monthly_value->new_paid_price;
    






    $data2 = $db->query("SELECT * FROM sales WHERE MONTH(create_at)='$last_month'");
    $last_month_total = $data2->num_rows; 
    $last_month_paid_amount = $db->query("SELECT SUM(paid_amount) AS total_paid_monthly FROM sales WHERE MONTH(create_at)='$last_month'");
    $last_month_paid_value = $last_month_paid_amount->fetch_object();
    $last_month_paid_price= $last_month_paid_value->total_paid_monthly
  
    // $paid_price2=$today_value2->total_paid_monthly;
    // $price2 += $paid_price2;
  ?>
  <style>
                 .modebar-group:nth-child(5){
               visibility:hidden;
           }

  </style>
  <style>
        .bg-success { background-color: #d4edda !important; }
        .bg-warning { background-color: #fff3cd !important; }
        .bg-danger { background-color: #f8d7da !important; }
        .card { margin-bottom: 20px; }
    </style>
  <?php
$sl = 0;
// Helper function to determine the background class based on remaining stock

// Helper function to determine the background class based on remaining stock
function getStockClass($remaining_stock) {
    if ($remaining_stock > 100) {
        return 'bg-success'; // Green
    } elseif ($remaining_stock > 50) {
        return 'bg-warning'; // Yellow
    } else {
        return 'bg-danger'; // Red
    }
}

// Query to fetch product and sales data grouped by product
$data = $db->query("
    SELECT 
        pn.name AS product_name, 
        SUM(p.qty) AS total_quantity, 
        COALESCE(SUM(sales.total_sold), 0) AS total_sold, 
        (SUM(p.qty) - COALESCE(SUM(sales.total_sold), 0)) AS remaining_stock,
        COALESCE(SUM(today_sales.today_sold), 0) AS today_sold
    FROM product p 
    JOIN product_name pn ON p.pn_id = pn.pn_id 
    LEFT JOIN (
        SELECT 
            item_name,  
            SUM(quantity) AS total_sold 
        FROM sales_order 
        GROUP BY item_name
    ) sales ON p.pn_id = sales.item_name 
    LEFT JOIN (
        SELECT 
            item_name, 
            SUM(quantity) AS today_sold 
        FROM sales_order 
        WHERE DATE(create_at) = CURDATE() 
        GROUP BY item_name
    ) today_sales ON p.pn_id = today_sales.item_name
    GROUP BY pn.name;
");

while ($value = $data->fetch_object()) {
    $sl++;
?>
<div class="col-md-3">
            <div class="card <?= getStockClass($value->remaining_stock); ?>">
                <div class="card-header">
                    <?= htmlspecialchars($value->product_name); ?>
                </div>
                <div class="card-body">
                    <div><b>Unit: </b><?= htmlspecialchars($value->unit); ?></div>
                    <div><b>Today's Sale: </b><?= number_format($value->today_sold, 0); ?></div>
                    <div><b>Total Stock: </b><?= number_format($value->total_quantity, 0); ?></div>
                    <div><b>Total Sold: </b><?= number_format($value->total_sold, 0); ?></div>
                    <div><b>Remaining Stock: </b><?= number_format($value->remaining_stock, 0); ?></div>
                </div>
            </div>
        </div>
<?php }?>
  <div class="col-xl-12 mb-4 col-lg-12 col-12">
    <div class="card h-100">
      <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="card-title mb-0">Statistics</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-3">
            
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-calendar ti-sm"></i></div>
              <div class="card-info">
                <p class="mb-0">Today Sale No <?= $today_total;?> </p>
                <h5 class="mb-0">Today Sale: Rs. <?php if(empty($today_paid_price)){echo "0";}else{echo $today_paid_price;}?> </h5>
                <small>Today Sale</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="ti ti-list-check ti-sm"></i></div>
              <div class="card-info">
                <p class="mb-0"> Monthly Sale <?= $month_total;?> </p>
                <h5 class="mb-0">Monthly Sale: Rs. <?php if(empty($monthly_price)){echo "0";}else{echo $monthly_price;}?> </h5>
                <small>Monthly Sale</small>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="d-flex align-items-center">
              <div class="badge rounded-pill bg-label-warning me-3 p-2"><i class="ti ti-building-bank ti-sm"></i></div>
              <div class="card-info">
                <p class="mb-0">Last Month Sale <?= $last_month_total;?> </p>
                <h5 class="mb-0">Last Month Sale: Rs. <?= $last_month_paid_price;?> </h5>
                <small>Last Month Sale</small>
              </div>
            </div>
          </div>
          <!--<div class="col-md-3 col-6">-->
          <!--  <div class="d-flex align-items-center">-->
          <!--    <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-chart-pie-2 ti-sm"></i></div>-->
          <!--    <div class="card-info">-->
          <!--      <p class="mb-0">Rs <?= $last_month_total;?> </p>-->
          <!--      <h5 class="mb-0">Last Month Sale: Rs. <?= $price2;?> </h5>-->
          <!--      <small>Last Month Sale</small>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
          
    
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-12 mb-4 col-lg-12 col-12">
    <div class="card h-100">
      <div class="card-header">
        <div class="d-flex justify-content-between mb-3">
          <h5 class="card-title mb-0">Daily and Monthly Sales Amount</h5>
        </div>
      </div>
      <div class="card-body">
        <div class="row gy-3">
            
          <div class="col-md-12 col-12">
             <div id='new'></div>
          </div>
          
          
        
         <script src='https://cdn.plot.ly/plotly-latest.min.js'></script>
         <script>
    var trace1 = {
        x: [<?php 
                $daily_sales_query1 = $db->query("SELECT DATE(create_at) as sale_date, SUM(paid_amount) as total_amount FROM sales GROUP BY DATE(create_at) ORDER BY sale_date");
                $dates1 = [];
                while($row1 = $daily_sales_query1->fetch_object()){
                    $dates1[] = $row1->sale_date;
                }
                echo '"' . implode('","', $dates1) . '"';
            ?>
        ],
        y: [<?php 
                $daily_sales_query = $db->query("SELECT DATE(create_at) as sale_date, SUM(paid_amount) as total_amount FROM sales GROUP BY DATE(create_at) ORDER BY sale_date");
                $amounts = [];
                while($row = $daily_sales_query->fetch_object()){
                    $amounts[] = $row->total_amount;
                }
                echo implode(',', $amounts);
            ?>
        ],
        name: 'Daily Sales',
        type: 'scatter'
    };

    var trace2 = {
        x: [
            <?php 
                $monthly_sales_query1 = $db->query("
                    SELECT DATE_FORMAT(create_at, '%Y-%m') as sale_month, SUM(paid_amount) as total_amount 
                    FROM sales 
                    GROUP BY sale_month
                    ORDER BY sale_month
                ");
                $months = [];
                while($row1 = $monthly_sales_query1->fetch_object()){
                    $months[] = $row1->sale_month;
                }
                echo '"' . implode('","', $months) . '"';
            ?>
        ],
        y: [
            <?php 
                $monthly_sales_query = $db->query("
                    SELECT DATE_FORMAT(create_at, '%Y-%m') as sale_month, SUM(paid_amount) as total_amount 
                    FROM sales 
                    GROUP BY sale_month
                    ORDER BY sale_month
                ");
                $amounts = [];
                while($row = $monthly_sales_query->fetch_object()){
                    $amounts[] = $row->total_amount;
                }
                echo implode(',', $amounts);
            ?>
        ],
        name: 'Monthly Sales',
        type: 'scatter'
    };

    var data = [trace1, trace2];

    var layout = {
        title: 'Daily and Monthly Sales Amounts',
        font: {size: 14},
        xaxis: {title: 'Date/Month'},
        yaxis: {title: 'Sale Amounts'},
    };

    var config1 = {responsive: true};

    Plotly.newPlot('new', data, layout, config1);
</script>


    
        </div>
      </div>
    </div>
  </div>
  
  <!--/ Statistics -->


