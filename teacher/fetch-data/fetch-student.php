<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['class_id'])){
        $user_id = Session::get('user_id');
        $class_id = $_POST['class_id'];

        $query = "SELECT * FROM tbl_user WHERE class_id = '$class_id'";
        $student_details = $db->select($query);

        if($student_details){
            while($result = $student_details->fetch_assoc()){
                echo "
                    <tr>
                        <td>".$result['id']."</td>
                        <td>".$result['fname']."<input type='hidden' name='user_id[]' value='".$result['id']."' ></td>
                        
                        <td>
                            <input type='checkbox' name='attendance_status[]' class='status-checkbox' value='1' data-row='".$result['id']."'; 

                           >
                        </td>
                        <td>
                            <input type='checkbox' name='attendance_status[]' class='status-checkbox' value='2' data-row='".$result['id']."' >
                        </td>
                        <td>
                            <input type='checkbox' name='attendance_status[]' class='status-checkbox' value='3' data-row='".$result['id']."' >
                        </td>
                    </tr>
                ";
            }
        }else{
            echo "
                    <tr>
                        <td>No studnets in this class</td>
                    </tr>
                ";
        }

        
       
    }
?>
<script>

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


<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['class_id'])){
        $user_id = Session::get('user_id');
        $class_id = $_POST['class_id'];

        $query = "SELECT * FROM tbl_user WHERE class_id = '$class_id'";
        $student_details = $db->select($query);

        if($student_details){
            while($result = $student_details->fetch_assoc()){
                echo "
                    <tr>
                        <td>".$result['id']."</td>
                        <td>".$result['fname']."<input type='hidden' name='user_id[]' value='".$result['id']."' ></td>
                        
                        <td>
                            <input type='checkbox' name='attendance_status[".$result['id']."]' class='status-checkbox' value='1' data-row='".$result['id']."' 
                            ";
                            // Check if attendance status is present
                            $attendance_query = "SELECT * FROM tbl_attendance WHERE user_id = '".$result['id']."' AND attendance_status = '1'";
                            $attendance_record = $db->select($attendance_query);
                            if ($attendance_record) {
                                while ($attendance = $attendance_record->fetch_assoc()) {
                                    if ($attendance['attendance_status'] == '1') {
                                        echo "checked"; // Check if attendance status is present
                                    }
                                }
                            }
                            echo " >
                        </td>
                        <td>
                            <input type='checkbox' name='attendance_status[".$result['id']."]' class='status-checkbox' value='2' data-row='".$result['id']."' 
                            ";
                            // Check if attendance status is absent
                            $attendance_query = "SELECT * FROM tbl_attendance WHERE user_id = '".$result['id']."' AND attendance_status = '2'";
                            $attendance_record = $db->select($attendance_query);
                            if ($attendance_record) {
                                while ($attendance = $attendance_record->fetch_assoc()) {
                                    if ($attendance['attendance_status'] == '2') {
                                        echo "checked"; // Check if attendance status is absent
                                    }
                                }
                            }
                            echo " >
                        </td>
                        <td>
                            <input type='checkbox' name='attendance_status[".$result['id']."]' class='status-checkbox' value='3' data-row='".$result['id']."' 
                            ";
                            // Check if attendance status is holiday
                            $attendance_query = "SELECT * FROM tbl_attendance WHERE user_id = '".$result['id']."' AND attendance_status = '3'";
                            $attendance_record = $db->select($attendance_query);
                            if ($attendance_record) {
                                while ($attendance = $attendance_record->fetch_assoc()) {
                                    if ($attendance['attendance_status'] == '3') {
                                        echo "checked"; // Check if attendance status is holiday
                                    }
                                }
                            }
                            echo " >
                        </td>
                    </tr>
                ";
            }
        }else{
            echo "
                    <tr>
                        <td>No students in this class</td>
                    </tr>
                ";
        }
    }
?>
<script>
    document.querySelectorAll('.status-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const row = this.getAttribute('data-row');
            console.log(row);
            document.querySelectorAll(`.status-checkbox[data-row="${row}"]`).forEach(cb => {
                if (cb !== this) cb.checked = false;
            });
        });
    });
</script>
