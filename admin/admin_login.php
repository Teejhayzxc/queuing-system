<?php
session_start();
include "../config/connection.php";

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
          echo "User does not exist";
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
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Document</title>
</head>
<body>
  <div class="container" style="display: grid; place-items:center;">
    <div class="card border shadow-lg bg-white rounded" style="margin-top:10em;">
      <div class="card-header bg-dark">
        <h1 class="text-white text-center">Admin</h1>
      </div>
      <div class="card-body p-5">
        <form action="" method="POST">
        <div class="form-group row">
          <label for="colFormLabel" class="col-lg-2 col-form-label col-form-label">Username</label>
          <div class="col-lg-10">
            <input type="text" class="form-control form-control mb-3" name="username" id="colFormLabelLg">
          </div>
          <label for="colFormLabel" class="col-lg-2 col-form-label col-form-label">Password</label>
          <div class="col-lg-10">
            <input type="password" class="form-control form-control mb-5" name="password" id="colFormLabelLg">
          </div>
        </div>
        <input type="submit" class="btn btn-dark w-100" name="login">
        </form>
      </div>
    </div>
  </div>
</body>
</html>


