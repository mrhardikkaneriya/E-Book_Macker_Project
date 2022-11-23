<?php

if($_GET['email']){
    $email = $_GET['email'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Change Password </title>
    <link rel="stylesheet" href="./assets/login-signup/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <div class="container">
    <div class="title">Change Password</div>
    <div class="content">
      <form action="./change_password.php?email=<?php echo $email; ?>" method="post" autocomplete="nope">
        <div class="user-details">          
          
          <div class="input-box">
            <span class="details">Password</span>
            <input autocomplete="nope" type="password" name="pass" minlength="3" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Conform Password</span>
            <input autocomplete="nope" type="password" name="cpass" minlength="3" placeholder="Enter Conform your password" required>
          </div>
        </div>        
        <div class="button">
          <input type="submit" name="sb" value="Forgot Password">
        </div>
      </form>
    </div>
    <h5>Don't have an account? &nbsp;&nbsp;&nbsp;<a href="./signup.html">SIGNUP NOW</a></h5>
    <h5>Rember Your Password? &nbsp;&nbsp;&nbsp;<a href="./login.html">LOGIN NOW</a></h5>
  </div>
</body>
</html>


<?php

}

if($_GET['email'] && isset($_POST['sb'])){
    $email = $_GET['email'];
    $pass = $_POST['pass'];
    include './database/connect.php';	
    $que = mysqli_query($con,"SELECT * FROM author_data WHERE author_email='$email'");
    $arr = mysqli_fetch_array($que);

    if($arr['author_email'] == $email && $_POST['pass'] == $_POST['cpass']){
        $que2 = mysqli_query($con,"UPDATE author_data SET author_password=$pass WHERE author_email='$email'");
        echo "<script LANGUAGE='JavaScript'>alert('Password Change Succesfully...');
        window.location.href='./login.html';</script>";
    }else{
        echo "<script LANGUAGE='JavaScript'>alert('Password Not Same...');</script>";
    }
}
?>