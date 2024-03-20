
<?php

include("connection.php");
$room = $_POST['room'];

$query = "SELECT msg, ctime, ip FROM msgs WHERE room='$room';";
$res = "";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {//there is a msg...
    while ($row = mysqli_fetch_assoc($result)) {
        $res .= '<div class="container">';
        $res .= $row['ip'];
        $res .= " Says <p>".$row['msg'];
        $res .= '</p><span class="time-right">'.$row["ctime"].'</span></div>';
}
}
echo $res;
?>
