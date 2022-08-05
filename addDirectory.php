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
    <input type="text" name="catagory" id="catagory">
    <input type="text" name="department" id="department">
    <input type="submit" name="submit" value="Upload">
</form>


<?php

$catagory = $_POST['catagory'];
$department = $_POST['department'];

if(isset($_POST["submit"]) && !empty($catagory)){
        $insert = "INSERT into directory (catagory, department) VALUES ('$catagory', '$department')";
        $res = mysqli_query($conn, $insert);
        if($insert){
            echo "Video Added";
            header('location:home.php');
        }else{
            echo "Error";
        }
}else{
    echo "Insert a catagory ";
}

?>


<php
mysqli_close($conn);
?>