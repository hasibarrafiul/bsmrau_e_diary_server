<?php
session_start();
$loggedin = $_SESSION['logedin'];
if($loggedin == 'true'){
    echo "Welcome ".$_SESSION['username']. '<br><br>';
}
else{
    header('location:login.php');
}
?>

<button onclick="window.location.href='login.php'">Logout</button> <br><br><br>
<button onclick="window.location.href='events.php'"> event</button> <br><br><br>
<button onclick="window.location.href='addevent.php'">add event</button> <br><br><br>
<button onclick="window.location.href='addnotice.php'">add Notice</button> <br><br><br>
<button onclick="window.location.href='noticeShow.php'"> Notices </button> <br><br><br>








