<?php 
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
        <!-- Header area start -->
        <div id="header">
            <h3>attendance management system</h3>
        </div>
        <!-- Header area end -->
         <div class="signup-area">
            <div class="signup-form">
                <h3>sign up</h3>
                <?php 
                    if(isset($_POST['submit'])){
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            // $insert_message = '';

                            $error_fname = '';
                            $error_lname = '';
                            $error_email= '';
                            $error_mobile = '';
                            $error_gender = '';
                            $error_birthday = '';
                            $error_division = '';
                            $error_district = '';
                            $error_upazila = '';
                            $error_union_parishad = '';
                            $error_role_id = '';
                            $error_password = '';

                            $fname = $fm->validation($_POST['fname']);
                            $lname = $fm->validation($_POST['lname']);
                            $email = $fm->validation($_POST['email']);
                            $mobile_number = $fm->validation($_POST['mobile_number']);
                            // $gender = $fm->validation($_POST['gender']);

                            $birthday = $fm->validation($_POST['birthday']);
                            $division = $fm->validation($_POST['division']);
                            $district = $fm->validation($_POST['district']);
                            $upazila = $fm->validation($_POST['upazila']);
                            $union_parishad = $fm->validation($_POST['union_parishad']);
                            $role_id = $fm->validation($_POST['role_id']);
                            $password = $fm->validation($_POST['password']);

                            $fname = mysqli_real_escape_string($db->link, $fname);
                            $lname = mysqli_real_escape_string($db->link, $lname);
                            $email = mysqli_real_escape_string($db->link, $email);
                            $mobile_number = mysqli_real_escape_string($db->link, $mobile_number);
                            if(isset($_POST['gender'])){
                                $gender = $fm->validation($_POST['gender']);
                                $gender = mysqli_real_escape_string($db->link, $gender);
                            }else{
                                $gender = '';
                            }
                            $birthday = mysqli_real_escape_string($db->link, $birthday);
                            $division = mysqli_real_escape_string($db->link, $division);
                            $district = mysqli_real_escape_string($db->link, $district);
                            $upazila = mysqli_real_escape_string($db->link, $upazila);
                            $union_parishad = mysqli_real_escape_string($db->link, $union_parishad);
                            $role_id = mysqli_real_escape_string($db->link, $role_id);
                            $password = mysqli_real_escape_string($db->link, $password);

                            if($fname == ''){
                                $error_fname = "First name must not be empty !!";
                            } 
                            if($lname == ''){
                                $error_lname = "Last name must not be empty !!";
                            } 

                            if($email == ''){
                                $error_email = "Email must not be empty";
                            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                $error_email = "Invalid email !!";
                            }

                            if($mobile_number == ''){
                                $error_mobile = "Mobile number must not be empty";
                            }elseif(!preg_match('/^0\d{10}$/', $mobile_number )){
                                $error_mobile = "Mobile Number must be in the format '01740377378' ";
                            }

                            if($gender == ''){
                                $error_gender = "Gender must not be empty !!";
                            }
                            if($birthday == ''){
                                $error_birthday = "Birthday must not be empty !!";
                            }
                            if($division == ''){
                                $error_division = "Division must not be empty !!";
                            }
                            if($district == ''){
                                $error_district = "district must not be empty !!";
                            }
                            if($upazila == ''){
                                $error_upazila = "Upazila must not be empty !!";
                            }
                            if($union_parishad == ''){
                                $error_union_parishad = "Union Parishad must not be empty !!";
                            }
                            if($role_id == ''){
                                $error_role_id = "Role must not be empty !!";
                            }

                            if($password == ''){
                                $error_password = "password must not be empty !!";
                            }elseif(strlen($password) < 5){
                                $error_password = "password lenght must be 5 characters or more !!";
                            } 

                            //Insert

                            if(!empty($fname) && !empty($lname) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mobile_number) && strlen($mobile_number) >10 && !empty($gender) && !empty($birthday) && !empty($division) && !empty($district) && !empty($upazila) && !empty($union_parishad) && !empty($role_id) && !empty($password) && strlen($password) >= 5){
                                $password = md5($password);
                                

                                $query = "INSERT INTO tbl_user (fname, lname, email, mobile_number, gender, birthday, division, district, upazila, union_parishad, role_id, password) VALUES ('$fname','$lname', '$email', '$mobile_number', '$gender', '$birthday', '$division', '$district', '$upazila', '$union_parishad', '$role_id', '$password')";
                                $result = $db->insert($query);

                                if($result){
                                    // $insert_message = "Registration successfully done";
                                    echo "<script>alert('Registration successfully done')</script>";
                                }else{
                                    // $insert_message = "Something went wrong";
                                    echo "<script>alert('Something went wrong')</script>";
                                }
                            }
                        }
                    }
                ?>
                <?php 
                    // if(!empty($insert_message)){
                    //     echo "<span class='success'>$insert_message</span>";
                    // }
                ?>
                <form action="" method="POST">
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">first name</label>
                            <input type="text" name="fname" placeholder="Enter your first name">
                            <?php echo isset($error_fname) ? "<span class='error'>$error_fname</span>" : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">last name</label>
                            <input type="text" name="lname" placeholder="Enter your last name">
                            <?php echo isset($error_lname) ? "<span class='error'>$error_lname</span>" : ''; ?>
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="text" name="email" placeholder="Enter your email">
                            <?php echo isset($error_email) ? "<span class='error'>$error_email</span>" : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">mobile number</label>
                            <input type="text" name="mobile_number" placeholder="01740345782">
                            <?php echo isset($error_mobile) ? "<span class='error'>$error_mobile</span>" : ''; ?>
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">gender</label>
                            <input type="radio" name="gender" value="male">Male
                            <input type="radio" name="gender" value="female">Female
                            <?php echo isset($error_gender) ? "<span class='error'>$error_gender</span>" : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">birthday</label>
                            <input type="date" name="birthday" placeholder="Enter your birthday">
                            <?php echo isset($error_birthday) ? "<span class='error'>$error_birthday</span>" : ''; ?>
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">division</label>
                             <select name="division" id="">
                                <option value="">Select your division</option>
                                <option value="Sylhet">Sylhet</option>
                                <option value="">Dhaka</option>
                                <option value="">Barishal</option>
                                <option value="">Chottogram</option>
                             </select>
                             <?php echo isset($error_division) ? "<span class='error'>$error_division</span>" : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">district</label>
                            <select name="district" id="">
                                <option value="">Select your district</option>
                                <option value="">Sylhet</option>
                                <option value="Moulvi">Moulvi Bazar</option>
                                <option value="">Habiganj</option>
                                <option value="">Sunamganj</option>
                             </select>
                             <?php echo isset($error_district) ? "<span class='error'>$error_district</span>" : ''; ?>
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">upazila</label>
                            <select name="upazila" id="">
                                <option value="">Select your upazila</option>
                                <option value="Barlekha">Barlekha</option>
                                <option value="">Juri</option>
                                <option value="">Kulaura</option>
                                <option value="">Sreemangal</option>
                             </select>
                             <?php echo isset($error_upazila) ? "<span class='error'>$error_upazila</span>" : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">union parishad</label>
                            <select name="union_parishad" id="">
                                <option value="">Select your union</option>
                                <option value="5 No. Dakshin Shahbazpur">5 No. Dakshin Shahbazpur</option>
                                <option value="">4 No. Uttor Shahbazpur</option>
                             </select> 
                             <?php echo isset($error_union_parishad) ? "<span class='error'>$error_union_parishad</span>" : ''; ?>
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">role</label>
                            <select name="role_id" id="">
                                <option value="">Select your role</option>
                                <option value="8">Student</option>
                                <option value="">Teacher</option>
                            </select>
                            <?php echo isset($error_role) ? "<span class='error'>$error_role</span>" : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="">password</label>
                            <input type="password" name="password" placeholder="Enter your password">
                            <?php echo isset($error_password) ? "<span class='error'>$error_password</span>" : ''; ?>
                        </div>
                    </div>
                   <div class="form-group">
                        <input type="submit" name="submit" value="Submit">
                   </div>
                </form>
            </div>
         </div>
        <!-- Footer area start -->
        <div class="footer-area">
            <p></p>&copy; Abdur Rahman Alom, All Rights Reserved.</p>
        </div>
        <!-- Footer area end -->
    </div>
</body>
</html>