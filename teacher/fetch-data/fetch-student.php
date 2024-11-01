<?php 
    include '../../lib/Session.php';
    Session::init();

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['class_id'])){
        $user_id = Session::get('user_id');
        $class_id = $_POST['class_id'];

        $query = "SELECT * FROM tbl_user WHERE class_id = '$class_id'";
        $student_details = $db->select($query);

        if($student_details){
            while($result = $student_details->fetch_assoc()){
                echo "
                    <tr>
                        <td>".$result['id']."</td>
                        <td>".$result['fname']."</td>
                        <td>
                            <input type='checkbox' name='status' class='status-checkbox' data-row='1' >
                        </td>
                        <td>
                            <input type='checkbox' name='status' class='status-checkbox' data-row='1' >
                        </td>
                        <td>
                            <input type='checkbox' name='status' class='status-checkbox' data-row='1' >
                        </td>
                    </tr>
                ";
            }
        }else{
            echo "
                    <tr>
                        <td>No studnets in this class</td>
                    </tr>
                ";
        }

        
       
    }
?>