<?php
session_start();
$loggedin = $_SESSION['logedin'];
if ($loggedin == 'true') {
    echo "Welcome " . $_SESSION['username'] . '<br><br>';
}
else {
    header('location:login.php');
}
?>
<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bsmrau_e_diary";

// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "DELETE FROM events WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    echo "Events Deleted Successfully";
    header('location:addevent.php');
}

else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>