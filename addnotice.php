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
    <input type="text" name="heading" id="heading">
    <input type="text" name="details" id="details">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>


<?php

$dir = "noticeimage/";
$fileName = basename($_FILES["file"]["name"]);
$path = $dir . $fileName;
$type = pathinfo($path,PATHINFO_EXTENSION);
$heading = $_POST['heading'];
$details = $_POST['details'];

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    $allowed = array('jpg','png','jpeg','gif','pdf');
    if(in_array($type, $allowed)){
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
            $insert = "INSERT into notices (noticeheading, details, noticeimage, created_on) VALUES ('$heading', '$details', '$fileName', NOW())";
            $res = mysqli_query($conn, $insert);
            if($insert){
                echo "Notice Added";
                header('location:home.php');
            }else{
                echo "Error";
            } 
        }else{
            echo "Error";
        }
    }else{
        echo "Unsupported file type";
    }
}else{
    echo "Select a picture";
}

?>


<php
mysqli_close($conn);
?>