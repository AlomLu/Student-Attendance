<?php include '../inc/header.php'; ?>

<!-- Attendance record area start -->
        <div class="attendance-record-section">
            <h3>What class do you study?</h3>
            <?php 
                // print_r($_SESSION);
            ?>
            <!-- <?php echo Session::get('user_fname') ?> -->
            <div class="class">
                <div class="form-group-inline">
                    <?php 
                        $user_id = Session::get('user_id');

                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $class_id = mysqli_real_escape_string($db->link, $fm->validation($_POST['class_id']));
                            // $class_id = strtolower($class_id);

                            if($class_id == ''){
                                echo "<span class='error'>Filed must not be empty</span>";
                            }else{
                                $query = "UPDATE tbl_user
                                            SET
                                            class_id = '$class_id'
                                            WHERE id = '$user_id' ";
                                $result = $db->update($query);

                                if($result){
                                    echo "<span class='success'>Class updated successfully</span>";
                                }else{
                                    echo "<span class='error'>Class not updated</span>";
                                }
                            }
                        }
                    ?>
                    <?php 
                        $query = "SELECT tbl_user.*, tbl_class.class FROM tbl_user
                                    INNER JOIN tbl_class
                                    ON tbl_user.class_id = tbl_class.id
                                    WHERE tbl_user.id = '$user_id'
                                    ";
                        $class = $db->select($query);

                        if($class){
                            while($get_class = $class->fetch_assoc()){

                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">class</label>
                            <!-- <input type="text" name="class" value="Enter your class"> -->
                            <select name="class_id" id="">
                                <option value="">
                                    <!-- <?php
                                        // if(Session::get('user_class') == '0'){
                                        //     echo "Select your class";
                                        // }else{
                                            echo $get_class['class'];
                                        // }
                                    ?> -->
                                </option>
                                <?php 
                                    $query = "SELECT * FROM tbl_class";
                                    $class_list = $db->select($query);

                                    if($class_list){
                                        while($result = $class_list->fetch_assoc()){

                                ?>
                                <option value="<?php echo $result['id'] ?>"><?php echo $result['class'] ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="save">
                        </div>
                    </form>
                    <?php } } ?>
                    <!-- <div class="form-group">
                        <label for="">section</label>
                        <input type="text" name="section" value="">
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Attendance record area end -->

    <?php include '../inc/footer.php'; ?>
