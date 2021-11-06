<?php
session_start();
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
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <?php 
    $user = $_SESSION['username'];
    $dept = $_SESSION['dept_id'];
    echo 'Hello ' . $user; 

    ?>
<div class="container d-flex flex-column">

<?php
$get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks, queuenumber.queue_status,
purposes.purpose_name, purposes.dept_id
FROM queuenumber 
LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
WHERE dept_id = $dept AND queuenumber.queue_status = 'Queuing'
LIMIT 1";
$get_num = mysqli_query($conn, $get_queue); ?>

<div class="card" style="display: grid; place-items:center;">
    <div class="card-body">
    <?php if(mysqli_num_rows($get_num)>0) {
    while($row = mysqli_fetch_array($get_num)){ ?>
    <form action="" method="POST">
        <?php echo 'Current Number : ' . $row['id'] ?>
        <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
        <input type="hidden" value="Done" name="statusUp">
        <input type="submit" name="Next" value="Next">
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
<div class="container">
<?php
    $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks, queuenumber.queue_status,
    purposes.purpose_name, purposes.dept_id
    FROM queuenumber 
    LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
    WHERE dept_id = $dept AND queuenumber.queue_status = 'Queuing'";
    $get_num = mysqli_query($conn, $get_queue); ?>
<table class="table text-center">
    <thead class="bg-dark text-white">
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


<p class="display-4">LAST CALLED NUMBER</p>
<?php
    $get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks, queuenumber.queue_status,
    purposes.purpose_name, purposes.dept_id
    FROM queuenumber 
    LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id 
    WHERE dept_id = $dept AND queuenumber.queue_status = 'Done'";
    $get_num = mysqli_query($conn, $get_queue); ?>
<table class="table">
    <thead class="bg-dark text-white">
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

