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

  <!-- richtextbox -->
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>  

</head>

<?php

include "../database/connect.php";

$id = $_SESSION['au_id'];

$que1 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$id");
$arr1 = mysqli_fetch_array($que1);

$bid = $_GET['id'];
$que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_id=$bid");
$arr2 = mysqli_fetch_array($que2);

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
          <div class="title">Edit Book</div>
          <div class="sales-details">
            <form action="./edit_book.php?id=<?php echo $bid; ?>" method="post" autocomplete="nope">

                  <label>Book Title</label>
                  <input class="admin-profile-form-text" autocomplete="nope" type="text" value="<?php echo $arr2['book_title']; ?>" name="book-title" minlength="2" value="" placeholder="Enter Book Title" required>
                  <label>Book Description</label>
                  <textarea class="admin-profile-form-text" autocomplete="nope" name="book-description" minlength="2" rows="4" cols="100%" value="" placeholder="Enter Book Description" required><?php echo $arr2['book_description']; ?></textarea>
                  <label>Book Cover</label>
                  <select name="book-cover">
                    <?php 
                    if($arr2['book_cover'] == "cover1"){
                    ?>
                    <option value="cover1">Cover 1</option>
                    <option value="cover2">Cover 2</option>
                    <option value="cover3">Cover 3</option>
                    <?php } ?>

                    <?php 
                    if($arr2['book_cover'] == "cover2"){
                    ?>
                    <option value="cover1">Cover 1</option>
                    <option value="cover2" selected>Cover 2</option>
                    <option value="cover3">Cover 3</option>
                    <?php } ?>

                    <?php 
                    if($arr2['book_cover'] == "cover3"){
                    ?>
                    <option value="cover1">Cover 1</option>
                    <option value="cover2">Cover 2</option>
                    <option value="cover3" selected>Cover 3</option>
                    <?php } ?>
                  </select>
                  <label>Book Data</label>
                  <textarea name="book-data" autocomplete="nope" minlength="12" rows="12" cols="100%" placeholder="Enter Book Data" required><?php echo $arr2['book_data']; ?></textarea>
                <input class="admin-profile-form-submit" type="submit" name="sb" value="Edit Book">
              
            </form>
          </div>

        </div>

        
      </div>
    </div>
  </section>

  <script src="./script.js">
  </script>
  <script>
      CKEDITOR.replace('book-data');
      var editor_data = CKEDITOR.instances['book-data'].getData();
  </script>
</body>

</html>

<?php

if(isset($_POST['sb'])){
    $booktitle = $_POST['book-title'];
    $bookdescription = $_POST['book-description'];
    $authorId = $arr1['author_id'];
    $bookdata = $_POST['book-data'];
    $bookcover = $_POST['book-cover'];

    $que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_title='$booktitle'");
    if(mysqli_num_rows($que2)!=1){
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Book Title Not Valid');
        </script>";
    }
    else{
        mysqli_query($con,"UPDATE ebook_data SET book_title='$booktitle',book_description='$bookdescription',book_cover='$bookcover',book_data='$bookdata',author_id='$authorId' WHERE book_title='$booktitle'");
        echo "<script LANGUAGE='JavaScript'>
        window.alert('Edit Book Data Succesfully...');
        window.location.replace('./book.php');
        </script>";

        
    }

    
}
}
else{
    header("Location: ../login.html");
}
?>