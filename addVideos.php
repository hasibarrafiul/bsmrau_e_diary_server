
<!-- new  -->
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
							<a class="nav-link" href="addfaculty.php">Faculty</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="addofficials.php">Officials</a>
						</li>
						<li class="nav-item">
							<a class="nav-link"  href="addnews.php">News</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="addVideos.php">Videos</a>
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
								<li><a class="dropdown-item bg-danger text-white fw-bold text-center" href="addVideos.php?logout='1'">logout</a></li>
							</ul>
						</li>
						<?php
} else { ?>
						<li class="nav-item">
							<a class="btn btn-outline-primary fw-bold" class="nav-link text-primary" href="login.php">Login</a>
						</li>

						<?php
}
?>

				</div>
			</div>
		</nav>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded">Insert Video</h1>
			</div>
			<div class="col-2"></div>
		</div>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<form class="row g-3 m-2 border-dark border-3 rounded px-2" name="form" method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="new" value="1" />
					<div class="col-md-12 mb-3">
						<label for="exampleFormControlInput1" class="form-label fw-bold">Video Link</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="videolink" placeholder="Enter Video link" required>
					</div>
					<div class="col-12 text-center">
						<button id="liveAlertBtn" name="submit" type="submit" value="Upload" class="btn btn-primary btn-lg">Submit</button>
					</div>
				</form>
			</div>
			<div class="col-2"></div>
		</div>
		<?php


if(isset($_POST["submit"]) && !empty($_POST["videolink"])){
		$videolink = $_POST['videolink'];
        $insert = "INSERT into videos (videolink, date) VALUES ('$videolink', NOW())";
        $res = mysqli_query($conn, $insert);
        if($insert){
            echo "Video Added";
            header('location:addVideos.php');
        }else{
            echo "Error";
        }
}else{
}
?>
		<div class="row">
			<div class="col-2"></div>
			<div class="col-8">
				<h1 class="text-center m-2 mb-4 p-1 border border-dark border-3 border-top-0 border-end-0 rounded">View Videos</h1>
			</div>
			<div class="col-2"></div>
		</div>
		<div class="row">
			<div class="col-1"></div>
			<div class="col-10">
				<div class="row table-responsive m-3">
					<table class="table table-lg align-middle">
						<thead class="table-dark">
							<tr>
								<th class="text-center border"><strong>S.No</strong></th>
								<th class="text-center border"><strong>Video</strong></th>
								<th class="text-center border"><strong>Created</strong></th>
								<th class="text-center border"><strong>Action</strong></th>

							</tr>
						</thead>
						<tbody>
							<?php
$count = 1;
$sel_query = "Select * from videos ORDER BY id desc;";
$result = mysqli_query($conn, $sel_query);
while ($row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td><?php echo $count; ?></td>
								<td><?php echo $row["videolink"]; ?></td>
								<td><?php echo $row["date"]; ?></td>
								<td>
									<a class="btn btn-danger" href="deleteVideo.php?id=<?=$row["id"] ?>">Delete</a>
									<a class="btn btn-danger" href="editVideo.php?id=<?=$row["id"] ?>">Edit</a>
								</td>
							</tr>
							<?php $count++;
}
?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-1"></div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>