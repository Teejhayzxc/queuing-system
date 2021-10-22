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
    $sql = "SELECT purposes.id, purposes.purpose_name, purposes.dept_id,
    department.id, department.departments
    FROM purposes
    LEFT JOIN department ON purposes.dept_id = department.id
    GROUP BY purposes.id";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0) {
    ?>
    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($query)){ ?>
            <tbody> 
                <tr>
                    <td><?php echo $row['departments']?></td>
                    <td><?php echo $row['purpose_name']?></td>
                </tr>
                <?php }?>
            </tbody>
        <?php } ?> 
    </table>

<form action="" method="POST">
    <?php 
    $sql_department = "SELECT * FROM department";
    $query_department = mysqli_query($conn, $sql_department);
    if(mysqli_num_rows($query_department)>0) { ?>
    <select name="dept">
    <?php while($row1 = mysqli_fetch_array($query_department)){ ?> 
    <option value="<?php echo $row1['id']?>"><?php echo $row1['departments'] ?></option>
    <?php } ?>
    </select>
    <?php }?> 
    <br>
    <label for="">Enter a Purpose name : </label> <br>
    <input type="text" name="purpose">
    <input type="submit" name="addpurpose" value="Add">
</form>
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