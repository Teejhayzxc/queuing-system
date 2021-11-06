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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                <th>Date Added</th>
                <th>Date Updated</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <?php while($row = mysqli_fetch_array($query)){ ?>
        <tbody>
            <tr>
                <td><?php echo $row['departments'] ?></td>  
                <td><?php echo $row['datetime_created'] ?></td>  
                <td><?php echo $row['datetime_updated'] ?></td>  
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
    $dateCreated = date("dd-mm-yyyy h:i:s");

    $insert = "INSERT INTO department (departments, datetime_created) VALUES ('$deptname', '$dateCreated')";
    if(mysqli_query($conn, $insert)){
        echo "<script> 
        swal({
            title: 'Department Added!',
            text: 'The item is successfully added.',
            icon: 'success',
            button: 'Nice',
        }).then(function(){
            window.location.href = 'departments.php'
        });
        </script>";
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
            echo "<script> 
            swal({
                title: 'Deleted Successfully',
                text: 'The item is successfully removed from this field',
                icon: 'success',
                button: 'Awesome!',
            }).then(function(){
                window.location.href = 'departments.php'
            });
            </script>";
        }else{
            echo "Error" . $delete . "<br>" . mysqli_error($conn);
        }
        
    }
?>