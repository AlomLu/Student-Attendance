<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';
    include '../../Helpers/Format.php';

    $db = new Database();
    $fm = new Format();
    if(isset($_POST['selected_month'])){
        $currentMonthYear = $_POST['selected_month'];

        $teacher_id = Session::get('user_id');

?>

    <h3>
        <?php echo $currentMonthYear ?>
    </h3>
    <table>
        <tr>
            <th width="30%">Date</th>
            <th width="10%">class</th>
            <th width="15%">Subject</th>
            <th width="10%">Present</th>
            <th width="10%">Absent</th>
            <th width="10%">Holiday</th>
            <th width="15%">Total Student</th>
        </tr>
        <tbody>

<?php
    $teacher_query = "SELECT * FROM tbl_attendance_record WHERE teacher_id = '$teacher_id' AND DATE_FORMAT(created_at, '%M %Y') = '$currentMonthYear' ";
    $teacher_result = $db->select($teacher_query);

    if($teacher_query){

    

    $attendance_check_query_monthly = "SELECT
                                        tbl_attendance_record.teacher_id, 
                                        tbl_attendance_record.class_id,
                                        tbl_attendance_record.subject_id,
                                        DATE_FORMAT(tbl_attendance_record.created_at, '%M %d %Y') as formatted_date,
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

                                        WHERE teacher_id = '$teacher_id' AND DATE_FORMAT(created_at, '%M %Y') = '$currentMonthYear'
    
                                        GROUP BY 
                                        tbl_attendance_record.teacher_id, 
                                        tbl_attendance_record.class_id, 
                                        tbl_attendance_record.subject_id,
                                        DATE_FORMAT(tbl_attendance_record.created_at, '%M %d %Y')
                                        ";

    $attendance_monthl_result = $db->select($attendance_check_query_monthly);

    if($attendance_monthl_result){
        while($result = $attendance_monthl_result->fetch_assoc()){
?>

            <tr>
                <td><?php echo $result['formatted_date'] ?></td>
                <td><?php echo $result['class'] ?></td>
                <td><?php echo $result['subject_name'] ?></td>
                <td><?php echo $result['present_count'] ?></td>
                <td><?php echo $result['absent_count'] ?></td>
                <td><?php echo $result['holiday_count'] ?></td>
                <td><?php echo $result['count'] ?></td>
            </tr>

<?php } }else{ ?>
    <?php  echo "<tr style='margin-top: 10px'><td>No records for $currentMonthYear</td></tr>"; ?>
<?php } } } ?>

        </tbody>
    </table>


    <?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';
    include '../../Helpers/Format.php';

    $db = new Database();
    $fm = new Format();
    if(isset($_POST['selected_month']) && isset($_POST['class_id']) && isset($_POST['selected_subject_id'])  ){

        $currentMonthYear = $_POST['selected_month'];
        $selected_class_id = $_POST['class_id'];
        $selected_subject_id = $_POST['selected_subject_id'];

        $teacher_id = Session::get('user_id');

?>

    <h3>
        <?php echo $currentMonthYear ?>
    </h3>
    <table>
        <tr>
            <th width="30%">Date</th>
            <th width="10%">class</th>
            <th width="15%">Subject</th>
            <th width="10%">Present</th>
            <th width="10%">Absent</th>
            <th width="10%">Holiday</th>
            <th width="15%">Total Student</th>
        </tr>
        <tbody>

<?php
    $teacher_query = "SELECT * FROM 
                        tbl_attendance_record 
                        WHERE teacher_id = '$teacher_id' 
                        AND class_id = '$selected_class_id'
                        AND subject_id = '$selected_subject_id'
                        AND DATE_FORMAT(created_at, '%M %Y') = '$currentMonthYear' 
                        
                        ";
    $teacher_result = $db->select($teacher_query);

    if($teacher_result){

    

    $attendance_check_query_monthly = "SELECT
                                        tbl_attendance_record.teacher_id, 
                                        tbl_attendance_record.class_id,
                                        tbl_attendance_record.subject_id,
                                        DATE_FORMAT(tbl_attendance_record.created_at, '%M %d %Y') as formatted_date,
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

                                        WHERE 
                                        tbl_attendance_record.teacher_id = '$teacher_id' 
                                        AND tbl_attendance_record.class_id = '$selected_class_id'
                                        AND tbl_attendance_record.subject_id = '$selected_subject_id'
                                        
                                        AND DATE_FORMAT(created_at, '%M %Y') = '$currentMonthYear'
    
                                        GROUP BY 
                                        tbl_attendance_record.teacher_id, 
                                        tbl_attendance_record.class_id, 
                                        tbl_attendance_record.subject_id,
                                        DATE_FORMAT(tbl_attendance_record.created_at, '%M %d %Y')
                                        ";

    $attendance_monthl_result = $db->select($attendance_check_query_monthly);

    if($attendance_monthl_result){
        while($result = $attendance_monthl_result->fetch_assoc()){
?>

            <tr>
                <td><?php echo $result['formatted_date'] ?></td>
                <td><?php echo $result['class'] ?></td>
                <td><?php echo $result['subject_name'] ?></td>
                <td><?php echo $result['present_count'] ?></td>
                <td><?php echo $result['absent_count'] ?></td>
                <td><?php echo $result['holiday_count'] ?></td>
                <td><?php echo $result['count'] ?></td>
            </tr>

<?php } }else{ ?>
    <?php  echo "<tr style='margin-top: 10px'><td>No records for $currentMonthYear</td></tr>"; ?>
<?php } } } ?>