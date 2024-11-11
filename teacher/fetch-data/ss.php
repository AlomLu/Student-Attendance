<?php 
    // include '../Config/config.php';
    // include '../lib/Database.php';
    // include '../../lib/Session.php';
    // Session::checkSession();

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['class_id'])){
        $class_id = $_POST['class_id'];

        $query = "SELECT * FROM tbl_class WHERE id = '$class_id' ";
        $subject_string = $db->select($query);

        if($subject_string){
            // echo "<option>select subject</option>";
            while($result = $subject_string->fetch_assoc()){
                // $result['subject_id'];
                $subject_array = explode(',', $result['subject_id']);

                foreach($subject_array as $subject){
                    $query_subject = "SELECT * FROM tbl_subject WHERE id = '$subject' ";
                    $subject_list = $db->select($query_subject);

                    if($subject_list){
                        while($result = $subject_list->fetch_assoc()){
                            // echo "<option>".$result['subject_name']."</option>";
                            echo "<div class='single-subject'><input type='checkbox' name='subject_id[]' value='".$result['id']."'><span>".$result['subject_name']."</span></div>";
                        }
                    }
                }
                // echo "<option>".$result['subject_id']."</option>";
            }
        }
    }
?>

<!-- $booked_subject_query = "SELECT * FROM tbl_teacher WHERE class_id = '$class_id' ";
        $booked_subject_string = $db->select($booked_subject_query);
        if($booked_subject_string){
            $booked_subject_concat_string = '';
            while($booked_subject_result = $booked_subject_string->fetch_assoc()){
                $booked_subject_concat_string .= ($booked_subject_result['subject_id'].',');

            }
            $booked_subject_array = explode(',', $booked_subject_concat_string);
            foreach($booked_subject_array as $subject){
                //  echo "<div class='single-subject'><input type='checkbox' name='subject_id[]' value=''><span>".$subject."</span></div>";
                
            } -->
        }