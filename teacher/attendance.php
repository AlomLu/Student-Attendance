<?php include '../inc/header.php'; ?>

        <!-- Attendance area start -->
        <div class="attendance">
            <div class="about">
                <h3>Teacher Name</h3>
                <p>
                    <span>Class: 10</span>
                    <span>Section: A</span>
                </p>
                <p>Data: 25th October, 2024</p>
            </div>
            <div class="attendance-form">
                <h3>Attendance</h3>
                <form action="" method="POST">
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Holiday</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>Abdur Rahman
                                    <!-- <input type="hidden" value="Id of student"> -->
                                </td>
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
                            <tr>
                                <td>John Doe
                                    <!-- <input type="hidden" value="Id of student"> -->
                                </td>
                                <td>
                                    <input type="checkbox" name="status" class="status-checkbox" data-row="2">
                                </td>
                                <td>
                                    <input type="checkbox" name="status" class="status-checkbox" data-row="2">
                                </td>
                                <td>
                                    <input type="checkbox" name="status" class="status-checkbox" data-row="2">
                                </td>
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