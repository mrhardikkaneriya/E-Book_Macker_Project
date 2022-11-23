<?php
session_start();
if(isset($_SESSION['au_id'])){
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">


</head>

<?php

include "../database/connect.php";

$id = $_SESSION['au_id'];

$que1 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$id");
$arr1 = mysqli_fetch_array($que1);

$que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE author_id=$id");
$que3 = mysqli_query($con, "SELECT * FROM ebook_data WHERE author_id=$id and book_status=0");
$que4 = mysqli_query($con, "SELECT * FROM ebook_data WHERE author_id=$id and book_varified=1");

?>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-user bx-flashing'></i>
      <span class="logo_name">Author Pannel</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="./index.php" class="active">
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
        <a href="./profile.php"><span class="admin_name"><?php echo $arr1['author_first_name'], " ", $arr1['author_last_name'];  ?></span></a>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Book</div>
            <div class="number"><?php echo mysqli_num_rows($que2); ?></div>
            
          </div>
          <i class='bx bx-book-heart cart two'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Running Book</div>
            <div class="number"><?php echo mysqli_num_rows($que3); ?></div>
            
          </div>
          <i class='bx bx-book-heart cart four'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Verified Book</div>
            <div class="number"><?php echo mysqli_num_rows($que4); ?></div>
            
          </div>
          <i class='bx bx-book-heart cart two'></i>
        </div>
        
      </div>

      
  </section>


  <script src="./script.js"></script>
</body>

</html>
<?php
}else{
  header("Location: ../login.html");
}
?>