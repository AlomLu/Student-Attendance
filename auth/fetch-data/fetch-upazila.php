<?php 
    // include '../Config/config.php';
    // include '../lib/Database.php';

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['district_id'])){
        $district_id = $_POST['district_id'];

        $query = "SELECT * FROM tbl_upazila WHERE dis_id = '$district_id' ";
        $upazila_list = $db->select($query);

        if($upazila_list){
            echo "<option>Select upazila</option>";
            while($result = $upazila_list->fetch_assoc()){
                echo "<option value=".$result['id'].">".ucfirst($result['upazila_name'])."</option>";
            }
        }else{
            echo "<option>No upazila available</option>";
        }
    }
?>