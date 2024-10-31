<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Division</h2>
               <div class="block copyblock"> 
               <?php 
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $subject_name = mysqli_real_escape_string($db->link, $fm->validation($_POST['subject_name']));
                        $subject_name = strtolower($subject_name);

                        if($subject_name == ''){
                            echo "<span class='error'>Filed must not be empty</span>";
                        }else{
                            $query = "INSERT INTO tbl_subject (subject_name) VALUES ('$subject_name')";
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
                                <input type="text" name="subject_name" placeholder="English" class="medium" />
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