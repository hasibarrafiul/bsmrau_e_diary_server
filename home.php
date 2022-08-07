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
<button onclick="window.location.href='addevent.php'">event</button> <br><br><br>
<button onclick="window.location.href='addnotice.php'">Notice</button> <br><br><br>


<button onclick="window.location.href='addfaculty.php'"> Faculty </button> <br><br><br>


<button onclick="window.location.href='addofficials.php'"> Add officials </button> <br><br><br>
<button onclick="window.location.href='showofficials.php'"> show officials </button> <br><br><br>


<button onclick="window.location.href='addnews.php'">add News</button> <br><br><br>
<button onclick="window.location.href='newsShow.php'"> News </button> <br><br><br>
<button onclick="window.location.href='addVideos.php'">add Videos</button> <br><br><br>
<button onclick="window.location.href='videoShow.php'"> Videos </button> <br><br><br>

<button onclick="window.location.href='addDirectory.php'"> Add Directory </button> <br><br><br>
<button onclick="window.location.href='directoryShow.php'"> Directory </button> <br><br><br>

