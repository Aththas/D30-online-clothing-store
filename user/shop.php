<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/D30.jpeg">
    <title>D30 Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
<link href="chatc.css" rel="stylesheet"> 
<style type="text/css">
    .form-popup {
  display: none;
  position: fixed;
  bottom: 0px;
  right: 150px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}
.cancel {
  background-color: black;
  border-color: transparent;
  margin-top: 10px;
  width: 45%
}
#myInput {
        background-image: url('img/search.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 6px 20px 0px 40px;
        border: transparent;
        width: 150px;
    }
</style>
</head>
<body>

<?php 
            include('Header.php');
        ?>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">    
                        <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Browse Products</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Choose Products</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                    </ul>
                </div>
            </div>
            <div class="inner-page-hero bg-image" data-image-src="img/bglog.png">
                <div class="container">
                    <button class="btn theme-btn-dash pull-right" style="background-color: purple; border: none; color: white;" onclick="openForm()">Size Chart</button>
                </div>
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">     
                    </div>
                </div>
            </div>
            <section class="featured-restaurants">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="title-block pull-left">
                            <h4>Featured Products</h4><input type="text" id="myInput" onkeyup="myFunction()" placeholder="search"> </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="restaurants-filter pull-right">
                            <nav class="primary pull-left">
                                <ul>
                                    <li><a href="#" class="selected" data-filter="*">all</a> </li>
                                    <?php 
                                    $res= mysqli_query($db,"select * from category");
                                          while($row=mysqli_fetch_array($res))
                                          {
                                            echo '<li><a href="#" data-filter=".'.$row['category_id'].'"> '.$row['category_name'].'</a> </li>';
                                          }
                                          
                                    ?>
                                   
                                </ul>
                            </nav>
                            
                        </div>
          
                    </div>
                </div>
    
                <div class="row">
                    <div class="restaurant-listing">
                        
                        
                        <?php  
                        $ress= mysqli_query($db,"select * from tbl_product");  
                                          while($rows=mysqli_fetch_array($ress))
                                          {
                                                    
                                                    $query= mysqli_query($db,"select * from category where category_name='".$rows['category']."' ");
                                                     $rowss=mysqli_fetch_array($query);
                        
                                                     echo ' <div class="col-xs-12 col-sm-12 col-md-6 single-restaurant all '.$rowss['category_id'].'">
                                                        <div class="restaurant-wrap">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                                                                    <a class="restaurant-logo" href="Veiwmore.php?res_id='.$rows['product_id'].'" > <img src="'.$rows['product_image'].'" alt="Restaurant logo"> </a>
                                                                </div>
                                                    
                                                                <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                                                                    <h5><a href="view.php?res_id='.$rows['product_id'].'" >'.$rows['product_name'].'</a></h5> <span>'.$rows['description'].'</span><br>
                                                                    <span>'.$rows['scale'].'</span>
                                                                    <i aria-hidden="true" id="'.$rows['product_id'].'"></i>
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                
                                                    </div>';
                                          }
                        
                        
                        ?>
                        
                            
                        
                    
                    </div>
                </div>
     
               </div>
            </div>
        </section>
        <?php 
     include('footer.php');
     ?>
        
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
    <script src="JavaScript/Main.js"></script>

                                        <script>
                            function openForm() {
                                document.getElementById("myForm").style.display = "block";
                            }

                            function closeForm() {
                                document.getElementById("myForm").style.display = "none";
                            }
                        </script>

<div class="form-popup" id="myForm" style="right: 325px; bottom: 100px;">
  <form method="POST" class="form-container">
    <h1></h1>

    <div class="inner-page-hero bg-image" style="width: 500px; height: 500px;" data-image-src="img/size.jpeg" onclick="closeForm()">    

  </form>
</div>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByClassName("restaurant-listing")[0];
        tr = table.getElementsByClassName("single-restaurant");
        
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("h5")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>
</body>

</html>