
<?php if(isset($_SESSION['id'])) { ?>
    <div class="header">
        <a href="#" class="logo">Hostel Management System</a>
        
        <ul class="ts-profile-nav">
            <li class="ts-account">
                <a href="#"><img src="img/ts_avatar3.avif" class="ts-avatar" alt=""> Account <i class="fa fa-angle-down"></i></a>
                <ul>
                    <li><a href="my-profile.php">My Account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
<?php } else { ?>
    <div class="header">
        <a href="#" class="logo">Hostel Management System</a>
        
    </div>
<?php } ?>