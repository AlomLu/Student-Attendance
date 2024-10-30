<?php 
    // include '../Config/config.php';
    // include '../lib/Database.php';

    include '../../Config/config.php';
    include '../../lib/Database.php';

    $db = new Database();

    if(isset($_POST['upazila_id'])){
        $upazila_id = $_POST['upazila_id'];

        $query = "SELECT * FROM tbl_union WHERE upazila_id = '$upazila_id' ";
        $union_list = $db->select($query);

        if($union_list){
            echo "<option>Select union</option>";
            while($result = $union_list->fetch_assoc()){
                echo "<option value=".$result['union_name'].">".ucfirst($result['union_name'])."</option>";
            }
        }else{
            echo "<option>No union available</option>";
        }
    }
?>