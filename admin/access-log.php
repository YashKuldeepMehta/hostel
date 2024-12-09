<?php
session_start();
include('includes/config.php');

if(isset($_SESSION['id'])){

}
else{
    header("Location:index.php");
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
	<title>Access Log</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/access-log.css">

</head>

<body>
	<?php include('includes/header.php');?>
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
						<h2 class="page-title" style="margin-top:50px;">Access Log</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Access Details</div>
							<div class="panel-body">
							
Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name" style="margin-bottom:10px;">
								<table id="zctb"  cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>User Id</th>
											<th>User Email</th>
											<th>IP</th>
											<th>Login Time</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>User Id</th>
											<th>User Email</th>
											<th>IP</th>
											<th>Login Time</th>
										</tr>
									</tfoot>
									<tbody id="mytab">
<?php	
$aid=$_SESSION['id'];
$ret="select * from userlog";
$stmt= $mysqli->prepare($ret) ;

$stmt->execute() ;
$res=$stmt->get_result();
$cnt=1;
while($row=$res->fetch_object())
	  {
	  	?>
<tr><td><?php echo $cnt;;?></td>
<td><?php echo $row->userId;?></td>
<td><?php echo $row->userEmail;?></td>
<td><?php echo $row->userIp;?></td>
<td><?php echo $row->loginTime;?></td>
										</tr>
									<?php
$cnt=$cnt+1;
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
