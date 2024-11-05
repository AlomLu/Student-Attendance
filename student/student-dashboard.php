<?php include '../inc/header.php'; ?>

<!-- Attendance record area start -->
        <div class="attendance-record-section">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#select_date').change(function(){
                        var selected_date = $(this).val();
                        
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

             <form action="" method="POST">
                <div class="form-group">
                    <label for="">select date</label>
                    <input type="date" name="date_pick"  id="select_date">
                </div>
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
            <div class="monthly-studnet-attendance-record">
                <h3>November, 2024</h3>
            </div>
        </div>
        <!-- Attendance record area end -->

    <?php include '../inc/footer.php'; ?>