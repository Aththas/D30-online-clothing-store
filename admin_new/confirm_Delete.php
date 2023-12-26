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
	<script src="sweetalert.min.js"></script>
</head>
<body>

<?php

$id = $_GET["id"];
$name = $_GET["name"];

?>
<script type="text/javascript">
 swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!!!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) 
  {
    window.location = "delete.php?id=<?php echo $id ?>&name=<?php echo $name ?>";
  } else 
  {<?php
    if($name == "product")
    {?>
        window.location = "index.php";
        <?php
    }
    else if($name == "job")
    {?>
        window.location = "job.php";
        <?php
    }
    ?>
  }
});
</script>

</body>
</html>