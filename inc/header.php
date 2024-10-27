<?php 
    include '../lib/Session.php';
    Session::checkSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <!-- Header area start -->
        <div class="student-header">
            <div class="logo">
                <a href="">Student</a>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="student-dashboard.php">dashboard</a></li>
                    <li><a href="student-profile.php">profile</a></li>
                    <li><a href="../auth/change-pass.php">change password</a></li>
                    <li><a href="">Alom</a></li>
                    <li>
                        <?php 
                            if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                                Session::destroy();
                            }
                        ?>
                        <a href="?action=logout">Logout</a>
                    </li>
                </ul>
                <!-- <ul>
                    <li><a href="teacher-dashboard.php">dashboard</a></li>
                    <li><a href="teacher-profile.php">profile</a></li>
                    <li><a href="attendance.php">attendance</a></li>
                    <li><a href="add-class.php">Add class</a></li>
                    <li><a href="../auth/change-pass.php">change password</a></li>
                    <li><a href="">Alom</a></li>
                    <li><a href="">Logout</a></li>
                </ul> -->
            </nav>
        </div>
        <!-- Header area end -->