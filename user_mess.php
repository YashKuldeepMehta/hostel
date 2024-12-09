<?php
session_start();

include('includes/config.php');
if (isset($_SESSION['id'])) {

} else {
    header("Location:index.php");
}

$user_id = $_SESSION['id'];
$foodstatus_stmt = $mysqli->prepare("SELECT foodstatus, totalamt FROM registration WHERE userid = ?");
$foodstatus_stmt->bind_param("i", $user_id);
$foodstatus_stmt->execute();
$foodstatus_stmt->bind_result($foodstatus, $totalamt);
$foodstatus_stmt->fetch();
$foodstatus_stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['foodstatus'])) {
        $selected_foodstatus = $_POST['foodstatus'];
        if ($selected_foodstatus == '1') {
            $new_totalamt = $totalamt + 2000;
            $update_stmt = $mysqli->prepare("UPDATE registration SET foodstatus = 1, totalamt = ? WHERE userid = ?");
            $update_stmt->bind_param("ii", $new_totalamt, $user_id);
            $update_stmt->execute();
            $update_stmt->close();
            echo "<script>alert('Food status updated successfully!'); window.location.href = 'user_mess.php';</script>";
        } elseif ($selected_foodstatus == '0') {
            echo "<script>alert('Food status was not updated.');</script>";
        }
    }
}

if ($foodstatus == 1) {
    $sql = "SELECT day, breakfast, lunch, dinner FROM mess_menu";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
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
    <title>Mess Menu</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/user_menu.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <h2 class="page-title" style="margin-top:50px;">This Week's Mess Menu</h2>
            <div class="panel panel-default">
                <div class="panel-heading">Weekly Menu</div>
                <div class="panel-body">
                    <?php if ($foodstatus == 1) { ?>
                        <table id="zctb" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Day</th>
                                    <th>Breakfast</th>
                                    <th>Lunch</th>
                                    <th>Dinner</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Day</th>
                                    <th>Breakfast</th>
                                    <th>Lunch</th>
                                    <th>Dinner</th>
                                </tr>
                            </tfoot>
                            <tbody>
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
                                        </tr>
                                        <?php
                                        $cnt++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="5">No menu found</td>
                                    </tr>
                                    <?php
                                }
                                $stmt->close();
                                ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>You do not have access to the mess menu.</p>
                        <button id="updateFoodstatusBtn">Want to update foodstatus?</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div id="foodstatusModal" class="statusupdate">
        <div class="statusupdate-content">
            <span class="close">&times;</span>
            <h3>Update Food Status</h3>
            <form action="user_mess.php" method="POST" class="statusupdate-form">
                <div class="fgroup">
                    <label style="font-weight:bold;">Food Status</label>
                    <div class="foodcheck">
                        <input type="radio" value="0" name="foodstatus" checked="checked">
                        <label>Without Food</label>
                        <br>
                        <input type="radio" value="1" name="foodstatus">
                        <label>With Food (Rs. 2000.00 Per Month Extra)</label>
                    </div>
                </div>
                <div class="fgroup">
                    <div  style="text-align: center; margin-top: 20px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>

    <script>
        var modal = document.getElementById("foodstatusModal");
        var btn = document.getElementById("updateFoodstatusBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
            modal.style.display = "block";
        }
        span.onclick = function () {
            modal.style.display = "none";
        }
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script> 
</body>
</html>