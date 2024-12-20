<?php include '../inc/header.php'; ?>

<!-- Attendance record area start -->
        <div class="attendance-record-section">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Month -->
            <script>
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
            </script>

            <!-- Monthly Summery -->
            <script>
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
            </script>
            <h3>your attendance record</h3>
             <form action="" method="POST">

                <!-- Month -->
                <div class="form-group monthly-record">
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
                </div>
                <a href="view-monthly-attendance-summary.php">View Monthly Attendance Record Summery</a>
             </form>
            <div id="studnet-attendance-record-monthly" class="studnet-attendance-record-monthly">
               

                      

            </div>
        </div>
        <!-- Attendance record area end -->

    <?php include '../inc/footer.php'; ?>