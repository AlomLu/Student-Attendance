<?php 
    include '../Config/config.php';
    include '../lib/Database.php'; 
    
    $db = new Database()    
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

        <!-- Login area start -->
        <div class="login">
            <h4>Login</h4>
            <form action="POST">
                <div class="form-group-inline">
                    <div class="form-group">
                        <input type="text" name="email" placeholder="Enter your email">
                    </div>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <input type="password" name="email" placeholder="Enter your password">
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