<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
	$id = $_GET["id"];
?>
<head>
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
.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
}

/* 
table { 
	width: 750px; 
	border-collapse: collapse; 
	margin: auto;
	
	}

/* Zebra striping */
/* tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #404040; 
	color: white; 
	font-weight: bold; 
	
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 14px;
	
	} */ */


@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* table { 
	  	width: 100%; 
	}

	
	table, thead, tbody, th, td, tr { 
		display: block; 
	} */
	
	
	/* thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; } */
	
	/* td { 
		
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		
		position: absolute;
	
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	} */

}
	</style>

	</head>

<body>
<?php 
            include('Header.php');
        ?>
        <div class="page-wrapper">
       
           
    
            <div class="inner-page-hero bg-image" data-image-src="images/img/w2.jpg">
                <div class="container"> </div>
        
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                       
                       
                    </div>
                </div>
            </div>
    
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                          </div>
                        <div class="col-xs-12">
                            <div class="bg-gray">
                                <div class="row">
								
							<table class="table table-bordered table-hover">
						  <thead style = "background: #404040; color:white;">
							<tr>
							<th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
							</tr>
						  </thead>
						  <tbody>
						  
						  
							<?php 
				
						$query_res= mysqli_query($db,"select * from order_product where order_id = '$id'");		      
										  while($row=mysqli_fetch_array($query_res))
										  {
						
							?>
												<tr>	
														  <td data-column="Product Id"> <?php echo $row['product_id']; ?></td>
														  <?php
														  	$c_id = $row["product_id"];
                        									$r = mysqli_query($db,"select * from tbl_product where product_id = $c_id ");
                        									while($rw=mysqli_fetch_array($r))
                        									{
                        										?>
                        									    <td data-column="Product Name"> <?php echo $rw['product_name']; ?></td>
                        									    <?php
                        									}
														  ?>
														  <td data-column="Product Price"><?php echo $row['product_price']; ?></td>
														  <td data-column="Quantity"><?php echo $row['qty']; ?></td>
														  <td data-column="Total"><?php echo $row['total']; ?></td>
												</tr>
												
											
														<?php } ?>					
							
							
										
						
						  </tbody>
					</table>
						
					
                                    
                                </div>
                           
                            </div>
                         
                            
                                
                            </div>
                          
                          
                           
                        </div>
                    </div>
                </div>
            </section>
            <?php 
     include('footer.php');
     ?>
        
        </div>
  
    
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
<?php
}
?>