<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){

}
else{
    header("Location:index.php");
}
$studentId = intval(value: $_GET['edit']);
$query10 = "SELECT * FROM registration WHERE id=?";
$stmt10 = $mysqli->prepare( $query10);
$stmt10->bind_param('i', $studentId);
$stmt10->execute();
$result10 = $stmt10->get_result();
$row2 = $result10->fetch_object(); 

if (!$row2) {
    echo "<script>alert('No student record found. Redirecting back.');</script>";
    echo "<script>window.location.href='manage-students.php'</script>";
    exit();
}
if (isset($_POST['update'])) {
   
    $roomno = $_POST['room'];
    $seater = $_POST['seater'];
    $feespm = $_POST['fpm'];
    $foodstatus = $_POST['foodstatus'];
    $stayfrom = $_POST['stayf'];
    $duration = $_POST['duration'];
    $course = $_POST['course'];
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $emcntno = $_POST['econtact'];
    $gurname = $_POST['gname'];
    $gurrelation = $_POST['grelation'];
    $gurcntno = $_POST['gcontact'];
    $caddress = $_POST['address'];
    $ccity = $_POST['city'];
    $cstate = $_POST['state'];
    $cpincode = $_POST['pincode'];
    $paddress = $_POST['paddress'];
    $pcity = $_POST['pcity'];
    $pstate = $_POST['pstate'];
    $ppincode = $_POST['ppincode'];
    $ta = $_POST['ta'];

    $query = "UPDATE registration SET roomno=?, seater=?, feespm=?, foodstatus=?, stayfrom=?, duration=?, totalamt=? ,course=?, regno=?, firstName=?, middleName=?, lastName=?, gender=?, contactno=?, emailid=?, egycontactno=?, guardianName=?, guardianRelation=?, guardianContactno=?, corresAddress=?, corresCIty=?, corresState=?, corresPincode=?, pmntAddress=?, pmntCity=?, pmnatetState=?, pmntPincode=? WHERE id=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iiiisiisissssisississsisssii', $roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $ta, $course, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurrelation, $gurcntno, $caddress, $ccity, $cstate, $cpincode, $paddress, $pcity, $pstate, $ppincode, $studentId);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Student details updated successfully');</script>";
    echo "<script>window.location.href='manage-students.php'</script>";
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
    <title>Student Hostel Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/edit-students.css">

    <script>
    function calculateTotalAmount() {
    const feespm = parseFloat(document.getElementById("fpm").value) || 0;
    const duration = parseFloat(document.getElementById("duration").value) || 0;
    const foodstatus = document.querySelector('input[name="foodstatus"]:checked').value;
    let totalAmount = feespm * duration;
    if (foodstatus == "1") {
        totalAmount += 2000;
    }
    document.getElementById("ta").value = totalAmount.toFixed(2);
}
     </script> 
</head>
    <body>
    <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
                        <h2 class="page-title">Edit Student Details </h2>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Fill all Info</div>
                                    <div class="panel-body">
                                        <form method="post" action="" class="fhorizon"  onsubmit="return validateForm();" id="registrationForm">
                                            <div class="fgroup">
                                                    <h4 style="color: green" align="left">Room Related Info </h4> 
                                            </div>
                                            <div class="fgroup">
                                                <label>Room No. </label>
                                                    <select name="room" id="room" class="fcontrol"
                                                        onChange="getSeater(this.value);" onBlur="checkAvailability()" value="<?php echo $row2->roomno;?>"  required>
                                                        <option value="">Select Room</option>
                                                        <?php
                                                        $query = "SELECT room_no FROM rooms WHERE room_no NOT IN (SELECT roomno FROM registration)";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            ?>
                                                            <option value="<?php echo $row->room_no; ?>">
                                                                <?php echo $row->room_no; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <span id="room-availability-status" style="font-size:12px;margin-top:10px;"></span>                            
                                            </div>
                                            <div class="fgroup">
                                                <label >Seater</label>
                                                    <input type="text" name="seater" id="seater" class="fcontrol" value="<?php echo $row2->seater;?>" >                                   
                                            </div>                             
                                            <div class="fgroup">
                                                <label >Fees Per Month</label>
                                                    <input type="text" name="fpm" id="fpm" class="fcontrol"  value="<?php echo $row2->feespm;?>" >                                    
                                            </div>
                                            <div class="fgroup">
                                                <label >Food Status</label>
                                                    <input type="radio" value="0" name="foodstatus" checked="checked"> Without Food
                                                  <input type="radio" value="1" name="foodstatus"> With Food (Rs 2000.00 Per Month Extra)                                            
                                            </div>
                                            <div class="fgroup">
                                                <label >Stay From</label>
                                                    <input type="date" name="stayf" id="stayf" class="fcontrol"  value="<?php echo $row2->stayfrom;?>">                                
                                            </div>
                                            <div class="fgroup">
                                                <label >Duration</label>
                                                    <select name="duration" id="duration" class="fcontrol" value="<?php echo $row2->duration;?>">
                                                        <option value="">Select Duration in Months</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>                                            
                                            </div>
                                            <div class="fgroup">
                                                <label >Total Amount</label>
                                                  <input type="text" name="ta" id="ta" class="fcontrol" value="<?php echo $row2->totalamt;?>" >                                               
                                            </div>
                                            <div class="fgroup">
                                                <label>
                                                    <h4 style="color: green" align="left">Personal Info</h4>
                                                </label>
                                            </div>
                                            <div class="fgroup">
                                                <label >Course</label>
                                                    <select name="course" id="course" class="fcontrol" required>
                                                        <option value="">Select Course</option>
                                                        <?php $query = "SELECT * FROM courses";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            ?>
                                                            <option value="<?php echo $row->course_fn; ?>">
                                                                <?php echo $row->course_fn; ?>&nbsp;&nbsp;(<?php echo $row->course_sn; ?>)
                                                            </option>
                                                        <?php } ?>
                                                    </select>                                            
                                            </div>
                                            <div class="fgroup">
                                                <label >Registration No</label>
                                                    <input type="text" name="regno" id="regno" class="fcontrol" value="<?php echo $row2->regno;?>" required>
                                                    <span id="regno-validation-status" style="font-size:12px;margin-top:10px;"></span>                                               
                                            </div>
                                            <div class="fgroup">
                                                <label >First Name</label>
                                                    <input type="text" name="fname" id="fname" class="fcontrol"  value="<?php echo $row2->firstName;?>" required>                                              
                                            </div>
                                            <div class="fgroup">
                                                <label >Middle Name</label>
                                                    <input type="text" name="mname" id="mname" class="fcontrol" value="<?php echo $row2->middleName;?>">                                               
                                            </div>
                                            <div class="fgroup">
                                                <label >Last Name</label>
                                                    <input type="text" name="lname" id="lname" class="fcontrol" value="<?php echo $row2->lastName;?>" required>                                              
                                            </div>
                                            <div class="fgroup">
                                                <label >Gender</label>
                                                    <select name="gender" class="fcontrol" required>
                                                        <option value="">Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="others">Others</option>
                                                    </select>                                              
                                            </div>
                                            <div class="fgroup">
                                                <label >Contact No</label>
                                                    <input type="text" name="contact" id="contact" class="fcontrol"  value="<?php echo $row2->contactno;?>" required>
                                                    <span id="contact-validation-status" style="font-size:12px;margin-top:10px;"></span>                                               
                                            </div>
                                            <div class="fgroup">
                                                <label >Email ID</label>
                                                    <input type="email" name="email" id="email" class="fcontrol" value="<?php echo $row2->emailid;?>" required>
                                                    <span id="email-validation-status" style="font-size:12px;margin-top:10px;"></span>                                              
                                            </div>
                                            <div class="fgroup">
                                                <label >Emergency Contact</label>
                                                    <input type="text" name="econtact" id="econtact" class="fcontrol" value="<?php echo $row2->egycontactno;?>" required>
                                                    <span id="econtact-validation-status" style="font-size:12px;margin-top:10px;"></span>                                              
                                            </div>
                                           <div class="fgroup">
                                                <label >Guardian Name</label>
                                                    <input type="text" name="gname" id="gname" class="fcontrol" value="<?php echo $row2->guardianName;?>" required>                                             
                                            </div>

                                            <div class="fgroup">
                                                <label >Guardian Relation</label>
                                                    <input type="text" name="grelation" id="grelation" class="fcontrol" value="<?php echo $row2->guardianRelation;?>" required>                                               
                                            </div>
                                           <div class="fgroup">
                                                <label >Guardian Contact No</label>
                                                    <input type="text" name="gcontact" id="gcontact" class="fcontrol" value="<?php echo $row2->guardianContactno;?>"  required>
                                                    <span id="gcontact-validation-status" style="font-size:12px;margin-top:10px;"></span>                                                
                                            </div>
                                            <div class="fgroup">
                                                <label>
                                                    <h4 style="color: green" align="left">Correspondense Address </h4>
                                                </label>
                                            </div>
                                            <div class="fgroup">
                                                <label >Address : </label>
                                                    <textarea rows="5" name="address" id="address" class="fcontrol"
                                                        required="required" ><?php echo $row2->corresAddress;?></textarea>                                                
                                            </div>

                                            <div class="fgroup">
                                                <label >City : </label>
                                                    <input type="text" name="city" id="city" class="fcontrol"
                                                        required="required" value="<?php echo $row2->corresCIty;?>">                                                
                                            </div>
                                            <div class="fgroup">
                                                <label >State :</label>
                                                    <select name="state" id="state" class="fcontrol" required>
                                                        <option value="">Select State</option>
                                                        <?php $query = "SELECT * FROM states";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            ?>
                                                            <option value="<?php echo $row->State; ?>">
                                                                <?php echo $row->State; ?></option>
                                                        <?php } ?>
                                                    </select>                                                
                                            </div>
                                            <div class="fgroup">
                                                <label >Pincode : </label>
                                                    <input type="text" name="pincode" id="pincode" class="fcontrol"
                                                        required="required" value="<?php echo $row2->corresPincode;?>">                                                
                                            </div>
                                            <div class="fgroup">
                                                <label>
                                                    <h4 style="color: green" align="left">Permanent Address </h4>
                                                </label>
                                            </div>
                                            <div class="fgroup">
                                                <label>Permanent Address same as
                                                    Correspondense address : </label>                                               
                                                    <input type="checkbox" id="adcheck" value="1" />                                               
                                            </div>
                                            <div class="fgroup">
                                                <label >Address : </label>
                                                    <textarea rows="5" name="paddress" id="paddress"
                                                        class="fcontrol" required="required"><?php echo $row2->pmntAddress;?></textarea>                                               
                                            </div>
                                            <div class="fgroup">
                                                <label >City : </label>
                                                    <input type="text" name="pcity" id="pcity" class="fcontrol"
                                                        required="required" value="<?php echo $row2->pmntCity;?>">                                               
                                            </div>
                                            <div class="fgroup">
                                                <label >State :</label>
                                                    <select name="pstate" id="pstate" class="fcontrol" required>
                                                        <option value="">Select State</option>
                                                        <?php $query = "SELECT * FROM states";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            ?>
                                                            <option value="<?php echo $row->State; ?>">
                                                                <?php echo $row->State; ?></option>
                                                        <?php } ?>
                                                    </select>                                              
                                            </div>
                                            <div class="fgroup">
                                                <label >Pincode : </label>
                                                    <input type="text" name="ppincode" id="ppincode"
                                                        class="fcontrol" required="required" value="<?php echo $row2->pmntPincode;?>">                                               
                                            </div>
                                            <div class="fgroup">
                                                <button class="btn btn-default" type="submit">Cancel</button>
                                                <input type="submit" name="update" Value="Register"
                                                    class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
        </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>  
    <script>
        function validateEmail() {
            const email = document.getElementById("email").value;
            const status = document.getElementById("email-validation-status");
            const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (regex.test(email)) {
                status.textContent = "Valid email.";
                status.style.color = "green";
                return true;
            } else {
                status.textContent = "Invalid email format.";
                status.style.color = "red";
                return false;
            }
        }
        function validateContactNumber(fieldId, statusId) {
            const contact = document.getElementById(fieldId).value;
            const status = document.getElementById(statusId);
            const regex = /^[0-9]{10}$/;

            if (regex.test(contact)) {
                status.textContent = "Valid contact number.";
                status.style.color = "green";
                return true;
            } else {
                status.textContent = "Contact number must be 10 digits long and contain only numbers.";
                status.style.color = "red";
                return false;
            }
        }
        function validateRegistrationNumber() {
            const regno = document.getElementById("regno").value;
            const status = document.getElementById("regno-validation-status");
            const regex = /^[a-zA-Z0-9]{8}$/;

            if (regex.test(regno)) {
                status.textContent = "Valid registration number.";
                status.style.color = "green";
                return true;
            } else {
                status.textContent = "Registration number must be exactly 8 alphanumeric characters.";
                status.style.color = "red";
                return false;
            }
        }
        function validateForm() {
            const isEmailValid = validateEmail();
            const isContactValid = validateContactNumber("contact", "contact-validation-status");
            const isEContactValid = validateContactNumber("econtact", "econtact-validation-status");
            const isGContactValid = validateContactNumber("gcontact", "gcontact-validation-status");
            const isRegnoValid = validateRegistrationNumber();

            if (!isEmailValid || !isContactValid || !isEContactValid || !isGContactValid || !isRegnoValid) {
                alert("Please correct the errors before submitting the form.");
                return false;
            }
            return true;
        }
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("email").addEventListener("input", validateEmail);

            document.getElementById("contact").addEventListener("input", function () {
                validateContactNumber("contact", "contact-validation-status");
            });
            document.getElementById("econtact").addEventListener("input", function () {
                validateContactNumber("econtact", "econtact-validation-status");
            });
            document.getElementById("gcontact").addEventListener("input", function () {
                validateContactNumber("gcontact", "gcontact-validation-status");
            });
            document.getElementById("regno").addEventListener("input", validateRegistrationNumber);

            document.getElementById("registrationForm").addEventListener("submit", function (e) {
                if (!validateForm()) {
                    e.preventDefault();  
                }
            });
        });

    $(document).ready(function () {
        $('#adcheck').click(function () {
            if ($(this).is(":checked")) {
                $('#paddress').val($('#address').val());
                $('#pcity').val($('#city').val());
                $('#pstate').val($('#state').val());
                $('#ppincode').val($('#pincode').val());
            } else {
                $('#paddress').val('');
                $('#pcity').val('');
                $('#pstate').val('');
                $('#ppincode').val('');
            }
        });
        $("#fpm, #duration").on('input', calculateTotalAmount);
    $('input[name="foodstatus"]').on('change', calculateTotalAmount);
    });
</script>

<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'roomno=' + $("#room").val(),
            type: "POST",
            success: function (data) {
                $("#room-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function () { }
        });
    }
        function getSeater(val) {
            $.ajax({
                type: "POST",
                url: "get_seater.php",
                data: 'roomid=' + val,
                success: function (data) {           
                    $('#seater').val(data);
                }
            });
            $.ajax({
                type: "POST",
                url: "get_seater.php",
                data: 'rid=' + val,
                success: function (data) {
                    $('#fpm').val(data);
                }
            });
        }
    </script>
</body>
</html>