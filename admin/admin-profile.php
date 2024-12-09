<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){}
else{
    header("Location:index.php");
}
if(isset($_POST['changemail']))
{
$email=$_POST['emailid'];
$aid=$_SESSION['id'];
$udate=date('Y-m-d');
$query="update admin set email=?,updation_date=? where id=?";
$stmt = $mysqli->prepare($query);
$rc=$stmt->bind_param('ssi',$email,$udate,$aid);
$stmt->execute();
echo"<script>alert('Email id has been successfully updated');</script>";
}
if(isset($_POST['changepwd']))
{
  $op=$_POST['oldpassword'];
  $np=$_POST['newpassword'];
$ai=$_SESSION['id'];
$udate=date('Y-m-d');
	$sql="SELECT password FROM admin where password=?";
	$chngpwd = $mysqli->prepare($sql);
	$chngpwd->bind_param('s',$op);
	$chngpwd->execute();
	$chngpwd->store_result(); 
    $row_cnt=$chngpwd->num_rows;
	if($row_cnt>0)
	{
		$con="update admin set password=?,updation_date=?  where id=?";
$chngpwd1 = $mysqli->prepare($con);
$chngpwd1->bind_param('ssi',$np,$udate,$ai);
  $chngpwd1->execute();
		$_SESSION['msg']="Password Changed Successfully !!";
	}
	else
	{
		$_SESSION['msg']="Old Password not match !!";
	}	
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>Admin Profile</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
	<link rel="stylesheet" href="css/admin-profile.css">
</head>
<body>
<body>
    <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container">
                <div class="custom-row">
                    <div class="colfull">
                        <h2 class="page-title">Admin Profile</h2>
                        <?php
                        $aid = $_SESSION['id'];
                        $ret = "SELECT * FROM admin WHERE id=?";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->bind_param('i', $aid);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        while ($row = $res->fetch_object()) {
                        ?>
                            <div class="custom-row">
                                <div class="colhalf">
                                    <div class="panel">
                                        <div class="panel-heading">Admin profile details</div>
                                        <div class="panel-body">
                                            <form method="post" class="fhorizon" id="profile-form" onsubmit="return validProfile();">
                                                <div class="fgroup">
                                                    <label>Username</label>
                                                    <input type="text" value="<?php echo $row->username; ?>" disabled>
                                                    <span class="help-text">Username can't be changed.</span>
                                                </div>
                                                <div class="fgroup">
                                                    <label>Email</label>
                                                    <input type="email" name="emailid" id="emailid" value="<?php echo $row->email; ?>" required>
                                                    <span id="email-status" class="error-message"></span>
                                                </div>
                                                <div class="fgroup">
                                                    <label>Reg Date</label>
                                                    <input type="text" value="<?php echo $row->reg_date; ?>" disabled>
                                                </div>

                                                <div class="btngrp">
                                                    <button type="submit" class="btn-cancel">Cancel</button>
                                                    <input type="submit" name="changemail" value="Update Profile" class="btn-submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="colhalf">
                                    <div class="panel">
                                        <div class="panel-heading">Change Password</div>
                                        <div class="panel-body">
                                            <form method="post" name="changepwd" id="change-pwd" onsubmit="return validPassword();">
                                            <?php if (isset($_POST['changepwd'])) { ?>
                            <p style="color: red">
                                <?php echo htmlentities($_SESSION['msg']); ?> 
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </p>
                        <?php } ?>
                                          
                                                <div class="fgroup">
                                                    <label>Old Password</label>
                                                    <input type="password" name="oldpassword" id="oldpassword"  onBlur="checkpass()" required>
                                                    <span id="password-availability-status" class="error-message"></span>
                                                </div>
                                                <div class="fgroup">
                                                    <label>New Password</label>
                                                    <input type="password" name="newpassword" id="newpassword" required>
                                                    <span id="new-password-status" class="error-message"></span>
                                                </div>
                                                <div class="fgroup">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="cpassword" id="cpassword" required>
                                                    <span id="confirm-password-status" class="error-message"></span>
                                                </div>

                                                <div class="btngrp">
                                                    <button type="button" class="btn-cancel">Cancel</button>
                                                    <input type="submit" name="changepwd" value="Change Password" class="btn-submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
	<script src="js/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
<script>
const emailInput = document.getElementById('emailid');
const emailStatus = document.getElementById('email-status');

emailInput.addEventListener('input', function () {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(emailInput.value)) {
        emailStatus.textContent = "Invalid email address!";
        emailStatus.style.color = "red";
    } else {
        emailStatus.textContent = "Valid email.";
        emailStatus.style.color = "green";
    }
});

const passwordInput = document.getElementById('newpassword');
const newPasswordStatus = document.getElementById('new-password-status');

passwordInput.addEventListener('input', function () {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#^])[A-Za-z\d@$!%*?&#^]{8,}$/;

    if (regex.test(passwordInput.value)) {
        newPasswordStatus.textContent = "Password is strong.";
        newPasswordStatus.style.color = "green";
    } else {
        newPasswordStatus.textContent = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special symbol.";
        newPasswordStatus.style.color = "red";
    }
});
const confirmPasswordInput = document.getElementById('cpassword');
const confirmPasswordStatus = document.getElementById('confirm-password-status');
confirmPasswordInput.addEventListener('input', function () {
    if (passwordInput.value === confirmPasswordInput.value) {
        confirmPasswordStatus.textContent = "Passwords match.";
        confirmPasswordStatus.style.color = "green";
    } else {
        confirmPasswordStatus.textContent = "Passwords do not match!";
        confirmPasswordStatus.style.color = "red";
    }
});
function validProfile() {
    const emailValid = emailStatus.textContent === "Valid email.";
    if (!emailValid) {
        alert("Please correct the email address.");
        return false;
    }
    return true;
}
function validPassword() {
    const newPasswordValid = newPasswordStatus.textContent === "Password is strong.";
    const passwordsMatch = confirmPasswordStatus.textContent === "Passwords match.";

    if (!newPasswordValid) {
        alert("Please enter a strong password.");
        return false;
    }

    if (!passwordsMatch) {
        alert("Password and Confirm Password do not match!");
        return false;
    }
    return true;
}
</script>	
<script>
function checkpass() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'oldpassword='+$("#oldpassword").val(),
type: "POST",
success:function(data){
$("#password-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</body>
</html>
	
