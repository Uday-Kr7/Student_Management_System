<?php

// Database Connection File

include("config.php");

$id = $_GET['id'];

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $course = $_POST['course'];

    $sql = "UPDATE `students` SET `name`='$name',`email`='$email',`number`='$number',`course`='$course' WHERE id = $id ";

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
    <?php
    
    $sql = "SELECT * FROM `students` WHERE id = $id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    
    <div class="form-box">
        <form action="" method="POST">
            <h2>Update Detailes</h2>
            <input type="text" name="name" value="<?php echo $row['name']?>">
            <input type="email" name="email" value="<?php echo $row['email']?>">
            <input type="text" name="number" value="<?php echo $row['number']?>">
            <input type="text" name="course" value="<?php echo $row['course']?>">
            <button type="submit" name="update">Update</button>
        </form>
    </div>
  </div>
</body>
</html>