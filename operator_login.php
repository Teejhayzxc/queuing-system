<?php
include "connection.php";
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['dept_id'])){
  header("location:index.php");
}
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dept = $_POST['dept_id'];
    
    if(empty($_POST['username']) && empty($_POST['password'])){
      echo "please input username & password";
    }
    else if(empty($_POST['username'])){
      echo "please input username";

    }
    else if(empty($_POST['password'])){
      echo "please input password";
    }
    else if(empty($_POST['dept_id'])){
      echo "Tell your department";
    } else{
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
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Username</label>
        <input type="text" name="username">
        <label for="">Password</label>
        <input type="password" name="password">
        <?php 
        $sql = "SELECT * FROM department";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0) { ?>
        <select name="dept_id">
            <option value="">Select departments</option>
        <?php 
        while($row = mysqli_fetch_array($query)){
            $dept_id = $row['id'];
            $dept_name = $row['departments'];
            echo "<option value = '$dept_id'>$dept_name</option>"
            ?> 
        <?php } ?>
        </select>
        <?php }?> 
        <input type="submit" name="login">
    </form>
</body>
</html>


