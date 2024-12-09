<?php
session_start();
include('includes/config.php');
date_default_timezone_set('Asia/Kolkata');

if (isset($_SESSION['id'])) {

} else {
    header("Location:index.php");
}

$ai = $_SESSION['id'];
if (isset($_POST['changepwd'])) {
    $op = $_POST['oldpassword'];
    $np = $_POST['newpassword'];
    $udate = date('d-m-Y h:i:s', time());
    $sql = "SELECT password FROM userregistration where password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('s', $op);
    $chngpwd->execute();
    $chngpwd->store_result();
    $row_cnt = $chngpwd->num_rows;
    if ($row_cnt > 0) {
        $con = "update userregistration set password=?,passUdateDate=? where id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('ssi', $np, $udate, $ai);
        $chngpwd1->execute();
        $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
        $_SESSION['msg'] = "Old Password not match !!";
    }
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
    <title>Change Password</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/change-password.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <h2 class="page-title" style="margin-top:45px;">Change Password</h2>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?php
                    $result = "SELECT passUdateDate FROM userregistration WHERE id=?";
                    $stmt = $mysqli->prepare($result);
                    $stmt->bind_param('i', $ai);
                    $stmt->execute();
                    $stmt->bind_result($result);
                    $stmt->fetch();
                    ?>
                    Last Updation Date:&nbsp;<?php echo $result; ?>
                </div>
                <div class="panel-body">
                    <form method="post" class="fhorizon" name="changepwd" id="change-pwd"
                        onSubmit="return validateForm();">
                        <?php if (isset($_POST['changepwd'])) { ?>
                            <p style="color: red">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </p>
                        <?php } ?>

                        <div class="fgroup">
                            <label>Old Password:</label>
                            <input type="password" value="" name="oldpassword" id="oldpassword" class="fcontrol"
                                onBlur="checkpass()" required="required">
                            <span id="password-availability-status" class="error-message"></span>
                        </div>

                        <div class="fgroup">
                            <label>New Password:</label>
                            <input type="password" class="fcontrol" name="newpassword" id="newpassword" value=""
                                required="required" oninput="checkNewPassword() ">
                            <span id="new-password-status" style="font-size:12px;color:red;"></span>
                        </div>

                        <div class="fgroup">
                            <label>Confirm Password:</label>
                            <input type="password" class="fcontrol" value="" required="required" id="cpassword"
                                name="cpassword" oninput="checkConfirmPassword()">
                            <span id="confirm-password-status" style="font-size:12px;color:red;"></span>
                        </div>

                        <div class="fgroup btngrp">
                            <button class="btn-cancel" type="submit">Cancel</button>
                            <input type="submit" name="changepwd" Value="Change Password" class="btn-change">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script>
        function checkNewPassword() {
            const pass = document.getElementById('newpassword').value;
            const feedback = document.getElementById('new-password-status');
            const passCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#^])[A-Za-z\d@$!%*?&#^]{8,}$/;

            if (passCriteria.test(pass)) {
                feedback.textContent = "Password strength is good.";
                feedback.style.color = "green";
            } else {
                feedback.textContent = "Password should have at least one uppercase letter, one lowercase letter, one number, and a special character.";
                feedback.style.color = "red";
            }
        }

        function checkConfirmPassword() {
            const pass = document.getElementById('newpassword').value;
            const confirmpass = document.getElementById('cpassword').value;
            const feedback = document.getElementById('confirm-password-status');

            if (pass === confirmpass) {
                feedback.textContent = "Passwords are matching.";
                feedback.style.color = "green";
            } else {
                feedback.textContent = "Passwords do not match!";
                feedback.style.color = "red";
            }
        }

        function validateForm() {
            const pass = document.getElementById('newpassword').value;
            const confirmpass = document.getElementById('cpassword').value;
            const passFeedback = document.getElementById('new-password-status').textContent;
            const confirmpassFeedback = document.getElementById('confirm-password-status').textContent;

            const passCriteria = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#^])[A-Za-z\d@$!%*?&#^]{8,}$/;
            if (!passCriteria.test(pass)) {
                alert("Your new password does not meet the required conditions.");
                document.changepwd.newpassword.focus();
                return false;
            }

            if (pass !== confirmpass) {
                alert("The passwords do not match.");
                document.changepwd.cpassword.focus();
                return false;
            }

            if (passFeedback !== "Password strength is good." || confirmpassFeedback !== "Passwords are matching.") {
                alert("Please fix the errors before submitting.");
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
                data: 'oldpassword=' + $("#oldpassword").val(),
                type: "POST",
                success: function (data) {
                    $("#password-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }
    </script>
</body>
</html>