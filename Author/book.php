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
    <style>

    </style>
</head>

<?php

include "../database/connect.php";

$id = $_SESSION['au_id'];

$que1 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$id");
$arr1 = mysqli_fetch_array($que1);

$que2 = mysqli_query($con, "SELECT * FROM ebook_data WHERE author_id='$id' ORDER BY book_status desc");

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
                <a href="./book.php" class="active">
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
                    <div class="title">Books List</div>
                    <div class="sales-details">
                        <table>
                            <tr>
                                <th style="text-align: center;">Id</th>
                                <th style="text-align: center;">Title</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Verified</th>
                                <th style="text-align: center;">Operation</th>
                                <th style="text-align: center;">Remove</th>
                            </tr>
                            <?php
                            $count = 0;
                                while ($arr2 = mysqli_fetch_array($que2)) {
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $arr2['book_id']; ?></td>
                                        <td><?php echo $arr2['book_title']; ?></td>
    
                                        <?php
                                        if ($arr2['book_status'] == 0) {
                                        ?>
                                            <td><a href="./edit_mode_change.php?status=1&id=<?php echo $arr2['book_id']; ?>"><button class="author-verified-button" style="width: 100px;">Editing</button></a></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><a href="./edit_mode_change.php?status=0&id=<?php echo $arr2['book_id']; ?>"><button class="author-unverified-button" style="width: 100px;">Under Review</button></a></td>
                                        <?php
                                        }
                                        ?>
    
                                        <?php
                                        if ($arr2['book_varified'] == 0) {
                                        ?>
                                            <td><button class="author-unverified-button" style="width: 50px;">No</button></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><button class="author-verified-button" style="width: 50px;">Yes</button></td>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($arr2['book_status'] == 0) {
                                        ?>    
                                        <td><a href="./edit_book.php?id=<?php echo $arr2['book_id']; ?>"><button class="author-verified-button" style="width: 80px;">Edit Book</button></a></td>
                                        <?php
                                        }
                                        else if($arr2['book_varified'] == 1){
                                          ?>
                                          <td><a href="../Admin/book_view.php?id=<?php echo $arr2['book_id']; ?>"><button class="author-verified-button" style="width: 80px;">Book View</button></a></td>
                                        <?php
                                        } else {
                                        ?>
                                        <td><button class="author-unverified-button"style="width: 80px;">Wait</button></td>
                                        <?php
                                        }
                                        ?>
                                        <td><a href="../Author/delete_book.php?id=<?php echo $arr2['book_id']; ?>"><button class="author-unverified-button"style="width: 70px;">Delete</button></a></td>
                                      </tr>
                                <?php
                                }
                                if(!$count){
                                ?>
                                <tr>
                                    <td colspan="5">No Book Found...</td>
                                </tr>
                                <?php
                                }
                            ?>
                        </table>
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
    header("Location: ../login.html");
}
?>