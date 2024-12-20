




<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['class_id'])){
        $user_id = Session::get('user_id');
        $class_id = $_POST['class_id'];

        $query = "SELECT * FROM tbl_teacher WHERE class_id = '$class_id'";
        $teacher_details = $db->select($query);

        
        if($teacher_details){
            while($result = $teacher_details->fetch_assoc()){
                // echo "<option>Select subject</option>";
                $get_user_id = $result['user_id'];
                $get_subject_id_string = $result['subject_id'];

                if($get_user_id == $user_id){
                    echo "<option>Select subject</option>";
                    $subject_array = explode(',', $get_subject_id_string);

                    foreach($subject_array as $subject_id){

                            $current_date = new DateTime("now", new DateTimeZone("Asia/Dhaka")) ;
                            $current_date = $current_date->format("F d, Y") ;
                            $attendance_check_query = "SELECT * FROM tbl_attendance_record WHERE class_id = '$class_id' AND subject_id = '$subject_id' AND date = '$current_date'";
                            // $attendance_check_query = "SELECT * FROM tbl_attendance_record WHERE class_id = '$class_id' AND subject_id = '$subject_id' AND $date = '$current_date' ";
                            $attendance_record = $db->select($attendance_check_query);


                            if(!$attendance_record){
                                $query_subject = "SELECT * FROM tbl_subject WHERE id = '$subject_id' ";
                                $get_subject = $db->select($query_subject);
                                
                                if($get_subject){
                                    while($result_subject = $get_subject->fetch_assoc()){
                                
                                        echo "<option value='".$result_subject['id']."'>".$result_subject['subject_name']."</option>";
                                    }
                                }
                                  
                         
                        }
                    }
                }
            }
        }
    }
?>