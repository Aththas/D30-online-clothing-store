<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <link rel="icon" href="img/D30.jpeg">
    <title>D30 Store</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

	  <style type="text/css">
	  #buttn{
		  color:#fff;
		  background-color: #5c4ac7;
	  }
	  </style>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
<div style=" background-image: url('img/bglog.png'); background-size: cover;
   background-position: top center;">

<?php
include("connection/connect.php"); 
error_reporting(0); 
session_start(); 
if(isset($_POST['submit']))  
{
	$code = $_POST['code'];  
	
	if(!empty($_POST["submit"]))   
     {

      if($code == $_SESSION["code"])
      {
        header("refresh:1;url=newpwd.php");
      }
      else
      {
        $message = "Invalid Code!";
      }
                 
	 }
	
	
}
?>
  

<div class="pen-title">
  <
</div>

<div class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Verify Code</h2>
	  <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
    <form action="" method="post" autocomplete="off">
      <input type="text" placeholder="verify code"  name="code"/>
      <input type="submit" id="buttn" name="submit" value="Submit Code" />
    </form>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

   
  <div class="container-fluid pt-3">
	<p></p>
  </div>
   
  <?php 
     include('footer.php');
     ?>
       


</body>

</html>
