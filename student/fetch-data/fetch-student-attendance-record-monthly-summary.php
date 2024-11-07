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
?>
        

    <h3>
        <?php echo $currentMonthYear ?>
    </h3>

    <table>
            <th>Teacher</th>
            <th>Subject</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Holiday</th>
        <tbody id="monthly-attendance-summary">

<?php

        $monthly_attendance_summery_query = "SELECT * FROM tbl_attendance_record
                                            WHERE user_id = '$student_id' 
                                            AND DATE_FORMAT(created_at, '%M %Y') = '$currentMonthYear' "; 

        $monthly_attendance_summery_result = $db->select($monthly_attendance_summery_query);

        if($monthly_attendance_summery_result){
            $unique_query_check = "SELECT tbl_attendance_record.teacher_id, 
                                    tbl_attendance_record.subject_id, 
                                    tbl_user.*, 
                                    tbl_subject.*, 
                                    COUNT(*) as count,

                                    SUM(CASE WHEN tbl_attendance_record.attendance_status = 1 THEN 1 ELSE 0 END) as present_count,
                                    SUM(CASE WHEN tbl_attendance_record.attendance_status = 2 THEN 1 ELSE 0 END) as absent_count,
                                    SUM(CASE WHEN tbl_attendance_record.attendance_status = 3 THEN 1 ELSE 0 END) as holiday_count
                                    FROM tbl_attendance_record 

                                    INNER JOIN tbl_user
                                    ON tbl_attendance_record.teacher_id = tbl_user.id

                                    INNER JOIN tbl_subject
                                    ON tbl_attendance_record.subject_id = tbl_subject.id

                                    WHERE tbl_attendance_record.user_id = '$student_id' 
                                    AND DATE_FORMAT(tbl_attendance_record.created_at, '%M %Y') = '$currentMonthYear'

                                    GROUP BY tbl_attendance_record.teacher_id, tbl_attendance_record.subject_id";

            $unique_column_result =$db->select($unique_query_check);

            if($unique_column_result){
                while($result = $unique_column_result->fetch_assoc()){
                //    echo $result['teacher_id'];
             
?>
        <tr>
            <td><?php echo $result['fname'].' '.$result['lname'] ?></td>
            <!-- <td><?php echo $result['count'] ?></td> -->
            
            <td><?php echo $result['subject_name'] ?></td>
            <td><?php echo $result['present_count'] ?></td>
            <td><?php echo $result['absent_count'] ?></td>
            <td><?php echo $result['holiday_count'] ?></td>
        </tr>         
                
<?php } } }else{ ?>
   <?php  echo "<tr><td>No records for $currentMonthYear</td></tr>"; ?>
<?php } }?>

        </tbody>
    </table>


