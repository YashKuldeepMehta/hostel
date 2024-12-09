<?php
session_start();
include('includes/config.php');
if (isset($_SESSION['id'])) {
} else {
	header("Location:index.php");
}
if (isset($_POST['submit'])) {
	$seater = $_POST['seater'];
	$fees = $_POST['fees'];
	$id = $_GET['id'];
	$query = "update rooms set seater=?,fees=? where id=?";
	$stmt = $mysqli->prepare($query);
	$rc = $stmt->bind_param('iii', $seater, $fees, $id);
	$stmt->execute();
	echo "<script>alert('Room Details has been Updated successfully');</script>";
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>Edit Room Details</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header_and_sidebar.css">
	<link rel="stylesheet" href="css/edit-room.css">
</head>
<body>
	<?php include('includes/header.php'); ?>
	<?php include('includes/sidebar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<h2 class="page-title">Edit Room Details </h2>
			<div class="panel panel-default">
				<div class="panel-heading">Edit Room Details</div>
				<div class="panel-body">
					<form method="post" class="fhorizon">
						<?php
						$id = $_GET['id'];
						$ret = "select * from rooms where id=?";
						$stmt = $mysqli->prepare($ret);
						$stmt->bind_param('i', $id);
						$stmt->execute();
						$res = $stmt->get_result();
						while ($row = $res->fetch_object()) {
							?>
							<div class="fgroup">
								<label>Seater: </label>
								<div class="finp">
									<input type="text" name="seater" value="<?php echo $row->seater; ?>" class="fcontrol">
								</div>
							</div>
							<div class="fgroup">
								<label>Room no </label>
								<div class="finp">
									<input type="text" class="fcontrol" name="rmno" id="rmno"
										value="<?php echo $row->room_no; ?>" disabled>
									<span>
										Room no can't be changed.</span>
								</div>
							</div>
							<div class="fgroup">
								<label>Fees (PM) </label>
								<div class="finp">
									<input type="text" class="fcontrol" name="fees" value="<?php echo $row->fees; ?>">
								</div>
							</div>
						<?php } ?>
						<input class="btn btn-primary" type="submit" name="submit" value="Update">
				</div>
				</form>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>
</body>
</html>