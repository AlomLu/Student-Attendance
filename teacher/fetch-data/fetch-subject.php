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

        // if($district_list){
        //     echo "<option>Select district</option>";
        //     while($result = $district_list->fetch_assoc()){
        //         echo "<option value=".$result['dis_name'].">".ucfirst($result['dis_name'])."</option>";
        //     }
        // }else{
        //     echo "<option>No district available</option>";
        // }
    }
?>