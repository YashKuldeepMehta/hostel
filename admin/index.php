<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$stmt = $mysqli->prepare("SELECT username,email,password,id FROM admin WHERE (userName=?|| email=?) and password=? ");
	$stmt->bind_param('sss', $username, $username, $password);
	$stmt->execute();
	$stmt->bind_result($username, $username, $password, $id);
	$rs = $stmt->fetch();
	if ($rs) {
		$_SESSION['id'] = $id;
		header("location:admin-profile.php");
	} else {
		echo "<script>alert('Invalid Username/Email or password');</script>";
	}
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>Admin login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<div class="fcontent">
		<h1>Hostel Management System</h1>
		<form action="" method="post">
			<label for="username">Your Username or Email</label>
			<input type="text" placeholder="Username" name="username" required>
			<label for="password">Password</label>
			<input type="password" placeholder="Password" name="password" required>
			<input type="submit" name="login" value="Login">
		</form>
		<a href="../index.php" class="sign-in-link">Sign in?</a>
	</div>
	<script src="js/jquery.min.js"></script>
</body>
</html>