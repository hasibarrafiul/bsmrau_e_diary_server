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
<html>
    <body>
    <form method="post" enctype="multipart/form-data">
    <input type="text" name="heading" id="heading">
    <input type="text" name="content" id="content">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>

    <?php
        $dir = "eventimage/";
        $fileName = basename($_FILES["file"]["name"]);
        $path = $dir . $fileName;
        $type = pathinfo($path,PATHINFO_EXTENSION);
        $heading = $_POST['heading'];
        $content = $_POST['content'];

        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
            $allowed = array('jpg','png','jpeg','gif','pdf');
            if(in_array($type, $allowed)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
                    $insert = "INSERT into events (heading, content, headingimage, created_on) VALUES ('$heading', '$content', '$fileName', NOW())";
                    $res = mysqli_query($conn, $insert);
                    if($insert){
                        echo "Event Added";
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
            echo "Select an Profile picture";
        }

?>

Events: <br>
                <?php
                $sql = "SELECT * from events ";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $url = 'eventimage/'.$row["headingimage"];
                        echo "Heading: " . $row["heading"]. "<br>";
                        echo "Content: " . $row["content"]. "<br>";
                        ?>
                            <img src="<?php echo $url; ?>" alt="" />
                        <?php
                        echo "<td><a href='deleteevent.php?id=".$row["id"]."'>Delete</a></td>";
                    }
                }

                echo "<br><br>";


                mysqli_close($conn);
                ?>


    </body>
</html>

<php
mysqli_close($conn);
?>