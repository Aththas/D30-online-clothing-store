<?php
session_start();
if($_SESSION["admin"]=="")
{
?>
<script type="text/javascript">
window.location="admin_login.php";
</script>
<?php
}

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../user/img/D30.jpeg">
    <title>D30 Store</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="" />
    <style type="text/css">
    @media(max-width: 768px){
    thead{
        display: none;
    }
    tbody, tr, td{
        display: block;
        width: 100%;
    }
    tr{
        margin-bottom: 15px;
    }
     tbody tr td{
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
     td:before{
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: 600;
        font-size: 14px;
        text-align: left;
    }
}
    </style>
  </head>
  <body>
    <div class="container-scroller">

        <?php include("topbar.php"); ?>
<br><br><br>
      <div class="container-fluid page-body-wrapper">

        <?php include("sidebar.php"); ?>

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Orders </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">View Orders</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Order Date</th>
                          <th>Customer ID</th>
                          <th>User Name</th>
                          <th>Total</th>
                          <th>View</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM tbl_order order by order_id desc";     
                          $rs_result = mysqli_query ($link, $query); 
                          while($row=mysqli_fetch_array($rs_result))
                          {
                          echo "<tr>";
                          echo "<td data-label='#'>"; echo $row["order_id"]; echo "</td>";
                          echo "<td data-label='Order Date'>"; echo $row["order_date"]; echo "</td>";
                          echo "<td data-label='Customer Id'>"; echo $row["Customer_ID"]; echo "</td>"; 

                              $c_id = $row["Customer_ID"];
                              $r = mysqli_query($link,"select * from cus_details where Customer_ID = $c_id ");
                              while($rw=mysqli_fetch_array($r))
                              {
                                  echo "<td data-label='Username'>"; echo $rw["username"]; echo "</td>";
                              }

                              $order_id = $row["order_id"];

                              $result = mysqli_query($link, "select SUM(total) AS total_amount from order_product where order_id = '$order_id' "); 
                              $row_new = mysqli_fetch_assoc($result); 
                              $sum = $row_new['total_amount'];
                              mysqli_query($link,"update tbl_order set total = '$sum' where order_id = '$order_id' ");

                          echo "<td data-label='Total'>"; echo $row["total"]; echo "</td>";
                          echo "<td data-label='View Order'>"; ?> <a href="view_order.php?id=<?php echo $row["order_id"]; ?>"> <i class="far fa-eye" style="color: green; font-size: 18px;"></i> </a> <?php echo "</td>";
                          echo "</tr>";
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <?php include("footer.php") ?>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>