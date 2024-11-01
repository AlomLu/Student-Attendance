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
                <p>Data: 25th October, 2024</p>
            </div>
            <div class="attendance-form">
                <h3>Attendance</h3>
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance_status']) && isset($_POST['user_id'])){
                        $class_id = mysqli_real_escape_string($db->link, $_POST['class_id']);
                        $subject_id = mysqli_real_escape_string($db->link, $_POST['subject_id']);
                        $user_data = $_POST['user_id'];
                        $attendance_data = $_POST['attendance_status'];

                        foreach($user_data as $index => $user){
                            $sanitized_user_id = mysqli_real_escape_string($db->link, $user);

                            // foreach($attendance_data as $attendance){
                                $sanitized_attendance_status = mysqli_real_escape_string($db->link, $attendance_data[$index]);

                                $query = "INSERT INTO tbl_attendance_record (user_id, class_id, subject_id, attendance_status) 
                                VALUES ('$sanitized_user_id', '$class_id', '$subject_id', '$sanitized_attendance_status')";
                                $db->insert($query);
                            // }

                        }
                        echo "<script>alert('Attendance records inserted successfully');</script>";
                    }

                   
                ?>
                <form action="" method="POST">
                   <div class="class-section">
                        <div class="form-group">
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