<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("connection/connect.php"); 
if(isset($_POST['submit'])){
  if(empty($_POST['name']) || empty($_POST['email']) ||  empty($_POST['phone'])||empty($_POST['msg']))
  {
      echo "<script>alert('All Fields Are Required!');</script>"; 
  }
  else
  {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
          echo "<script>alert('Invalid email address please type a valid email!');</script>"; 
    }
    else
    {   
          $mql = "INSERT INTO tbl_msg VALUES('','$_POST[name]','$_POST[phone]','$_POST[email]','$_POST[msg]')";
          mysqli_query($db, $mql);
          ?>
          <script type="text/javascript">
            alert("Message sended Successfully");
          </script>
          <?php
          header("refresh:0.1;url=index.php");
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
  <link href="chatc.css" rel="stylesheet"> </head>
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
              <div style="max-width:100%;list-style:none; transition: none;overflow:hidden;width:1800px;height:400px;"><div id="google-maps-canvas" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Wattala,+Sri+Lanka&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div><a class="embed-ded-maphtml" href="https://www.bootstrapskins.com/themes" id="grab-map-data">premium bootstrap themes</a><style>#google-maps-canvas img.text-marker{max-width:none!important;background:none!important;}img{max-width:none}</style></div><br><br>
               <div class="container ">
                  <div class="row ">
                     <div class="col-md-12">
                        <div class="widget" >
                           <div class="widget-body">
                            Contact Form
                            
                              <form method="POST" autocomplete="off">
                                 <div class="row">
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Your Name</label>
                                       <input class="form-control" type="text" name="name" id="example-text-input"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Contact No.</label>
                                       <input class="form-control" type="text" name="phone" id="example-text-input" onkeypress="return validation(event)" maxlength="10"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Email</label>
                                       <input class="form-control" type="text" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"> 
                                    </div>
                                    <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Message(max 1000 characters)</label>
                                       <textarea type="text" class="form-control" name="msg" id="example-text-input" ></textarea> 
                                    </div>
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Submit" name="submit" class="btn theme-btn"> </p>
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