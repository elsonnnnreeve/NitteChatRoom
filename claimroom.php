<?php

include("connection.php");

session_start();
$test=mysqli_real_escape_string($conn, $_POST['user']);//to prevent mysqli injection
$_SESSION['variable'] = "$test";

$room = mysqli_real_escape_string($conn, $_POST['room']);



if (strlen($room) > 15 || strlen($room) < 2) {
    $msg = "Please choose a room name between 2 to 15 characters";
    echo '<script language="javascript">';
    echo 'alert(" '.$msg.' ");';
    echo 'window.location="https://localhost/NCR/";';
    echo '</script>';
    exit;
}

// Check if the room already exists
$query = "SELECT * FROM rooms WHERE roomname = '$room';";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {//theres aldready a room so just join.
        $msg = "Room exists.Preparing to join room...";
        echo '<script language="javascript">';
        echo 'alert(" '.$msg.' ");';
        echo 'window.location="https://localhost/NCR/rooms.php?roomname='.$room.'"';
       // echo 'window.location="https://172.20.10.3/NCR/rooms.php?roomname='.$room.'"';
        echo '</script>';
        exit;
    } else {
        // create a new room if it doesn't exist
        $insertQuery = "INSERT INTO rooms (roomname, ctime) VALUES ('$room', CURRENT_TIMESTAMP);";

        if (mysqli_query($conn, $insertQuery)) {
            $msg = "Room created and ready for use.";
            echo '<script language="javascript">';
            echo 'alert(" '.$msg.' ");';
           echo 'window.location="https://localhost/NCR/rooms.php?roomname='.$room.'"';
           // echo 'window.location="https://172.20.10.3/NCR/rooms.php?roomname='.$room.'"';
            echo '</script>';
            exit;
        } else {
            echo "ERROR!" . mysqli_error($conn);
        }
    }
} else {
    echo "ERROR!" . mysqli_error($conn);
}

?>
