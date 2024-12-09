<?php
session_start();
include('includes/config.php');
if (isset($_SESSION['id'])) {
} else {
    header("Location:index.php");
}
$user_id = $_SESSION['id'];
if (isset($_POST['pay'])) {
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];
    if ($payment_method == 'card') {
        $card_number = $_POST['card_number'];
        $expiry_date = $_POST['expiry_date'];
        $cvv = $_POST['cvv'];
        $card_holder_name = $_POST['card_holder_name'];
        $query = "INSERT INTO payment_details (user_id, payment_method, amount, card_number, card_holder_name, expiry_date, cvv, payment_status) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, 'successful')";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('isissss', $user_id, $payment_method, $total_amount, $card_number, $card_holder_name, $expiry_date, $cvv);
        $stmt->execute();
        $stmt->close();
    } else if ($payment_method == 'upi') {
        $upi_name = $_POST['upi_name'];
        $upi_id = $_POST['upi_id'];
        $query = "INSERT INTO payment_details (user_id, payment_method, amount, upi_name, upi_id, payment_status) 
                  VALUES (?, ?, ?, ?, ?, 'successful')";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('isiss', $user_id, $payment_method, $total_amount, $upi_name, $upi_id);
        $stmt->execute();
        $stmt->close();
    }
    $query = "SELECT userid FROM registration WHERE userid = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $query = "UPDATE registration 
                  JOIN temp_registration ON registration.userid = temp_registration.userid 
                  SET registration.roomno = temp_registration.roomno,
                      registration.seater = temp_registration.seater,
                      registration.feespm = temp_registration.feespm,
                      registration.foodstatus = temp_registration.foodstatus,
                      registration.stayfrom = temp_registration.stayfrom,
                      registration.duration = temp_registration.duration,
                      registration.totalamt = temp_registration.totalamt,
                      registration.course = temp_registration.course,
                      registration.regno = temp_registration.regno,
                      registration.firstName = temp_registration.firstName,
                      registration.middleName = temp_registration.middleName,
                      registration.lastName = temp_registration.lastName,
                      registration.gender = temp_registration.gender,
                      registration.contactno = temp_registration.contactno,
                      registration.emailid = temp_registration.emailid,
                      registration.egycontactno = temp_registration.egycontactno,
                      registration.guardianName = temp_registration.guardianName,
                      registration.guardianRelation = temp_registration.guardianRelation,
                      registration.guardianContactno = temp_registration.guardianContactno,
                      registration.corresAddress = temp_registration.corresAddress,
                      registration.corresCIty = temp_registration.corresCIty,
                      registration.corresState = temp_registration.corresState,
                      registration.corresPincode = temp_registration.corresPincode,
                      registration.pmntAddress = temp_registration.pmntAddress,
                      registration.pmntCity = temp_registration.pmntCity,
                      registration.pmnatetState = temp_registration.pmnatetState,
                      registration.pmntPincode = temp_registration.pmntPincode
                  WHERE registration.userid = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
    } else {
        $query = "INSERT INTO registration SELECT * FROM temp_registration WHERE userid = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->close();
    }
    $query = "DELETE FROM temp_registration WHERE userid = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Payment successful and registration completed!'); window.location.href='room-details.php';</script>";
} else {
    $query = "DELETE FROM temp_registration WHERE userid = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Payment failed. Please try again.'); window.location.href='book-hostel1.php';</script>";
}
?>