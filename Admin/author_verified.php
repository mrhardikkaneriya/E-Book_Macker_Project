<?php
session_start();
if(isset($_SESSION['ad_id'])){
include '../database/connect.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($con,"UPDATE author_data SET author_verified=$status WHERE author_id=$id");

$que1 = mysqli_query($con,"SELECT * FROM author_data WHERE author_id=$id");	
$row1 = mysqli_fetch_array($que1);

require '../mailer/credential.php';

define('TOEMAIL', $row1['author_email']);	

function PHPMailerAutoload($classname)
{
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'../mailer/class.'.strtolower($classname).'.php';
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

$mail->setFrom(FROMEMAIL, 'E-Book Macker');
$mail->addAddress(TOEMAIL, 'Verification');     // Add a recipient
$mail->addReplyTo(FROMEMAIL, 'Replay To This Email');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Verification';
if($status == 1){
$mail->Body    = "Dear User,<p>Your account has been verified. You may now login.</p><br/>Team E-Book Maker.";
}else{
$mail->Body    = "Dear User,<p>Due to unfortunate reason your account has been unverified.</p><br/>Team E-Book Maker.";
}

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo "<script LANGUAGE='JavaScript'>
        window.alert('Verified Change Succesfully...');
        window.location.href='author.php';
        </script>";
}

}else{
    echo "<script LANGUAGE='JavaScript'>window.location.href='../login.html';</script>";  
}  
?>