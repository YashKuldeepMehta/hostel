<?php
session_start();
include("includes/config.php");
if (isset($_SESSION['id'])) {
} else {
    header("Location:index.php");
}
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_stmt = $mysqli->prepare("DELETE FROM complaints WHERE id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        echo "<script>alert('Complaint deleted successfully!');</script>";
        echo "<script>window.location.href='user_complaints.php';</script>";
    } else {
        echo "<script>alert('Error deleting complaint.');</script>";
    }
    $delete_stmt->close();
}

if (isset($_POST['reply_submit'])) {
    $complaint_id = $_POST['complaint_id'];
    $admin_reply = $_POST['admin_reply'];
    $reply_stmt = $mysqli->prepare("UPDATE complaints SET admin_reply = ?, date_of_adminreply = NOW() WHERE id = ?");
    $reply_stmt->bind_param("si", $admin_reply, $complaint_id);

    if ($reply_stmt->execute()) {
        echo "<script>alert('Reply submitted successfully!');</script>";
        echo "<script>window.location.href='user_complaints.php';</script>";
    } else {
        echo "<script>alert('Error submitting reply.');</script>";
    }
    $reply_stmt->close();
}

$sql = "SELECT id, student_name, student_complaint, date_of_complaint, admin_reply, date_of_adminreply FROM complaints";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>User Complaints</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/user_complaints.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    <div class="content-wrapper">
        <h2 class="page-title" style="margin-top:50px;">User Complaints</h2>
        <div class="panel panel-default">
            <div class="panel-heading">All Complaints</div>
            <div class="panel-body">
                Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name"
                    style="margin-bottom:10px;">
                <table id="zctb" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Student Name</th>
                            <th>Complaint</th>
                            <th>Date of Complaint</th>
                            <th>Admin Reply</th>
                            <th>Date of Reply</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sno.</th>
                            <th>Student Name</th>
                            <th>Complaint</th>
                            <th>Date of Complaint</th>
                            <th>Admin Reply</th>
                            <th>Date of Reply</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="mytab">
                        <?php
                        $cnt = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_object()) {
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row->student_name; ?></td>
                                    <td><?php echo $row->student_complaint; ?></td>
                                    <td><?php echo $row->date_of_complaint; ?></td>
                                    <td><?php echo $row->admin_reply; ?></td>
                                    <td><?php echo $row->date_of_adminreply; ?></td>
                                    <td>
                                        <a href="user_complaints.php?reply_id=<?php echo $row->id; ?>" class="fa fa-reply"
                                            title="Reply"></a>&nbsp;&nbsp;
                                        <a href="user_complaints.php?delete_id=<?php echo $row->id; ?>" class="fa fa-close"
                                            title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this complaint?');"></a>
                                    </td>
                                </tr>
                                <?php
                                $cnt++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7">No complaints found</td>
                            </tr>
                            <?php
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($_GET['reply_id'])) {
                    $reply_id = $_GET['reply_id'];
                    $stmt = $mysqli->prepare("SELECT id, student_complaint FROM complaints WHERE id = ?");
                    $stmt->bind_param("i", $reply_id);
                    $stmt->execute();
                    $reply_result = $stmt->get_result();
                    $reply_row = $reply_result->fetch_assoc();
                    ?>

                    <h3>Reply to Complaint:</h3>
                    <form action="user_complaints.php" method="POST">
                        <input type="hidden" name="complaint_id" value="<?php echo $reply_row['id']; ?>">
                        <div class="fgroup">
                            <label for="student_complaint">Complaint:</label>
                            <textarea id="student_complaint" rows="4"
                                disabled><?php echo $reply_row['student_complaint']; ?></textarea>
                        </div>
                        <div class="fgroup">
                            <label for="admin_reply">Reply:</label>
                            <textarea id="admin_reply" name="admin_reply" rows="4" required></textarea>
                        </div>
                        <button type="submit" name="reply_submit">Submit Reply</button>
                    </form>
                    <?php
                    $stmt->close();
                }
                ?>
            </div>
        </div>
    </div>
    <script src="js/search-bar.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
</body>
</html>