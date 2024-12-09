<?php
session_start();
include('includes/config.php');
if (isset($_POST['submit'])) {
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $password = $_POST['password'];
    $query = "insert into  userRegistration(regNo,firstName,middleName,lastName,gender,contactNo,email,password) values(?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssiss', $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $password);
    $stmt->execute();
    echo "<script>alert('Student Succssfully register');</script>";
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <div class="main-content">
            <h2 class="page-title">Student Registration</h2>
            <div class="panel">
                <div class="panel-heading">Fill all Info</div>
                <div class="panel-body">
                    <form method="post" action="" name="registration" onSubmit="return validateForm();">
                        <div class="fgroup">
                            <label for="regno">Registration No:</label>
                            <input type="text" name="regno" id="regno" required="required">
                        </div>
                        <div class="fgroup">
                            <label for="fname">First Name:</label>
                            <input type="text" name="fname" id="fname" required="required">
                        </div>
                        <div class="fgroup">
                            <label for="mname">Middle Name:</label>
                            <input type="text" name="mname" id="mname">
                        </div>
                        <div class="fgroup">
                            <label for="lname">Last Name:</label>
                            <input type="text" name="lname" id="lname" required="required">
                        </div>
                        <div class="fgroup">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender" required="required">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="fgroup">
                            <label for="contact">Contact No:</label>
                            <input type="text" name="contact" id="contact" required="required">
                        </div>
                        <div class="fgroup">
                            <label for="email">Email id:</label>
                            <input type="email" name="email" id="email" required="required"
                                onBlur="checkAvailability()">
                            <span id="user-availability-status" style="font-size:12px;"></span>
                        </div>
                        <div class="fgroup">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" required="required">
                            <ul class="validation-list">
                                <li id="uppercase">At least one uppercase letter</li>
                                <li id="lowercase">At least one lowercase letter</li>
                                <li id="number">At least one number</li>
                                <li id="special">At least one special character</li>
                                <li id="length">At least 8 characters long</li>
                            </ul>
                        </div>
                        <div class="fgroup">
                            <label for="cpassword">Confirm Password:</label>
                            <input type="password" name="cpassword" id="cpassword" required="required">
                            <span class="confirm-password-error"></span>
                        </div>
                        <div class="btngrp">
                            <button type="submit" class="cancel-btn">Cancel</button>
                            <button type="submit" name="submit" class="submit-btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('cpassword');
        const validationList = document.querySelector('.validation-list');
        const confirmPasswordError = document.querySelector('.confirm-password-error');
        const emailInput = document.getElementById('email');
        const contactInput = document.getElementById('contact');

        passwordInput.addEventListener('focus', () => validationList.style.display = 'block');
        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);
        emailInput.addEventListener('input', () => validateInput(emailInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Please enter a valid email address.'));
        contactInput.addEventListener('input', () => validateInput(contactInput, /^\d{10}$/, 'Contact No must be exactly 10 digits and contain only numbers.'));

        form.addEventListener('submit', function (event) {
            if (!validateForm()) event.preventDefault();
        });

        function validateInput(input, pattern, errorMessage) {
            const isValid = pattern.test(input.value);
            toggleValidationStyles(input, isValid, errorMessage);
            return isValid;
        }

        function validatePassword() {
            const password = passwordInput.value;
            const validations = [
                { id: 'uppercase', regex: /[A-Z]/ },
                { id: 'lowercase', regex: /[a-z]/ },
                { id: 'number', regex: /\d/ },
                { id: 'special', regex: /[@$!%*?&]/ },
                { id: 'length', regex: /.{8,}/ }
            ];

            validations.forEach(validation => {
                const element = document.getElementById(validation.id);
                toggleListValidationStyles(element, validation.regex.test(password));
            });

            return validations.every(validation => validation.regex.test(password));
        }
   
        function validateConfirmPassword() {
            const isValid = confirmPasswordInput.value === passwordInput.value;
            confirmPasswordError.textContent = isValid ? '' : 'Passwords do not match.';
            confirmPasswordError.style.display = isValid ? 'none' : 'block';
            return isValid;
        }

        function validateForm() {
            return validateInput(emailInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'Please enter a valid email address.') &&
                   validatePassword() &&
                   validateConfirmPassword() &&
                   validateInput(contactInput, /^\d{10}$/, 'Contact No must be exactly 10 digits and contain only numbers.');
        }

        function toggleValidationStyles(element, isValid, errorMessage) {
            clearError(element);
            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);
            if (!isValid) showError(element, errorMessage);
        }

        function toggleListValidationStyles(element, isValid) {
            element.classList.toggle('valid', isValid);
            element.classList.toggle('invalid', !isValid);
        }

        function showError(element, message) {
            clearError(element);
            const errorElement = document.createElement('span');
            errorElement.className = 'error-message';
            errorElement.textContent = message;
            element.parentNode.appendChild(errorElement);
        }

        function clearError(element) {
            const errorElement = element.parentNode.querySelector('.error-message');
            if (errorElement) errorElement.remove();
        }
    });
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#email").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
                    event.preventDefault();
                    alert('error');
                }
            });
        }
    </script>
</body>
</html>