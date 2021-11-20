<?php
include "connection.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script>window.history.forward();</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body style="background:var(--bs-light);">
<div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-success p-4">
    <a class="text-white" style="text-decoration: none; font-family:var(--poppins); font-weight:600;"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Log-in as Operator</a>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h5 class="modal-title text-white " id="staticBackdropLabel"> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"> 
          <div class="container p-lg-5">
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
            <label for="colFormLabel">Department</label>
              <?php 
                $sql = "SELECT * FROM department";
                $query = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query)>0) { ?>
                <select class="form-select mb-5" name="dept_id">
                    <option value="">Select departments</option>
                <?php 
                while($row = mysqli_fetch_array($query)){
                $dept_id = $row['id'];
                $dept_name = $row['departments'];
                echo "<option value = '$dept_id'>$dept_name</option>";
                } ?>
                </select>
                <?php }?> 
              </div> 
              </div>
              <span class="text-center">
              <input type="submit" class="btn btn-outline-success" name="login">
              </span>
          </form>
          </div> 
          </div>
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
<div class="container-xxl py-sm-3 bg-white">
  <span style="display: grid; place-items:center; padding:2em;">
    <img src="./images/um.png" alt="UMLOGO">
  </span>
<?php
    $query = "SELECT * FROM purposes";
    $get_purpose = mysqli_query($conn,$query);
    if(mysqli_num_rows($get_purpose)>0) { ?>
    <form action="" method="POST" style="display: grid; place-items:center;">
      <div class="row mt-lg-2">
        <div class="col-lg-12 mb-lg-5" style="margin-bottom: 2.5em;">
          <select class="form-select mt-3" name="purpose">
            <option value="">Your purpose of attending</option>
            <?php while($row = mysqli_fetch_array($get_purpose)){ ?> 
            <option value="<?php echo $row['id']?>"><?php echo $row['purpose_name']?></option> 
          <?php } ?>
          </select> 
        </div>
        <div class="col-lg-12">
          <textarea name="remarks" class="form-control" cols="38" rows="10" style="resize:none; outline:none;" placeholder="Say something..."></textarea>
        </div>
      </div>
      <input type="hidden" value="Queuing" name="status">
  <br>
  <input type="submit" class="btn btn-success" style="margin-bottom:2.4em;" name="submitbtn">
</form>
<?php } ?>
</div>
<div class="container-fluid bg-success">
  <div class="container text-white">
    <div class="row p-lg-5" style="padding-top: 5em;">
      <div class="col-lg-6">
        <div class="container-fluid">
        <p class="p-0 m-0" style="font-size:1.7em; font-family:var(--lobs); font-weight:500; letter-spacing:2px;">The University of Manila</p>
        <p class="p-0 m-0" style="font-size:14px; font-family:var(--poppins); font-weight:500;">546 Mariano V. delos Santos Street, Sampaloc</p>
        <p style="font-size:14px; font-family:var(--poppins); font-weight:500;">Manila, Philippines 1008.</p>
        </div>
      </div>
      <div class="col-lg-6" style="padding-bottom: 4.7em;">
        <div class="container-fluid text-center-lg">
        <h4>Contact Us</h4>
        <p class="p-0 m-0" style="font-size:14px; font-family:var(--poppins); font-weight:500;">Telephone No. : 8735-5085</p>
        <p class="p-0 m-0" style="font-size:14px; font-family:var(--poppins); font-weight:500;">E-mail : umnla.edu.ph@gmail.com</p>
        </div>
      </div>
      <hr class="featurette-divider">
      <div class="col-lg-12 text-center" style="padding:2em;">
          <p class="p-0 m-0" style="font-size:14px; font-family:var(--poppins); font-weight:500;">Copyright © 2021 </p>
          <p class="p-0 m-0" style="font-size:14px; font-family:var(--poppins); font-weight:500;">The University of Manila</p>
          <p class="p-0 m-0" style="font-size:14px; font-family:var(--poppins); font-weight:500;">All Rights Reserved</p>
      </div>
    </div>
    
  </div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>

<?php
  if(isset($_POST['submitbtn'])) {
    $purpose = $_POST['purpose'] ;
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];

    $insert = "INSERT INTO queuenumber (purpose_id, queue_status, remarks) VALUE ('$purpose','$status', '$remarks')"; 
    
    if(empty($purpose)){
      echo "<script>swal({
        title: 'Oops invalid request!',
        text: 'Kindly choose a purpose of attending',
        icon: 'warning',
        }).then(function() {
        window.location.href='index.php';
        });</script>";
    }else{
      if(mysqli_query($conn, $insert)) {
        echo "<script> 
        swal({
            title: 'Request Success!',
            text: 'Redirecting to ticket....',
            icon: 'success',
            button: false,
            timer: 3000,
        }).then(function(){
            window.location.href = 'ticket.php'
        });
        </script>";
      }else{
        echo "<script>swal({
          title: 'Oops invalid request!',
          text: 'An error has occured/',
          icon: 'warning',
          }).then(function() {
          window.location.href='index.php';
          });</script>";
      }
    }
  }
?>