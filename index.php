<?php
include('connection.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<a href="operator_login.php">ADMIN</a>
    <form action="" method="POST">
    <?php
      $query = "SELECT * FROM purposes";
      $get_purpose = mysqli_query($conn,$query);
      if(mysqli_num_rows($get_purpose)>0) { ?> 
    
      <select name="purpose">
    <?php while($row = mysqli_fetch_array($get_purpose)){ ?>  
        <option value="<?php echo $row['id']?>"><?php echo $row['purpose_name']?></option> 
        <input type="hidden" name="dept" value="<?php echo $row['dept_id']?>">
    <?php }  ?>
      </select> 
  <?php } ?>
  <br>
  <textarea name="remarks" id="" cols="30" rows="10" placeholder="Say something..."></textarea>
  <br>
  <input type="submit" name="submitbtn">
</form>
</body>
</html>

<?php
  if(isset($_POST['submitbtn'])) {
    $purpose = $_POST['purpose'];
    $dept_id = $_POST['dept'];
    $remarks = $_POST['remarks'];
    

    $insert = "INSERT INTO queuenumber (purpose_id, dept_id, remarks) VALUE ('$purpose','$dept_id' ,'$remarks')"; 
    
    if(mysqli_query($conn, $insert)) {
      echo "Success!";
    }else{
      echo "di gumana shyet";
    }
  }
?>