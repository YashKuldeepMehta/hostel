<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){}
else{
    header("Location:index.php");
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>DashBoard</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
	<link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<?php include("includes/header.php");?>
<div class="ts-main-content">
	<?php include("includes/sidebar.php");?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="column-full">
					<h2 class="page-title" style="margin-top:50px;">Dashboard</h2>
					<div class="row">
						<div class="column-full">
							<div class="row">
								<div class="column-quarter">
									<div class="panel panel-default">
										<div class="panel-body primary-bg text-light">
											<div class="stat-panel text-center">
												<?php
												$result ="SELECT count(*) FROM registration ";
												$stmt = $mysqli->prepare($result);
												$stmt->execute();
												$stmt->bind_result($count);
												$stmt->fetch();
												$stmt->close();
												?>
												<div class="stat-panel-number h1"><?php echo $count;?></div>
												<div class="stat-panel-title" style="text-transform:uppercase;"> Students</div>
											</div>
										</div>
										<a href="manage-students.php" class="block-anchor panel-footer" style="color:black;">Full Detail <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
								<div class="column-quarter">
									<div class="panel panel-default">
										<div class="panel-body success-bg text-light">
											<div class="stat-panel text-center">
												<?php
												$result1 ="SELECT count(*) FROM rooms ";
												$stmt1 = $mysqli->prepare($result1);
												$stmt1->execute();
												$stmt1->bind_result($count1);
												$stmt1->fetch();
												$stmt1->close();
												?>
												<div class="stat-panel-number h1"><?php echo $count1;?></div>
												<div class="stat-panel-title" style="text-transform:uppercase;">Total Rooms </div>
											</div>
										</div>
										<a href="manage-rooms.php" class="block-anchor panel-footer text-center" style="color:black;">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
								<div class="column-quarter">
									<div class="panel panel-default">
										<div class="panel-body info-bg text-light">
											<div class="stat-panel text-center">
												<?php
												$result2 ="SELECT count(*) FROM courses ";
												$stmt2 = $mysqli->prepare($result2);
												$stmt2->execute();
												$stmt2->bind_result($count2);
												$stmt2->fetch();
												$stmt2->close();
												?>
												<div class="stat-panel-number h1"><?php echo $count2;?></div>
												<div class="stat-panel-title" style="text-transform:uppercase;">Total Courses</div>
											</div>
										</div>
										<a href="manage-courses.php" class="block-anchor panel-footer text-center" style="color:black;">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>
</body>
</html>
