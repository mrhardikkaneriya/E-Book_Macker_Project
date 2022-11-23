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

$que = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_id=$id");
$arr1 = mysqli_fetch_array($que);

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
        <a href="./profile.php"  class="active">
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
          <div class="title">Admin Profile</div>
          <div class="sales-details">
            <form action="update_profile.php" method="post" autocomplete="nope">
                  <input type="hidden" name="id" value="<?php echo $arr1['admin_id'];?>">
                
                  <label>First Name</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="text" name="fname" minlength="2" value="<?php echo $arr1['admin_first_name'];?>" placeholder="Enter your First name" required>
                
                
                  <label>Last Name</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="text" name="lname" minlength="2" value="<?php echo $arr1['admin_last_name'];?>" placeholder="Enter your Last name" required>
                
                
                  <label>Email</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="email" name="email" value="<?php echo $arr1['admin_email'];?>" placeholder="Enter your email" required>
                
                
                  <label>Password</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="password" name="pass" minlength="3"  value="<?php echo $arr1['admin_password'];?>" placeholder="Enter your password" required>
                
                
                  <label>Confirm Password</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="password" name="cpass" minlength="3"  value="<?php echo $arr1['admin_password'];?>" placeholder="Confirm your password" required>
              
                <input class="admin-profile-form-submit" type="submit" name="sb" value="Update Profile">
              
            </form>
          </div>

        </div>

      </div>
    </div>
  </section>

  <script src="./script.js"></script>

</body>

</html>
<?php
}
else{
  header("Location: ../login.html");
}
?>