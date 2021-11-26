<?php 
include "includes/header.php";
?>
    <div class="container">
    <div class="container-fluid" style="padding-top:10em; overflow:auto;">
    <?php 
    $sql = "SELECT purposes.id, purposes.purpose_name, purposes.dept_id, purposes.datetime_created, purposes.datetime_updated,
    department.departments
    FROM purposes
    LEFT JOIN department ON purposes.dept_id = department.id";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query)>0) {
    ?>
    <table class="table table-hover">
        <thead class="bg-dark text-white">
            <tr>
                <th colspan="2">Purpose</th>
                <th>Department</th>
                <th>Date Added</th>
                <th>Date Updated</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($query)){ ?>
            <tbody> 
                <tr>
                    <td colspan="2"><?php echo $row['purpose_name']?></td>
                    <td><?php echo $row['departments']?></td>
                    <td><?php echo $row['datetime_created']?></td>
                    <td><?php echo $row['datetime_updated']?></td>
                    <td class="text-center"><a class="btn btn-success" href="purpose_edit.php?edit=<?php echo $row['id']?>">Edit</a>
                    <a class="btn btn-danger" href="purpose.php?delete=<?php echo $row['id']?>">Delete</a></td>
                </tr>
                <?php }?>
            </tbody>
        <?php }else{
            echo "No Data Found";
        } ?> 
    </table>
    </div>
    <div class="container">
    <form action="#" method="POST" class="needs-validation" novalidate>
        <label for="validationCustom05" class="form-label">Enter an attending reason/purpose :</label>
        <input type="text" name="purpose" class="form-control form-control-sm w-25 mb-3" id="validationCustom05" required>
        <div class="invalid-feedback">
            The field is empty.
        </div>
        <select class="form-select w-25 mb-3" name="dept">
        <option value="">Select Department</option>
        <?php 
        $sql_department = "SELECT * FROM department";
        $query_department = mysqli_query($conn, $sql_department);
        if(mysqli_num_rows($query_department)>0) { ?>
        <?php while($row1 = mysqli_fetch_array($query_department)){ ?> 
        <option value="<?php echo $row1['id']?>"><?php echo $row1['departments'] ?></option>
        <?php } ?>
        </select>
        <input class="btn btn-success" type="submit" name="addpurpose" value="Add">
        <?php }else {?> 
        <input class="btn btn-success disabled" type="submit" name="addpurpose" value="Add">
        <?php }?>
</form>
</div>
</div>
<?php
include "includes/footer.php";
?>

<?php 
if(isset($_POST['addpurpose'])){ 
    $purpose = $_POST['purpose'];
    $dept = $_POST['dept'];
    $dateCreated = date_default_timezone_set('Asia/Manila');
    $dateCreated = date("y-m-d h:i:s");

    $insert = "INSERT INTO purposes (purpose_name, dept_id, datetime_created) VALUES ('$purpose', '$dept', '$dateCreated')";
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