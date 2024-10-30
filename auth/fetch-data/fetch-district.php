<?php 
    // include '../Config/config.php';
    // include '../lib/Database.php';

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['division_id'])){
        $division_id = $_POST['division_id'];

        $query = "SELECT * FROM tbl_district WHERE div_id = '$division_id' ";
        $district_list = $db->select($query);

        if($district_list){
            echo "<option>Select district</option>";
            while($result = $district_list->fetch_assoc()){
                echo "<option value=".$result['dis_name'].">".ucfirst($result['dis_name'])."</option>";
            }
        }else{
            echo "<option>No district available</option>";
        }
    }
?>