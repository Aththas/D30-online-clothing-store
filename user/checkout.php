<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert() { 
      

    echo "<script>alert('Thank you. Your Order has been placed!');</script>"; 
    echo "<script>window.location.replace('your_orders.php');</script>"; 
} 

if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

                                                $count = mysqli_query($db,"select max(order_id) from order_product");
                                                $row_count = mysqli_fetch_row($count);
                                                $lastid = $row_count[0]+1;
										          $item_total_amount = 0;

                                                foreach ($_SESSION["cart_item"] as $item)
                                                {

                                                $item_total = (floatval($item["product_price"])*floatval($item["quantity"]));
                                                $item_total_amount = $item_total_amount + $item_total;
                                                }
                                                $net = floatval($item_total_amount);

                                            if($_POST['submit'])
                                            {
                                                if($_POST["name"] == "" || $_POST["number"] == "" || $_POST["date"] == ""|| $_POST["cvv"] == "")
                                                {
                                                    ?>
                                                    <script type="text/javascript">
                                                        alert("Cards details are required");
                                                        window.location="checkout.php";
                                                    </script>
                                                    <?php
                                                }
                                                else
                                                {
                                                    $total = 0;
												    foreach ($_SESSION["cart_item"] as $item)
												    {

												    $item_total = (floatval($item["product_price"])*floatval($item["quantity"]));
                                                    $total = $total + $item_total;
													

													   $SQL="insert into order_product values('$lastid','".$item["product_id"]."','".$item["product_price"]."','".$item["quantity"]."','$item_total')";
														  mysqli_query($db,$SQL);


                                                          if($item["product_size"] == "Small") {
                                                            mysqli_query($db, "update size set Small = Small-$item[quantity] where product_id ='".$item["product_id"]."' ");
														  }else if($item["product_size"] == "Medium") {
                                                            mysqli_query($db, "update size set Medium = Medium-$item[quantity] where product_id ='".$item["product_id"]."' ");
                                                          }else if($item["product_size"] == "Large") {
                                                            mysqli_query($db, "update size set Large = Large-$item[quantity] where product_id ='".$item["product_id"]."' ");
                                                          }else if($item["product_size"] == "XL") {
                                                            mysqli_query($db, "update size set XL = XL-$item[quantity] where product_id ='".$item["product_id"]."' ");
                                                          }else if($item["product_size"] == "XXL") {
                                                            mysqli_query($db, "update size set XXL = XXL-$item[quantity] where product_id ='".$item["product_id"]."' ");
                                                          }else if($item["product_size"] == "XXXL") {
                                                            mysqli_query($db, "update size set XXXL = XXXL-$item[quantity] where product_id ='".$item["product_id"]."' ");
                                                          }
                                                        
                                                            unset($_SESSION["cart_item"]);
                                                            unset($item["product_name"]);
                                                            unset($item["quantity"]);
                                                            unset($item["product_price"]);
                                                            unset($item["product_size"]);
														  $success = "Thank you. Your order has been placed!";

                                                            function_alert();
												    }
                                                    $tdy = date("Y-m-d");
                                                    $order_query = "insert into tbl_order values('$lastid','".$_SESSION["user_id"]."','$tdy','$total')";
                                                    mysqli_query($db,$order_query);

                                                    $payment_query = "insert into payment_details values('','$lastid','".$_SESSION["user_id"]."','$total', 'Online Payment')";
                                                    mysqli_query($db,$payment_query);
                                                }
                                                
											}
                                                
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
    <link href="chatc.css" rel="stylesheet">  </head>
<body>
    
    <div class="site-wrapper">
    <?php 
            include('Header.php');
        ?>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="shop.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>3</span><a href="checkout.php">Order and Pay</a></li>
                    </ul>
                </div>
            </div>
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
                </div>
            
			
			
				  
            <div class="container m-t-30">

			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                        <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td><?php echo $item_total_amount; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong><?php echo $net; ?></strong></td>
                                                    </tr>
                                                </tbody>
												
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row"><br>
                                        <div class="cart-totals-title" style="padding-left: 15px;">
                                            <h4>Card Details</h4> </div><br>
                                    <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Name on card</label>
                                       <input class="form-control" type="text" name="name" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Card number</label>
                                       <input class="form-control" type="text" name="number" id="example-text-input" maxlength="16" onkeypress="return validation(event)"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Date(mm/yy)</label>
                                       <input class="form-control" type="text" name="date" maxlength="5" id="example-text-input-2"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">CVV</label>
                                       <input type="text" class="form-control" name="cvv" maxlength="3" id="example-text-input" onkeypress="return validation(event)"> 
                                    </div>
                                 </div>
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" checked class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Paypal <img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit"  class="btn btn-success btn-block" value="Order Now"> </p>
                                    </div>
									</form>
                                    <script type="text/javascript">
                                        function validation(evt) {
          
                                            var ASCII = (evt.which) ? evt.which : evt.keyCode
                                            if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
                                                return false;
                                            return true;
                                        }
                                    </script>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>
            <?php 
     include('footer.php');
     ?>
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

<?php
}
?>
