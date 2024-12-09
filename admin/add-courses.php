<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){
}
else{
    header("Location:index.php");
}
if(isset($_POST['submit']))
{
$coursecode=$_POST['cc'];
$coursesn=$_POST['cns'];
$coursefn=$_POST['cnf'];
$query="insert into  courses (course_code,course_sn,course_fn) values(?,?,?)";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('sss',$coursecode,$coursesn,$coursefn);
$stmt->execute();
echo"<script>alert('Course has been added successfully');</script>";
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
	<title>Add Courses</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/add-courses.css">
</head>

<body>
	<?php include('includes/header.php'); ?>
		<?php include('includes/sidebar.php'); ?>
		<div class="content-wrapper">
				<h2 class="page-title">Add Courses</h2>
				<div class="panel">
					<div class="panel-heading">Add Courses</div>
					<div class="panel-body">
						<form method="post" class="fhorizon">
							<div class="fgroup">
								<label for="cc">Course Code</label>
								<input type="text" name="cc" id="cc">
							</div>
							<div class="fgroup">
								<label for="cns">Course Name (Short)</label>
								<input type="text" name="cns" id="cns" required>
							</div>
							<div class="fgroup">
								<label for="cnf">Course Name (Full)</label>
								<input type="text" name="cnf" id="cnf">
							</div>
							<div class="fsubmit">
								<input type="submit" name="submit" value="Add course">
							</div>
						</form>
					</div>
				</div>		
		</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>
</body>
</html>
