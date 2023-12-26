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

$id = $_GET["id"];
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
$res= mysqli_query($link,"select * from job_positions where id=$id");
while($row=mysqli_fetch_array($res))
{
    $position= $row["position"];
    $expDate= $row["expire_date"];
}
$tmrw = date("Y-m-d", strtotime("+1 day"));
                        if(isset($_POST["edit_job"]))
                        {

                            if($_POST["name"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Fields Can't be empty!!!");
                                </script>
                                <?php
                            }
                            else
                            {
                                mysqli_query($link,"Update job_positions set position='$_POST[name]',expire_date='$_POST[exp_date]' where id=$id");
                    
                                ?>
                                <script type="text/javascript">
                                        alert("Job has been updated successfully!!!");
                                        window.location="job.php";
                                </script>
                                <?php
                            }
                        }

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
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <?php include("topbar.php"); ?>
<br><br><br>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <?php include("sidebar.php"); ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Edit Job #<?php echo $id; ?> </h3>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Details</h4>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Position</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="<?php echo $position; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Expire Date</label>
                        <input type="date" class="form-control" id="exampleInputEmail1" name="exp_date" value="<?php echo $expDate; ?> " min="<?php echo $tmrw; ?>">
                      </div>
                      <input type="submit" name="edit_job" value="Update Job Details" class="btn btn-primary me-2">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
              </div>
            </div>
          </footer>
          <!-- partial -->
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
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>