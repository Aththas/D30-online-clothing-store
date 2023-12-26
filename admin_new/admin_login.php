<?php
session_start();
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="../user/img/D30.jpeg">
  <title>Admin Login</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" method="POST">
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" class="login__input" placeholder="User name / Email" name="uname">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" class="login__input" placeholder="Password" name="pwd">
                </div>
                <span class="button__text"><input type="submit" value="Log In Now" name="submit_btn" class="button login__submit"> </span>
                    
                                 
            </form>
            <div class="social-login">
                <h3>Follow us via</h3>
                <div class="social-icons">
                    <a href="#" class="social-login__icon fab fa-instagram"></a>
                    <a href="#" class="social-login__icon fab fa-facebook"></a>
                    <a href="#" class="social-login__icon fab fa-twitter"></a>
                </div>
            </div>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>      
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>      
    </div>
</div>
<!-- partial -->

<?php
   
    if(isset($_POST["submit_btn"]))
    {   
        
            $res=mysqli_query($link,"select * from admin_login");
                $count = 0;
                while($row=mysqli_fetch_array($res))
                {
                    $u = strcmp($row["username"], $_POST["uname"]);
                    $verify = password_verify($_POST["pwd"],$row["password"]);

                    if($u == 0)
                    {
                        if($verify)
                        {
                            $_SESSION["admin"]=$row["admin_ID"];
                            $count++;
                            ?>
                            <script type="text/javascript">
                                window.location="index.php";
                            </script>
                            <?php
                        }
                        
                    }
                }

                    $u = strcmp("", $_POST["uname"]);
                    $p = strcmp("", $_POST["pwd"]);
                if($count == 0 && $u != 0 && $p != 0)
                {
                        ?>
                        <script type="text/javascript">
                            alert("Invalid Login!!!");
                            window.location = "admin_login.php";
                        </script>
                        <?php
                }
                if($u == 0 || $p == 0)
                {
                        ?>
                        <script type="text/javascript">
                            alert("Fields Can't be empty!!!");
                            window.location = "admin_login.php";
                        </script>
                        <?php
                }

    }
    ?>
  
</body>
</html>
