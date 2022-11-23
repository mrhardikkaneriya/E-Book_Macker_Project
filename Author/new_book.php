<?php
session_start();
if(isset($_SESSION['au_id'])){
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

$que1 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$id");
$arr1 = mysqli_fetch_array($que1);

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
        <a href="./new_book.php" class="active">
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
      

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">New Book</div>
          <div class="sales-details">
            <form action="./new_book.php" method="post" autocomplete="nope">
                
                  <label>Book Title</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="text" name="book-title" minlength="2" value="" placeholder="Enter Book Title" required>
                
                  <label>Book Description</label>
                  <textarea class="admin-profile-form-text" autocomplete="nope" name="book-description" minlength="2" rows="4" cols="100%" value="" placeholder="Enter Book Description" required></textarea>
                  
                <input class="admin-profile-form-submit" type="submit" name="sb" value="Add New Book">
              
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

if(isset($_POST['sb'])){
    $booktitle = $_POST['book-title'];
    $bookdescription = $_POST['book-description'];
    $bookcover = "cover1";
    $authorId = $arr1['author_id'];

    $que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_title='$booktitle'");
    $que3 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_status=0 and author_id='$authorId'");

    if(mysqli_num_rows($que3) > 2){
      echo "<script LANGUAGE='JavaScript'>
        window.alert('More then 3 book Already Available in Editing Mode....');
        window.location.href='./new_book.php';
        </script>";
    }
    else if(mysqli_num_rows($que2)){
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Book Title Already Available....');
        window.location.href='./new_book.php';
        </script>";
    }
    else{
        mysqli_query($con,"INSERT INTO ebook_data(book_title,book_description,book_cover,author_id) VALUES('$booktitle','$bookdescription','$bookcover','$authorId')");
        echo "<script LANGUAGE='JavaScript'>
        window.alert('New Book Add Succesfully...');
        window.location.href='./book.php';
        </script>";
    }
}
}
else{
    echo "<script LANGUAGE='JavaScript'>wondow.location.href='../login.html';</script>";
}
?>