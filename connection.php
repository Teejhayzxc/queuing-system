<?php
$conn = new mysqli('localhost', 'root', '', 'queuing_system');
if($conn == false){
    echo "not connected". $conn->error;
}

?>