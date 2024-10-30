<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New District</h2>
               <div class="block copyblock"> 
               <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $dis_name = mysqli_real_escape_string($db->link, $fm->validation($_POST['dis_name']));
                        $dis_name = strtolower($dis_name);

                        $div_id = mysqli_real_escape_string($db->link, $fm->validation($_POST['div_id']));

                        if($dis_name == '' || $div_id == ''){
                            echo "<span class='error'>Filed must not be empty</span>";
                        }else{
                            $query = "INSERT INTO tbl_district (dis_name, div_id) VALUES ('$dis_name', '$div_id')";
                            $result = $db->insert($query);

                            if($result){
                                echo "<span class='success'>Data inserted successfullly</span>";
                            }else{
                                echo "<span class='error'>Data not inserted</span>";
                            }
                        }
                    }
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="dis_name" placeholder="Enter District Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="div_id" id="">
                                    <option value="">Select division</option>
                                    <?php 
                                        $query = "SELECT * FROM tbl_division";
                                        $result = $db->select($query);

                                        if($result){
                                            while($row = $result->fetch_assoc()){
                                    ?>

                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['div_name'] ?></option>
                                         
                                    <?php } }?>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'inc/footer.php' ?>