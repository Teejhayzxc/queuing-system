<?php
session_start();
ob_start();
include "connection.php";
if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <script>window.history.forward();</script>
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <?php 
    $user = $_SESSION['username'];
    $dept = $_SESSION['dept_id'];
    echo 'Hello ' . $user; 

    ?>
<div class="container-xxl">
<div class="row mt-lg-5" style="margin-top: 2em;">
    <div class="col-lg-5 mb-lg-5">
        <?php
        $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks, queuenumber.queue_status,
        purposes.purpose_name, purposes.dept_id
        FROM queuenumber 
        LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
        WHERE dept_id = $dept AND queuenumber.queue_status = 'Queuing'
        LIMIT 1";
        $get_num = mysqli_query($conn, $get_queue); ?>
        <div class="card w-100">
            <div class="card-header bg-success text-white">
                <p class="h4 text-center">CURRENT NUMBER</p>
            </div>
            <div class="card-body">
            <?php if(mysqli_num_rows($get_num)>0) {
            while($row = mysqli_fetch_array($get_num)){ ?>
            <form action="" method="POST">
                <p class="h1 text-center mb-5" style="font-size: 10em;"><?php echo $row['id'] ?></p>
                <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                <input type="hidden" value="Done" name="statusUp">
                <span class="d-flex justify-content-center">
                    <input type="submit" class="btn btn-outline-secondary" name="Next" value="CALL">
                </span>
            </form>
            </div>
            <?php
            }
            }else{
                echo "No Queued yet";
            }
            ?>
        </div>
    </div>
    <div class="col-lg-7 mb-lg-5" style="margin-top: 1.5em;">
        <p class="display-6 text-muted" style="font-family: var(--poppins); font-weight:600;">QUEUE</p>
        <div class="container-fluid p-1" style="overflow: scroll; max-height:15.8em;">
        <?php
            $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks, queuenumber.queue_status,
            purposes.purpose_name, purposes.dept_id
            FROM queuenumber 
            LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
            WHERE dept_id = $dept AND queuenumber.queue_status = 'Queuing'";
            $get_num = mysqli_query($conn, $get_queue); ?>
        <table class="table text-center border">
            <thead class="bg-success text-white">
                <tr>
                    <th>ID</th>
                    <th>Purpose</th>
                    <th>Remarks</th>
                </tr>
            </thead>
        <?php if(mysqli_num_rows($get_num)>0) {
            while($row = mysqli_fetch_array($get_num)){ ?>
            <tbody>
                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['purpose_name']?></td>
                    <td><?php echo $row['remarks']?> </td>
                </tr>
            </tbody>  
            <?php
                }
            }
            ?>    
        </table>
        </div>
    </div>
    <div class="col-lg-12" style="margin-top: 1.7em;">
        <p class="display-6">LAST CALLED NUMBER</p>
        <div class="container-fluid p-1" style="max-height:15.8em; overflow:scroll;">
        <?php
            $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks, queuenumber.queue_status,
            purposes.purpose_name, purposes.dept_id
            FROM queuenumber 
            LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
            WHERE dept_id = $dept AND queuenumber.queue_status = 'Done'
            ORDER BY id desc";
            $get_num = mysqli_query($conn, $get_queue); 
        ?>
        <table class="table border" >
            <thead class="bg-success text-white">
                <tr>
                    <th>ID</th>
                    <th>Purpose</th>
                    <th>Remarks</th>
                </tr>
            </thead>
        <?php if(mysqli_num_rows($get_num)>0) {
            while($row = mysqli_fetch_array($get_num)){ ?>
            <tbody>
                <tr >
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['purpose_name']?></td>
                    <td><?php echo $row['remarks']?> </td>
                </tr>
            </tbody>  
            <?php } }?>    
        </table>
        </div>
    </div>
</div>
</div>
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

