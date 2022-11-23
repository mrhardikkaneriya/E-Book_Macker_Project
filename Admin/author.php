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

$que1 = mysqli_query($con, "SELECT * FROM admin_data WHERE admin_id=$id");
$arr1 = mysqli_fetch_array($que1);

$que2 = mysqli_query($con, "SELECT * FROM author_data WHERE author_email_status=1 order by author_verified");

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
        <a href="./author.php" class="active">
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
          <div class="title">Author List</div>
          <div class="sales-details">
            <table>
              <tr>
                <th style="text-align: center;">Id</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">View</th>
                <th style="text-align: center;">Total Books</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Remove</th>
              </tr>
              <?php
              while ($arr2 = mysqli_fetch_array($que2)) {
              ?>
                <tr>
                  <td><?php echo $arr2['author_id']; ?></td>
                  <td><?php echo $arr2['author_first_name'], " ", $arr2['author_last_name']; ?></td>
                  <td><a href="./author_view.php?id=<?php echo $arr2['author_id']; ?>"><button>View</button></a></td>
                  <?php
                  if ($arr2['author_verified'] == 0) {
                  ?>
                    <td>0</td>
                    <td><a href="./author_verified.php?status=1&id=<?php echo $arr2['author_id']; ?>"><button class="author-unverified-button">UnVerified</button></a></td>
                  <?php
                  } else {
                    $tmpid = $arr2['author_id'];
                    $tmpq = mysqli_query($con, "SELECT * FROM ebook_data WHERE author_id=$tmpid");
                    $tmparr = mysqli_num_rows($tmpq);
                  ?>

                    <td><?php echo $tmparr; ?></td>
                    <td><a href="./author_verified.php?status=0&id=<?php echo $arr2['author_id']; ?>"><button class="author-verified-button">Verified</button></a></td>
                  <?php
                  }
                  ?>
                  <td><a href="../Admin/delete_author.php?id=<?php echo $arr2['author_id']; ?>"><button class="author-unverified-button">Delete</button></a></td>
                </tr>
              <?php
              }
              ?>
            </table>
          </div>
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
  header("Location: ../login.html");
}
?>