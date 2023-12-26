<?php 
session_start();
include("../connection/connect.php");  
$action=$_POST['action'];
if($action=="Componentsearch"){
if(isset($_POST['Component'])){
    $products=$_POST['Component'];
    $brand ="SELECT * From tbl_product WHERE `sub_category` Like '%$products'";
    $brandresult=$db->query($brand);
    $outBrand='';
    $outSize='';
    if(mysqli_num_rows($brandresult)>0){
        while($Brandrow=mysqli_fetch_assoc($brandresult)){ 
            $outBrand.="<option value=".$Brandrow['brand']."></option>";
            $outSize.="<option value=".$Brandrow['scale']."></option>";
        }
        echo $outBrand."_".$outSize;
    }
    else{
        echo "noresult";
    }
}
}
else if($action=="ProductSearch"){
    if(isset($_POST['Component']) && isset($_POST['Brand'])){
        $component=$_POST['Component'];
        $Brand= $_POST['Brand'];
        $productresult=$db->query("SELECT * FROM `tbl_product` WHERE `sub_category` = '$component' AND `brand` = '$Brand'");
        while($productrow=mysqli_fetch_object($productresult)){ 
                $Jsonbj=json_encode($productrow);
            ?>
            <div id='<?php echo  $Jsonbj; ?>' class='Suggestitem' onclick='show(this.id)'><div><img src='<?php echo $productrow->product_image; ?>'></div><div><h3><?php echo $productrow->product_name; ?></h3><h5>Rs <?php echo $productrow->product_price;?>/=</h5><p><?php echo $productrow->product_price; ?></p></div></div>";
       <?php }

    }
    else{
        echo "Component is false";
    }
}
else if($action=="costomisalorder"){
    $_SESSION['user_id']=1;
    $coustomisableorderid=0;
    $products=$_POST['products'];
    $productTotal=$_POST['Total'];
    $id=$_SESSION['user_id'];
    $date=date('d-m-y');
    $insertcostomisable="INSERT INTO `tbl_order`(`order_id`, `Customer_ID`, `order_date`, `total`) VALUES ('$coustomisableorderid','$id','$date','$productTotal')";
    if($db->query($insertcostomisable)){
        $coustomisableorderid=$db->insert_id;
        echo 'ok';
    }
    $pro=json_decode($products,true);
    foreach($pro as $p){
        $pid=$p['product_id'];
        $pprice=$p['product_price'];
        $pqrt=$p['noofitem'];
        $tatal=$p['noofitem']*$p['product_price'];
        $insetproducts="INSERT INTO `order_product` (`order_id`, `product_id`, `product_price`, `qty`, `total`) VALUES ('$coustomisableorderid', '$pid', '$pprice', '$pqrt', '$tatal');";
        $db->query( $insetproducts);
    }
    $CostomizableProductStore=(object)array('cid'=>$coustomisableorderid,'total'=>$productTotal,'product'=>$products,'date'=>$date);
    $filname="../USERCOS/Cost".$_SESSION['username'].".json";
    if(file_exists($filname)){
        $jsondata=file_get_contents($filname,true);
        $jsonphp=json_decode($jsondata,false);
        $affteradd=array_push($jsonphp,$CostomizableProductStore);
        $saveCostomisable=json_encode($affteradd);
        file_put_contents($filname,$saveCostomisable);
    }
    else{
        file_put_contents($filname,json_encode($CostomizableProductStore));
    }
    
}
?>