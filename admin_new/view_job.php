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

$id= $_GET["id"];
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");

$res1= mysqli_query($link,"select * from job_positions where id = '$id' ");
while($row1=mysqli_fetch_array($res1))
{  $position= $row1["position"]; }

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
              <h3 class="page-title">View Jobs </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Position of <?php echo $position; ?></h4>
                    <table class="table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>CV</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $i=0;
                            $rs_result= mysqli_query($link,"select * from job_applications where position = '$position' ");
                            while($row=mysqli_fetch_array($rs_result))
                            {
                            echo "<tr>";
                            echo "<td>"; echo ++$i; echo "</td>";
                            echo "<td>"; echo $row["fullname"]; echo "</td>"; 
                            echo "<td>"; echo $row["contact"]; echo "</td>";
                            echo "<td>"; echo $row["email"]; echo "</td>";
                            echo "<td>"; ?> <a href="<?php echo $row["cv"]; ?>"> <i class="far fa-eye" style="color: green; font-size: 18px;"></i> </a> <?php echo "</td>";
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