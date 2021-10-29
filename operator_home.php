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
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <?php 
    $user = $_SESSION['username'];
    echo 'Hello ' . $user; 
    ?>
<?php
$get_queue = "SELECT queuenumber.id, queuenumber.purpose_id, queuenumber.remarks,
purposes.purpose_name, purposes.dept_id
FROM queuenumber 
LEFT JOIN purposes ON purposes.id = queuenumber.purpose_id";
$get_num = mysqli_query($conn, $get_queue); ?>

<table class="table">
    <thead>
    <tr>
    <th>Purpose</th>
    <th>Remarks</th>
    <th> Actions </th>
    
    </tr>
    </thead>
<?php
    if(mysqli_num_rows($get_num)>0) {
    while($row = mysqli_fetch_array($get_num)){
?>
<tbody>
<tr>
    <td><?php echo $row['purpose_name']?> </td>
    <td><?php echo $row['remarks']?> </td>
    <td><a href="operator_home.php?id=<?php $row['id']?>">Next</a></td>
</tr>
</tbody>  
<?php
    }
    }
?>    
</table>
</body>
</html>

