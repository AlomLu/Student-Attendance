<?php include '../inc/header.php'; ?>

        <!-- Attendance record area start -->
        <div class="attendance-record-section">
            <h3>your attendance record</h3>
            <div class="attendance-record">
                <table>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Holiday</th>
                    <th>Total Student</th>
                    <tbody>
                        <?php 
                            $user_id = Session::get('user_id');
                            $current_date = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
                            $current_date = $current_date->format("F d, Y");

                            $query_classes = "SELECT * FROM tbl_teacher WHERE user_id = '$user_id' ";
                            $teacher_classes = $db->select($query_classes);

                            if($teacher_classes){
                                while($result_class = $teacher_classes->fetch_assoc()){
                                    $class_id = $result_class['class_id'];
                                    $subject_ids = explode(',', $result_class['subject_id']);



                                    $query_class_name = "SELECT * FROM tbl_class WHERE id = '$class_id' ";
                                    $class_list = $db->select($query_class_name);

                                    if($class_list){
                                        $class_name = $class_list->fetch_assoc()['class'];
                                    }
                              
                                    foreach($subject_ids as $subject_id){

                                        $attendance_check_query = "SELECT * FROM tbl_attendance_record WHERE subject_id = '$subject_id' AND class_id = '$class_id' ";
                                        $attendance_result = $db->select($attendance_check_query);

                                        if($attendance_result){
                                        $query_subject = "SELECT * FROM tbl_subject WHERE id = '$subject_id'";
                                        $subject_list = $db->select($query_subject);
                                        

                                        if($subject_list){
                                            $subject_name = $subject_list->fetch_assoc()['subject_name'];
                                        }

                                        // Present Count for each subject
                                        $present_query = "SELECT COUNT(*) AS present_count FROM tbl_attendance_record WHERE teacher_id ='$user_id' AND class_id ='$class_id' AND subject_id ='$subject_id' AND attendance_status ='1' AND date = '$current_date'";
                                        $present_result = $db->select($present_query);

                                        if($present_result){
                                            $present_count = $present_result->fetch_assoc()['present_count'];
                                        }

                                        // Absent Count for each subject
                                        $absent_query = "SELECT COUNT(*) AS absent_count FROM tbl_attendance_record WHERE teacher_id ='$user_id' AND class_id ='$class_id' AND subject_id ='$subject_id' AND attendance_status ='2' AND date = '$current_date'";
                                        $absent_result = $db->select($absent_query);

                                        if($absent_result){
                                            $absent_count = $absent_result->fetch_assoc()['absent_count'];
                                        }

                                        // Holiday Count for each subject
                                        $holiday_query = "SELECT COUNT(*) AS holiday_count FROM tbl_attendance_record WHERE teacher_id ='$user_id' AND class_id ='$class_id' AND subject_id ='$subject_id' AND attendance_status ='3' AND date = '$current_date'";
                                        $holiday_result = $db->select($holiday_query);

                                        if($holiday_result){
                                            $holiday_count = $holiday_result->fetch_assoc()['holiday_count'];
                                        }

                                        // Total Studnet count
                                        $total_student_query = "SELECT COUNT(*) student_count FROM tbl_user WHERE class_id = '$class_id' ";
                                        $total_student_result = $db->select($total_student_query);

                                        if($total_student_result){
                                            $total_student_count = $total_student_result->fetch_assoc()['student_count'];
                                        }
                                    
                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $class_name ?></td>
                            <td><?php echo $subject_name ?></td>
                            <td><?php echo $present_count ?></td>
                            <td><?php echo $absent_count ?></td>
                            <td><?php echo $holiday_count ?></td>
                            <td><?php echo $total_student_count ?></td>
                        </tr>
                        <?php } } } }?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Attendance record area end -->

<?php include '../inc/footer.php'; ?>