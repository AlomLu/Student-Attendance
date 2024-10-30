<?php include '../inc/header.php'; ?>

        <!-- Profile area start -->
        <div class="profile-area">
            <div class="profile">
                <h3>update your profile</h3>
                <?php 
                    $user_id = Session::get('user_id');
                    $query = "SELECT * FROM tbl_user WHERE id = '$user_id' ";
                    $user_details = $db->select($query);

                    if($user_details){
                        while($result = $user_details->fetch_assoc()){

                ?>
                <form action="" method="POST">
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">first name</label>
                            <input type="text" name="fname" value="<?php echo $result['fname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">last name</label>
                            <input type="text" name="lname" value="<?php echo $result['lname'] ?>">
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="text" readonly name="email" value="<?php echo $result['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="">mobile number</label>
                            <input type="text" name="mobile_number" value="<?php echo $result['mobile_number'] ?>">
                        </div>
                    </div>
                    <!-- <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">class</label>
                            <select name="class" id="">
                                <option value="">Select your class</option>
                                <option value="">10</option>
                                <option value="">9</option>
                                <option value="">8</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">section</label>
                            <input type="text" name="section" value="">
                        </div>
                    </div> -->
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">gender</label>
                            <input type="radio" name="gender" value="male"
                              <?php if(Session::get('user_gender') == 'male'){
                                echo 'checked';
                              } ?>  >Male
                            <input type="radio" name="gender" value="female"
                            <?php if(Session::get('user_gender') == 'female'){
                                echo 'checked';
                              } ?> >Female
                        </div>
                        <div class="form-group">
                            <label for="">birthday</label>
                            <input type="date" name="birthday" value="<?php echo $result['birthday'] ?>">
                        </div>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="">division</label>
                            <select name="division" id="">
                                <option value=""><?php echo $result['division'] ?></option>
                                <option value="">Sylhet</option>
                                <option value="">Dhaka</option>
                                <option value="">Barishal</option>
                                <option value="">Chottogram</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">district</label>
                            <select name="district" id="">
                                <option value=""><?php echo $result['district'] ?></option>
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
                                <option value=""><?php echo $result['upazila'] ?></option>
                                <option value="">Barlekha</option>
                                <option value="">Juri</option>
                                <option value="">Kulaura</option>
                                <option value="">Sreemangal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">union</label>
                            <select name="union" id="">
                                <option value=""><?php echo $result['union_parishad'] ?></option>
                                <option value="">5 No. Dakshin Shahbazpur</option>
                                <option value="">4 No. Uttor Shahbazpur</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form-group-inline">
                      
                        <div class="form-group">
                            <input type="submit" name="class" value="Update">
                        </div>
                    </div>
                </form>
                <?php } } ?>
            </div>
        </div>
        <!-- Profile area end -->

<?php include '../inc/footer.php'; ?>