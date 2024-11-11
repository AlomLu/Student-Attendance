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

        $teacher_id = Session::get('user_id');

?>

    <p>
        <?php echo $selected_date ?>
    </p>
    <table>
        <tr>
            <th width="15%">class</th>
            <th width="15%">Subject</th>
            <th width="15%">Present</th>
            <th width="15%">Absent</th>
            <th width="15%">Holiday</th>
            <th width="15%">Total Student</th>
        </tr>
        <tbody>

<?php
            $current_date_month_year = $fm->currentDateMonthYear(); 
            $attendance_check_query = "SELECT 
                                        tbl_attendance_record.teacher_id, 
                                        tbl_attendance_record.class_id,
                                        tbl_attendance_record.subject_id,
                                        tbl_attendance_record.*,   
                                        tbl_subject.*,
                                        tbl_class.*,
                                        COUNT(*) as count,

                                        SUM(CASE WHEN tbl_attendance_record.attendance_status = 1 THEN 1 ELSE 0 END) as present_count,
                                        SUM(CASE WHEN tbl_attendance_record.attendance_status = 2 THEN 1 ELSE 0 END) as absent_count,
                                        SUM(CASE WHEN tbl_attendance_record.attendance_status = 3 THEN 1 ELSE 0 END) as holiday_count
                                        FROM tbl_attendance_record

                                        INNER JOIN tbl_subject
                                        ON tbl_attendance_record.subject_id = tbl_subject.id

                                        INNER JOIN tbl_class
                                        ON tbl_attendance_record.class_id = tbl_class.id

                                        WHERE teacher_id = '$teacher_id' AND DATE_FORMAT(created_at, '%M %d %Y') = '$selected_date'
                                        
                                        GROUP BY 
                                        tbl_attendance_record.teacher_id, 
                                        tbl_attendance_record.class_id, 
                                        tbl_attendance_record.subject_id
                                    ";

            $attendance_result = $db->select($attendance_check_query);

            if($attendance_result){
                while($result = $attendance_result->fetch_assoc()){
?>

            <tr>
                <td><?php echo $result['class'] ?></td>
                <td><?php echo $result['subject_name'] ?></td>
                <td><?php echo $result['present_count'] ?></td>
                <td><?php echo $result['absent_count'] ?></td>
                <td><?php echo $result['holiday_count'] ?></td>
                <td><?php echo $result['count'] ?></td>
            </tr>

<?php } } } ?>

        </tbody>
    </table>