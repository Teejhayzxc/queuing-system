<?php
include('connection.php'); 
date_default_timezone_set('Asia/Manila');


$que_num = 0;
if(isset($_POST['submitbtn'])){
    $que_num = $_POST['que_num'];
    $que_num ++;



}

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
<a href="operator_login.php">Log-in as Operator</a>
<?php
    $query = "SELECT * FROM purposes";
    $get_purpose = mysqli_query($conn,$query);
    if(mysqli_num_rows($get_purpose)>0) { ?>
    <form action="" method="POST">
      <input type="hidden" name="dept" value="<?php $row['dept_id'] ?>">
      <select name="purpose">
        <?php while($row = mysqli_fetch_array($get_purpose)){ ?> 
        <option value="<?php echo $row['id']?>"><?php echo $row['purpose_name']?></option> 
        <?php } ?>
      </select> 
      
  <br>
  <textarea name="remarks" id="" cols="30" rows="10" placeholder="Say something..."></textarea>
  <br>

  <input type="text" name="que_num" value="<?php echo $que_num ?>" size="1" >


  <input type="submit" name="submitbtn">
</form>
<?php } ?>
</body>
</html>

<?php
  if(isset($_POST['submitbtn'])) {
    $purpose = $_POST['purpose'] ;
    $dept_id = $_POST['dept'];
    $remarks = $_POST['remarks'];
    $dateCreated = date("m-d-y h:i:a ");


      
  
  
  


    

    $insert = "INSERT INTO queuenumber (purpose_id, dept_id, queuing_num, remarks, datetime_created) VALUE ('$purpose','$dept_id', '$que_num' ,'$remarks','$dateCreated')"; 


    
    if(mysqli_query($conn, $insert)) {
      echo "Success!";
    }else{
      echo "Failed to insert data";
    }
  }  

?>