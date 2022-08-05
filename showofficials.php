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
$sql = "SELECT * from officials ";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
        $url = 'officialsimage/'.$row["image"];
        echo "Name: " . $row["name"]. "<br>";
        echo "designation: " . $row["designation"]. "<br>";
        echo "Department: " . $row["department"]. "<br>";
        echo "Mobile Number: " . $row["mobilenumber"]. "<br>";
        echo "Email: " . $row["email"]. "<br>";
        echo "Office Number: " . $row["officenumber"]. "<br>";
        ?>
            <img src="<?php echo $url; ?>" alt="" />
        <?php
        echo "<td><a href='deleteofficials.php?id=".$row["id"]."'>Delete</a></td>";
    }
}

echo "<br><br>";


mysqli_close($conn);
?>
