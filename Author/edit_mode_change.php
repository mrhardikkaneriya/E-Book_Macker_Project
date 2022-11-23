<?php
session_start();
if(isset($_SESSION['au_id'])){

include '../database/connect.php';

$id = $_GET['id'];
$status = $_GET['status'];
$aid = $_SESSION['au_id'];

$que1 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_status=0 and author_id='$aid'");

if($status==1){
        mysqli_query($con,"UPDATE ebook_data SET book_status=$status, book_varified=0 WHERE book_id=$id");


echo "<script LANGUAGE='JavaScript'>
        window.alert('Status Change Succesfully...');
        window.location.href='./book.php';
        </script>";
}
else{
if(mysqli_num_rows($que1) > 2){
        echo "<script LANGUAGE='JavaScript'>
          window.alert('More then 3 book Already Available in Editing Mode....');
          window.location.href='./book.php';
          </script>";
      }
      else{
mysqli_query($con,"UPDATE ebook_data SET book_status=$status, book_varified=0 WHERE book_id=$id");


echo "<script LANGUAGE='JavaScript'>
        window.alert('Status Change Succesfully...');
        window.location.href='./book.php';
        </script>";
      }
}
}else{
    echo "<script LANGUAGE='JavaScript'>window.location.href='../login.html';</script>";  
}
?>