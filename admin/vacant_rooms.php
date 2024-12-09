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
	<title>Vacant Rooms</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/vacant_rooms.css">
</head>
<body>
	<?php include('includes/header.php');?>
			<?php include('includes/sidebar.php');?>
		<div class="content-wrapper">
						<h2 class="page-title" style="margin-top:50px;">Vacant Rooms</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Vacant Room Details</div>
							<div class="panel-body">
							Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name" style="margin-bottom:10px;">
								<table id="zctb"  cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Sno.</th>
											<th>Seater</th>
											<th>Room No.</th>
											<th>Fees (PM) </th>
											<th>Posting Date</th>
											
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Sno.</th>
											<th>Seater</th>
											<th>Room No.</th>
											<th>Fees (PM) </th>
											<th>Posting Date  </th>
										</tr>
									</tfoot>
									<tbody id="mytab">
    <?php
        $sql ="SELECT r.id, r.seater, r.room_no, r.fees, r.posting_date
        FROM rooms r
        LEFT JOIN registration b ON r.room_no = b.roomno
        WHERE b.roomno IS NULL
        ORDER BY r.room_no";

        $stmt= $mysqli->prepare($sql) ;
        $stmt->execute() ;
        $res=$stmt->get_result();
        $cnt=1;
        if($res->num_rows > 0){
            while($row = $res->fetch_object()){
            ?>
<tr><td><?php echo $cnt;?></td>
<td><?php echo $row->seater;?></td>
<td><?php echo $row->room_no;?></td>
<td><?php echo $row->fees;?></td>
<td><?php echo $row->posting_date;?></td>
										</tr>
                                        <?php
$cnt=$cnt+1;
									 } 
                                    }
                                    else{
                                        echo "<h3>No rooms are Vacants!!</h3>";
                                    }?>
									</tbody>
								</table>
							</div>
						</div>				
		</div>
	<script src="js/search-bar.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/sidebar.js"></script>
</body>
</html>

