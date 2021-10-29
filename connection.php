<?php
$conn = new mysqli('localhost', 'root', '', 'queuing_system');
if(!$conn){
    die(mysqli_error($conn));
}

?>