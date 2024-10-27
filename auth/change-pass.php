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
            if(isset($_GET['user_role_id'])){
                $user_role_id = $_GET['user_role_id'];
            }
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
                            if($user_role_id == 1){
                                echo "../student/student-dashboard.php";
                            }elseif($user_role_id == 2){
                                echo "../teacher/teacher-dashboard.php";
                            }
                        ?>
                    ">dashboard</a></li>
                    <li><a href="
                        <?php
                            if($user_role_id == 1){
                                echo "../student/student-profile.php";
                            }elseif($user_role_id == 2){
                                echo "../teacher/teacher-profile.php";
                            }
                        ?>
                    ">profile</a></li>
                    <li><a href="change-pass.php">change password</a></li>

                    <?php 
                        if($user_role_id == 2){
                            echo '<li><a href="../teacher/attendance.php">attendance</a></li>';
                            echo '<li><a href="../teacher/add-class.php">Add class</a></li>';
                        }
                    ?>

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
            </nav>
        </div>
        <!-- Header area end -->

        <!-- Change password start -->
        <div class="change-password">
            <h3>change your password</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="password" name="old_password" placeholder="Enter your old password">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="" value="Update">
                </div>
            </form>
        </div>
         <!-- Change password end -->

        <!-- Footer area start -->
        <div class="footer-area">
            <p></p>&copy; Abdur Rahman Alom, All Rights Reserved.</p>
        </div>
        <!-- Footer area end -->
    </div>
</body>
</html>