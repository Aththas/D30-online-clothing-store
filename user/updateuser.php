<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("connection/connect.php"); 
if(isset($_POST['submit'] )){
  if(empty($_POST['firstname']) ||
    empty($_POST['username']) || 
   	empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
	  empty($_POST['home']) ||  
    empty($_POST['street'])||
    empty($_POST['city'])||
    empty($_POST['country']) ||
    empty($_POST['postal']))
	{
			echo "<script>alert('All Fields Are Required!');</script>"; 
	}
	else
	{
     if(strlen($_POST['phone']) < 10 || strlen($_POST['phone']) > 10)  
	   {
        echo "<script>alert('Invalid phone number!');</script>"; 
	   }
	   else{
       
	 
	     $mql = "update cus_details set firstName = '$_POST[firstname]', lastName = '$_POST[lastname]', contact_number = '$_POST[phone]', email = '$_POST[email]', HomeNo = '$_POST[home]',street = '$_POST[street]', city = '$_POST[city]', country = '$_POST[country]',postalcode = '$_POST[postal]', username = '$_POST[username]' where Customer_ID = '$_GET[id]'";
	     mysqli_query($db, $mql);

      ?>
      <script type="text/javascript">
        alert("User Details Updated Successfully");
      </script>
      <?php
	
		  header("refresh:0.1;url=updateuser.php?id=$_GET[id]");
     }
	}

}

if(isset($_POST['update_pwd'] )){

  $loginquery ="SELECT * FROM cus_details WHERE Customer_ID=$_GET[id] "; //selecting matching records
  $result=mysqli_query($db, $loginquery); //executing
  $row=mysqli_fetch_array($result);

  $verify = password_verify($_POST['cpwd'] ,$row["password"]);

  if(empty($_POST['cpwd']) || empty($_POST['npwd']) || empty($_POST['rpwd']))
  {
    echo "<script>alert('All Fields Are Required!');</script>"; 
  }
  else if($verify)
  {
      if($_POST['npwd'] == $_POST['rpwd'])
      {
        $encrypt_pwd = password_hash($_POST["npwd"], PASSWORD_DEFAULT);
        $mql = "update cus_details set password = '$encrypt_pwd' where Customer_ID = '$_GET[id]'";
        mysqli_query($db, $mql);

        ?>
        <script type="text/javascript">
          alert("Password Updated Successfully");
        </script>
        <?php
  
        header("refresh:0.1;url=updateuser.php?id=$_GET[id]");
      }
      else
      {
        ?>
        <script type="text/javascript">
          alert("New Passwords Not Matched!");
        </script>
        <?php
  
        header("refresh:0.1;url=updateuser.php?id=$_GET[id]");
      }
  }
  else
  {
      ?>
      <script type="text/javascript">
        alert("Invalid Password!");
      </script>
      <?php
  
      header("refresh:0.1;url=updateuser.php?id=$_GET[id]");
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
  <link href="chatc.css" rel="stylesheet"> 
</head>
<body>
<?php 
            include('Header.php');
        ?>
<div style=" background-image: url('images/bg.jpg');">
       	
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
   
         <div class="page-wrapper">
            
               <div class="container">
                  <ul>
                    
                    
                  </ul>
               </div>
            
            <section class="contact-page inner-page">
               <div class="container ">
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="widget" >
                           <div class="widget-body">
                            <h1>User Details</h1>
							  <form action="" method="POST" autocomplete="off">
                                 <div class="row">
                                  <?php
                                  $uid = $_GET["id"];
                                  $rs_update = mysqli_query($db,"select * from cus_details where Customer_ID = '$uid'");
                                  while($row_update = mysqli_fetch_array($rs_update))
                                  {
                                  ?>
								                    <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">User-Name</label>
                                       <input class="form-control" type="text" name="username" value="<?php echo $row_update["username"]; ?>" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">First Name</label>
                                       <input class="form-control" type="text" name="firstname" id="example-text-input" value="<?php echo $row_update["firstName"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Last Name</label>
                                       <input class="form-control" type="text" name="lastname" id="example-text-input-2" value="<?php echo $row_update["lastName"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Email Address</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row_update["email"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Phone number</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3" value="0<?php echo $row_update["contact_number"]; ?>" maxlength="10" onkeypress="return validation(event)"> 
                                    </div>

                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Home No</label>
                                       <input class="form-control" type="text" name="home" id="example-text-input-3" value="<?php echo $row_update["HomeNo"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Street</label>
                                       <input class="form-control" type="text" name="street" id="example-text-input-4" value="<?php echo $row_update["street"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-4">
                                       <label for="exampleInputEmail1">City</label>
                                       <input class="form-control" type="text" name="city" id="example-text-input-5" value="<?php echo $row_update["city"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-4">
                                       <label for="exampleInputEmail1">Country</label>
                                       <input class="form-control" type="text" name="country" id="example-text-input-6" value="<?php echo $row_update["country"]; ?>"> 
                                    </div>
                                    <div class="form-group col-sm-4">
                                       <label for="exampleInputEmail1">Postal code</label>
                                       <input class="form-control" type="text" name="postal" id="example-text-input-7" value="<?php echo $row_update["postalcode"]; ?>"> 
                                    </div>
                                  <?php
                                  }
                                  ?>
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Update Details" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                  
						   </div>
           
                        </div>
                     
                     </div>
                    
                  </div>
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="widget" >
                           <div class="widget-body">
                            <h1>Password Reset</h1>
                <form action="" method="POST" autocomplete="off">
                                 <div class="row">
                                    <div class="form-group col-sm-4">
                                       <label for="exampleInputEmail1">Current Password</label>
                                       <input class="form-control" type="password" name="cpwd" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-4">
                                       <label for="exampleInputEmail1">New Password</label>
                                       <input class="form-control" type="password" name="npwd" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-4">
                                       <label for="exampleInputEmail1">Re Password</label>
                                       <input class="form-control" type="password" name="rpwd" id="example-text-input-2"> 
                                    </div>
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Update Password" name="update_pwd" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                  
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