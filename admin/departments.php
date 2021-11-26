<?php 
include "includes/header.php";
?>
<div class="container">
    <div class="container-fluid" style="padding-top:10em; overflow:auto;">
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
    </div>
<div class="container">
    <form action="#" method="POST" class="needs-validation" novalidate>
        <label for="validationCustom05" class="form-label">Enter a department :</label>
        <input type="text" name="deptname" class="form-control form-control-sm w-25" id="validationCustom05" required>
        <div class="invalid-feedback">
            The field is empty.
        </div>
        <input type="submit" class="btn btn-success" name="addDept" value="Add">
    </form>

</div>
</div>
<?php
include "includes/footer.php";
?>

<?php
if(isset($_POST['addDept'])){
    $deptname = $_POST['deptname'];
    $dateCreated = date_default_timezone_set('Asia/Manila');
    $dateCreated = date("y-m-d h:i:s");

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