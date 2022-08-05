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
    <input type="text" name="name" id="name">
    <input type="text" name="designation" id="designation">
    <input type="text" name="department" id="department">
    <input type="number" name="mobilenumber" id="mobilenumber">
    <input type="email" name="email" id="email">
    <input type="number" name="officenumber" id="officenumber">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>


<?php

$dir = "facultyimage/";
$fileName = basename($_FILES["file"]["name"]);
$path = $dir . $fileName;
$type = pathinfo($path,PATHINFO_EXTENSION);
$name = $_POST['name'];
$designation = $_POST['designation'];
$department = $_POST['department'];
$mobilenumber = $_POST['mobilenumber'];
$email = $_POST['email'];
$officenumber = $_POST['officenumber'];

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    $allowed = array('jpg','png','jpeg','gif','pdf');
    if(in_array($type, $allowed)){
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
            $insert = "INSERT into faculty (name, designation, department, mobilenumber, email, officenumber, image) VALUES ('$name', '$designation', '$department', '$mobilenumber', '$email', '$officenumber', '$fileName')";
            $res = mysqli_query($conn, $insert);
            if($insert){
                echo "Faculty Added";
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