<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';
    include '../../Helpers/Format.php';

    $db = new Database();
    $fm = new Format();

    if(isset($_POST['class_id'])){
        $class_id = $_POST['class_id'];
        $teacher_id = Session::get('user_id');

        $subject_query = "SELECT * FROM tbl_teacher WHERE user_id = '$teacher_id' AND class_id = '$class_id' ";
        $subject_id_string = $db->select($subject_query);

        if($subject_id_string){
            while($result_subject_string = $subject_id_string->fetch_assoc()){
                echo "<option>Select subjet</option>";
                $result = $result_subject_string['subject_id'];

                $subject_array = explode(',', $result);

                foreach($subject_array as $subject_id){
                    $subject_name_query = "SELECT * FROM tbl_subject WHERE id = '$subject_id' ";
                    $subject_list = $db->select($subject_name_query);

                    if($subject_list){
                        while($result_subject = $subject_list->fetch_assoc()){
                            // $subject_name = $result_subject['subject_name'];
                            
                            echo "<option value='".$result_subject['id']."'>".$result_subject['subject_name']."</option>";
                        }
                    }
                }
            }
        }

    }

?>