<?php
session_start();
include('includes/config.php');
if (isset($_SESSION['id'])) {

} else {
    header("Location:index.php");
}

$user_id = $_SESSION['id'];
$query = "SELECT * FROM temp_registration WHERE userid = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$temp_data = $result->fetch_assoc();
$total_amount = $temp_data['totalamt'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="css/payment.css">
</head>

<body>
    <div class="container">
        <h2>Choose Payment Method</h2>
        <h3>Total Amount: ₹<?php echo $total_amount; ?></h3>
        <form method="post" action="process-payment.php">
            <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
            <label>
                <input type="radio" name="payment_method" value="card" onclick="showcard_form()"> Credit/Debit Card
            </label>
            <label>
                <input type="radio" name="payment_method" value="upi" onclick="showupi_form()"> UPI
            </label>
            <div id="card_form" class="hidden">
                <label>Card Number:</label><input type="text" name="card_number" required>
                <label>Expiry Date (MM/YY):</label><input type="text" name="expiry_date" required>
                <label>CVV:</label><input type="text" name="cvv" required>
                <label>Card Holder Name:</label><input type="text" name="card_holder_name" required>
            </div>
            <div id="upi_form" class="hidden">
                <label>UPI Name:</label><input type="text" name="upi_name" required>
                <label>UPI ID:</label><input type="text" name="upi_id" required>
            </div>
            <button type="submit" name="pay">Submit Payment</button>
        </form>
    </div>

    <script>
        function showcard_form() {
            document.getElementById('card_form').classList.remove('hidden');
            document.getElementById('upi_form').classList.add('hidden');

            document.querySelectorAll('#upi_form input').forEach(inputField => inputField.removeAttribute('required'));
            document.querySelectorAll('#card_form input').forEach(inputField => inputField.setAttribute('required', 'true'));
        }
        function showupi_form() {
            document.getElementById('upi_form').classList.remove('hidden');
            document.getElementById('card_form').classList.add('hidden');

            document.querySelectorAll('#card_form input').forEach(inputField => inputField.removeAttribute('required'));
            document.querySelectorAll('#upi_form input').forEach(inputField => inputField.setAttribute('required', 'true'));
        }
    </script>
</body>

</html>