<?php
session_start();
include('includes/config.php');

if (isset($_SESSION['id'])) {

} else {
	header("Location:index.php");
}

if (isset($_GET['del'])) {
	$id = intval($_GET['del']);
	$adn = "delete from courses where id=?";
	$stmt = $mysqli->prepare($adn);
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->close();
	echo "<script>alert('Data Deleted');</script>";
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
	<title>Manage Courses</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/header_and_sidebar.css">
	<link rel="stylesheet" href="css/manage-courses.css">

</head>

<body>
	<?php include('includes/header.php'); ?>


	<?php include('includes/sidebar.php'); ?>
	<div class="content-wrapper">
		<div class="container-fluid">
			<h2 class="page-title" style="margin-top:50px;">Manage Course</h2>
			<div class="panel panel-default">
				<div class="panel-heading">All Courses Details</div>
				<div class="panel-body">
					Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name"
						style="margin-bottom:10px;">
					<table id="zctb" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Sno.</th>
								<th>Course Code</th>
								<th>Course Name(Short)</th>
								<th>Course Name(Full)</th>
								<th>Reg Date </th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Sl No</th>
								<th>Course Code</th>
								<th>Course Name(Short)</th>
								<th>Course Name(Full)</th>
								<th>Regd Date</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody id="mytab">
							<?php
							$aid = $_SESSION['id'];
							$ret = "select * from courses";
							$stmt = $mysqli->prepare($ret);
							$stmt->execute();
							$res = $stmt->get_result();
							$cnt = 1;
							while ($row = $res->fetch_object()) {
								?>
								<tr>
									<td><?php echo $cnt;
									; ?></td>
									<td><?php echo $row->course_code; ?></td>
									<td><?php echo $row->course_sn; ?></td>
									<td><?php echo $row->course_fn; ?></td>
									<td><?php echo $row->posting_date; ?></td>
									<td><a href="edit-course.php?id=<?php echo $row->id; ?>"><i
												class="fa fa-edit"></i></a>&nbsp;&nbsp;
										<a href="manage-courses.php?del=<?php echo $row->id; ?>"
											onclick="return confirm('Do you want to delete');"><i
												class="fa fa-close"></i></a>
									</td>
								</tr>
								<?php
								$cnt = $cnt + 1;
							} ?>


						</tbody>
					</table>


				</div>
			</div>
		</div>
	</div>


	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>
	<script src="js/search-bar.js"></script>



</body>

</html>