<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Forgot Password </title>
    <link rel="stylesheet" href="./assets/login-signup/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <div class="container">
    <div class="title">Forgot Password</div>
    <div class="content">
      <form action="./forgot_password.php" method="post" autocomplete="nope">
        <div class="user-details">          
          <div class="input-box" style="width: 100%;">
            <span class="details">Register Email</span>
            <input autocomplete="nope" type="email" name="email" placeholder="Enter your Register email" required>
          </div>
          <!-- <div class="input-box">
            <span class="details">Password</span>
            <input autocomplete="nope" type="password" name="pass" minlength="3" placeholder="Enter your password" required>
          </div> -->
        </div>        
        <div class="button">
          <input type="submit" name="sb" value="Forgot Password">
        </div>
      </form>
    </div>
    <!-- <h5>If, Your are already Not Register User so Click &nbsp;&nbsp;&nbsp;<a href="signup.html">SIGNUP</a></h5> -->
    <h5>Don't have an account? &nbsp;&nbsp;&nbsp;<a href="signup.html">SIGNUP NOW</a></h5>
    <h5>Rember Your Password? &nbsp;&nbsp;&nbsp;<a href="login.html">LOGIN NOW</a></h5>
  </div>
</body>
</html>


<?php

if(isset($_POST['sb'])){
    $email = $_POST['email'];

    include './database/connect.php';
    $que = mysqli_query($con,"SELECT * FROM author_data WHERE author_email='$email'");
    $arr = mysqli_fetch_array($que);


    if($arr['author_email'] == $email){

//require 'PHPMailerAutoload.php';
require './mailer/credential.php';

// $email = $_GET['email'];
define('TOEMAIL', $email);

function PHPMailerAutoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'./mailer/class.'.strtolower($classname).'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('PHPMailerAutoload', true, true);
    } else {
        spl_autoload_register('PHPMailerAutoload');
    }
} else {
    function spl_autoload_register($classname)
    {
        PHPMailerAutoload($classname);
    }
}	

$mail = new PHPMailer;

$mail->SMTPDebug = 0;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = FROMEMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(FROMEMAIL, 'E-Book Maker');
$mail->addAddress(TOEMAIL, 'Verification');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo(FROMEMAIL, 'Replay To This Email');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Password Forgot Email';
$mail->Body    = '<h1>Click Here To Change Password</h1><br>http://localhost/ProjectSE/change_password.php?email='.TOEMAIL;
// $mail->AltBody = '<br>;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    echo "<script LANGUAGE='JavaScript'>
        window.alert('Message Send Succesfully... Please Check EMail....');
        window.location.href='./login.html';
        </script>";
}
    }
    else{
        echo "<script LANGUAGE='JavaScript'>window.alert('Email Not Register... Please Register First....');
        window.location.href='./forgot_password.php';</script>";
    }

}
?>