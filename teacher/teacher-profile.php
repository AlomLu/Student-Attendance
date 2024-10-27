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
                            <label for="">image</label>
                            <input type="file" name="image" id="image">
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