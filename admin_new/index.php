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

                        if(isset($_POST["add_cat"]))
                        {

                            if($_POST["category"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Field's Can't be Empty!!!")
                                </script>
                                <?php
                                header("refresh:0.1;url=index.php");
                            }
                            else
                            {
     
                                mysqli_query($link,"insert into category values('','$_POST[category]')");

                                ?>
                                <script type="text/javascript">
                                    alert("Category added successfully!!!");
                                </script>
                                <?php
                                header("refresh:0.1;url=index.php");
                                
                            }
                        
                        }

                        if(isset($_POST["add_product"]))
                        {
                            $Q = $_POST["price"];
                            $intQ = floatval($Q);

                            //product image
                            $v1=rand(1,9);
                            $v2=rand(1,9);
   
                            $v3=$v1.$v2;
   
                            $fnm=$_FILES["pimage"]["name"];
                            $dst="../user/img/".$v3.$fnm;
                            $dst1="img/".$v3.$fnm;
                            move_uploaded_file($_FILES["pimage"]["tmp_name"],$dst);
                            //end product image

                            if($_POST["name"] == "" || $_POST["pcategory"] == "" || $_POST["color"] == "" || $_POST["des"] == "" || $_POST["price"] == "")
                            {
                                ?>
                                <script type="text/javascript">
                                  alert("Field's Can't be Empty!!!")
                                </script>
                                <?php
                                header("refresh:0.1;url=index.php");
                            }
                            else if ($fnm == "") 
                            {
                                ?>
                                    <script type="text/javascript">
                                      alert("Product Image Required!!!")
                                    </script>
                                <?php
                                header("refresh:0.1;url=index.php");
                            }
                            else
                            {
     
                                mysqli_query($link,"insert into tbl_product values('','$_POST[name]','$_POST[price]','$dst1','$_POST[des]','$_POST[pcategory]','$_POST[color]')");

                                $query1 = "SELECT MAX(product_id) FROM tbl_product";     
                                $rs_result1 = mysqli_query($link, $query1);     
                                $row1 = mysqli_fetch_row($rs_result1);     
                                $pid = $row1[0];

                                mysqli_query($link,"insert into size values('$pid',0,0,0,0,0,0)");

                                ?>
                                <script type="text/javascript">
                                    alert("Product added successfully!!!");
                                </script>
                                <?php
                                header("refresh:0.1;url=index.php");
                                
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
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="" />
    <style type="text/css">
              input, button{   
        height: 34px;   
    } 
          .open-button {
  background-color: purple;
  color: white;
  border: none;
  cursor: pointer;
  width: 150px;
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0px;
  right: 150px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container textarea, .form-container select, .form-container input[type=file] {
  width: 100%;
  padding: 10px;
  margin: 5px 0 12px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}


/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: black;
  border-color: transparent;
  margin-top: 10px;
  width: 45%
}
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
              <h3 class="page-title"> Products </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                    <h4 class="card-title col-lg-7">View Products</h4>
                    <button class="open-button col-lg-2" onclick="openForm1()">+Add Categories</button>
                    <h4 class="card-title col-lg-1"></h4>
                    <button class="open-button col-lg-2" onclick="openForm()">+Add Products</button>
                  </div>
                    <script>
                            function openForm() {
                                document.getElementById("myForm").style.display = "block";
                            }

                            function closeForm() {
                                document.getElementById("myForm").style.display = "none";
                            }

                            function openForm1() {
                                document.getElementById("myForm1").style.display = "block";
                            }

                            function closeForm1() {
                                document.getElementById("myForm1").style.display = "none";
                            }
                        </script>

<div class="form-popup" id="myForm1" style="right: 450px; bottom: 500px;">
  <form method="POST" class="form-container">
    <h1></h1>

    <label for="Category"><b>Category Name</b></label>
    <input type="text" placeholder="Category" name="category">

    <input type="submit" name="add_cat" value="ADD" class="btn" style="border-color: transparent; width: 45%; font-weight: bold; cursor:pointer; background-color: purple; margin-top: 10px;">
    <button type="button" class="btn cancel" onclick="closeForm1()">Close</button>
  </form>
</div>

<div class="form-popup" id="myForm">
  <form method="POST" class="form-container" enctype="multipart/form-data">
    <h1></h1>

    <label for="name"><b>Product Name</b></label>
    <input type="text" name="name">

    <label for="name"><b>Product Image</b></label>
    <input type="file" name="pimage">

    <label for="price"><b>Product Price</b></label>
    <input type="text" name="price" onkeypress="return validation(event)">

    <label for="category"><b>Category</b></label>
    <select name="pcategory">
        <option disabled selected> Select a Category</option> 
        <?php 
        $r = mysqli_query($link,"select * from category");

        while ($rw=mysqli_fetch_array($r)) {
                                    
            echo "<option>".$rw["category_name"]."</option>"; 
        }

        ?> 
    </select>

    <label for="color"><b>Color</b></label>
    <input type="text" name="color">

    <label for="des"><b>Product Description</b></label>
    <textarea name="des"></textarea>

    <input type="submit" name="add_product" value="ADD" class="btn" style="border-color: transparent; width: 45%; font-weight: bold; cursor:pointer; background-color: purple; margin-top: 10px;">
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>


                    <table class="table">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Name</th>
                          <th>Price</th>
                          <th>Category</th>
                          <th>Color</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM tbl_product order by product_id desc";     
                          $rs_result = mysqli_query ($link, $query); 
                          while($row=mysqli_fetch_array($rs_result))
                          {
                          echo "<tr>";
                          echo "<td data-label='Image'>"; ?>
                            <div class="nav-profile-img">
                              <a href="../user/<?php echo $row["product_image"]; ?>"><img src="../user/<?php echo $row["product_image"]; ?>" /></a>
                            </div>
                          <?php  echo "</td>";
                          echo "<td data-label='Name'>"; echo $row["product_name"]; echo "</td>";
                          echo "<td data-label='Price'>"; echo $row["product_price"]; echo "</td>";
                          echo "<td data-label='Category'>"; echo $row["category"]; echo "</td>";
                          //echo "<td data-label='Size'>"; echo $row["scale"]; echo "</td>";
                          echo "<td data-label='Color'>"; echo $row["color"]; echo "</td>";
                          //echo "<td data-label='Quantity'>"; echo $row["available_quantity"]; echo "</td>";
                          echo "<td data-label='Actions'>"; ?> 
                            <a href="edit.php?id=<?php echo $row["product_id"]; ?>"> <i class="far fa-edit" style="color: green; font-size: 18px;"></i> </a>
                            <a href="confirm_Delete.php?id=<?php echo $row["product_id"]; ?>&name=product"> <i class="far fa-trash-alt" style="color: red; font-size: 18px;"></i> </a> 
                          <?php echo "</td>";
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