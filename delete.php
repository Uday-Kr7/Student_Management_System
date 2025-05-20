<?php

// Database Connection File

include("config.php");
$id = $_GET['id'];
$sql = "DELETE FROM `students` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if($result){
    header("Location: home.php");
} else{
    die("Failed To Insert Data In Database: ". mysqli_error($conn));
}


?>