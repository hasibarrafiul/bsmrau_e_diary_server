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


if (isset($_POST['submit'])) {    $username = $_POST['username'];    $password = $_POST['password'];    $repassword = $_POST['repassword'];    if ($username != "" && $password != "") {
        if ($password == $repassword) {
            $encpt_password = hash('sha256', $password);
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$encpt_password')";
            if (mysqli_query($conn, $sql)) {
                echo "User Created Successfully";
                header('location:login.php');
            }
            else {
                echo "User already exists";
            }
        }
        else {
            echo "Both Password must be same";
        }    }    else {
        echo "Username and Password must be filled";    }
}


mysqli_close($conn);
?>

<html>
<head>
<title>Sign Up</title>
</head>
<body>
<h1>Sign Up</h1>
<form method="post">
<p>Username: <input type="text" name="username" size="20" maxlength="20" /></p>
<p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
<p>Again Password: <input type="password" name="repassword" size="20" maxlength="20" /></p>
<p><input type="submit" name="submit" value="Sign Up" /></p>
</form>

<button onclick="window.location.href='login.php'">Login</button>
</body>
</html>