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

<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bsmrau_e_diary";
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="videolink" id="videolink">
    <input type="submit" name="submit" value="Upload">
</form>


<?php

$videolink = $_POST['videolink'];

if(isset($_POST["submit"]) && !empty($videolink)){
        $insert = "INSERT into videos (videolink, date) VALUES ('$videolink', NOW())";
        $res = mysqli_query($conn, $insert);
        if($insert){
            echo "Video Added";
            header('location:home.php');
        }else{
            echo "Error";
        }
}else{
    echo "Insert a Video Link";
}

?>


<php
mysqli_close($conn);
?>