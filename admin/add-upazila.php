<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#division').change(function(){
                        var division_id = $(this).val();

                        console.log(division_id);

                        $.ajax({
                            url: "fetch_district.php",
                            method: "POST",
                            data: {division_id: division_id},

                            success: function(data){
                                $('#selected_district').html(data);
                                console.log(data);
                            }
                        });
                    });
                });
            </script>
		
            <div class="box round first grid">
                <h2>Add New District</h2>
               <div class="block copyblock"> 
               <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $div_id = mysqli_real_escape_string($db->link, $fm->validation($_POST['div_id']));
                        $dis_id = mysqli_real_escape_string($db->link, $fm->validation($_POST['dis_id']));
                        
                        $upazila_name = mysqli_real_escape_string($db->link, $fm->validation($_POST['upazila_name']));
                        $upazila_name = strtolower($upazila_name);

                        if($div_id == '' || $dis_id == '' || $upazila_name == ''){
                            echo "<span class='error'>Filed must not be empty</span>";
                        }else{
                            $query = "INSERT INTO tbl_upazila(div_id, dis_id, upazila_name) VALUES ('$div_id', '$dis_id', '$upazila_name')";
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
                                <select name="div_id" id="division">
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
                                <select name="dis_id" id="selected_district">
                                    <option value="">Select district</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" name="upazila_name" placeholder="Enter Upazila Name..." class="medium" />
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