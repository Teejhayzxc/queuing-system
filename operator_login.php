<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <title>Document</title>
</head>
<body>
<?php
include "config/connection.php";
session_start();

if (!isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['dept_id'])){
  header("location:index.php");
}
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dept = $_POST['dept_id'];
      $sql_users= "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND dept_id = $dept";
      $query_users = mysqli_query($conn, $sql_users);
      $result = mysqli_num_rows($query_users);
      if($result == 1){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['dept_id'] = $dept;
        header("location:operator_home.php");
        exit();
      }else{
        echo "Error";
      }
  }
?>
</body>
</html>



