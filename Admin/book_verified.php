<?php
session_start();
if(isset($_SESSION['ad_id'])){
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS only -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

</head>

<?php

include "../database/connect.php";

$id = $_SESSION['ad_id'];

$bid = $_GET['id'];
$status = $_GET['status'];

$que = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_id=$id");
$arr1 = mysqli_fetch_array($que);

$que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_id='$bid'");
$arr2 = mysqli_fetch_array($que2);


if(isset($_POST['sb'])){

    $auid = $arr2['author_id'];
$que3 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id='$auid'");
$arr3 = mysqli_fetch_array($que3);

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
    require '../mailer/credential.php';
define('TOEMAIL', $arr3['author_email']);


    $mail = new PHPMailer;

    // $mail->SMTPDebug = 4;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = FROMEMAIL;                 // SMTP username
    $mail->Password = PASS;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom(FROMEMAIL, 'E-Book Macker');
$mail->addAddress(TOEMAIL);     // Add a recipient

    $mail->addReplyTo(FROMEMAIL);
    for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
        $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
    }
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Hello";
    $mail->Body    = "<b>Book Title = </b>" . $_POST['bname'] . "<br><br><b> Book Review :- </b><br>" .$_POST['book-review'];
    $mail->AltBody = 'message';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
        mysqli_query($con, "UPDATE ebook_data SET book_varified=$status WHERE book_id=$bid");

        header("Location: ./book_review.php");
    }

}	


?>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-user bx-flashing'></i>
            <span class="logo_name">Admin Pannel</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="./index.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
        <a href="./book_review.php">
          <i class='bx bx-box'></i>
          <span class="links_name">Book</span>
        </a>
      </li>
            <li>
                <a href="./author.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Author list</span>
                </a>
            </li>
            
            <li>
                <a href="./profile.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            
            <li class="log_out">
                <a href="../logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            
            <div class="profile-details">
                <i class='bx bx-user'></i>
                <a href="./profile.php"><span class="admin_name"><?php echo $arr1['admin_first_name'], " ", $arr1['admin_last_name'];  ?></span></a>
            </div>
        </nav>

        <div class="home-content">
            
            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Book Review</div>
                    <div class="sales-details">
            <form enctype="multipart/form-data" action="./book_verified.php?id=<?php echo $bid?>&status=<?php echo $status?>" method="post" autocomplete="nope">
                  <input type="hidden" name="id" value="<?php echo $arr2['book_id'];?>">
                
                  <label>Book Name</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="text" name="bname" minlength="2" value="<?php echo $arr2['book_title'];?>" placeholder="Enter your First name" required>
                
                  
                  <label>Book Review</label>
                  <textarea class="admin-profile-form-text" autocomplete="nope" name="book-review" minlength="2" rows="4" cols="100%" value="" placeholder="Enter Book Description" required></textarea>
                  
                  
                  <label for="name">File:</label>
                    <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
                  <input class="admin-profile-form-submit" type="submit" name="sb" value="Send Review">
              
            </form>
            
          </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Sales Boxes -->

    </div>

    <script src="./script.js"></script>

</body>

</html>
<?php
}else{
  header('Location: ../login.html');
}
?>