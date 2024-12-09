<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){
}
else{
    header("Location:index.php");
}
$_SESSION['msg'] ='';
if(isset($_POST['submit']))
{
    $seater=$_POST['seater'];
    $roomno=$_POST['rmno'];
    $fees=$_POST['fee'];
    $sql="SELECT room_no FROM rooms where room_no=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('i',$roomno);
    $stmt1->execute();
    $stmt1->store_result(); 
    $row_cnt=$stmt1->num_rows;;
    if($row_cnt>0)
    {
        echo"<script>alert('Room already exist');</script>";
    }
    else
    {
        $query="insert into  rooms (seater,room_no,fees) values(?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc=$stmt->bind_param('iii',$seater,$roomno,$fees);
        $stmt->execute();
        echo"<script>alert('Room has been added successfully');</script>";
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>Create Room</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/create-room.css">
</head>
<body>
    <?php include('includes/header.php');?>
        <?php include('includes/sidebar.php');?>
        <div class="content-wrapper">
            <h2 class="page-title">Add a Room</h2>
            <div class="panel">
                <div class="panel-heading">Add a Room</div>
                <div class="panel-body">
                    <?php if(isset($_POST['submit'])) { ?>
                        <p class="msg"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg']=""); ?></p>
                    <?php } ?>
                    <form method="post" class="fhorizon">
                        <div class="fgroup">
                            <label>Select Seater:</label>
                          <select name="seater" required>
                                <option value="">Select Seater</option>
                                <option value="1">Single Seater</option>
                                <option value="2">Two Seater</option>
                                <option value="3">Three Seater</option>
                                <option value="4">Four Seater</option>
                                <option value="5">Five Seater</option>
                            </select>
                        </div>
                        <div class="fgroup">
                            <label>Room No:</label>
                            <input type="text" name="rmno" id="rmno" required="required">
                        </div>
                        <div class="fgroup">
                            <label>Fee (Per Student):</label>
                            <input type="text" name="fee" id="fee" required="required">
                        </div>
                        <div class="fsubmit">
								<input type="submit" name="submit" value="Add Room">
							</div>
                    </form>
                </div>
            </div>
        </div>
	<script src="js/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
</body>
</html>
