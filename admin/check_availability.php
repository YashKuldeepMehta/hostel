<?php 
session_start();
$aid=$_SESSION['id'];
require_once("includes/config.php");


if (!empty($_POST["emailid"])) {
    $email = $_POST["emailid"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error: You did not enter a valid email.";
    } else {
        $query = "SELECT count(*) FROM userRegistration WHERE email = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            if ($count > 0) {
                echo "<span style='color:red'> Email already exists.</span>";
            } else {
                echo "<span style='color:green'> Email available for registration.</span>";
            }
        } else {
            echo "error: Could not prepare SQL statement.";
        }
    }
}

if(!empty($_POST["roomno"])) 
{
$roomno=$_POST["roomno"];
$result ="SELECT count(*) FROM registration WHERE roomno=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('i',$roomno);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
if($count>0)
echo "<span style='color:red'>$count. Seats already full.</span>";
else
	echo "<span style='color:red'>All Seats are Available</span>";
}

if(!empty($_POST["oldpassword"])) 
{
$pass=$_POST["oldpassword"];
$result ="SELECT password FROM admin WHERE password=?";
$stmt = $mysqli->prepare($result);
$stmt->bind_param('s',$pass);
$stmt->execute();
$stmt -> bind_result($result);
$stmt -> fetch();
$opass=$result;
if($opass==$pass) 
echo "<span style='color:green'> Password  matched .</span>";
else echo "<span style='color:red'> Password Not matched</span>";
}
?>
