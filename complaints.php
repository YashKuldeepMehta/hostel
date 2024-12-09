<?php
session_start();

include('includes/config.php');
if(isset($_SESSION['id'])){

}
else{
    header("Location:index.php");
}

$userid = $_SESSION['id'];
if (isset($_POST['complaint_submit'])) {
    $student_name = $_POST['student_name'];
    $complaint = $_POST['complaint'];
    $stmt = $mysqli->prepare("INSERT INTO complaints (userid,student_name, student_complaint) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userid, $student_name, $complaint);

    if ($stmt->execute()) {
        echo "<script>alert('Complaint submitted successfully!');</script>";
    } 
    else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!doctype html>
<html lang="en" class="no-js">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/complaints.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">   
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
                <h2 style="margin-top:50px;">Submit Your Complaint</h2>
                <form action="complaints.php" method="POST">
                    <div class="fgroup">
                        <label for="student_name">Name:</label>
                        <input type="text" id="student_name" name="student_name" required>
                    </div>
                    <div class="fgroup">
                        <label for="complaint">Complaint:</label>
                        <textarea id="complaint" name="complaint" rows="4" required></textarea>
                    </div>
                    <button type="submit" name="complaint_submit">Submit</button>
                </form>
                <h3 style="margin-top:20px;">Your Previous Complaints</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Complaint</th>
                            <th>Date of Complaint</th>
                            <th>Admin Reply</th>
                            <th>Date of Reply</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       $sql = "SELECT id, student_complaint, date_of_complaint, admin_reply, date_of_adminreply FROM complaints WHERE userid = ?";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("i", $userid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $cnt = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $cnt . "</td><td>" . $row["student_complaint"] . "</td><td>" . $row["date_of_complaint"] . "</td><td>" . $row["admin_reply"] . "</td><td>" . $row["date_of_adminreply"] . "</td></tr>";
                                $cnt += 1;
                            }
                        } else {
                            echo "<tr><td colspan='5'>No complaints found</td></tr>";
                        }
                        $stmt->close();
                        $mysqli->close();
                        ?>
                    </tbody>         
        </div>
    </div>
   <script src="js/jquery.min.js"></script>   
</body>
</html>