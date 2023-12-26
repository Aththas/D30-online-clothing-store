
<html>
  <head>
    <title>Test</title>
  </head>
  <body>
    

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"online_shopping");
session_start(); 

$email = $_SESSION["email"];

$res1= mysqli_query($link,"select Customer_ID from cus_details WHERE email='$email' ");
$row1=mysqli_fetch_row($res1);  
$id= $row1[0];
$_SESSION["uid"] = $id;

$v1=rand(1111,9999);
$v2=rand(1111,9999);
   
$v3=($v1.$v2)/100;
$code=intval($v3);

$_SESSION["code"] = $code;


require 'Mailer/PHPMailer-master/src/Exception.php'; 
require 'Mailer/PHPMailer-master/src/PHPMailer.php'; 
require 'Mailer/PHPMailer-master/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//ast_123_
try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'samadhiperera929@gmail.com';                     //SMTP username
    $mail->Password   = 'cxykqzadfeqnffpj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('samadhiperera929@gmail.com');
    $mail->addAddress($email);     //Add a recipient             //Name is optional


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Code';
    $mail->Body    = $code;

    $mail->send();
    ?>
    <script type="text/javascript">
        alert("Verification Code has been sended to <?php echo $email; ?>");
        window.location = "verify.php";

    </script>
    <?php

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    ?>
    <script type="text/javascript">
        alert("Verification Code could not be sent. Mailer Error!!!");
        window.location = "reset.php";
    </script>
    <?php
}
?>

  </body>
</html>