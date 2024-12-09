<nav class="ts-sidebar">
	<ul class="ts-sidebar-menu">
		<li class="ts-label">Main</li>
		<?PHP if (isset($_SESSION['id'])) { ?>
			<li><a href="dashboard.php"><i class="fa fa-desktop"></i>Dashboard</a></li>
			<li><a href="my-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
			<li><a href="change-password.php"><i class="fa fa-lock"></i>Change Password</a></li>
			<li><a href="book-hostel1.php"><i class="fa fa-bed"></i>Book Hostel</a></li>
			<li><a href="room-details.php"><i class="fa fa-list-alt"></i>Room Details</a></li>
			<li><a href="complaints.php"><i class="fa fa-exclamation-circle"></i>Complaints</a></li>
			<li><a href="user_mess.php"><i class="fa fa-cutlery"></i>Mess Menu</a></li>
			<li><a href="access-log.php"><i class="fa fa-history"></i>Access log</a></li>
		<?php } else { ?>
			<li><a href="registration.php"><i class="fa fa-user-plus"></i> User Registration</a></li>
			<li><a href="index.php"><i class="fa fa-sign-in"></i> User Login</a></li>
			<li><a href="admin"><i class="fa fa-shield"></i> Admin Login</a></li>
		<?php } ?>
	</ul>
</nav>