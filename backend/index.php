<?php
include ('connection.php');
date_default_timezone_set('Asia/singapore');
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
<?php 
    $sql = "SELECT * FROM purpose";
    $sql_purpose = mysqli_query($conn, $sql);
?>
<?php if(mysqli_num_rows($sql_purpose) > 0) {?>
<form action="" method="POST">
    Purpose :<select name="purpose_id">
            <?php while($row=mysqli_fetch_array($sql_purpose)) {?>  
                <option value="<?php echo $row['id']?>"><?php echo $row['purpose_name'] ?></option>
            <?php 
            }
            ?>
    </select>
    <?php 
    }
    ?>

<br>
    Remarks: <br>
    <input type="text" name="remarks">
    
    <br>
    
    <input type="submit" name="submit" value="submit">
  
</form>


</body>
</html>

<?php 

if (isset($_POST['submit'])) {

    $purpose_name = $_POST['purpose_id'];
    $remarks = $_POST['remarks'];
    $dateCreated = date("d-m-y h:i:a ");

    if(empty($_POST[$purpose_name])){
        echo "Please enter a Purpose";

    }
    
    
    if(empty($_POST[$remarks])){
        echo"Please enter a Remarks";
    }
    
    // get variables from the form
    
    

    //write sql query
    $sql = "INSERT INTO `purpose`(`purpose_name`, `datetime_created`, `Remarks`) VALUES ('$purpose_name', '$dateCreated','$remarks')";
    
    // execute the query
    $result = $conn->query($insert);

    if ($result == TRUE) {
        echo "New record created successfully.";
    }else{
        echo "Error:". $insert . "<br>". $conn->error;
    }

    header("Location:index.php");
    $conn->close();
}

?>
