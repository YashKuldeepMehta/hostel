<?php
session_start();
include('includes/config.php');
$pwd = "";
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $stmt = $mysqli->prepare("SELECT email, contactNo, password FROM userregistration WHERE (email=? && contactNo=?) ");
    $stmt->bind_param('ss', $email, $contact);
    $stmt->execute();
    $stmt->bind_result($username, $email, $password);
    $rs = $stmt->fetch();
    if ($rs) {
        $pwd = $password;				
    } else {
        echo "<script>alert('Invalid Email/Contact no or password');</script>";
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>User Forgot Password</title>
    <link  rel="stylesheet" href="css/forgot-password.css">	
</head>
<body>
    <div class="fcontent">
        <h1>Forgot Password</h1>
        <?php if($pwd != null) { ?>
            <div class="password-display">Your Password is <?php echo $pwd;?><br>Change the Password After login</div>
        <?php } ?>
        <form action="" method="post">
            <label for="email">Your Email</label>
            <input type="email" placeholder="Email" name="email" id="email" required>

            <label for="contact">Your Contact no</label>
            <input type="text" placeholder="Contact no" name="contact" id="contact" required>

            <input type="submit" name="login" value="Login">
        </form>
        <a href="index.php" class="sign-in-link">Sign in?</a>
    </div>
</body>
</html>
