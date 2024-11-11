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

        // $subject_query = "SELECT * FROM tbl_subject
        //                     JOIN tbl_class ON FIND_IN_SET(tbl_subject.id, tbl_class.subject_id) > 0
        //                     WHERE 
        //                     tbl_class.id = '$class_id'";

        // $subject_list = $db->select($subject_query);

        // if($subject_list){
        //     while($result = $subject_list->fetch_assoc()){
        //         echo "<div class='single-subject'><input type='checkbox' name='subject_id[]' value='".$result['id']."'><span>".$result['subject_name']."</span></div>";
        //     }
        // }


        // Query to fetch subjects for the class that are NOT assigned to any teacher
        $subject_query = "SELECT * FROM tbl_subject
                            INNER JOIN tbl_class ON FIND_IN_SET(tbl_subject.id, tbl_class.subject_id) > 0
                            LEFT JOIN tbl_teacher ON FIND_IN_SET(tbl_subject.id, tbl_teacher.subject_id) > 0
                                AND tbl_teacher.class_id = '$class_id'
                            WHERE tbl_class.id = '$class_id'
                                AND tbl_teacher.subject_id IS NULL";
        $subject_list = $db->select($subject_query);

        if($subject_list){
            while($result = $subject_list->fetch_assoc()){
                echo "<div class='single-subject'><input type='checkbox' name='subject_id[]' value='".$result['id']."'><span>".$result['subject_name']."</span></div>";
            }
        }
    

    }
?>