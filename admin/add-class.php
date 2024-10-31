<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Division</h2>
               <div class="block copyblock"> 
               <?php 
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $class = mysqli_real_escape_string($db->link, $fm->validation($_POST['class']));
                        $class = strtolower($class);

                        $subject_id_string = [];
                       if(isset($_POST['subject_id'])){
                            $subject_ids = $_POST['subject_id']; // Array of subject IDs

                            // $subject_id_string = implode(',', $subject_ids);

                            foreach($subject_ids as $subject_id){
                                $sanitized_subject_id[] = mysqli_real_escape_string($db->link, $subject_id);
                            }

                            $subject_id_string = implode(',', $sanitized_subject_id);

                       }

                        if ($class == '' || $subject_id_string == '') {
                            echo "<span class='error'>Field must not be empty</span>";
                        } else {
                            $query = "INSERT INTO tbl_class (class, subject_id) VALUES ('$class', '$subject_id_string')";
                            $result = $db->insert($query);

                            if ($result) {
                                echo "<span class='success'>Data inserted successfully</span>";
                            } else {
                                echo "<span class='error'>Data not inserted</span>";
                            }
                        }
                    }
                ?>

                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="class" placeholder="10" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <?php 
                                $query = "SELECT * FROM tbl_subject";
                                $subject_list = $db->select($query);

                                if($subject_list){
                                    while($result = $subject_list->fetch_assoc()){
                                  
                            ?>
                            <td>
                                <input type="checkbox" name="subject_id[]" class="medium" Value="<?php echo $result['id'] ?>"/><span><?php echo $result['subject_name'] ?></span>
                            </td>
                            <?php } } ?>
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