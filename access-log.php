<?php
session_start();
include('includes/config.php');
if (isset($_SESSION['id'])) {

} else {
    header("Location:index.php");
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
    <title>Access Log</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/access-log.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <h2 class="page-title">Access Log</h2>
            <div class="panel">
                <div class="panel-heading">All Access Details</div>
                <div class="panel-body">
                    Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder="" title="Type in a name">
                    <table id="zctb">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>User Id</th>
                                <th>User Email</th>
                                <th>IP</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Sno.</th>
                                <th>User Id</th>
                                <th>User Email</th>
                                <th>IP</th>
                                <th>Login Time</th>
                            </tr>
                        </tfoot>
                        <tbody id="mytab">
                            <?php
                            $aid = $_SESSION['id'];
                            $ret = "select * from userlog where userId=?";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->bind_param('i', $aid);
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $cnt = 1;
                            while ($row = $res->fetch_object()) {
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row->userId; ?></td>
                                    <td><?php echo $row->userEmail; ?></td>
                                    <td><?php echo $row->userIp; ?></td>
                                    <td><?php echo $row->loginTime; ?></td>
                                </tr>
                                <?php
                                $cnt = $cnt + 1;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function searchfun() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myinp");
            filter = input.value.toUpperCase();
            table = document.getElementById("mytab");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }

                if (j === td.length) {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>


</body>

</html>