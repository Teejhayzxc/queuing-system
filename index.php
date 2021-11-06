<?php
include('connection.php'); 

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
<a href="operator_login.php">Log-in as Operator</a>
<?php
    $query = "SELECT * FROM purposes";
    $get_purpose = mysqli_query($conn,$query);
    if(mysqli_num_rows($get_purpose)>0) { ?>
    <form action="" method="POST">
      <select name="purpose">
        <option value="">Your purpose of attending</option>
        <?php while($row = mysqli_fetch_array($get_purpose)){ ?> 
        <option value="<?php echo $row['id']?>"><?php echo $row['purpose_name']?></option> 
        <?php } ?>
      </select> 
  <br>
  <textarea name="remarks" id="" cols="30" rows="10" placeholder="Say something..."></textarea>
  <input type="hidden" value="Queuing" name="status">
  <br>
  <input type="submit" name="submitbtn">
</form>
<?php } ?>
</body>
</html>

<?php
  if(isset($_POST['submitbtn'])) {
    $purpose = $_POST['purpose'] ;
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];

    $insert = "INSERT INTO queuenumber (purpose_id, queue_status, remarks) VALUE ('$purpose','$status', '$remarks')"; 
    
    if(mysqli_query($conn, $insert)) {
      echo "Success!";
    }else{
      echo "Failed to insert data";
    }
  }
?>