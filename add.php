<?php

// Database Connection File

include("config.php");

if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $course = $_POST['course'];

    $sql = "INSERT INTO `students`(`id`, `name`, `email`, `number`, `course`) VALUES (NULL,'$name','$email','$number','$course')";

    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: home.php");
    } else{
        die("Failed To Insert Data In Database: ". mysqli_error($conn));
    }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="container">
    <div class="form-box">
        <form action="" method="POST">
            <h2>Add New Student</h2>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="number" placeholder="Number" required>
            <input type="text" name="course" placeholder="Course" required>
            <button type="submit" name="add">Add</button>
        </form>
    </div>
 </div>
</body>
</html>