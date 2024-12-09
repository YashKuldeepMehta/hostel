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
	<title>DashBoard</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
</head>

<body>
<?php include("includes/header.php");?>
    <?php include("includes/sidebar.php");?>
        <div class="custom-container">
            <h2 class="page-title" style="margin-top:40px;">Dashboard</h2>
            <div class="custom-row">
                <div class="custom-col-half-width">
                    <div class="custom-panel">
                        <div class="panel-body">
                               <div class="h1">My Profile</div>  
                        </div>
                        <a href="my-profile.php" class="custom-panel-footer">Full Details <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="custom-col-half-width">
                    <div class="custom-panel">
                        <div class="panel-body">  
                                <div class="h1">My Room</div>   
                        </div>
                        <a href="room-details.php" class="custom-panel-footer">See All <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
	<script src="js/jquery.min.js"></script>
</body>
</html>
