<?php 
session_start();
require "../connection.php";
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
    <!-- reading ng data na ieedit -->
    <?php
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        // query to para sa showing ng data ni user
        $sql = "SELECT * from user WHERE id = $id";
        $user_query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($user_query)>0) {
                while($users = mysqli_fetch_array($user_query)){ ?>
                <form action="" method="POST">
                    <label for="">First name</label><br>
                    <input type="text" name="first_name" value="<?php echo $users['first_name'] ?>"><br><br>
                    <label for="">Last name</label><br>
                    <input type="text" name="last_name" value="<?php echo $users['last_name'] ?>"><br><br>
                    <label for="">Username</label><br>
                    <input type="text" name="username" value="<?php echo $users['username'] ?>"><br><br>
                    <label for="">Password</label><br>
                    <input type="password" name="password"><br><br>
                <!-- another query para sa departments -->
                <?php $sql = "SELECT * FROM department";
                $query = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query)>0) { ?>
                <select name="dept">
                    <option value="">Select department</option>
                <?php while($row = mysqli_fetch_array($query)){
                    $dept_id = $row['id'];
                    $dept_name = $row['departments'];
                    echo "<option value = '$dept_id'>$dept_name</option>"
                    ?> 
                <?php } ?>
                </select>
                <?php }?> 
                <input type="submit" name="update" value="Update">
            </form>
    <?php }
        }
    }
    ?> 
</body>
</html>
<!-- update process -->
<?php 
    if(isset($_POST['update'])){
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dept = $_POST['dept'];

        if(empty($fname) || empty($lname) || empty($username) || empty($password) || empty($dept)) {
            echo "Must fill this field";
        } else if(empty($fname) && empty($lname) && empty($username) && empty($password) && empty($dept)){
            echo "Fields must not left blank";
        }else{
            $update = "UPDATE user SET first_name = '$fname', last_name = '$lname',
            username = '$username', password = '$password', dept_id = '$dept' WHERE id = $id";
            $query_update = mysqli_query($conn, $update);
            if($query_update) {
                header("location: operator.php");
                exit();
            }else{
                echo "Error" .$conn->error;
            }
        }
    }
?>