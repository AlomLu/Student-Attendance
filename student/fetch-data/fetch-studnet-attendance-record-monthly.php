<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';
    include '../../Helpers/Format.php';

    $db = new Database();
    $fm = new Format();

    if(isset($_POST['selected_month'])){

        $student_id = Session::get('user_id');
        $currentMonthYear = $_POST['selected_month'];
        

        $attendance_check_query = "SELECT tbl_attendance_record.*, tbl_user.*, tbl_subject.*, tbl_class.* FROM tbl_attendance_record 
        INNER JOIN tbl_user
        ON tbl_attendance_record.teacher_id = tbl_user.id

        INNER JOIN tbl_subject
        ON tbl_attendance_record.subject_id = tbl_subject.id

        INNER JOIN tbl_class
        ON tbl_attendance_record.class_id = tbl_class.id
        
        
         WHERE tbl_attendance_record.user_id = '$student_id' AND
         DATE_FORMAT(created_at, '%M %Y') = '$currentMonthYear'";

        $month_attendance_result = $db->select($attendance_check_query);

        // print_r($month_attendance_result);

        if($month_attendance_result){
            $i = 0;
            while($result = $month_attendance_result->fetch_assoc()){
                // print_r($result);

            $i++;
        
?>
    <tr>
        <td><?php echo $result['date'];?></td>
        <td><?php echo $result['class'];?></td>
        <td><?php echo $result['fname'].' '.$result['lname']?></td>
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
        echo "<p style='margin-top: 10px'>No records for $currentMonthYear</p>";
    }
    } ?>


