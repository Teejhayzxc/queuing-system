<?php
session_start();
include "../config/connection.php";
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
    <title>Document</title>
</head>
<body>
    

<?php
    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM purposes WHERE id = $id";
        $show_purpose = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($show_purpose) > 0) {
            while($row = mysqli_fetch_array($show_purpose)){ ?>
                <form action="" method="POST"> 
                    <label for="">Enter a Purpose name : </label> <br>
                        <input type="text" name="purpose" value="<?php echo $row['purpose_name'] ?>"><br>
                    <select name="dept">
                    <option value="">Select Department</option>
                <?php 
                    $sql_department = "SELECT * FROM department";
                    $query_department = mysqli_query($conn, $sql_department);
                        if(mysqli_num_rows($query_department)>0) { ?>
                        <?php while($row1 = mysqli_fetch_array($query_department)){ ?> 
                        <option value="<?php echo $row1['id']?>"><?php echo $row1['departments'] ?></option>
                        <?php } ?>
                        </select>
                <?php }?> 
                    <br>
                    <br>
                    <input type="submit" name="submit" value="Update">
                </form>
    <?php }
        }
    }

?>
</body>
</html>
<?php 
    if(isset($_POST['submit'])) {
        $purpose = $_POST['purpose'];
        $dept = $_POST['dept'];
        $deptUpdate = date_default_timezone_set('Asia/Manila');
        $deptUpdate = Date("y-m-d h:i:s");

        if(empty($purpose) || empty($dept)){
            echo "Must fill this field";
            exit();
        }else{
            $update = "UPDATE purposes SET purpose_name = '$purpose', dept_id = '$dept', datetime_updated = '$deptUpdate' WHERE id = $id";
            $query = mysqli_query($conn, $update);
            
            if($query){
                header("location: purpose.php");
                exit();
            }else{
                echo "Error" .$conn->error;
            }
        }
    }
?>