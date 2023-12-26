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
$res= mysqli_query($link,"select * from tbl_product where product_id=$id");
while($row=mysqli_fetch_array($res))
{
    $p_name= $row["product_name"];
    $price= $row["product_price"];
    $product_image= $row["product_image"];
    $category= $row["category"]; 
    $des= $row["description"]; 
    $color= $row["color"]; 
}

$resa= mysqli_query($link,"select * from size where product_id=$id");
while($rowa=mysqli_fetch_array($resa))
{
    $small= $rowa["Small"];
    $large= $rowa["Large"];
    $medium= $rowa["Medium"];
    $xl= $rowa["XL"];
    $xxl= $rowa["XXL"];
    $xxxl= $rowa["XXXL"];
}

                        if(isset($_POST["edit_image"]))
                        {
                            $fnm=$_FILES["pimage"]["name"];
                            if($fnm=="")
                            {
                              ?>
                              <script type="text/javascript">
                                  alert("Product Image Required!!!");
                                </script>
                                <?php
                            }
                            else
                            {
                              //product image
                              $v1=rand(1,9);
                              $v2=rand(1,9);
   
                              $v3=$v1.$v2;
   
                              $fnm=$_FILES["pimage"]["name"];
                              $dst="../user/img/".$v3.$fnm;
                              $dst1="img/".$v3.$fnm;
                              move_uploaded_file($_FILES["pimage"]["tmp_name"],$dst);
                              //end product image

                              mysqli_query($link,"Update tbl_product set product_image='$dst1' where product_id=$id");
                              ?>
                                <script type="text/javascript">
                                        alert("Product has been updated successfully!!!");
                                        window.location = "edit.php?id=<?php echo $id; ?>";
                                </script>
                              <?php
                            }
                        }

                        if(isset($_POST["edit_product"]))
                        {
                            $Q1 = $_POST["price"];
                            $intQ1 = (int)$Q1;
                            $Q2 = $_POST["qty"];
                            $intQ2 = (int)$Q2;
                            if($_POST["name"] == "" || $_POST["price"] == "" || $_POST["des"] == "" || $_POST["qty"] == "" || $_POST["color"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Fields Can't be empty!!!");
                                </script>
                                <?php
                            }
                            else if($intQ1 < 1)
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Invalid Price!!!");
                                </script>
                                <?php
                            }
                            else if($intQ2 < 1)
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Invalid Quantity!!!");
                                </script>
                                <?php
                            }
                            else
                            {
                                mysqli_query($link,"Update tbl_product set product_name='$_POST[name]',product_price='$_POST[price]',category='$_POST[pcategory]',scale='$_POST[size]',color='$_POST[color]',description='$_POST[des]', available_quantity='$_POST[qty]' where product_id=$id");
                    
                                ?>
                                <script type="text/javascript">
                                        alert("Product has been updated successfully!!!");
                                        window.location="index.php";
                                </script>
                                <?php
                            }
                        }

                        if(isset($_POST["update_qty"]))
                        {
                            $Q1 = $_POST["small"];
                            $intQ1 = (int)$Q1;
                            $Q2 = $_POST["medium"];
                            $intQ2 = (int)$Q2;
                            $Q3 = $_POST["large"];
                            $intQ3 = (int)$Q3;
                            $Q4 = $_POST["xl"];
                            $intQ4 = (int)$Q4;
                            $Q5 = $_POST["xxl"];
                            $intQ5 = (int)$Q5;
                            $Q6 = $_POST["xxxl"];
                            $intQ6 = (int)$Q6;
                            if($_POST["small"] == "" || $_POST["medium"] == "" || $_POST["large"] == "" || $_POST["xl"] == "" || $_POST["xxl"] == "" || $_POST["xxxl"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Fields Can't be empty!!!");
                                </script>
                                <?php
                            }
                            else
                            {
                                mysqli_query($link,"Update size set Small='$_POST[small]',Medium='$_POST[medium]',Large='$_POST[large]',XL='$_POST[xl]',XXL='$_POST[xxl]',XXXL='$_POST[xxxl]' where product_id=$id");
                    
                                ?>
                                <script type="text/javascript">
                                        alert("Product Quantity has been updated successfully!!!");
                                        window.location="index.php";
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
    <style type="text/css">
      .img-box-update {
    position: relative;
    width: 225px;
    height: 200px;
    overflow: hidden;
}
    </style>
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
              <h3 class="page-title"> Edit Product #<?php echo $id; ?> </h3>
            </div>
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Details</h4>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Product Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="<?php echo $p_name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Product Price</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="price" value="<?php echo $price; ?> " onkeypress="return validation(event)">
                      </div>
                      <div class="form-group">
                        <label for="size"><b>Category</b></label>
                        <select name="pcategory" class="form-control">
                          <option selected><?php echo $category; ?></option> 
                          <?php 
                          $r = mysqli_query($link,"select * from category");

                          while ($rw=mysqli_fetch_array($r)) {
                                    
                              echo "<option>".$rw["category_name"]."</option>"; 
                          }

                          ?> 
                      </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Color</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="color" value="<?php echo $color; ?>">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="des" class="form-control" rows="6"><?php echo $des; ?></textarea>
                      </div>
                      <input type="submit" name="edit_product" value="Update Product Details" class="btn btn-primary me-2">
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Update Quantity</h4>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Small</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="small" value="<?php echo $small; ?> " onkeypress="return validation(event)" maxlength="2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Medium</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="medium" value="<?php echo $medium; ?> " onkeypress="return validation(event)" maxlength="2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Large</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="large" value="<?php echo $large; ?> " onkeypress="return validation(event)" maxlength="2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">XL</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="xl" value="<?php echo $xl; ?> " onkeypress="return validation(event)" maxlength="2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">XXL</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="xxl" value="<?php echo $xxl; ?> " onkeypress="return validation(event)" maxlength="2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">XXXL</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="xxxl" value="<?php echo $xxxl; ?> " onkeypress="return validation(event)" maxlength="2">
                      </div>
                      <input type="submit" name="update_qty" value="Update Quantity" class="btn btn-primary me-2">
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Product Image</h4>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <div class="img-box-update" style="width: 360px; height: 400px;">
                                <a href="../user/<?php echo $product_image; ?>">
                                  <img src="../user/<?php echo $product_image; ?>" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; object-fit: cover;" />
                                </a>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" id="exampleInputEmail2" name="pimage">
                        </div>
                      </div>
                      <input type="submit" name="edit_image" value="Update Product Image" class="btn btn-primary me-2">
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
    <script type="text/javascript">
    function validation(evt) {
          
        var ASCII = (evt.which) ? evt.which : evt.keyCode
        if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
            return false;
        return true;
    }
</script>
  </body>
</html>