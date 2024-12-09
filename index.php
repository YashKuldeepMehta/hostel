<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$stmt = $mysqli->prepare("SELECT email,password,id FROM userregistration WHERE email=? and password=? ");
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($email, $password, $id);
	$rs = $stmt->fetch();
	$stmt->close();

	if ($rs) {
		$_SESSION['id'] = $id;
		$_SESSION['login'] = $email;
		$uid = $_SESSION['id'];
		$uemail = $_SESSION['login'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$log = "insert into userLog(userId,userEmail,userIp) values('$uid','$uemail','$ip')";
		$mysqli->query($log);
		if ($log) {
			header("location:dashboard.php");
		}
	} else {
		echo "<script>alert('Invalid Username/Email or password');</script>";
	}
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Student Hostel Registration</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/header_and_sidebar.css">
</head>

<body>
	<?php include('includes/header.php'); ?>

	<div class="ts-main-content">
		<?php include('includes/sidebar.php'); ?>

		<div class="content-wrapper">

			<div class="log-container">
				<h2 class="page-title">User Login</h2>
				<form action="" method="post">
					<label for="email" class="flabel">Email</label>
					<input type="text" id="email" name="email" placeholder="Email" class="finput">
					<label for="password" class="flabel">Password</label>
					<input type="password" id="password" name="password" placeholder="Password" class="finput">
					<input type="submit" name="login" class="btn-submit" value="Login">
				</form>
				<div class="forget-pass">
					<a href="forgot-password.php">Forgot password?</a>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
</body>

</html>