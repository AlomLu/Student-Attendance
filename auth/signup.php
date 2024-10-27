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
                <form action="" method="POST">
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">first name</label>
                            <input type="text" name="fname" placeholder="Enter your first name">
                        </div>
                        <div class="form-group">
                            <label for="">last name</label>
                            <input type="text" name="lname" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="text" name="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="">mobile number</label>
                            <input type="text" name="mobile_number" placeholder="Enter your mobile number">
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">gender</label>
                            <input type="radio" name="gender" value="male">Male
                            <input type="radio" name="gender" value="female">Female
                        </div>
                        <div class="form-group">
                            <label for="">birthday</label>
                            <input type="date" name="birthday" placeholder="Enter your birthday">
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">division</label>
                             <select name="division" id="">
                                <option value="">Select your division</option>
                                <option value="">Sylhet</option>
                                <option value="">Dhaka</option>
                                <option value="">Barishal</option>
                                <option value="">Chottogram</option>
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="">district</label>
                            <select name="district" id="">
                                <option value="">Select your district</option>
                                <option value="">Sylhet</option>
                                <option value="">Moulvi Bazar</option>
                                <option value="">Habiganj</option>
                                <option value="">Sunamganj</option>
                             </select>
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">upazila</label>
                            <select name="upazila" id="">
                                <option value="">Select your upazila</option>
                                <option value="">Barlekha</option>
                                <option value="">Juri</option>
                                <option value="">Kulaura</option>
                                <option value="">Sreemangal</option>
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="">union</label>
                            <select name="union" id="">
                                <option value="">Select your union</option>
                                <option value="">5 No. Dakshin Shahbazpur</option>
                                <option value="">4 No. Uttor Shahbazpur</option>
                             </select> 
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">role</label>
                            <select name="role" id="">
                                <option value="">Select your role</option>
                                <option value="">Student</option>
                                <option value="">Teacher</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">password</label>
                            <input type="password" name="password" placeholder="Enter your password">
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