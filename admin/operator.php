<?php
include "includes/header.php";
?>
<div class="container">
    <div class="container" style="padding-top: 10em;">
    <?php 
    $query_users = "SELECT user.id, user.first_name, user.last_name, user.dept_id, user.datetime_created, user.datetime_updated,
    department.departments 
    FROM user 
    LEFT JOIN department ON user.dept_id = department.id";   
    $get_users = mysqli_query($conn, $query_users);
    if(mysqli_num_rows($get_users) > 0 ){?>
    <table class="table table-hover text-center" style="overflow:auto;">
    <thead class="bg-dark text-white ">
    <tr>
        <th>Department</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date Added</th>
        <th>Date Updated</th>
        <th>Actions</th>
    </tr>
    </thead>
    <?php while($row = mysqli_fetch_array($get_users)){ ?>
    <tbody>
        <tr> 
            <td><?php echo $row['departments']?></td>
            <td><?php echo $row['first_name']?></td>
            <td><?php echo $row['last_name']?></td>
            <td><?php echo $row['datetime_created']?></td>
            <td><?php echo $row['datetime_updated']?></td>
            <td>
                <a class="btn btn-success" href="operator_edit.php?edit=<?php echo $row['id'] ?>">Edit</a>
                <a class="btn btn-danger" href="operator.php?delete=<?php echo $row['id'] ?>">Delete</a>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
<?php }else{
    echo "No Employees Added Yet";
} ?>
<div class="container">
<form action="" method="POST" class="row needs-validation" novalidate>
    <div class="col-lg-6">
        <label for="validationCustom05" class="form-label">First Name</label>
        <input type="text" class="form-control" id="validationCustom05" name="first_name" required>
        <div class="invalid-feedback">
            Please provide a First Name.
        </div>
    </div>
    <div class="col-lg-6" >
        <label for="validationCustom05" class="form-label">Last Name</label>
        <input class="form-control" type="text" name="last_name" required>
        <div class="invalid-feedback">
            Please provide a Last Name.
        </div>
    </div>
    <div class="col-lg-6" style="padding-top: 2em;">
    <label for="validationCustom05" class="form-label">Set Password</label>
        <input class="form-control" type="password" name="password" required>
        <div class="invalid-feedback">
            Must fill this field.
        </div>
    </div>
    <div class="col-lg-6" style="padding-top: 2em;">
        <?php 
        $sql = "SELECT * FROM department";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0) { ?>
        
        <label for="validationCustom05" class="form-label">Department</label>
        <select class="form-select" name="dept" required>
            <option value="">Select a Department</option>
        <?php 
        while($row = mysqli_fetch_array($query)){
            $dept_id = $row['id'];
            $dept_name = $row['departments'];
            echo "<option value = '$dept_id'>$dept_name</option>"
            ?> 
        <?php } ?>
        </select>
        <div class="invalid-feedback">
            Must select a department.
        </div>
        <?php }?> 
        
    </div>
    
    <div class="col-lg-12 d-flex justify-content-center" style="padding-top: 2em;">
    <input type="submit" class="btn btn-success" name="addOperators" value="Submit"> 
    </div>
</form>
</div>
</div>
<?php
include "includes/footer.php";
?>

<!-- process para sa pag-add ng users -->
<?php 
if(isset($_POST['addOperators'])){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $password = $_POST['password'];
    $dept = $_POST['dept'];
    $dateCreated = date_default_timezone_set('Asia/Manila');
    $dateCreated = date("y-m-d h:i:s");

    $insert = "INSERT INTO user (first_name, last_name, username, password, dept_id, datetime_created) 
    VALUE ('$fname', '$lname', '$username', '$password', '$dept', '$dateCreated')";
    
    if(mysqli_query($conn, $insert)){
        echo "Success";
        header('location:operator.php');
    }else{
        echo "Failed to insert the data";
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