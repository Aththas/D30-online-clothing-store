        <style type="text/css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </style>
        <script type="text/javascript">
    function validation(evt) {
          
        var ASCII = (evt.which) ? evt.which : evt.keyCode
        if (ASCII > 31 && (ASCII < 48 || ASCII > 57) )
            return false;
        return true;
    }
</script>
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img style="border-radius:50%" src="img/D30.jpeg" alt="" width="40px" height="40px"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">

                            	<li class="nav-item"> <a class="nav-link active" href="index.php">Home<span class="sr-only"></span></a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="shop.php">Shop<span class="sr-only"></span></a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="job.php">Jobs<span class="sr-only"></span></a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="contact.php">Contact us<span class="sr-only"></span></a> </li>
                        <?php
						if(empty($_SESSION["user_id"])) // if user is not login
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{

									
									echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active"><i class="fa fa-power-off" style="font-size:18px; color: red;"></i></a> </li>';
                                                      echo  '<li class="nav-item"><a href="updateuser.php?id='.$_SESSION["user_id"].'" class="nav-link active"><i class="fa fa-user" style="font-size:18px; color:green;"></i></a> </li>';
                                                      
							}

						?>
							 
                        </ul>
						 
                    </div>
                </div>
            </nav>

        </header>
