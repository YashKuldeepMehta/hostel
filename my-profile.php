<?php
session_start();
include('includes/config.php');
date_default_timezone_set('Asia/Kolkata');
if (isset($_SESSION['id'])) {

} else {
    header("Location:index.php");
}
$aid = $_SESSION['id'];
if (isset($_POST['update'])) {
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $udate = date('d-m-Y h:i:s', time());
    $query = "update  userregistration set regNo=?,firstName=?,middleName=?,lastName=?,gender=?,contactNo=?,updationDate=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssisi', $regno, $fname, $mname, $lname, $gender, $contactno, $udate, $aid);
    $stmt->execute();
    echo "<script>alert('Profile updated Succssfully');</script>";
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
    <title>Profile Updation</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/my-profile.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <?php include('includes/sidebar.php'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php
            $aid = $_SESSION['id'];
            $ret = "select * from userregistration where id=?";
            $stmt = $mysqli->prepare($ret);
            $stmt->bind_param('i', $aid);
            $stmt->execute();
            $res = $stmt->get_result();
            while ($row = $res->fetch_object()) {
                ?>
                <h2 class="page-title" style="margin-top:40px;"><?php echo $row->firstName; ?>'s&nbsp;Profile</h2>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Last Updation date : &nbsp; <?php echo $row->updationDate; ?>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="registration" class="fhorizon" onSubmit="return valid();">
                            <div class="fgroup">
                                <label> Registration No : </label>
                                <input type="text" name="regno" id="regno" class="fcontrol" required="required"
                                    value="<?php echo $row->regNo; ?>">
                            </div>
                            <div class="fgroup">
                                <label>First Name : </label>
                                <input type="text" name="fname" id="fname" class="fcontrol"
                                    value="<?php echo $row->firstName; ?>" required="required">
                            </div>
                            <div class="fgroup">
                                <label>Middle Name : </label>
                                <input type="text" name="mname" id="mname" class="fcontrol"
                                    value="<?php echo $row->middleName; ?>">
                            </div>
                            <div class="fgroup">
                                <label>Last Name : </label>
                                <input type="text" name="lname" id="lname" class="fcontrol"
                                    value="<?php echo $row->lastName; ?>" required="required">
                            </div>
                            <div class="fgroup">
                                <label>Gender : </label>
                                <select name="gender" class="fcontrol" required="required">
                                    <option value="<?php echo $row->gender; ?>"><?php echo $row->gender; ?></option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="fgroup">
                                <label>Contact No : </label>
                                <input type="text" name="contact" id="contact" class="fcontrol" maxlength="10"
                                    value="<?php echo $row->contactNo; ?>" required="required">
                            </div>
                            <div class="fgroup">
                                <label>Email id: </label>
                                <input type="email" name="email" id="email" class="fcontrol"
                                    value="<?php echo $row->email; ?>" readonly>
                                <span id="user-availability-status" style="font-size:12px;"></span>
                            </div>
                            <div class="fgroup">
                                <input type="submit" name="update" Value="Update Profile" class="btn">
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
</body>

</html>