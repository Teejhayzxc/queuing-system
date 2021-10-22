<?php
session_start();
include "../connection.php";

if (isset($_SESSION['username']) && isset($_SESSION['password'])){
    header("location:admin.php");
  }
    if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(empty($_POST['username']) && empty($_POST['password'])){
        $error = "please input username & password";
      }else if(empty($_POST['username'])){
        $error = "please input username";
      }else if(empty($_POST['password'])){
        $error = "please input password";
      }else{
        $sql_admin = "SELECT * FROM administrator WHERE username = '$username' and password = '$password'";
        $query_admin = mysqli_query($conn, $sql_admin);
        if(mysqli_num_rows($query_admin) == 1){
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          header("location:admin.php");
          exit();
        }else{
          $error = "Credentials not found";
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


