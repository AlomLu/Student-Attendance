<?php include '../inc/header.php'; ?>

        <!-- Attendance area start -->
        <div class="attendance">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

             // Fetch-subject by class
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

            // Fetch-student by class and subject
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
                        $error_class = '';
                        $error_subject = '';
                        $error_attendance = '';
                       
                            
                        $class_id = mysqli_real_escape_string($db->link, $_POST['class_id']);
                        $subject_id = mysqli_real_escape_string($db->link, $_POST['subject_id']);
                        $teacher_id = mysqli_real_escape_string($db->link, $_POST['teacher_id']);
                        $date = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
                        $date = $date->format("F d, Y");

                        $user_data = $_POST['user_id']; //Array for user_id
                        $attendance_data = $_POST['attendance_status']; //Array of attendance_status

                        if($class_id == ''){
                            $error_class = "Field must not be empty !!";
                        }
                        if($subject_id == ''){
                            $error_class = "Field must not be empty !!";
                        }

                        if(!empty($class_id) && !empty($subject_id)){
                            foreach($user_data as $index => $user){
                                $sanitized_user_id = mysqli_real_escape_string($db->link, $user);

                                $sanitized_attendance_status = mysqli_real_escape_string($db->link, $attendance_data[$index]);

                                if($sanitized_attendance_status == ''){
                                    $error_attendance = "Field must not be empty !!";
                                }

                                // if(!empty($sanitized_attendance_status)){
                                    $query = "INSERT INTO tbl_attendance_record (user_id, class_id, subject_id, attendance_status, teacher_id, date) 
                                    VALUES ('$sanitized_user_id', '$class_id', '$subject_id', '$sanitized_attendance_status', '$teacher_id', '$date')";
                                    $result = $db->insert($query);

                                  
                                // }
                            }
                            if($result){
                                echo "<script>alert('Attendance  records inserted successfully');</script>";
                            }else{
                                echo "<script>alert('Attendance  records not inserted');</script>";
                            }
                        }
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
                            <?php 
                                if(!empty($error_class)){
                                    echo $error_class;
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <select name="subject_id" id="selected-class">
                                <option value="">Select subject</option>
                            </select>
                            <?php 
                                if(!empty($error_subject)){
                                    echo $error_subject;
                                }
                            ?>
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
                            $teacher_id = Session::get('user_id');
                            $current_date_month_year = $fm->currentDateMonthYear(); 
                            $attendance_check_query = "SELECT 
                                                        tbl_attendance_record.teacher_id, 
                                                        tbl_attendance_record.class_id,
                                                        tbl_attendance_record.subject_id,
                                                        tbl_attendance_record.*,   
                                                        tbl_subject.*,
                                                        tbl_class.*,
                                                        COUNT(*) as count,

                                                        SUM(CASE WHEN tbl_attendance_record.attendance_status = 1 THEN 1 ELSE 0 END) as present_count,
                                                        SUM(CASE WHEN tbl_attendance_record.attendance_status = 2 THEN 1 ELSE 0 END) as absent_count,
                                                        SUM(CASE WHEN tbl_attendance_record.attendance_status = 3 THEN 1 ELSE 0 END) as holiday_count
                                                        FROM tbl_attendance_record

                                                        INNER JOIN tbl_subject
                                                        ON tbl_attendance_record.subject_id = tbl_subject.id

                                                        INNER JOIN tbl_class
                                                        ON tbl_attendance_record.class_id = tbl_class.id

                                                        WHERE teacher_id = '$teacher_id' AND DATE_FORMAT(created_at, '%M %d %Y') = '$current_date_month_year'
                                                        
                                                        GROUP BY 
                                                        tbl_attendance_record.teacher_id, 
                                                        tbl_attendance_record.class_id, 
                                                        tbl_attendance_record.subject_id
                                                    ";

                            $attendance_result = $db->select($attendance_check_query);

                            if($attendance_result){
                                while($result = $attendance_result->fetch_assoc()){

                        ?>

                        <tr>
                            <td><?php echo $result['class'] ?></td>
                            <td><?php echo $result['subject_name'] ?></td>
                            <td><?php echo $result['present_count'] ?></td>
                            <td><?php echo $result['absent_count'] ?></td>
                            <td><?php echo $result['holiday_count'] ?></td>
                            <td><?php echo $result['count'] ?></td>
                        </tr>

                        <?php } } ?>

                    </tbody>
                </table>
            </div>
        </div>

<?php include '../inc/footer.php'; ?>