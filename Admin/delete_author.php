<?php
session_start();
if(isset($_SESSION['ad_id'])){

include "../database/connect.php";

$aid = $_GET['id'];

mysqli_query($con, "DELETE FROM author_data WHERE author_id=$aid");

echo "<script LANGUAGE='JavaScript'>
        window.alert('Author Delete Succesfully...');
        window.location.replace('./author.php');
        </script>";
}else{
    echo "<script LANGUAGE='JavaScript'>window.location.href='../login.html';</script>";  
}
?>