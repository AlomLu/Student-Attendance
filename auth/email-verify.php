<?php 
    session_start();
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
            // $query = "SELECT * FROM tbl_user";
            // $result = $db->select($query);

            // $row_count = mysqli_num_rows($result);
            // echo $row_count;
        ?>
        <?php
            if(isset($_POST['submit'])){
                if($_SERVER['REQUEST_METHOD']){
                    $error_token = '';

                    $token = $fm->validation($_POST['token']);
                    $token = mysqli_real_escape_string($db->link,$token);

                    if($token == ''){
                        $error_token = "Field must not be empty !!";
                    }

                    $fname = $_SESSION['user_data']['fname'];
                    $lname = $_SESSION['user_data']['lname'];
                    $email = $_SESSION['user_data']['email'];
                    $mobile_number = $_SESSION['user_data']['mobile_number'];
                    $gender = $_SESSION['user_data']['gender'];
                    $birthday = $_SESSION['user_data']['birthday'];
                    $division = $_SESSION['user_data']['division'];
                    $district = $_SESSION['user_data']['district'];
                    $upazila = $_SESSION['user_data']['upazila'];
                    $union_parishad = $_SESSION['user_data']['union_parishad'];
                    $role_id = $_SESSION['user_data']['role_id'];
                    $password = $_SESSION['user_data']['division'];

                    if(!empty($token)){

                        $query = "SELECT * FROM pending_verifications WHERE email = '$email'";
                        $result = $db->select($query);
                        // alert('Registration successfully completed');

                        if($result){
                            $row = $result->fetch_assoc();

                            $saved_token = $row['token'];
                            $token_timestamp = $row['token_timestamp'];

                            if(time() - $token_timestamp <= 120 ){
                                if($saved_token == $token){
                                    $query = "INSERT INTO tbl_user (fname, lname, email, mobile_number, gender, birthday, division, district, upazila, union_parishad, role_id, password) VALUES ('$fname','$lname', '$email', '$mobile_number', '$gender', '$birthday', '$division', '$district', '$upazila', '$union_parishad', '$role_id', '$password')";
                                    $insert_result = $db->insert($query);
        
                                    if($insert_result){
                                        unset($_SESSION['user_data']);
                                        $delete_query = "DELETE FROM pending_verifications WHERE email = '$email' ";
                                        $delete = $db->delete($delete_query);
                                        echo "<script>
                                                alert('Your account has been successfully created and verified.');
                                                window.location = 'login.php';
                                            </script>";
                                    }else{
                                        echo "<script>
                                            alert('Something went wrong !!');
                                        </script>";
                                    }
                                }else{
                                    echo "<script>
                                        alert('Token mismatched !!');
                                        window.location = 'email-verify.php';
                                    </script>";
                                }
                            }else{
                                echo "<script>
                                    alert('Timed out !!');
                                </script>";
                                unset($_SESSION['user_data']);
                                $delete_query = "DELETE FROM pending_verifications WHERE email = '$email' ";
                                $delete = $db->delete($delete_query);
                                
                            }

                        }
                    }
                }
            }
        ?>
        <div class="email-verify">
            <h3>Email verify</h3>
            <p>A 6-digit code has been sent to your email</p>
            <form action="" method="POST">
            <div class="form-group">
                <input type="text" name="token" placeholder="Enter token number">
                <?php echo isset($error_token) ? "<span class='error'>$error_token</span>" : '' ?>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="verify">
            </div>
            </form>
        </div>
    </div>
</body>
</html>