<?php
session_start();
include('includes/config.php');

if(isset($_SESSION['id'])){

}
else{
    header("Location:index.php");
}

if(isset($_GET['del']))
{
	$id=intval($_GET['del']);
	$adn="delete from rooms where id=?";
		$stmt= $mysqli->prepare($adn);
		$stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	   
        echo "<script>alert('Data Deleted');</script>" ;
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
	<title>Manage Rooms</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/manage-rooms.css">
</head>

<body>
	<?php include('includes/header.php');?>
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
						<h2 class="page-title" style="margin-top:50px;">Manage Rooms</h2>
						<div class="panel panel-default">
							<div class="panel-heading">All Room Details</div>
							<div class="panel-body">
							Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name" style="margin-bottom:10px;">
								<table id="zctb"  cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Seater</th>
											<th>Room No.</th>
											<th>Fees (PM) </th>
											<th>Posting Date  </th>
											<th>Status</th>
											<th>Action</th>			
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Seater</th>
											<th>Room No.</th>
											<th>Fees (PM) </th>
											<th>Posting Date  </th>
											<th>Status</th>
											<th>Action</th>		
										</tr>
									</tfoot>
									<tbody id="mytab">
<?php	

$sql = "SELECT rooms.id, rooms.room_no, rooms.seater, rooms.fees, rooms.posting_date, 
        registration.roomno AS booked_roomno
        FROM rooms
        LEFT JOIN registration ON rooms.room_no = registration.roomno";
$stmt= $mysqli->prepare($sql) ;
$stmt->execute() ;
$res=$stmt->get_result();
$cnt=1;
if($res->num_rows > 0){
while($row=$res->fetch_object())
	  {
		$status = $row->booked_roomno ? "Booked" : "Vacant";
	  	?>
<tr><td><?php echo $cnt;;?></td>
<td><?php echo $row->seater;?></td>
<td><?php echo $row->room_no;?></td>
<td><?php echo $row->fees;?></td>
<td><?php echo $row->posting_date;?></td>
<td><?php echo $status;?></td>
<td><a href="edit-room.php?id=<?php echo $row->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="manage-rooms.php?del=<?php echo $row->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
										</tr>
									<?php
$cnt=$cnt+1;
									 } 
									}?>	
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
