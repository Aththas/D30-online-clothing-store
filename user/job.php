<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("connection/connect.php"); 
if(isset($_POST['submit'] )){
     if(empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['phone'])|| empty($_POST['position']))
		{
			echo "<script>alert('All Fields Are Required!');</script>"; 
		}
	else
	{
	
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
          echo "<script>alert('Invalid email address please type a valid email!');</script>"; 
    }
	  else
    {
          //CV start
          $targetDir = "../cv/";
          $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
          $uploadOk = 1;
          $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
          //CV end


          if($fileType != "pdf") {
              ?>
                  <script type="text/javascript">
                      alert('Sorry, only PDF files are allowed');
                  </script>
              <?php
              header("refresh:0.1;url=job.php");
              $uploadOk = 0;
          }
          else{
          move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile);
       
	         $mql = "INSERT INTO job_applications VALUES('','$_POST[fname]','$_POST[phone]','$_POST[email]','$_POST[position]','$targetFile')";
	         mysqli_query($db, $mql);
           ?>
                  <script type="text/javascript">
                      alert('Job Application Submitted Successfully');
                  </script>
              <?php
	
		      header("refresh:0.1;url=index.php");
        }
    }
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
<div style=" background-image: url('img/bglog.png'); background-size: cover;
   background-position: top center;">
<?php 
            include('Header.php');
        ?>
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
                            
							                 <form method="POST" autocomplete="off" enctype="multipart/form-data">
                                 <div class="row">
								                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Full Name</label>
                                       <input class="form-control" type="text" name="fname" id="fname"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Contact No.</label>
                                       <input class="form-control" type="text" name="phone" id="phone" onkeypress="return validation(event)" maxlength="10"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Email</label>
                                       <input class="form-control" type="text" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Position</label>
                                       <select name="position" id="position" class="form-control">
                                          <option disabled selected> Select a Category</option> 
                                          <?php 
                                          $tdy = date("Y-m-d");
                                            $r = mysqli_query($db,"select * from job_positions where expire_date>'$tdy' ");

                                            while ($rw=mysqli_fetch_array($r)) {
                                    
                                                echo "<option>".$rw["position"]."</option>"; 
                                            }

                                          ?> 
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Add CV</label>
                                       <input class="form-control" type="file" name="pdfFile" id="pdfFile"> 
                                    </div>
                                    
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Submit Form" name="submit" class="btn theme-btn"> </p>
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