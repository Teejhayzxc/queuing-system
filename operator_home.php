<?php
session_start();
ob_start();
include "config/connection.php";
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    header("Location:index.php");
    exit();
}

$user = $_SESSION['username'];
$dept = $_SESSION['dept_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/datatables.min.js"></script>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <script>window.history.forward();</script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-success justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand text-white">Queue</a>
        <div class="text-white">
            <a class="btn text-white" href="logout.php" style="background: var(--bs-teal);">Sign-out</a>
        </div>
    </div>
</nav>
<div class="container-fluid ">
<div class="row">
    <div class="col-lg-4 p-4">
    <p class="text-muted" style="font-family: var(--poppins); font-weight:600; font-size:2.4em;">Queue List</p>
        <div class="container p-0 m-0">
            <?php
                $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.date_created, queuenumber.remarks, queuenumber.queue_status,
                purposes.purpose_name, purposes.dept_id,
                department.departments
                FROM queuenumber 
                LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
                LEFT JOIN department ON department.id = purposes.dept_id
                WHERE dept_id = $dept AND queuenumber.queue_status = 'Queuing'
                LIMIT 6";
                $get_num = mysqli_query($conn, $get_queue); ?>
            <ul class="list-group">
            <?php if(mysqli_num_rows($get_num)>0) {
                while($row = mysqli_fetch_array($get_num)){ 
                    $id = $row['id'];
                    $padded_id = str_pad($id, 4, '0', STR_PAD_LEFT);
                ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-8">
                            <p><?php echo 'Ticket No. : ' , 'UM-' . $row['departments'] . '-' . $row['date_created'] . '-'. $padded_id ?></p>  
                        </div>
                        <div class="col-4">
                            <p><?php echo 'Purpose : ' . $row['purpose_name']?></p>
                        </div>
                    </div>
                </li>
                <?php
                }
                }else{
                    echo "Nothing queued yet ";
                }
                ?>    
        </div>    
    </div>
    <div class="col-lg-8">
        <div class="container">
        <div class="row gy-2">
        <div class="col-12 p-5">
        <?php
        $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.date_created, queuenumber.remarks, queuenumber.queue_status,
        purposes.purpose_name, purposes.dept_id,
        department.departments
        FROM queuenumber 
        LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
        LEFT JOIN department ON department.id = purposes.dept_id
        WHERE dept_id = $dept AND queuenumber.queue_status = 'Queuing'
        LIMIT 1";
        $get_num = mysqli_query($conn, $get_queue); 
        ?>
        <div class="card">
            <div class="card-header bg-success text-white">
                <p class="h4 text-center">CURRENT NUMBER</p>
            </div>
            <div class="card-body">
                <?php if(mysqli_num_rows($get_num)>0) {
                while($row = mysqli_fetch_array($get_num)){ 
                    $id = $row['id'];
                    $padded_id = str_pad($id, 4, '0', STR_PAD_LEFT);
                ?>
            
                <form action="" method="POST">
                    <p class="h5 text-center mb-5" style="font-size:2.4em;"><?php echo 'UM-' . $row['departments'] . '-' . $row['date_created'] . '-'. $padded_id  ?></p>
                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                    <input type="hidden" value="Done" name="statusUp">
                    <span class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-outline-secondary" name="Next" value="NEXT">
                    </span>
                </form>
    
            <?php
            }
            }else{
                echo "<span style='display:grid; place-items:center;'>No Queued yet</span>";
            }
            ?>
        </div>
        </div>
        </div>   
        </div>
        <div class="col-12 p-5">
            <p class="display-6">LAST CALLED NUMBER</p>
            <?php
                $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.date_created, queuenumber.remarks, queuenumber.queue_status,
                purposes.purpose_name, purposes.dept_id
                FROM queuenumber 
                LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
                WHERE dept_id = $dept AND queuenumber.queue_status = 'Done'
                ORDER BY id desc";
                $get_num = mysqli_query($conn, $get_queue); 
            ?>
            <table class="table border display" id="recentQueue" >
                <thead class="bg-success text-white">
                    <tr>
                        <th>ID</th>
                        <th>Purpose</th>
                        <th>Date Added</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
            <?php if(mysqli_num_rows($get_num)>0) {
                while($row = mysqli_fetch_array($get_num)){ ?>
                <tbody>
                    <tr >
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['purpose_name']?></td>
                        <td><?php echo $row['date_created']?></td>
                        <td><?php echo $row['remarks']?> </td>
                    </tr>
                </tbody>  
                <?php } }?>    
            </table>
        </div>
    </div>
    </div>
</div>
<script src="assets/js/bootstrap.js"></script>
<script>
$(document).ready(function() {
    $('#recentQueue').DataTable();
} );
</script>
</body>
</html>

<?php 
    if(isset($_POST['Next'])){
        $id = $_POST['id'];
        $statusUp = $_POST['statusUp'];

        $update =  "UPDATE queuenumber SET queue_status = '$statusUp' WHERE id = $id";
            $query = mysqli_query($conn, $update);
            
            if($query){
                header("location: operator_home.php"); 
                exit();
            }else{
                echo "Error" .$conn->error;
            }
        } 
?>

