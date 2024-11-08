<?php include '../inc/header.php'; ?>

<!-- Attendance record area start -->
        <div class="attendance-record-section">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Month -->
            <!-- <script>
                $(document).ready(function(){
                    $('#current_month_year').change(function(){
                        var selected_month = $(this).val();
                        
                        console.log(selected_month);

                        $.ajax({
                            url: "fetch-data/fetch-student-attendance-record-monthly.php",
                            method: "POST",
                            data: {selected_month: selected_month},

                            success: function(data){
                                $('#studnet-attendance-record-monthly').html(data);
                                console.log(data);
                            }
                        });
                    });
                });
            </script> -->

            <!-- Monthly Summery -->
            <!-- <script>
                $(document).ready(function(){
                    $('#current_month_year').change(function(){
                        var selected_month = $(this).val();
                        
                        console.log(selected_month);

                        $.ajax({
                            url: "fetch-data/fetch-student-attendance-record-monthly-summery.php",
                            method: "POST",
                            data: {selected_month: selected_month},

                            success: function(data){
                                $('#monthly-attendance-summery').html(data);
                                console.log(data);
                            }
                        });
                    });
                });
            </script> -->

            <!-- monthly-attendance-check-subject -->
            <script>
                $(document).ready(function(){
                    $('#class_id').change(function(){
                        var class_id = $(this).val();
                        // var class_id = $('#class_id').val();

                        console.log(class_id);

                        $.ajax({
                            url: "fetch-data/monthly-attendance-check-subject.php",
                            method: "POST",
                            data: {class_id: class_id},
                            success: function(data){
                                $('#selected_subject').html(data);

                                console.log(data);
                            }
                        });
                    });
                });
            </script>

            <!-- monthly-attendance-list based on class and subject -->
            <script>
                $(document).ready(function(){
                    $('#current_month_year, #class_id, #selected_subject').change(function(){
                        var selected_month = $('#current_month_year').val();
                        var selected_class_id = $('#class_id').val();
                        var selected_subject_id = $('#selected_subject').val();
                        
                        console.log(selected_month);
                        console.log(selected_class_id);
                        console.log(selected_subject_id);

                        // if(class_id != '' && selected_subject_id != '' && selected_month != ''){
                            $.ajax({
                                url: "fetch-data/fetch-student-attendance-record-monthly.php",
                                method: "POST",
                                data: {selected_month: selected_month, selected_class_id: selected_class_id, selected_subject_id: selected_subject_id},
                                success: function(data){
                                    $('#selected_attendance_records').html(data);

                                    console.log(data);
                                }
                            });
                        // }
                    });
                });
            </script>
            <h3>your attendance record</h3>
            <?php 
                $teacher_id = Session::get('user_id');
            ?>
             <form action="" method="POST">

                 <div class="form-group monthly-record">

                     <!-- Month -->
                     <label for="" style="display: block">select month</label>
                    <select name="current_month_year" id="current_month_year">
                        <option value="">Select Month</option>
                        <?php 
                            $currentYear = date("Y");
                            $month_query = "SELECT * FROM tbl_month";
                            $month_result = $db->select($month_query);

                            if($month_result->num_rows > 0){
                                while($result = $month_result->fetch_assoc()){

                             
                        ?>
                            <option value="<?php echo $result['month'].' '.$currentYear?>"><?php echo $result['month'] ?></option>
                        <?php } } ?>
                    </select>

                    <!-- Class -->
                    <select name="class_id" id="class_id">
                        <option value="">Select class</option>
                        <?php 

                            //Using join
                            $class_query = "SELECT 
                                            tbl_teacher.*, 
                                            tbl_class.* 
                                            FROM tbl_teacher

                                            INNER JOIN tbl_class
                                            ON tbl_teacher.class_id = tbl_class.id

                                            WHERE user_id = '$teacher_id'";

                            $class_list = $db->select($class_query);

                            if($class_list){
                                while($result = $class_list->fetch_assoc()){
                                    echo "<option value='".$result['id']."'>".$result['class']."</option>";
                                }
                            }
                       
                            //Using Multiple queries...

                            // $class_id_query = "SELECT * FROM tbl_teacher WHERE user_id = '$teacher_id' ";
                            // $class_id_result = $db->select($class_id_query);

                            // if($class_id_result){
                            //     while($result = $class_id_result->fetch_assoc()){
                            //         $class_id = $result['class_id'];

                            //         $class_name_query = "SELECT * FROM tbl_class WHERE id = '$class_id' ";
                            //         $class_list = $db->select($class_name_query);

                            //         if($class_list){
                            //             while($class_name_result = $class_list->fetch_assoc()){
                            //                 echo "<option value='".$class_name_result['id']."'>".$class_name_result['class']."</option>";
                            //             }
                            //         }
                            //     }
                            // }
                        ?>
                    </select>

                    <!-- subject -->
                    <select name="subject_id" id="selected_subject">
                        <option value="">Select subject</option>
                    </select>
                    <?php 
                        if(!empty($error_subject)){
                            echo $error_subject;
                        }
                    ?>
                </div>
                <div class="form-group">
                </div>
                <a href="view-monthly-attendance-summary.php">View Monthly Attendance Record Summery</a>
             </form>
            <div id="selected_attendance_records" class="studnet-attendance-record-monthly">
               

                      

            </div>
        </div>
        <!-- Attendance record area end -->

    <?php include '../inc/footer.php'; ?>