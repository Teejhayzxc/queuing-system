<?php 
session_start();
include "../connection.php";
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    header("Location:admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Document</title>
</head>
<body>
<a href="admin.php">Back</a>
<div class="container">
    <?php 
    $sql = "SELECT * FROM department";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){ ?>
    <table class="table table-hover text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th>Department</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <?php while($row = mysqli_fetch_array($query)){ ?>
        <tbody>
            <tr>
                <td><?php echo $row['departments'] ?></td>  
                <td><a class="btn btn-success" href="dept_edit.php?edit=<?php echo $row['id']?>">Edit</a>
                <a class="btn btn-danger" href="departments.php?delete=<?php echo $row['id']?>">Delete</a></td>  
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
</div>
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

<?php
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $delete = "DELETE FROM department WHERE id = $id";
        if(mysqli_query($conn, $delete)){
            echo 'deleted';
            header('location:departments.php');
            exit();
        }else{
            echo "Error" . $delete . "<br>" . mysqli_error($conn);
        }
        
    }
?>