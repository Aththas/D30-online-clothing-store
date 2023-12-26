<?php

include("connection/connect.php"); 
if(!empty($_GET["action"])) 
{
$productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
$size = isset($_POST['size']) ? htmlspecialchars($_POST['size']) : '';
$available_qty = 0;
$ress= mysqli_query($db,"select * from size where product_id='$_GET[res_id]'");
$rows=mysqli_fetch_array($ress);
if($size == "Small")
{
	$available_qty = $rows['Small'];
}
else if($size == "Medium")
{
	$available_qty = $rows['Medium'];
}
else if($size == "Large")
{
	$available_qty = $rows['Large'];
}
else if($size == "XL")
{
	$available_qty = $rows['XL'];
}
else if($size == "XXL")
{
	$available_qty = $rows['XXL'];
}
else if($size == "XXXL")
{
	$available_qty = $rows['XXXL'];
}

$quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

switch($_GET["action"])
 {
	case "add":
	 if($available_qty > $quantity){
		if(!empty($quantity)) {
								$stmt = $db->prepare("SELECT * FROM tbl_product where product_id= ?");
								$stmt->bind_param('i',$productId);
								$stmt->execute();
								$productDetails = $stmt->get_result()->fetch_object();
                                $itemArray = array($productDetails->product_id=>array('product_name'=>$productDetails->product_name, 'product_id'=>$productDetails->product_id, 'quantity'=>$quantity, 'product_price'=>$productDetails->product_price,  'product_size'=>$size));
					if(!empty($_SESSION["cart_item"])) 
					{
						if(in_array($productDetails->product_id,array_keys($_SESSION["cart_item"]))) 
						{
							foreach($_SESSION["cart_item"] as $k => $v) 
							{
								if($productDetails->product_id == $k) 
								{
									if(empty($_SESSION["cart_item"][$k]["quantity"])) 
									{
									$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $quantity;
								}
							}
						}
						else 
						{
								$_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
						}
					} 
					else 
					{
						$_SESSION["cart_item"] = $itemArray;
					}
			}
		}
		else{

			?>
				<script type="text/javascript">
					alert("Quantity Limit Exceeded");
				</script>
			<?php
		}
		break;

	case "remove":
		if(!empty($_SESSION["cart_item"]))
			{
				foreach($_SESSION["cart_item"] as $k => $v) 
				{
					if($productId == $v['product_id'])
						unset($_SESSION["cart_item"][$k]);
				}
			}
			break;
			
	case "empty":
			unset($_SESSION["cart_item"]);
			break;
			
	case "check":
			header("location:checkout.php");
			break;
	}
}