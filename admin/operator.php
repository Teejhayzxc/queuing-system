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
    $query_users = "SELECT user.id, user.first_name, user.last_name, user.dept_id,
    department.id, department.departments 
    FROM user 
    LEFT JOIN department ON user.dept_id = department.id 
    ORDER BY user.id ASC";   
    $get_users = mysqli_query($conn, $query_users);
    if(mysqli_num_rows($get_users) > 0 ){?>
    <table>
        <thead>
        <tr>
            <th>Department</th>
            <th>Department ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Actions</th>
        </tr>
    </thead>
        <?php
        while($row = mysqli_fetch_array($get_users)){ 
        ?>
        <tbody>
        <tr> 
            <td><?php echo $row['departments']?></td>
            <td><?php echo $row['dept_id']?></td>
            <td><?php echo $row['first_name']?></td>
            <td><?php echo $row['last_name']?></td>
            <td><a href="">Update</a></td>
            <td><a href="">Delete</a></td>
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
    <label for="">First name</label><br>
    <input type="text" name="first_name"><br><br>
    <label for="">Last name</label><br>
    <input type="text" name="last_name"><br><br>
    <label for="">Username</label><br>
    <input type="text" name="username"><br><br>
    <label for="">Password</label><br>
    <input type="password" name="password"><br><br>
        <?php 
        $sql = "SELECT * FROM department";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0) { ?>
        <select name="dept">
        <?php while($row = mysqli_fetch_array($query)){ ?> 
            <option value="<?php echo $row['id']?>"><?php echo $row['departments'] ?></option>
        <?php } ?>
        </select>
        <?php }?> 
    <input type="submit" name="addOperators" value="submit">
</form>
</body>
</html>

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
    }else{
        echo "hende success";
    }
}
?>