<?php 
require 'config/config.php';

if(isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else{
	header("Location: register.php");
}

?>

<!DOCTYPE html>

<html>
<head>
	<title>DankLand</title>
	<!-- JAVA -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="https://kit.fontawesome.com/69ade4f58e.js" crossorigin="anonymous"></script>
	<!-- <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script> -->

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/hover.css">

</head>
<body>

	<div class = "top_bar">
		<div class = "logo">
			<a href="index.php">DankLand</a>
			
		</div>

		<nav>
			<a href="<?php echo $userLoggedIn?>" class="special_nav"><?php echo $user['first_name'] ?></a>
			<a href="#" class="hvr-grow"><i class="fas fa-home"></i> Home</a>
			<a href="#" class="hvr-grow"><i class="fas fa-envelope"></i> Messages</a>	
			<a href="#" class="hvr-grow"><i class="fas fa-bell"></i> Notificaton</a>
			<a href="#" class="hvr-grow"><i class="fas fa-user"></i> Profile</a>
			<a href="includes/handlers/logout.php" class="hvr-grow"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</nav>
	</div>
<div class="wrapper">