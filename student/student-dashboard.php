<?php include '../inc/header.php'; ?>

<!-- Attendance record area start -->
        <div class="attendance-record-section">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- Date -->
            <script>
                $(document).ready(function(){
                    $('#select_date').change(function(){
                        var selected_date = $(this).val();
                        // var selected_date = dateMonthYearFormat(selected_date);
                        
                        console.log(selected_date);

                        $.ajax({
                            url: "fetch-data/fetch-studnet-attendance-record.php",
                            method: "POST",
                            data: {selected_date: selected_date},

                            success: function(data){
                                $('#studnet-attendance-record').html(data);
                                console.log(data);
                            }
                        });
                    });
                });
            </script>

            <h3>your attendance record</h3>

            <?php 
                // $dd = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
                // $dd = "2024-11-06";
                // echo $dd = $fm->dateMontYearFormat($dd);

                
            ?>
            
            <!-- Date -->
             <form action="" method="POST" class="view-attendance">
                <div class="form-group">
                    <label for="" style="display: block">select date</label>
                    <input type="date" name="date_pick"  id="select_date">
                </div>
                <a href="student-attendance-record-monthly.php">View Monthly Attendance Record</a>
             </form>
            <div class="studnet-attendance-record">
                <table>
                    <th>Date</th>
                    <th>Teacher</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Holiday</th> 
                    <!-- tbl_attendance_record -->
                    <tbody id="studnet-attendance-record">
                       
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Attendance record area end -->

    <?php include '../inc/footer.php'; ?>