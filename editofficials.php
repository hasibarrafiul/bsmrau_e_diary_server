
<?php
session_start();
$loggedin = $_SESSION["logedin"];
if ($loggedin == "false") {
    header("location:login.php");
}
if (isset($_GET["logout"])) {
    session_destroy();
    unset($_SESSION["username"]);
    header("location: login.php");
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

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body>
	<div class="container-fluid ">
		<nav class="navbar navbar-expand-lg bg-light">
			<div class="container-fluid ">
				<a class="navbar-brand border border-dark border-3 rounded px-2" href="home.php"><b>BSMRAU E-Diary Server</b></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav ml-auto">
						<!-- <li class="nav-item">
									<a class="nav-link active" aria-current="page" href="#">Home</a>
								</li> -->
						<?php
			if (isset($_SESSION["username"])) {
    			if ($_SESSION["username"] == "admin") { ?>
						<li class="nav-item">
							<a class="nav-link" href="home.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addevent.php">Events</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addnotice.php">Notices</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="addofficials.php">Officials</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addofficials.php">Officials</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addnews.php">News</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addVideos.php">Videos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addDirectory.php">Directory</a>
						</li>

						<?php
    }
}
			if (isset($_SESSION["username"])) { ?>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Welcome <strong class="text-black"><?php echo $_SESSION["username"]; ?></strong>
							</a>
							<ul class="dropdown-menu bg-danger" aria-labelledby="navbarDropdownMenuLink">
								<li><a class="dropdown-item bg-danger text-white fw-bold text-center" href="addOfficials.php?logout='1'">logout</a></li>
							</ul>
						</li>
						<?php
} else { ?>
						<li class="nav-item">
							<a class="btn btn-outline-primary fw-bold" class="nav-link text-primary" href="login.php">Login</a>
						</li>

<?php
}
			$id = $_GET['id'];
			$sql2 = "SELECT * from officials where id = '$id'";
			$res2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($res2);
			$name = $row2["name"];
			$designation = $row2["designation"];
			$department = $row2["department"];
			$mobilenumber = $row2["mobilenumber"];
			$email = $row2["email"];
			$officenumber = $row2["officenumber"];
?>

				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded">Edit Officials</h1>
			</div>
			<div class="col-2"></div>
		</div>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<form class="row g-3 m-2 border-dark border-3 rounded px-2" name="form" method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="new" value="1" />
					<div class="col-md-6 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Officials Name</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Enter Name" required value="<?php echo $name ?>">
					</div>
                    <div class="col-md-6 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Officials Designation</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="designation" placeholder="Enter designation" required value="<?php echo $designation ?>">
					</div>
                    
					<div class="col-md-6 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Officials Department</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="department" placeholder="Enter department" required value="<?php echo $department ?>">
					</div>

                    <div class="col-md-6 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Officials email</label>
						<input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Enter email" required value="<?php echo $email ?>">
					</div>
                    
					<div class="col-md-6 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Officials mobile number</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="mobilenumber" placeholder="Enter mobile number" required value="<?php echo $mobilenumber ?>">
					</div>
                    
					<div class="col-md-6 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Officials office number</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="officenumber" placeholder="Enter office number" required value="<?php echo $officenumber ?>">
					</div>
                    
					<div class="col-md-12">
						<label for="formFile" class="form-label fw-bold">Image</label>
						<input class="form-control" type="file" id="formFile" name="file">
					</div>
					<div class="col-12 text-center">
						<button id="liveAlertBtn" name="submit" type="submit" value="Upload" class="btn btn-primary btn-lg">Submit</button>
					</div>
				</form>
			</div>
			<div class="col-2"></div>
		</div>
		<?php

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
	$dir = "Officialsimage/";
	$fileName = basename($_FILES["file"]["name"]);
	$path = $dir . $fileName;
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$name = $_POST["name"];
	$designation = $_POST["designation"];
	$department = $_POST["department"];
	$mobilenumber = $_POST["mobilenumber"];
	$email = $_POST["email"];
	$officenumber = $_POST["officenumber"];
    $allowed = ["jpg", "png", "jpeg", "gif", "pdf"];
    $id = $_GET["id"];
    if (in_array($type, $allowed)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
            $insert = "UPDATE officials SET name= '$name', designation='$designation', department='$department', mobilenumber='$mobilenumber', email='$email', officenumber='$officenumber', image='$fileName' WHERE id= '$id'";
            $res = mysqli_query($conn, $insert);
            if ($insert) {
                echo "Officials Edited Successfully";
                //header("location:addOfficials.php");
				echo("<script>location.href = 'addofficials.php';</script>");
            } else {
                echo "Error";
            }
        } else {
            echo "Error";
        }
    } else {
        echo "Unsupported file type";
    }
} else {
}


if (isset($_POST["submit"]) && empty($_FILES["file"]["name"])) {
	
	$name = $_POST["name"];
	$designation = $_POST["designation"];
	$department = $_POST["department"];
	$mobilenumber = $_POST["mobilenumber"];
	$email = $_POST["email"];
	$officenumber = $_POST["officenumber"];
    $id = $_GET["id"];
   
            $insert = "UPDATE Officials SET name= '$name', designation='$designation', department='$department', mobilenumber='$mobilenumber', email='$email', officenumber='$officenumber' WHERE id= '$id'";
            $res = mysqli_query($conn, $insert);
            if ($insert) {
                echo "Officials Edited Successfully";
                //header("location:addOfficials.php");
				echo("<script>location.href = 'addofficials.php';</script>");
            } else {
                echo "Error";
            }
} else {
}


?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>