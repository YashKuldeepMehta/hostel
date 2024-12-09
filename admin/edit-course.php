<?php
session_start();
include('includes/config.php');

if(isset($_SESSION['id'])){

}
else{
    header("Location:index.php");
}
if (isset($_POST['submit'])) {
	$coursecode = $_POST['cc'];
	$coursesn = $_POST['cns'];
	$coursefn = $_POST['cnf'];
	$id = $_GET['id'];
	$query = "update courses set course_code=?,course_sn=?,course_fn=? where id=?";
	$stmt = $mysqli->prepare($query);
	$rc = $stmt->bind_param('sssi', $coursecode, $coursesn, $coursefn, $id);
	$stmt->execute();
	echo "<script>alert('Course has been Updated successfully');</script>";
}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<title>Edit Course</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header_and_sidebar.css">
	<link rel="stylesheet" href="css/edit-course.css">
</head>
<body>
	<?php include('includes/header.php'); ?>
		<?php include('includes/sidebar.php'); ?>
		<div class="content-wrapper">
			<div class="container-fluid">
						<h2 class="page-title">Edit Course Details</h2>
								<div class="panel panel-default">
									<div class="panel-heading">Edit courses</div>
									<div class="panel-body">
										<form method="post" class="fhorizon">
											<?php
											$id = $_GET['id'];
											$ret = "select * from courses where id=?";
											$stmt = $mysqli->prepare($ret);
											$stmt->bind_param('i', $id);
											$stmt->execute();
											$res = $stmt->get_result();
											while ($row = $res->fetch_object()) {
												?>
												<div class="fgroup">
													<label>Course Code </label>
													<div class="finp">
														<input type="text" name="cc" value="<?php echo $row->course_code; ?>"
															class="fcontrol">
													</div>
												</div>
												<div class="fgroup">
													<label>Course Name (Short)</label>
													<div class="finp">
														<input type="text" class="fcontrol" name="cns" id="cns"
															value="<?php echo $row->course_sn; ?>" required="required">
													</div>
												</div>
												<div class="fgroup">
													<label>Course Name(Full)</label>
													<div class="finp">
														<input type="text" class="fcontrol" name="cnf"
															value="<?php echo $row->course_fn; ?>">
													</div>
												</div>
											<?php } ?>
												<input class="btn btn-primary" type="submit" name="submit"
													value="Update Course">							
									</div>
									</form>
								</div>
			</div>
		</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>
</body>
</html>