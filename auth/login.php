<?php 
    include '../Config/config.php';
    include '../lib/Database.php'; 
    include '../Helpers/Format.php';
    include '../lib/Session.php';
    Session::checkLogin();
    
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
        <!-- Header area start -->
        <div id="header">
            <h3>attendance management system</h3>
        </div>
        <!-- Header area end -->

        <!-- Database Connection test -->
         <!-- <?php 
            if(isset($db->success)){
                echo $db->success;
            }
         ?> -->

        <!-- Login code -->
         <?php 
            if(isset($_POST['submit'])){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $error_email =  '';
                    $error_password =  '';
                    $error_login = '';

                    $email = $fm->validation($_POST['email']);
                    $password = $fm->validation($_POST['password']);

                    $email = mysqli_real_escape_string($db->link, $email);
                    $password = mysqli_real_escape_string($db->link, $password);

                    if($email == ''){
                        $error_email = "Email must not be empty !";
                    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $error_email = "Invalid email";
                    }

                    if($password == ''){
                        $error_password = "Password must not be empty !";
                    }

                    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($password)){
                        $password = md5($password);

                        $query = "SELECT * FROM tbl_user WHERE email = '$email' AND password ='$password' ";
                        $result = $db->select($query);

                        if($result != false){
                           $value = $result->fetch_assoc();

                           Session::set('login', true);
                           Session::set('user_id', $value['id']);
                           Session::set('user_fname', $value['fname']);
                           Session::set('user_lname', $value['lname']);
                           Session::set('user_email', $value['email']);
                           Session::set('user_mobile', $value['mobile_number']);
                           Session::set('user_gender', $value['gender']);
                           Session::set('user_birthday', $value['birthday']);
                           Session::set('user_division', $value['division']);
                           Session::set('user_district', $value['district']);
                           Session::set('user_upazila', $value['upazila']);
                           Session::set('user_union', $value['union_parishad']);
                           Session::set('user_role_id', $value['role_id']);
                           Session::set('user_class', $value['class_id']);

                           switch(Session::get('user_role_id')){
                            case '1':
                                // header('Location: ../student/student-dashboard.php');
                                header('Location: ../student/class.php');
                                exit();
                            case '2':
                                header('Location: ../teacher/teacher-dashboard.php');
                                exit();
                           }
                        }else{
                            $error_login = "Username or Password not matched!!..";
                        }
                    }
                }
            }
         ?>
        <!-- Login code -->

        <!-- Login area start -->
        <div class="login">
            <h4>Login</h4>
            <?php echo isset($error_login) ? "<span class='error'>$error_login</span>" : '';?>
            <form action="" method="POST">
                <div class="form-group-inline">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Enter your email">
                        <?php
                           echo isset($error_email) ? "<span class='error'>$error_email</span>" : '';
                        ?>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter your password">
                        <?php
                            // if(isset($error_password)){
                            //     echo "<span class='error'>$error_password</span>";
                            // }
                            echo isset($error_password) ? "<span class='error'>$error_password</span>" : '';
                        ?>
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <input type="submit" name="submit" value="Log In">
                    </div>
                </div>
            </form>
            <div class="form-group-inline">
                <div class="form-group">
                    <a href="../auth/forget-pass.php">Forgotten password</a>
                    <a href="../auth/signup.php">Signup</a>
                </div>
            </div>
         </div>
        <!-- Login area end -->

        <!-- Footer area start -->
         <div class="footer-area">
            <p></p>&copy; Abdur Rahman Alom, All Rights Reserved.</p>
         </div>
        <!-- Footer area end -->
    </div>
</body>
</html>