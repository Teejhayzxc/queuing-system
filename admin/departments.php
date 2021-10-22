<?php 
session_start();
include "../connection.php";
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
    <a href="admin.php">Back</a>
    <?php 
    $sql = "SELECT * FROM department";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){ ?>
    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Department ID</th>
            </tr>
        </thead>
        <?php while($row = mysqli_fetch_array($query)){ ?>
        <tbody>
            <tr>
                <td><?php echo $row['departments'] ?></td>  
                <td><?php echo $row['id'] ?></td>   
            </tr>
            <?php }?>
        </tbody>
    <?php } ?>
</table>
<br>
<br>
<br>
<br>
<form action="#" method="POST">
    <label for="">Enter a department name : </label> <br>
    <input type="text" name="deptname">
    <input type="submit" name="adddept" value="Add">
</form>
</body>
</html>

<?php
if(isset($_POST['adddept'])){
    $deptname = $_POST['deptname'];
    
    $insert = "INSERT INTO department (departments) VALUES ('$deptname')";
    if(mysqli_query($conn, $insert)){
        header('location:departments.php');
    }else{
        echo "Failed to add";
    }
}

?>