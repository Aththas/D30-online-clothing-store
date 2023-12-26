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
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
$id = $_GET["id"];
$name = $_GET["name"];
if($name == "product")
{
	mysqli_query($link,"delete from tbl_product where product_id= '$id'");
	mysqli_query($link,"delete from size where product_id= '$id'");
	?>
	<script type="text/javascript">
        alert("Product #<?php echo $id; ?> deleted successfully!!!");
        window.location = "index.php";
	</script>
	<?php
}
else if($name == "job")
{
	mysqli_query($link,"delete from job_positions where id= '$id'");
	?>
	<script type="text/javascript">
        alert("Job #<?php echo $id; ?> deleted successfully!!!");
        window.location = "job.php";
	</script>
	<?php
}

?>
</body>
</html>