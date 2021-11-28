<?php include "includes/header.php"; ?>

<div class="container-xxl py-sm-3 bg-white">
    <span style="display: grid; place-items:center; padding:2em;">
    <img src="./assets/images/um.png" alt="UMLOGO">
    </span> 
    <form action="" method="POST" style="display: grid; place-items:center;">  
    <?php $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.date_created, queuenumber.remarks, queuenumber.queue_status,
    purposes.purpose_name, purposes.dept_id,
    department.departments
    FROM queuenumber 
    LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
    LEFT JOIN department ON department.id = purposes.dept_id
    ORDER BY id DESC
    LIMIT 1";
    $get_num = mysqli_query($conn, $get_queue);
    if(mysqli_num_rows($get_num)>0) {
      while($row = mysqli_fetch_array($get_num)){
        $id = $row['id'] + 1;
        $padded_id = str_pad($id, 4, '0', STR_PAD_LEFT); ?>
      <input type="hidden" name="ticket_num" value="<?php echo $padded_id?>">
    <?php }}else{
      $id = 1; 
      $padded_id = str_pad($id, 4, '0', STR_PAD_LEFT);
    }?>

    <?php
    $query = "SELECT purposes.id, purposes.purpose_name, purposes.dept_id,
    department.departments
    FROM purposes
    LEFT JOIN department ON department.id = purposes.dept_id";
    $get_purpose = mysqli_query($conn,$query);
    if(mysqli_num_rows($get_purpose)>0) { ?>
    <div class="row mt-lg-2">
    <div class="col-lg-12 mb-lg-5" style="margin-bottom: 2.5em;">
    <select class="form-select mt-3" name="purpose">
    <option value="">Your purpose of attending</option>
    <?php while($row = mysqli_fetch_array($get_purpose)){ 
      $purpose_id = $row['id']; ?>
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
    <?php }else{ ?>
      <div class="container" style="height: 11.3em;">
      <p class="display-6 text-center alert alert-danger">QUEUE UNAVAILABLE PLEASE TRY AGAIN LATER</p>
      </div>
    <?php } ?>
    </form>
    </div>
    <a href=""></a>
<?php include "includes/footer.php"; ?>
<?php
  if(isset($_POST['submitbtn'])) {
    $purpose = $_POST['purpose'] ;
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];
    $ticket = $_POST['ticket_num'];
    $dateCreated = date('Ymd');
    $ticket_number = "UM". '-' . "$dateCreated" . '-' . "$padded_id";
    $insert = "INSERT INTO queuenumber (purpose_id, ticket, queue_status, date_created, remarks) VALUE ('$purpose', '$ticket_number','$status', '$dateCreated', '$remarks')"; 
    
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
            title: 'Your ticket number is $ticket_number',
            text: 'Redirecting to Queue window in 30secs...',
            icon: 'success',
            button: false,
            timer: 30000,
        }).then(function(){
            window.location.href = 'window.php'
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