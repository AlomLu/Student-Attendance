<?php include '../inc/header.php'; ?>

        <!-- Profile area start -->
        <div class="profile-area">
            <div class="profile">
                <h3>update your profile</h3>
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
                            <label for="">class</label>
                            <!-- <input type="text" name="class" placeholder="Enter your class"> -->
                            <select name="class" id="">
                                <option value="">Select your class</option>
                                <option value="">10</option>
                                <option value="">9</option>
                                <option value="">8</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">section</label>
                            <input type="text" name="section" placeholder="Enter your section">
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
                            <input type="submit" name="class" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Profile area end -->

<?php include '../inc/footer.php'; ?>