<?php
session_start();
if(isset($_SESSION['au_id'])){

include "../database/connect.php";

$bid = $_GET['id'];

mysqli_query($con, "DELETE FROM ebook_data WHERE book_id=$bid");

echo "<script LANGUAGE='JavaScript'>
        window.alert('Book Delete Succesfully...');
        window.location.replace('./book.php');
        </script>";
}else{
    echo "<script LANGUAGE='JavaScript'>window.location.href='../login.html';</script>";  
}
?>