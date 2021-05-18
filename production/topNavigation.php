<?php
include("config.php");
session_start();
$userName=$_POST['user'];
$UserConnect = $collection->findOne(array("email" => $_SESSION['email']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
<!--                        <img src="images/img.jpg" alt="">-->
                        <?php echo $UserConnect['name'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="profile.php"> Profile</a>
<!--                        <a class="dropdown-item"  href="javascript:;">-->
<!--                            <span class="badge bg-red pull-right">50%</span>-->
<!--                            <span>Settings</span>-->
<!--                        </a>-->
<!--                        <a class="dropdown-item"  href="javascript:;">Help</a>-->
                        <a class="dropdown-item"  href="login.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>


            </ul>
        </nav>
    </div>
</div>
</body>
</html>