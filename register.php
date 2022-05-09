<?php

include 'config.php';

  if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    // select user if its exist
    $select = mysqli_query($conn, "SELECT * FROM `user_info` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 
    if(mysqli_num_rows($select) > 0){
       $message[] = 'user already exist!';
    }else{
      // insert new user
       mysqli_query($conn, "INSERT INTO `user_info`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query 2 failed');
       $message[] = 'registered successfully!';
       //move to login 
       header('location:login.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>register</title>
</head>
<body>
  <!-- start register form  -->
  <?php
   if(isset($message)){
     foreach($message as $message){
       echo '<div class ="message" onclick = "this.remove();">'.$message.'</div>';
     }
   }
  ?>
 

  <div class ="form-container">
<form action ="" method="post">
  <h3>register now</h3>
  <input type="text" name="name" required placeholder="enter username" class ="box">
  <input type="email" name="email" required placeholder="enter email" class ="box">
  <input type="password" name="password" required placeholder="enter password" class ="box">
  <input type="password" name="cpassword" required placeholder="confirm password" class ="box">
  <input type="submit" name="submit" class="btn" value="register now">
  <p>already have an account? <a href="login.php">login now</a> </p>
</form>
  </div>

  <!-- end register form  -->
  
</body>
</html>