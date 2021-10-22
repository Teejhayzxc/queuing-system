<?php
include "connection.php";
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['password'])){
    header("location:index.php");
  }
    if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      if(empty($_POST['username']) && empty($_POST['password'])){
        $error = "please input username & password";
      }
      else if(empty($_POST['username'])){
        $error = "please input username";
  
      }
      else if(empty($_POST['password'])){
        $error = "please input password";
      }else{
        $sql_users= "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $query_users = mysqli_query($conn, $sql_users);
        if(mysqli_num_rows($query_users) > 0){
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          header("location:operator_home.php");
          exit();
        }else{
          echo "Credentials not found";
        }
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Username</label>
        <input type="text" name="username">
        <label for="">Password</label>
        <input type="password" name="password">
        <input type="submit" name="login">
    </form>
</body>
</html>


