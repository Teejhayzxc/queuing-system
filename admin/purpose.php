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
    $sql = "SELECT purposes.id, purposes.purpose_name, purposes.dept_id,
    department.departments
    FROM purposes
    LEFT JOIN department ON purposes.dept_id = department.id";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0) {
    ?>
    <table class="table table-hover">
        <thead class="bg-dark text-white border border-dark">
            <tr>
                <th colspan="2">Purpose</th>
                <th>Department</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($query)){ ?>
            <tbody> 
                <tr>
                    <td colspan="2"><?php echo $row['purpose_name']?></td>
                    <td><?php echo $row['departments']?></td>
                    <td class="text-center"><a class="btn btn-success" href="purpose_edit.php?edit=<?php echo $row['id']?>">Edit</a>
                    <a class="btn btn-danger" href="purpose.php?delete=<?php echo $row['id']?>">Delete</a></td>
                </tr>
                <?php }?>
            </tbody>
        <?php } ?> 
    </table>
<br>
<br>
<br>
<form action="" method="POST"> 
    <label for="">Enter a Purpose name : </label> <br>
    <input type="text" name="purpose">
    <?php 
    $sql_department = "SELECT * FROM department";
    $query_department = mysqli_query($conn, $sql_department);
    if(mysqli_num_rows($query_department)>0) { ?>
    <select name="dept">
    <option value="">Select Department</option>
    <?php while($row1 = mysqli_fetch_array($query_department)){ ?> 
    <option value="<?php echo $row1['id']?>"><?php echo $row1['departments'] ?></option>
    <?php } ?>
    </select>
    <?php }?> 
    <br>
    <input type="submit" name="addpurpose" value="Add">
</form>
</div>
</body>
</html>

<?php 
if(isset($_POST['addpurpose'])){ 
    $purpose = $_POST['purpose'];
    $dept = $_POST['dept'];

    $insert = "INSERT INTO purposes (purpose_name, dept_id) VALUES ('$purpose', '$dept')";
    if(mysqli_query($conn, $insert)){
        header('location:purpose.php');
    }else{
        echo "di pumasok";
    }
}
?>

<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = "DELETE FROM purposes WHERE id = $id";
    if(mysqli_query($conn, $delete)){
        header('location:purpose.php');
        exit();
    }else{
        echo "Error" . $delete . "<br>" . mysqli_error($conn);
    }
}
?>