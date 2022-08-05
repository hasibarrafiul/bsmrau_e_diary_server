<?php

session_start();

$_SESSION['logedin'] = 'false';
$_SESSION['username'] = '';

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
if(isset($_POST['submit'])){
$username = $_POST['username'];
$password = $_POST['password'];

    $sql = "SELECT id, password from  users where username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            if($row["password"] == hash('sha256', $password)){
                $_SESSION['logedin'] = 'true';
                $_SESSION['username'] = $username;
                $_SESSION['doctorid'] = $row["id"];
                header('location:home.php');
            }
            else{
                echo "Password is incorrect";
            }
        }
    } else {
        echo "No user found";
    }
    //header('location:login.php');
    

}
mysqli_close($conn);

?>

<html>
<head>
<title>Login</title>
</head>
<body>
<h1>Login</h1>
<form method="post">
<p>Username: <input type="text" name="username" size="20" maxlength="20" /></p>
<p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
<p><input type="submit" name="submit" value="Login" /></p>
</form>

<button onclick="window.location.href='signup.php'">Signup</button>
</body>
</html>