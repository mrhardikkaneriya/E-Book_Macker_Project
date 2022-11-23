<?php

if(isset($_POST['sb'])){
    $email = $_POST['email'];
require './mailer/credential.php';

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

$mail->setFrom(TOEMAIL, 'E-Book Macker');
$mail->addAddress(FROMEMAIL, 'Verification');     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo(TOEMAIL, 'Replay To This Email');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Contact Mail';
$mail->Body    = '<h1>Name :- </h1>'.$_POST['name'].'<br><h1>Email :- </h1>'.$_POST['email'].'<br><h1>Message :- </h1>'.$_POST['message'];
// $mail->AltBody = '<br>';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
    echo "<script LANGUAGE='JavaScript'>
        window.alert('Message Send Succesfully... Please Wait Response....');
        window.location.href='./index.php';
        </script>";
}
}
?>