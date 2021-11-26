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
        // showing (or reading) ng data
        $sql = "SELECT * FROM department WHERE id = $id";
        $show_dept = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($show_dept) > 0) {
            while($row = mysqli_fetch_array($show_dept)){ ?>
                <form action="" method="POST">
                    <label for="">Enter a department name : </label> <br>
                    <input type="text" name="deptname" value="<?php echo $row['departments'] ?>">
                    <input type="submit" name="submit" value="Update">
                </form>
    <?php }
        }
    }

?>
</body>
</html>
<!-- process ng update -->
<?php 
    if(isset($_POST['submit'])) {
        $dept = $_POST['deptname'];
        $deptUpdate = date_default_timezone_set('Asia/Manila');
        $deptUpdate = Date("y-m-d h:i:s");

        if(empty($dept)){
            echo "Must fill this field";
            exit();
        }else{
            $update = "UPDATE department SET departments = '$dept', datetime_updated = '$deptUpdate' WHERE id = $id ";
            $query = mysqli_query($conn, $update);
            
            if($query){
                header("location: departments.php"); 
                exit();
            }else{
                echo "Error" .$conn->error;
            }
        }
    }
?>