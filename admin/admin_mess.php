<?php
session_start();
include('includes/config.php');
if (isset($_SESSION['id'])) {

} else {
    header("Location:index.php");
}
if (isset($_POST['edit_submit'])) {
    $menu_id = $_POST['menu_id'];
    $day = $_POST['day'];
    $breakfast = $_POST['breakfast'];
    $lunch = $_POST['lunch'];
    $dinner = $_POST['dinner'];

    $edit_stmt = $mysqli->prepare("UPDATE mess_menu SET day = ?, breakfast = ?, lunch = ?, dinner = ? WHERE id = ?");
    $edit_stmt->bind_param("ssssi", $day, $breakfast, $lunch, $dinner, $menu_id);
    if ($edit_stmt->execute()) {
        echo "<script>alert('Menu updated successfully!');</script>";
        echo "<script>window.location.href='admin_mess.php';</script>";
    } else {
        echo "<script>alert('Error updating menu.');</script>";
    }
    $edit_stmt->close();
}
$sql = "SELECT id, day, breakfast, lunch, dinner FROM mess_menu";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>Mess Management</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/admin-mess.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    <div class="content-wrapper">
        <h2 class="page-title" style="margin-top:50px;">Mess Management</h2>
        <div class="panel panel-default">
            <div class="panel-heading">Weekly Menu</div>
            <div class="panel-body">
                Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name"
                    style="margin-bottom:10px;">
                <table id="zctb" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Day</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Dinner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sno.</th>
                            <th>Day</th>
                            <th>Breakfast</th>
                            <th>Lunch</th>
                            <th>Dinner</th>
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
                                    <td><?php echo $row->day; ?></td>
                                    <td><?php echo $row->breakfast; ?></td>
                                    <td><?php echo $row->lunch; ?></td>
                                    <td><?php echo $row->dinner; ?></td>
                                    <td>
                                        <a href="admin_mess.php?edit_id=<?php echo $row->id; ?>" class="fa fa-edit"
                                            title="Edit"></a>&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <?php
                                $cnt++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">No menu found</td>
                            </tr>
                            <?php
                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
                <?php
                if (isset($_GET['edit_id'])) {
                    $edit_id = $_GET['edit_id'];
                    $stmt = $mysqli->prepare("SELECT id, day, breakfast, lunch, dinner FROM mess_menu WHERE id = ?");
                    $stmt->bind_param("i", $edit_id);
                    $stmt->execute();
                    $edit_result = $stmt->get_result();
                    $edit_row = $edit_result->fetch_assoc();
                    ?>
                    <h3>Edit Menu</h3>
                    <form action="admin_mess.php" method="POST">
                        <input type="hidden" name="menu_id" value="<?php echo $edit_row['id']; ?>">
                        <div class="fgroup">
                            <label for="day">Day:</label>
                            <input type="text" id="day" name="day" value="<?php echo $edit_row['day']; ?>" required>
                        </div>
                        <div class="fgroup">
                            <label for="breakfast">Breakfast:</label>
                            <textarea id="breakfast" name="breakfast" rows="2"
                                required><?php echo $edit_row['breakfast']; ?></textarea>
                        </div>
                        <div class="fgroup">
                            <label for="lunch">Lunch:</label>
                            <textarea id="lunch" name="lunch" rows="2" required><?php echo $edit_row['lunch']; ?></textarea>
                        </div>
                        <div class="fgroup">
                            <label for="dinner">Dinner:</label>
                            <textarea id="dinner" name="dinner" rows="2"
                                required><?php echo $edit_row['dinner']; ?></textarea>
                        </div>
                        <button type="submit" name="edit_submit">Update Menu</button>
                    </form>
                    <?php
                    $stmt->close();
                }
                ?>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/search-bar.js"></script>
</body>
</html>