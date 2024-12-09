<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){}
else{
    header("Location:index.php");
}
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $adn = "delete from registration where id=?";
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>alert('Data Deleted');</script>";
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header_and_sidebar.css">
    <link rel="stylesheet" href="css/manage-students.css">

    <script language="javascript" type="text/javascript">
        var popUpWin = 0;
        function popUpWindow(URLStr, left, top, width, height) {
            if (popUpWin) {
                if (!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' + 510 + ',height=' + 430 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
        }
    </script>
</head>
<body>
    <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                        <h2 class="page-title" style="margin-top:50px;">Manage Students</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">All Student Details</div>
                            <div class="panel-body">
                                Search: <input type="text" id="myinp" onkeyup="searchfun()" placeholder=""
                                    title="Type in a name" style="margin-bottom:10px;">
                                <table id="zctb" 
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Student Name</th>
                                            <th>Reg no</th>
                                            <th>Contact no </th>
                                            <th>room no </th>
                                            <th>Seater </th>
                                            <th>Staying From </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Student Name</th>
                                            <th>Reg no</th>
                                            <th>Contact no </th>
                                            <th>Room no </th>
                                            <th>Seater </th>
                                            <th>Staying From </th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="mytab">
                                        <?php
                                        $aid = $_SESSION['id'];
                                        $ret = "select * from registration";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute();
                                        $res = $stmt->get_result();
                                        $cnt = 1;
                                        while ($row = $res->fetch_object()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt;
                                                ; ?></td>
                                                <td><?php echo $row->firstName." ".$row->middleName." ".$row->lastName; ?>
                                                </td>
                                                <td><?php echo $row->regno; ?></td>
                                                <td><?php echo $row->contactno; ?></td>
                                                <td><?php echo $row->roomno; ?></td>
                                                <td><?php echo $row->seater; ?></td>
                                                <td><?php echo $row->stayfrom; ?></td>
                                                <td>
                                                    <a href="javascript:void(0);"
                                                        onClick="popUpWindow('http://localhost/hostel/admin/full-profile.php?id=<?php echo $row->id; ?>');"
                                                        title="View Full Details"><i
                                                            class="fa fa-desktop"></i></a>&nbsp;&nbsp;

                                                    <a href="manage-students.php?del=<?php echo $row->id; ?>"
                                                        title="Delete Record"
                                                        onclick="return confirm('Do you want to delete');"><i
                                                            class="fa fa-close"></i></a>&nbsp;&nbsp;

                                                            <a href="edit-students.php?edit=<?php echo $row->id; ?>" title="Edit Record">
        <i class="fa fa-edit"></i>
    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt = $cnt + 1;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/search-bar.js"></script>  
</body>
</html>