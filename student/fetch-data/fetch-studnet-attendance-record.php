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
        $selected_date = $fm->dateFormat($selected_date);
        
        $student_id = Session::get('user_id');

        // echo $fm->selectedDay($selected_date);

        // $selected_date = $fm->currentDate();


        $student_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND date = '$selected_date' ";
        $studnet_result = $db->select($student_query);
        if($studnet_result){
            while($student_details = $studnet_result->fetch_assoc()){
                // $date = $student_details['date'];
                $teacher_id = $student_details['teacher_id'];
                $subject_id = $student_details['subject_id'];
                // $presentCheck_query=1;

                // Teacher name
                $teacher_query = "SELECT * FROM tbl_teacher WHERE user_id = '$teacher_id' ";
                $teacher_result = $db->select($teacher_query);

                if($teacher_result){

                    $teacher_id = $teacher_result->fetch_assoc()['user_id'];

                    $teacher_name_query = "SELECT * FROM tbl_user WHERE id = '$teacher_id' ";
                    $teacher_name_result = $db->select($teacher_name_query);
                    if($teacher_name_result){
                        $row = $teacher_name_result->fetch_assoc();
                        $teacher_name = ucfirst($row['fname'].' '.$row['lname']);
                    }
                }
  echo "<tr>
        <td>".$selected_date."</td>
        <td>".$teacher_name."</td>
        <td>";
                $presentCheck_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND subject_id = '$subject_id' AND date = '$selected_date' AND attendance_status ='1' ";
                $present_result = $db->select($presentCheck_query);

                if($present_result){
                    while($get_id = $present_result->fetch_assoc()){
                        $id = $get_id['subject_id'];

                        $query_subject_name = "SELECT * FROM tbl_subject WHERE id = '$id' ";
                        $subject_name_result = $db->select($query_subject_name);

                        if($subject_name_result){
                            echo ucfirst($subject_name_result->fetch_assoc()['subject_name']);
                        }
                    }
                }
       echo  "</td>
        <td>";
                $presentCheck_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND subject_id = '$subject_id' AND date = '$selected_date' AND attendance_status ='2' ";
                $present_result = $db->select($presentCheck_query);

                if($present_result){
                    while($get_id = $present_result->fetch_assoc()){
                        $id = $get_id['subject_id'];

                        $query_subject_name = "SELECT * FROM tbl_subject WHERE id = '$id' ";
                        $subject_name_result = $db->select($query_subject_name);

                        if($subject_name_result){
                            echo ucfirst($subject_name_result->fetch_assoc()['subject_name']);
                        }
                    }
                }
       echo  "</td>
        <td>";
                $presentCheck_query = "SELECT * FROM tbl_attendance_record WHERE user_id = '$student_id' AND subject_id = '$subject_id' AND date = '$selected_date' AND attendance_status ='3' ";
                $present_result = $db->select($presentCheck_query);

                if($present_result){
                    while($get_id = $present_result->fetch_assoc()){
                        $id = $get_id['subject_id'];

                        $query_subject_name = "SELECT * FROM tbl_subject WHERE id = '$id' ";
                        $subject_name_result = $db->select($query_subject_name);

                        if($subject_name_result){
                            echo ucfirst($subject_name_result->fetch_assoc()['subject_name']);
                        }
                    }
                }
        
       echo "</td>
    </tr>";
    } }else{        

        // $currentDate = $fm->currentDate();
        // $selectedDate = $fm->selectedDate($selected_date);

        // echo "<tr><td>";
        //     if($selectedDate > $currentDate){
        //         echo "The selected date has not yet arrived.";
        //     }elseif($selectedDate < $currentDate){
        //         echo "Attendance records for past dates are not available.";
        //     }elseif($selectedDate == $currentDate){
        //         echo "The teacher has not submitted today's attendance yet.";
        //     }
            
        // echo"</td></tr>";
    } }
?>

