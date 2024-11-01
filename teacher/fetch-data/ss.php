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
                <form action="" method="POST">
                   <div class="class-section">
                        <div class="form-group">
                            <select name="" id="class" style="margin-bottom: 30px">
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
                            <select name="" id="selected-class">
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
                        <tbody>
                            <?php 
                                $query = "SELECT * FROM tbl_user WHERE class_id = '14'";
                                $student_list = $db->select($query);
                                
                                if($student_list){
                                    while($result = $student_list->fetch_assoc()){

                            ?>
                            <tr>
                                <td><?php echo $result['id'] ?></td>
                                <td><?php echo $result['fname'] ?></td>
                                <td>
                                    <input type="checkbox" name="status" class="status-checkbox" data-row="1">
                                </td>
                                <td>
                                    <input type="checkbox" name="status" class="status-checkbox" data-row="1">
                                </td>
                                <td>
                                    <input type="checkbox" name="status" class="status-checkbox" data-row="1">
                                </td>
                            </tr>
                            <?php } } ?>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            
            <script>
                    // var exnode = document.querySelectorAll('.status-checkbox');
                    // console.log(exnode);

                    // exnode.forEach(node=>{
                    //     console.log(node.textContent);
                    // });
                

                document.querySelectorAll('.status-checkbox').forEach(checkbox => {
                    
                    checkbox.addEventListener('change', function() {
                        const row = this.getAttribute('data-row');
                        console.log(row)
                        document.querySelectorAll(`.status-checkbox[data-row="${row}"]`).forEach(cb => {
                            if (cb !== this) cb.checked = false;
                        });
                    });
                });
            </script>
            
            
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

<?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        // $error_attendance_status = '';

                        // if($error_attendance_status == ''){
                        //     $error_attendance_status = "Field must not be empty !!";
                        // }

                        $user_id = mysqli_real_escape_string($db->link, $_POST['user_id']);
                        $class_id = mysqli_real_escape_string($db->link, $_POST['class_id']);
                        $subject_id = mysqli_real_escape_string($db->link, $_POST['subject_id']);

                        if(isset($_POST['attendance_status'])){
                            $attendance_status_array = $_POST['attendance_status']; //Array of attendance status


                            foreach($attendance_status_array as $attendance_status_string){
                                $sanitized_attendance_status[] = mysqli_real_escape_string($db->link, $attendance_status_string);
                            }

                            $attendance_status = implode(',', $sanitized_attendance_status);

                        }


                        if(!empty($user_id) && !empty($class_id) && !empty($subject_id) && !empty($attendance_status)){
                            $query = "INSERT INTO tbl_attendance_record (user_id, class_id, subject_id, attendance_status) VALUES ('$user_id', '$class_id', '$subject_id', '$attendance_status') ";
                            $row_insert = $db->insert($query);

                            if($row_insert){
                                echo "<script>alert('successfully inserted')</script>";
                            }else{
                                echo "<script>alert('Something went wrong !!')</script>";
                            }
                        }
                    }
                ?>