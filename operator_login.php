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
      $sql_users= "SELECT * FROM user WHERE last_name = '$username' AND password = '$password' AND dept_id = $dept";
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



