<?php include '../inc/header.php'; ?>

<!-- Attendance record area start -->
        <div class="attendance-record-section">
            <h3>your attendance record</h3>
            <?php 
                // print_r($_SESSION);
            ?>
            <!-- <?php echo Session::get('user_fname') ?> -->
            <div class="attendance-record">
                <table>
                    <th>Teacher</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Holiday</th> 
                    <!-- tbl_attendance_record -->
                    <tbody>
                        <?php 
                            $student_id = Session::get('user_id');
                            $current_date = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
                            $current_date = $current_date->format("F d, Y");

                            $student_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND date = '$current_date' ";
                            $studnet_result = $db->select($student_query);
                            if($studnet_result){
                                while($student_details = $studnet_result->fetch_assoc()){
                                    // $date = $student_details['date'];
                                    $teacher_id = $student_details['teacher_id'];
                                    $subject_id = $student_details['subject_id'];

                                    // Teacher name
                                    $teacher_query = "SELECT * FROM tbl_teacher WHERE user_id = '$teacher_id' ";
                                    $teacher_result = $db->select($teacher_query);

                                    if($teacher_result){

                                        $teacher_id = $teacher_result->fetch_assoc()['user_id'];

                                        $teacher_name_query = "SELECT * FROM tbl_user WHERE id = '$teacher_id' ";
                                        $teacher_name_result = $db->select($teacher_name_query);
                                        if($teacher_name_result){
                                            $row = $teacher_name_result->fetch_assoc();
                                            $teacher_name = ucfirst($row['fname'].' '.$row['lname']);
                                        }
                                    }
                        ?>
                        <tr>
                            <td><?php echo $current_date ?></td>
                            <td><?php echo $teacher_name ?></td>
                            <td>
                                <?php 
                                    $presentCheck_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND subject_id = '$subject_id' AND date = '$current_date' AND attendance_status ='1' ";
                                    $present_result = $db->select($presentCheck_query);

                                    if($present_result){
                                        while($get_id = $present_result->fetch_assoc()){
                                            $id = $get_id['subject_id'];

                                            $query_subject_name = "SELECT * FROM tbl_subject WHERE id = '$id' ";
                                            $subject_name_result = $db->select($query_subject_name);

                                            if($subject_name_result){
                                                echo ucfirst($subject_name_result->fetch_assoc()['subject_name']);
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $presentCheck_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND subject_id = '$subject_id' AND date = '$current_date' AND attendance_status ='2' ";
                                    $present_result = $db->select($presentCheck_query);

                                    if($present_result){
                                        while($get_id = $present_result->fetch_assoc()){
                                            $id = $get_id['subject_id'];

                                            $query_subject_name = "SELECT * FROM tbl_subject WHERE id = '$id' ";
                                            $subject_name_result = $db->select($query_subject_name);

                                            if($subject_name_result){
                                                echo ucfirst($subject_name_result->fetch_assoc()['subject_name']);
                                            }
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $presentCheck_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND subject_id = '$subject_id' AND date = '$current_date' AND attendance_status ='3' ";
                                    $present_result = $db->select($presentCheck_query);

                                    if($present_result){
                                        while($get_id = $present_result->fetch_assoc()){
                                            $id = $get_id['subject_id'];

                                            $query_subject_name = "SELECT * FROM tbl_subject WHERE id = '$id' ";
                                            $subject_name_result = $db->select($query_subject_name);

                                            if($subject_name_result){
                                                echo ucfirst($subject_name_result->fetch_assoc()['subject_name']);
                                            }
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Attendance record area end -->

    <?php include '../inc/footer.php'; ?>