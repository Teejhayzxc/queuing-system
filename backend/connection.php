<?php

$conn = new mysqli ("localhost" , "root" ,"" ,"queue_system");

if($conn == false){
    echo "not connected". $conn->error;
}

?>