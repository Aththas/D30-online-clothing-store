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

$user = $_SESSION["admin"];
$res= mysqli_query($link,"select * from admin_login where admin_ID = '$user' ");
while($row=mysqli_fetch_array($res))
{
    $uname= $row["username"];
    $pwd= $row["password"];
    $email= $row["email"];
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

      <?php include("topbar.php"); ?>
<br><br><br>

      <div class="container-fluid page-body-wrapper">

        <?php include("sidebar.php"); ?>

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Profile </h3>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Profile Details</h4>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="<?php echo $uname; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $email; ?>" name="email">
                      </div>
                      <input type="submit" value="Update Profile" name="update_profile" class="btn btn-primary me-2">
                    </form>
                  </div>
                </div>
              </div>

              <?php
                        if(isset($_POST["update_profile"]))
                        {
                            
                            if($_POST["name"] == "" || $_POST["email"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                    alert("Fields Can't be empty!!!");
                                    window.location = "profile.php";
                                </script>
                                <?php
                            }
                            else
                            {

                                mysqli_query($link,"Update admin_login set username='$_POST[name]',email='$_POST[email]' where admin_ID='$user'");

                                ?>
                                <script type="text/javascript">
                                    alert("Admin profile has been updated!!!");
                                    window.location = "profile.php";
                                </script>
                                <?php
                            }
                        }
                        ?>

              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Password Reset</h4>
                    <form class="forms-sample" method="POST">
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Current Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="cpwd">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="npwd">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password" name="rpwd">
                        </div>
                      </div>
                      <input type="submit" value="Update Password" name="update_password" class="btn btn-primary me-2">
                      <?php
                        if(isset($_POST["update_password"]))
                        {


                            $respwd=mysqli_query($link,"select password from admin_login where admin_ID='$user'");
                            $rowpwd = mysqli_fetch_row($respwd);
                            $decrypt_pwd = $rowpwd[0];

                            $verify = password_verify($_POST["cpwd"],$decrypt_pwd);

                            if($verify)
                            {
                                if($_POST["npwd"] != $_POST["rpwd"])
                                {
                                    ?>
                                    <script type="text/javascript">
                                        alert("Password not matched. Not able to update the password. Try again!!!");
                                        window.location = "profile.php";
                                    </script>
                                    <?php
                                }
                                else
                                {
                                    $encrypt_pwd = password_hash($_POST["npwd"], PASSWORD_DEFAULT);
                                    mysqli_query($link,"Update admin_login set password='$encrypt_pwd' where admin_ID='$user'");
                    
                                    ?>
                                    <script type="text/javascript">
                                        alert("Password changed successfully!!!");
                                          window.location = "profile.php";
                                    </script>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <script type="text/javascript">
                                    alert("Invalid Password!!!");
                                    window.location = "profile.php";
                                </script>
                                <?php
                            }
                        }
                        ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
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