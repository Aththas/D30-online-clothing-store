<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

include_once 'product-action.php'; 

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <<link rel="icon" href="img/D30.jpeg">
    <title>D30 Store</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="chatc.css" rel="stylesheet"> 
     </head>

<body>
<?php 
            include('Header.php');
        ?>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="#">Browse Products</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="view.php?res_id=<?php echo $_GET['res_id']; ?>">Choose Products</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                        
                    </ul>
                </div>
            </div>
			<?php $ress= mysqli_query($db,"select * from tbl_product where product_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);
										  
										  ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/w2.jpg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="'.$rows['product_image'].'" alt="Restaurant logo">'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $rows['product_name']; ?></a></h6>
                                    <p>Category : <?php echo $rows['category']; ?></p>
                                    <p>Color : <?php echo $rows['color']; ?></p>  
                                    <p>Price : Rs <?php echo $rows['product_price']; ?></p>
                                    <p>Description : <?php echo $rows['description']; ?></p>    
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </section>
            <div class="breadcrumb">
                <div class="container">
                   
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        
                         <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Your Cart
                              </h3>
							  				  
							  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">
									
									
	<?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)  
{
?>                                  
                                    
                                        <div class="title-row">
                                        <?php echo $item["product_name"]; ?><a href="view.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["product_id"]; ?>" >
                                        <i class="fa fa-trash pull-right"></i></a>
                                        </div>
                                        
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                 <input type="text" class="form-control b-r-0" value='<?php echo $item["product_price"]; ?>' readonly id="exampleSelect1">
                                                   
                                            </div>
                                            <div class="col-xs-4">
                                               <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                        
                                      </div>
                                      
    <?php
$item_total += (floatval($item["product_price"])*floatval($item["quantity"])); 
}
?>  							  
									  
									  
									  
                                    </div>
                                </div>
                               
                         
                             
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo $item_total; ?></strong></h3>
                                        <p>Free Delivery!</p>
                                        <?php
                                        if($item_total==0){
                                        ?>

                                        
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-danger btn-lg disabled">Checkout</a>

                                        <?php
                                        }
                                        else{   
                                        ?>
                                        <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check"  class="btn btn-success btn-lg active">Checkout</a>
                                        <?php   
                                        }
                                        ?>

                                    </div>
                                </div>
								
						
								
								
                            </div>
                    </div>

                    <div class="col-md-8">
                      
             
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="popular2">
						<?php  
									$stmt = $db->prepare("select * from tbl_product where product_id='$_GET[res_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{
						
													
													 
													 ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
										<form method="post" action='view.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['product_id']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="'.$product['product_image'].'" alt="logo">'; ?></a>
                                            </div>
                                
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['product_name']; ?></a></h6>
                                                <!-- <p> <?php echo $product['description']; ?></p> -->
                                            </div>
                           
                                        </div>
                               
                                        <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info"> 
										<span class="price pull-left" ><?php echo $product['product_price']; ?></span><br>
                                        <label for="size">Choose a Size:</label>
                                          <select name="size" id="size">
                                            <option>Small</option>
                                            <option>Medium</option>
                                            <option>Large</option>
                                            <option>XL</option>
                                            <option>XXL</option>
                                            <option>XXXL</option>
                                          </select>
										  <input class="b-r-0" type="number" name="quantity" value="1" size="2" min="1" />
										  <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />
										</div>
										</form>
                                    </div>
              
                                </div>
                
								
								<?php
									  }
									}
									
								?>
								
								
                              
                            </div>
             
                        </div>
            
                       
                    </div>
                    
                </div>
     
            </div>

        
            <?php 
     include('footer.php');
     ?>
      
        </div>
  
    </div>

 
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
              
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
               
                            </div>
           
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2"> </div>
                                </div>
                            </div>
                        </div>
               
                    </div>
              
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                    
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                
                            </div>
               
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.49</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3"> </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
            
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                       
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                 
                            </div>
                
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 1.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4"> </div>
                                </div>
                            </div>
                        </div>
                 
                    </div>
               
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                 
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                      
                            </div>
                       
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 3.15</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5"> </div>
                                </div>
                            </div>
                        </div>
           
                    </div>
             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add To Cart</button>
                </div>
            </div>
        </div>
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
