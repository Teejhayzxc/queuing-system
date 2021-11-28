<?php
include "config/connection.php"; 
if(!empty($_SESSION['username']) && empty($_SESSION['password'])){
  header("Location: operator_home.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script>window.history.forward();</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body style="background:var(--bs-light);">
  <div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-success p-4">
  <a class="text-white" style="text-decoration: none; font-family:var(--poppins); font-weight:600; cursor:pointer;"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Log-in as Operator</a>
  <!-- modal login start -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
  <div class="modal-header bg-success">
  <h5 class="modal-title text-white " id="staticBackdropLabel"> </h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <!-- Modal login content -->
  <div class="modal-body">
  <div class="container p-lg-4">
  <form action="operator_login.php" method="POST">
  <div class="form-group row">
  <div class="col-lg-12">
  <label for="colFormLabel">Username</label>
  <input type="text" id="validationCustom05" class="form-control form-control mb-3" name="username" id="colFormLabelLg">
  </div>
  <div class="col-lg-12">
  <label for="colFormLabel">Password</label>
  <input type="password" class="form-control form-control mb-2" name="password" id="colFormLabelLg">
  </div>
  <div class="col-lg-12">
    <?php 
      $sql = "SELECT * FROM department";
      $query = mysqli_query($conn, $sql);
      if(mysqli_num_rows($query)>0) { ?>  
      <label for="colFormLabel">Department</label>
      <select class="form-select" name="dept_id">
          <option value="">Select departments</option>
      <?php 
      while($row = mysqli_fetch_array($query)){
      $dept_id = $row['id'];
      $dept_name = $row['departments'];
      echo "<option value = '$dept_id'>$dept_name</option>";
      } ?>
      </select>
      <span class="d-flex justify-content-center mt-5">
      <div class="row text-center">
      <div class="col-12">
      <input type="submit" class="btn btn-outline-success w-75" name="login">
      </div>
      <div class="col-12">
      <a class="text-dark" href="./admin/admin_login.php">Sign-in as Admin</a>
      </div>
      </div>
      </span>
      <?php }else{ ?>
        <p class="alert alert-danger text-center">Error : No Data Found for Department/s</p>
        <span class="d-flex justify-content-center mt-5">
        <div class="row text-center">
        <div class="col-12">
        <input type="submit" class="btn btn-outline-success w-75 disabled" name="login">
        </div>
        <div class="col-12">
        <a class="text-dark" href="./admin/admin_login.php">Sign-in as Admin</a>
        </div>
        </div>
        </span>
      <?php }
        ?>
  </div> 
  </div>
  </form>
  </div> 
  </div>
  <!-- modal login end -->
  </div>
  </div>
  </div>
  </div>
  </div>
  
  
  <nav class="navbar navbar-dark bg-success">
  <div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <h4 class="text-white" style="font-family:var(--lobs); font-weight:500; letter-spacing:2px;">UM Queue</h2>
  </div>
  </nav>
  