<?php

include("connection.php");
$msg = $_POST['text']; 
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql = "INSERT INTO msgs (msg, room, ip, ctime) VALUES ('$msg', '$room', '$ip', CURRENT_TIMESTAMP);";

if(mysqli_query($conn, $sql)) {
    //echo "Message posted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
