<!-- <ul>
    <li><a href="../student/student-dashboard.html">dashboard</a></li>
    <li><a href="../student/student-profile.html">profile</a></li>
    <li><a href="../teacher/attendance.html">attendance</a></li>
    <li><a href="../auth/change-pass.html">change password</a></li>
    <li><a href="">Alom</a></li>
    <li><a href="">Logout</a></li>
</ul> -->
<?php include '../inc/header.php'; ?>
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

<?php include '../inc/footer.php'; ?>
