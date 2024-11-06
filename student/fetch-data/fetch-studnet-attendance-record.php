<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';
    include '../../Helpers/Format.php';

    $db = new Database();
    $fm = new Format();
    if(isset($_POST['selected_date'])){
        $selected_date = $_POST['selected_date'];
        $selected_date = $fm->dateMontYearFormat($selected_date);

        $student_id = Session::get('user_id');

        // echo $selected_date;

        $attendance_check_query = "SELECT tbl_attendance_record.*, tbl_user.*, tbl_subject.* FROM tbl_attendance_record
        INNER JOIN tbl_user
        ON tbl_attendance_record.teacher_id = tbl_user.id

        INNER JOIN tbl_subject
        ON tbl_attendance_record.subject_id = tbl_subject.id
        
        WHERE user_id = '$student_id' AND DATE_FORMAT(created_at, '%M %d %Y') = '$selected_date' ";

        $studnet_attendance_result = $db->select($attendance_check_query);

        if($studnet_attendance_result){
            while($result = $studnet_attendance_result->fetch_assoc()){
              
?>
    <tr>
        <td><?php echo $selected_date; ?></td>
        <td><?php echo $result['fname']; ?></td>
        <td>
            <?php 
                if($result['attendance_status'] == '1'){
                    echo $result['subject_name'];
                }
            ?>
        </td>
        <td>
            <?php 
                if($result['attendance_status'] == '2'){
                    echo $result['subject_name'];
                }
            ?>
        </td>
        <td>
            <?php 
                if($result['attendance_status'] == '3'){
                    echo $result['subject_name'];
                }
            ?>
        </td>
    </tr>

<?php } }else{
     echo "<p style='margin-top: 10px'>No records for $selected_date</p>";
} } ?>