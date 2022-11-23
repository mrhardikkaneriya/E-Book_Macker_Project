<?php
session_start();
if (isset($_SESSION['au_id'])) {
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

  $id = $_SESSION['au_id'];

  $que = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$id");
  $arr1 = mysqli_fetch_array($que);

  ?>

  <body>
    <div class="sidebar">
      <div class="logo-details">
        <i class='bx bx-user bx-flashing'></i>
        <span class="logo_name">Author Pannel</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="./index.php">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./new_book.php">
            <i class='bx bx-box'></i>
            <span class="links_name">New Book</span>
          </a>
        </li>
        <li>
          <a href="./book.php">
            <i class='bx bx-list-ul'></i>
            <span class="links_name">Book list</span>
          </a>
        </li>

        <li>
          <a href="./profile.php" class="active">
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
          <a href="./profile.php"><span class="admin_name"><?php echo $arr1['author_first_name'], " ", $arr1['author_last_name'];  ?></span></a>
        </div>
      </nav>

      <div class="home-content">


        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Author Profile</div>
            <div class="sales-details">
              <form action="./update_profile.php" method="post" autocomplete="nope">
                <input type="hidden" name="id" value="<?php echo $arr1['author_id']; ?>">

                <label>First Name</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="text" name="fname" minlength="2" value="<?php echo $arr1['author_first_name']; ?>" placeholder="Enter your First name" required>


                <label>Last Name</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="text" name="lname" minlength="2" value="<?php echo $arr1['author_last_name']; ?>" placeholder="Enter your Last name" required>


                <label>Email</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="email" name="email" value="<?php echo $arr1['author_email']; ?>" placeholder="Enter your email" required>


                <label>Phone Number</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="number" name="number" value="<?php echo $arr1['author_phone_no']; ?>" placeholder="Enter your number" min="5555555555" max="9999999999" required>


                <label>Password</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="password" name="pass" minlength="3" value="<?php echo $arr1['author_password']; ?>" placeholder="Enter your password" required>


                <label>Confirm Password</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="password" name="cpass" minlength="3" value="<?php echo $arr1['author_password']; ?>" placeholder="Confirm your password" required>


                <label>City</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="text" name="city" value="<?php echo $arr1['author_city']; ?>" placeholder="Enter your city" required>


                <label>State</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="text" name="state" value="<?php echo $arr1['author_state']; ?>" placeholder="Enter your stste" required>


                <label>Pincode</label>
                <input class="admin-profile-form-text" autocomplete="nope" type="number" name="pcode" min="100001" max="999999" value="<?php echo $arr1['author_pincode']; ?>" placeholder="Enter your Pincode" required>


                <label>Gender</label><br>

                <?php if ($arr1['author_gender'] == 'Male') { ?>
                  <input type="radio" name="gender" value="Male" id="dot-1" checked>
                <?php } else { ?>
                  <input type="radio" name="gender" value="Male" id="dot-1">
                <?php } ?>
                <label>Male</label><br>

                <?php if ($arr1['author_gender'] == 'Female') { ?>
                  <input type="radio" name="gender" value="Female" id="dot-2" checked>
                <?php } else { ?>
                  <input type="radio" name="gender" value="Female" id="dot-2">
                <?php } ?>
                <label>Female</label><br>

                <?php if ($arr1['author_gender'] == 'Other') { ?>
                  <input type="radio" name="gender" value="Other" id="dot-3" checked>
                <?php } else { ?>
                  <input type="radio" name="gender" value="Other" id="dot-3">
                <?php } ?>
                <label>Other</label><br><br>

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
} else {
  header('Location: ../login.html');
}
?>