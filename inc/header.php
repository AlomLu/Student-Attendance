<?php 
    include '../lib/Session.php';
    Session::checkSession();

    include '../Config/config.php';
    include '../lib/Database.php';
    include '../Helpers/Format.php';

    $db = new Database();
    $fm = new Format();
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
        <?php 
            $user_role_id = Session::get('user_role_id')
        ?>
        <!-- Header area start -->
        <div class="student-header">
            <div class="logo">
                <a href="">Student</a>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="
                        <?php
                            if(Session::get('user_role_id') == 1){
                                echo "student-dashboard.php";
                            }elseif(Session::get('user_role_id') == 2){
                                echo "teacher-dashboard.php";
                            }
                        ?>
                    ">dashboard</a></li>
                    <li><a href="
                        <?php
                            if(Session::get('user_role_id') == 1){
                                echo "student-profile.php";
                            }elseif(Session::get('user_role_id') == 2){
                                echo "teacher-profile.php";
                            }
                        ?>
                    ">profile</a></li>
                    <li><a href="
                        <?php
                            if(Session::get('user_role_id') == 1){
                                echo "class.php";
                            }
                        ?>
                    ">class</a></li>
                    <li><a href="../auth/change-pass.php?user_role_id=<?php echo $user_role_id?>">change password</a></li>

                    <?php 
                        if(Session::get('user_role_id') == 2){
                            echo '<li><a href="attendance.php">attendance</a></li>';
                            echo '<li><a href="add-class.php">Add class</a></li>';
                        }
                    ?>

                    <li><a href=""><?php echo Session::get('user_lname') ?></a></li>
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
                    <li>
                        <?php 
                            if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                                Session::destroy();
                            }
                        ?>
                        <a href="?action=logout">Logout</a>
                    </li>
                </ul> -->
            </nav>
        </div>
        <!-- Header area end -->