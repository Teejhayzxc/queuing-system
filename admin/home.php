<?php
include('../backend/connection.php');
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

$sql_queue = "SELECT * FROM queuenum";
$sql_num = mysqli_query($conn, $sql_queue); ?>

<table>
    <thead>
        <tr>
            <th>Purpose</th>
            <th>Remarks</th>
            <th></th>
        </tr>
    </thead>
<?php
    if(mysqli_num_rows($sql_num) > 0) {
    if(mysqli_num_rows($sql_num) > 0) {
    foreach($sql_num as $queue) {
?>
    <tbody>
            <tr>
                <td><?php echo $queue['purpose_id']?> </td>
                <td><?php echo $queue['remarks']?> </td>
                <td> <input type="button" name="update" value="NEXT"></td>
            </tr>
    </tbody>  
<?php
    }
    }
    }
?>    
</table>
</body>
</html>