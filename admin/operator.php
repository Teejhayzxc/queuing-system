<?php 
session_start();
include "../connection.php";
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    header("Location:operator_login.php");
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
    $query_users = "SELECT user.id, user.first_name, user.last_name, user.dept_id,
    department.departments 
    FROM user 
    LEFT JOIN department ON user.dept_id = department.id";   
    $get_users = mysqli_query($conn, $query_users);
    if(mysqli_num_rows($get_users) > 0 ){?>
    <table class="table table-hover text-center">
        <thead class="bg-dark text-white ">
        <tr>
            <th>Department</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Actions</th>
            <th></th>
        </tr>
    </thead>
        <?php
        while($row = mysqli_fetch_array($get_users)){ 
        ?>
        <tbody>
        <tr> 
            <td><?php echo $row['departments']?></td>
            <td><?php echo $row['first_name']?></td>
            <td><?php echo $row['last_name']?></td>
            <td>
                <a class="btn btn-success" href="operator_edit.php?edit=<?php echo $row['id'] ?>">Edit</a>
                <a class="btn btn-danger" href="operator.php?delete=<?php echo $row['id'] ?>">Delete</a>
            </td>
            <td></td>
        </tr>
    </tbody>
    <?php } ?>
</table>
<?php } ?>
<br>
<br>
<br>
<br>
<form action="" method="POST">
    <div class="row">
        <div class="col-lg-6">
            <label for="">First name</label><br>
            <input class="form-control" type="text" name="first_name"><br><br>
        </div>
        <div class="col-lg-6">
            <label for="">Last name</label><br>
            <input class="form-control" type="text" name="last_name"><br><br>
        </div>
    </div>
    <label for="">Username</label><br>
    <input type="text" name="username"><br><br>
    <label for="">Password</label><br>
    <input type="password" name="password"><br><br>
        <?php 
        $sql = "SELECT * FROM department";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0) { ?>
        <select name="dept">
            <option value="">Select departments</option>
        <?php 
        while($row = mysqli_fetch_array($query)){
            $dept_id = $row['id'];
            $dept_name = $row['departments'];
            echo "<option value = '$dept_id'>$dept_name</option>"
            ?> 
        <?php } ?>
        </select>
        <?php }?> 
    <input type="submit" name="addOperators" value="submit">
</form>
</div>
</body>
</html>

<!-- process para sa pag-add ng users -->
<?php 
if(isset($_POST['addOperators'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dept = $_POST['dept'];

    $insert = "INSERT INTO user (first_name, last_name, username, password, dept_id) 
    VALUE ('$fname', '$lname', '$username', '$password', '$dept')";
    
    if(mysqli_query($conn, $insert)){
        echo "Success";
        header('location:operator.php');
    }else{
        echo "hende success";
    }
}
?>

<!-- delete  -->
<?php 
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $delete = "DELETE FROM user WHERE id = $id";
        if (mysqli_query($conn, $delete)){
            echo 'deleted';
            header('location:operator.php');
        }else{
            echo "Error" . $delete . "<br>" . mysqli_error($conn);
        }
    }
?>