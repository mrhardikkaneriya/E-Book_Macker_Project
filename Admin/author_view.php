<?php
session_start();
if (isset($_SESSION['ad_id'])) {

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

  $aid = $_GET['id'];

  $que1 = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_id=$id");
  $arr1 = mysqli_fetch_array($que1);

  $que2 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$aid");
  $arr2 = mysqli_fetch_array($que2);

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
            <div class="title">Author Data</div>
            <div class="sales-details">
              <table>
                <tr>
                  <th>Field</th>
                  <th>Value</th>
                </tr>

                <tr>
                  <td>ID</td>
                  <td><?php echo $arr2['author_id']; ?></td>
                </tr>
                <tr>
                  <td>First Name</td>
                  <td><?php echo $arr2['author_first_name']; ?></td>
                </tr>
                <tr>
                  <td>Last Name</td>
                  <td><?php echo $arr2['author_last_name']; ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><?php echo $arr2['author_email']; ?></td>
                </tr>
                <tr>
                  <td>Phone Number</td>
                  <td><?php echo $arr2['author_phone_no']; ?></td>
                </tr>
                <tr>
                  <td>Gender</td>
                  <td><?php echo $arr2['author_gender']; ?></td>
                </tr>
                <tr>
                  <td>City</td>
                  <td><?php echo $arr2['author_city']; ?></td>
                </tr>
                <tr>
                  <td>State</td>
                  <td><?php echo $arr2['author_state']; ?></td>
                </tr>
                <tr>
                  <td>PinCode</td>
                  <td><?php echo $arr2['author_pincode']; ?></td>
                </tr>

              </table>
            </div>

          </div>

        </div>
      </div>
    </section>


    </div>



    <script src="./script.js"></script>

  </body>

  </html>

<?php
} else {
  header('Location: ../login.html');
}
?>