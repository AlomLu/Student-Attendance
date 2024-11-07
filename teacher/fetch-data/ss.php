<?php include '../inc/header.php'; ?>

        <!-- Attendance area start -->
        <div class="attendance">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#class').change(function(){
                    // var class_id = $(this).val();

                    var class_id = $('#class').val();
                    console.log(class_id);

                    $.ajax({
                        url: "fetch-data/fetch-subject-attendance.php",
                        method: "POST",
                        data: {class_id: class_id},
                        success: function(data){
                            $('#selected-class').html(data);

                            console.log(data);
                        }
                    })
                })
            })
            $(document).ready(function(){
                $('#class').change(function(){
                    // var class_id = $(this).val();

                    var class_id = $('#class').val();
                    console.log(class_id);

                    $.ajax({
                        url: "fetch-data/fetch-student.php",
                        method: "POST",
                        data: {class_id: class_id},
                        success: function(data){
                            $('#student').html(data);

                            console.log(data);
                        }
                    })
                })
            })
        </script>
            <div class="about">
                <h3><?php echo Session::get('user_fname').' '.Session::get('user_lname').' '.Session::get('user_id') ?></h3>
                <p>
                    <!-- <span>Class: 10</span> -->
                    <!-- <span>Subject:</span>  -->
                        <?php 
                            $user_id = Session::get('user_id');

                            $query = "SELECT * FROM tbl_teacher WHERE user_id = '$user_id' ";
                            $teacher_details = $db->select($query);

                            if($teacher_details){
                                while($result = $teacher_details->fetch_assoc()){
                                    $get_class_id = $result['class_id'];
                                    $get_subject_id_string = $result['subject_id'];

                                    $query_class = "SELECT * FROM tbl_class WHERE id = '$get_class_id' ";
                                    $get_class = $db->select($query_class);

                                    if($get_class){
                                        // echo "<span>Class: </span>";
                                        while($result_class = $get_class->fetch_assoc()){

                                            ?>
                                          <?php  echo "<span>"."Class ".$result_class['class']." - "."</span>" ?>

                                          <?php  $subject_array = explode(',', $get_subject_id_string);

                                            foreach($subject_array as $subject_id){
                                                $query_subject = "SELECT * FROM tbl_subject WHERE id = '$subject_id' ";
                                                $get_subject = $db->select($query_subject);

                                                if($get_subject){
                                                    while($result_subject = $get_subject->fetch_assoc()){
                                                        echo "<span>".$result_subject['subject_name']." | "."</span>";
                                                    }
                                                }
                                            }
                                            // $query_subject = "SELECT * FROM tbl_subject WHERE id = '$get_subject_id' ";
                                            // $subject_list = $db->select($query_subject);
                                            
                                        }
                                    }
                                }
                            }
                        ?>
                    
                </p>
                <p>
                    <?php 
                        $current_date = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
                        $current_date = $current_date->format("F d, Y");
                        
                        echo $current_date 
                    ?>
                </p>
            </div>
            <div class="attendance-form">
                <h3>Attendance</h3>
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance_status']) && isset($_POST['user_id'])){
                        $class_id = mysqli_real_escape_string($db->link, $_POST['class_id']);
                        $subject_id = mysqli_real_escape_string($db->link, $_POST['subject_id']);
                        $teacher_id = mysqli_real_escape_string($db->link, $_POST['teacher_id']);
                        $date = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
                        $date = $date->format("F d, Y");
                        $user_data = $_POST['user_id']; //Array fof user_id
                        $attendance_data = $_POST['attendance_status']; //Array of attendance_status

                        foreach($user_data as $index => $user){
                            $sanitized_user_id = mysqli_real_escape_string($db->link, $user);

                            // foreach($attendance_data as $attendance){
                                $sanitized_attendance_status = mysqli_real_escape_string($db->link, $attendance_data[$index]);

                                $query = "INSERT INTO tbl_attendance_record (user_id, class_id, subject_id, attendance_status, teacher_id, date) 
                                VALUES ('$sanitized_user_id', '$class_id', '$subject_id', '$sanitized_attendance_status', '$teacher_id', '$date')";
                                $db->insert($query);
                            // }

                        }
                        echo "<script>alert('Attendance records inserted successfully');</script>";
                    }

                   
                ?>
                <form action="" method="POST">
                   <div class="class-section">
                        <div class="form-group">
                            <input type="hidden" name="teacher_id" value="<?php echo Session::get('user_id'); ?>">
                            <select name="class_id" id="class" style="margin-bottom: 30px">
                                <option value="">Select class</option>
                                <?php 
                                $user_id = Session::get('user_id');

                                $query = "SELECT * FROM tbl_teacher WHERE user_id = '$user_id' ";
                                $teacher_details = $db->select($query);

                                if($teacher_details){
                                    while($result = $teacher_details->fetch_assoc()){
                                        $get_class_id = $result['class_id'];
                                        $get_subject_id_string = $result['subject_id'];

                                        $query_class = "SELECT * FROM tbl_class WHERE id = '$get_class_id' ";
                                        $get_class = $db->select($query_class);

                                        if($get_class){
                                            // echo "<span>Class: </span>";
                                            while($result_class = $get_class->fetch_assoc()){
                                                echo "<option value='".$result_class['id']."'>".$result_class['class']."</option>";
                                            }
                                        }
                                    }
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="subject_id" id="selected-class">
                                <option value="">Select subject</option>
                            </select>
                        </div>
                   </div>
                    <table>
                        <tr>
                            <th width="15%">Student Id</th>
                            <th width="40%">Name</th>
                            <th width="15%">Present</th>
                            <th width="15%">Absent</th>
                            <th width="15%">Holiday</th>
                        </tr>
                        <tbody id="student">
                           
                        </tbody>
                    </table>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="student-record">
                <h3>student record <span><?php echo $current_date ?></span></h3>
                <table>
                    <tr>
                        <th width="15%">class</th>
                        <th width="15%">Subject</th>
                        <th width="15%">Present</th>
                        <th width="15%">Absent</th>
                        <th width="15%">Holiday</th>
                        <th width="15%">Total Student</th>
                    </tr>
                    <tbody>
                    <?php 
                        // Fetch classes associated with the teacher
                        $query_classes = "SELECT * FROM tbl_teacher WHERE user_id = '$user_id'";
                        $teacher_classes = $db->select($query_classes);

                        if ($teacher_classes) {
                            while ($teacher_class = $teacher_classes->fetch_assoc()) {
                                $class_id = $teacher_class['class_id'];
                                $subject_ids = explode(',', $teacher_class['subject_id']);

                                // Fetch class name
                                $query_class_name = "SELECT class FROM tbl_class WHERE id = '$class_id'";
                                $class_result = $db->select($query_class_name);

                                if($class_result){
                                    $class_name = $class_result->fetch_assoc()['class'];
                                }

                                foreach ($subject_ids as $subject_id) {

                                    $attendance_check_query = "SELECT * FROM tbl_attendance_record WHERE class_id = '$class_id' AND subject_id = '$subject_id' AND date = '$current_date'";
                                    $attendance_result = $db->select($attendance_check_query);

                                    if($attendance_result){

                                    

                                    // Fetch subject name
                                    $query_subject_name = "SELECT subject_name FROM tbl_subject WHERE id = '$subject_id'";
                                    $subject_result = $db->select($query_subject_name);

                                    if($subject_result){
                                        $subject_name = $subject_result->fetch_assoc()['subject_name'];
                                    }

                                    // Count Present for each subject
                                    $present_query = "SELECT COUNT(*) AS present_count FROM tbl_attendance_record 
                                                    WHERE teacher_id = '$user_id' AND class_id = '$class_id' AND subject_id = '$subject_id' AND attendance_status = '1' AND date = '$current_date' ";

                                    $present_result = $db->select($present_query);
                                    if($present_result){
                                        $present_count = $present_result->fetch_assoc()['present_count'];
                                    }

                                     // Count Absent for each subject
                                    $absent_query = "SELECT COUNT(*) AS absent_count FROM tbl_attendance_record
                                                WHERE teacher_id = '$user_id' AND class_id = '$class_id' AND subject_id = '$subject_id' AND attendance_status = '2' AND attendance_status = '2' AND date = '$current_date' ";
                                    
                                    $absent_result = $db->select($absent_query);
                                    if($absent_result){
                                        $absent_count = $absent_result->fetch_assoc()['absent_count'];
                                    }

                                     // Count Holiday for each subject
                                    $holiday_query = "SELECT COUNT(*) AS holiday_count FROM tbl_attendance_record
                                                WHERE teacher_id = '$user_id' AND class_id = '$class_id' AND subject_id = '$subject_id' AND attendance_status = '3' AND attendance_status = '3' AND date = '$current_date' ";
                                    
                                    $holiday_result = $db->select($holiday_query);
                                    if($holiday_result){
                                        $holiday_count = $holiday_result->fetch_assoc()['holiday_count'];
                                    }

                                    // Count Total student
                                    $total_student_query = "SELECT COUNT(*) AS total_student_count FROM tbl_user
                                                WHERE class_id = '$class_id'";
                                    
                                    $total_student_result = $db->select($total_student_query);
                                    if($total_student_result){
                                        $total_student_count = $total_student_result->fetch_assoc()['total_student_count'];
                                    }

                                    ?>
                                    
                                    <tr>
                                        <td style="color: "><?php echo $class_name; ?></td>
                                        <td style="font-weight: bold"><?php echo $subject_name; ?></td>
                                        <td style="color: green"><?php echo $present_count; ?></td>
                                        <td style="color: red"><?php echo $absent_count; ?></td>
                                        <td style="color: blue"><?php echo $holiday_count; ?></td>
                                        <td style="font-weight: bold"><?php echo $total_student_count; ?></td>
                                    </tr>
                                    
                    <?php } } } }?>

                    </tbody>
                </table>
            </div>
            
            <!-- else {
                            echo "<tr><td colspan='6'>No data available</td></tr>";
                        } -->

            
            
            <!-- <div class="attendance-form">
               <h3>attendance</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">subject</label>
                        <select name="subject" id="">
                            <option value="">Select your subject</option>
                            <option value="">ICT</option>
                            <option value="">Math</option>
                            <option value="">Physics</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">attendance status</label>
                        <input type="radio" name="attendance_status" value="male"><span>Present</span>
                        <input type="radio" name="attendance_status" value="female"><span>Absent</span>
                        <input type="radio" name="attendance_status" value="female"><span>Holiday</span>
                    </div>
                </form>
           </div> -->
        </div>
        <!-- Attendance area end -->

<?php include '../inc/footer.php'; ?>