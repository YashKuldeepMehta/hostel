<?php
session_start();
include('includes/config.php');

if(isset($_SESSION['id'])){

}
else{
    header("Location:index.php");
}

 $user_id = $_SESSION['id']; // Using session variable id
// Code for registration or updating
if (isset($_POST['submit'])) {
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

   

    // Check if the student has already booked a room
    $stmt = $mysqli->prepare("SELECT userid FROM registration WHERE userid=?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Student has already booked a room, update the existing record
        $stmt->close();
        $query = "UPDATE registration SET  userid=?, roomno=?, seater=?, feespm=?, foodstatus=?, stayfrom=?, duration=?, totalamt=?, course=?, regno=?, firstName=?, middleName=?, lastName=?, gender=?, contactno=?, emailid=?, egycontactno=?, guardianName=?, guardianRelation=?, guardianContactno=?, corresAddress=?, corresCIty=?, corresState=?, corresPincode=?, pmntAddress=?, pmntCity=?, pmnatetState=?, pmntPincode=? WHERE userid=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('iiiiisiisissssisississsisssii', $user_id, $roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $ta ,$course, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurrelation, $gurcntno, $caddress, $ccity, $cstate, $cpincode, $paddress, $pcity, $pstate, $ppincode, $user_id);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Student information updated successfully');</script>";
    } 
    else {
        // Student has not booked a room, insert new record
        $stmt->close();
        $query = "INSERT INTO registration(userid, roomno, seater, feespm, foodstatus, stayfrom, duration, totalamt, course, regno, firstName, middleName, lastName, gender, contactno, emailid, egycontactno, guardianName, guardianRelation, guardianContactno, corresAddress, corresCIty, corresState, corresPincode, pmntAddress, pmntCity, pmnatetState, pmntPincode) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param(
            'iiiiisiisissssisississsisssi', 
            $user_id,$roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $ta,$course, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurrelation, $gurcntno, $caddress, $ccity, $cstate, $cpincode, $paddress, $pcity, $pstate, $ppincode);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('Student successfully registered');</script>";
    }
    
    
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Student Hostel Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/book-hostel.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    
    
</head>

<body>
    <?php include('includes/header.php'); ?>
   
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
          
                        <h2 class="page-title" style="margin-top:40px;">Registration </h2>
                       
                                    <div class="panel-heading">Fill all Info</div>
                                    <div class="panel-body">
                                        <form method="post" action="" class="form-horizontal" onsubmit="return validateForm();" id="registrationForm">
                                            <?php
                                            $uid = $_SESSION['id'];
                                            $stmt = $mysqli->prepare("SELECT userid FROM registration WHERE userid=?");
                                            $stmt->bind_param('i', $uid);
                                            $stmt->execute();
                                            $stmt->bind_result($id);
                                            $rs = $stmt->fetch();
                                            $stmt->close();
                                            if ($rs) { ?>
                                                <h3 style="color: red" align="left">Hostel already booked by you</h3>
                                            <?php } else {
                                                echo "";
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <h4 style="color: green" align="left">Room Related info </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room no. </label>
                                                <div class="col-sm-8">
                                                    <select name="room" id="room" class="form-control"
                                                        onChange="getSeater(this.value);" onBlur="checkAvailability()"
                                                        required>
                                                        <option value="">Select Room</option>
                                                        <?php
                                                        $query = "SELECT room_no FROM rooms WHERE room_no NOT IN (SELECT roomno FROM registration)";
                                                        $stmt2 = $mysqli->prepare($query);
                                                        $stmt2->execute();
                                                        $res = $stmt2->get_result();
                                                        while ($row = $res->fetch_object()) {
                                                            echo "<option value='" . $row->room_no . "'>" . $row->room_no . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="room-availability-status" style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Seater</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="seater" id="seater" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fees Per Month</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fpm" id="fpm" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Food Status</label>
                                                <div class="col-sm-8">
                                                    <input type="radio" value="0" name="foodstatus" checked="checked">
                                                    Without Food
                                                    <input type="radio" value="1" name="foodstatus"> With Food(Rs
                                                    2000.00 Per Month Extra)
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Stay From</label>
                                                <div class="col-sm-8">
                                                    <input type="date" name="stayf" id="stayf" class="form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Duration</label>
                                                <div class="col-sm-8">
                                                    <select name="duration" id="duration" class="form-control">
                                                        <option value="">Select Duration in Month</option>
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
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Total Amount</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="ta" id="ta" class="result form-control">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">
                                                    <h4 style="color: green" align="left">Personal info </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Course </label>
                                                <div class="col-sm-8">
                                                    <select name="course" id="course" class="form-control" required>
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
                                            </div>

                                            <?php
                                            $aid = $_SESSION['id'];
                                            $ret = "select * from userregistration where id=?";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $aid);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            while ($row = $res->fetch_object()) {
                                                ?>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Registration No : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="regno" id="regno" class="form-control"
                                                            value="<?php echo $row->regNo; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">First Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="fname" id="fname" class="form-control"
                                                            value="<?php echo $row->firstName; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Middle Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="mname" id="mname" class="form-control"
                                                            value="<?php echo $row->middleName; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Last Name : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="lname" id="lname" class="form-control"
                                                            value="<?php echo $row->lastName; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Gender : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="gender" value="<?php echo $row->gender; ?>"
                                                            class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Contact No : </label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="contact" id="contact"
                                                            value="<?php echo $row->contactNo; ?>" class="form-control"
                                                            readonly>
                                                        <span id="contact-validation-status" style="font-size:12px;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Email id : </label>
                                                    <div class="col-sm-8">
                                                        <input type="email" name="email" id="email" class="form-control"
                                                            value="<?php echo $row->email; ?>" readonly>
                                                        <span id="email-validation-status" style="font-size:12px;"></span>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Emergency Contact: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="econtact" id="econtact"
                                                        class="form-control" required="required">
                                                    <span id="econtact-validation-status"
                                                        style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Guardian Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gname" id="gname" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Guardian Relation : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="grelation" id="grelation"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Guardian Contact no : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gcontact" id="gcontact"
                                                        class="form-control" required="required">
                                                    <span id="gcontact-validation-status"
                                                        style="font-size:12px;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">
                                                    <h4 style="color: green" align="left">Correspondense Address </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address : </label>
                                                <div class="col-sm-8">
                                                    <textarea rows="5" name="address" id="address" class="form-control"
                                                        required="required"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">City : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="city" id="city" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">State </label>
                                                <div class="col-sm-8">
                                                    <select name="state" id="state" class="form-control" required>
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
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Pincode : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pincode" id="pincode" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">
                                                    <h4 style="color: green" align="left">Permanent Address </h4>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-5 control-label">Permanent Address same as
                                                    Correspondense address : </label>
                                                <div class="col-sm-4">
                                                    <input type="checkbox" id="adcheck" value="1" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address : </label>
                                                <div class="col-sm-8">
                                                    <textarea rows="5" name="paddress" id="paddress"
                                                        class="form-control" required="required"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">City : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="pcity" id="pcity" class="form-control"
                                                        required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">State </label>
                                                <div class="col-sm-8">
                                                    <select name="pstate" id="pstate" class="form-control" required>
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
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Pincode : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="ppincode" id="ppincode"
                                                        class="form-control" required="required">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-sm-offset-4">
                                                <button class="btn btn-default" type="submit">Cancel</button>
                                                <input type="submit" name="submit" Value="Register"
                                                    class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                          
                  
        </div>
 


    <script src="js/jquery.min.js"></script>
 

    <script>
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

function validateForm() {
    const isEmailValid = validateEmail();
    const isContactValid = validateContactNumber("contact", "contact-validation-status");
    const isEContactValid = validateContactNumber("econtact", "econtact-validation-status");
    const isGContactValid = validateContactNumber("gcontact", "gcontact-validation-status");

    if (!isEmailValid || !isContactValid || !isEContactValid || !isGContactValid) {
        alert("Please correct the errors before submitting the form.");
        return false;
    }

    return true;
}

$(document).ready(function () {
    // Show validation messages only when the user starts typing
    $("#email").on('input', function () {
        validateEmail();
    });

    $("#email").on('blur', function () {
        $("#email-validation-status").html('');  // Clear message on blur
    });

    // Contact number validations
    $("#contact").on('input', function () {
        validateContactNumber("contact", "contact-validation-status");
    });

    $("#contact").on('blur', function () {
        $("#contact-validation-status").html('');  // Clear message on blur
    });

    $("#econtact").on('input', function () {
        validateContactNumber("econtact", "econtact-validation-status");
    });

    $("#econtact").on('blur', function () {
        $("#econtact-validation-status").html('');  // Clear message on blur
    });

    $("#gcontact").on('input', function () {
        validateContactNumber("gcontact", "gcontact-validation-status");
    });

    $("#gcontact").on('blur', function () {
        $("#gcontact-validation-status").html('');  // Clear message on blur
    });

    // Recalculate total amount whenever relevant fields change
    $("#fpm, #duration").on('input', calculateTotalAmount);
    $('input[name="foodstatus"]').on('change', calculateTotalAmount);

    // Copy address when the checkbox is checked
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

    // Prevent form submission if validations fail
    $('#registrationForm').on('submit', function (e) {
        if (!validateForm()) {
            e.preventDefault();  // Prevent form submission if validation fails
        }
    });
});


        
    </script>
    
</body>

</html>
