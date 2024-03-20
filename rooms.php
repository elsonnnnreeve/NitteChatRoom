


<?php

include("connection.php");

session_start();
$user = $_SESSION['variable'];


//$roomname= $_POST['roomname'];
//sanitized the connection,prevents sql injection injection attacks
$roomname = mysqli_real_escape_string($conn, $_GET['roomname']);






$query="select * from rooms where roomname='$roomname';";

$result=mysqli_query($conn,$query);

if($result)
{
    /*if(mysqli_num_rows($result) == 0)
    {
        $msg = "This room does not exist. Kindly create a room first.";
            echo '<script language="javascript">';
            echo 'alert(" '.$msg.' ");';
            echo 'window.location="https://localhost/NCR/"';
            echo '</script>';
            exit;
    }*/
}
else
{
    echo "Error!".mysqli_error($conn);
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 2px;
  max-length: 40px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 20px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 50%;
  margin-right: 20px;
  border-radius: 20%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
.anyclass{
    height:400px;
    overflow-y:scroll;
}
</style>
</head>
<body>
<br><br>
<h2>Room name: 
    <?php echo $roomname; 
    ?>
    
    </h2>

<div class="container">
    <div class="anyclass">
  
</div>
</div>



<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Type you message here">
<br>
<button class="btn btn-success" name="submitmsg" id="submitmsg">Send</button>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poTPtJCKJJDbLLPE7Mo9CZHw9RVWKV1hXcJJwwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2mzW2Ve7UEByoXETBsFK6jEufUdeo8S3fktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script type="text/javascript">

setInterval(runFunction,1000);

function runFunction()
{
    $.post("fetchmsg.php",{room:'<?php echo $roomname ?>'},
    function(data,status)
    {
        document.getElementsByClassName('anyclass')[0].innerHTML=data;

    }
    )
}


$(document).ready(function() {

    var input = document.getElementById("usermsg");
//below code for executing send button when enter key is clicked.
// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});

    $("#submitmsg").click(function() {
        var clientmsg = $("#usermsg").val();
        $.post("postmsg.php", { text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $user ?>' },//echo $_SERVER['REMOTE_ADDR']
            function(data, status) {
                $(".anyclass").html(data);
            }
        );

        $("#usermsg").val("");
        return false;
    });
});
</script>

</body>
</html>





