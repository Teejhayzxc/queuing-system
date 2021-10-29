<?php
include "../connection.php";
session_start();
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
	header("Location:admin_login.php");
	exit();
}
if (isset($_SESSION['username']) && isset($_SESSION['password'])){
	session_unset();
	session_destroy();
	header("location:admin_login.php");
	exit();
}
?>