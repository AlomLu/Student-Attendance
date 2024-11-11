<?php include '../inc/header.php'; ?>

        <!-- class area start -->
        <div class="class-area">
            <h3>add new class</h3>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>

                //Fetch subject by class
                $(document).ready(function(){
                    $('#class').change(function(){
                        // var class_id = $(this).val();

                        var class_id = $('#class').val();
                        console.log(class_id);

                        $.ajax({
                            url: "fetch-data/fetch-subject.php",
                            method: "POST",
                            data: {class_id: class_id},
                            success: function(data){
                                $('#selected-subject').html(data);

                                console.log(data);
                            }
                        })
                    })
                })
            </script>

            <?php 
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $error_class = '';
                    $error_subject = '';
                    // $msg = '';

                    $user_id = Session::get('user_id');
                    $user_id = mysqli_real_escape_string($db->link, $user_id);

                    $class_id = mysqli_real_escape_string($db->link, $_POST['class_id']);
                     

                    $subject_id_string = [];
                    if(isset($_POST['subject_id'])){
                        $subject_ids = $_POST['subject_id']; //Array of subject_id
                        $sanitized_subject_id = [];

                        foreach($subject_ids as $subject_id){
                            $sanitized_subject_id[] = mysqli_real_escape_string($db->link, $subject_id);

                        }
                        $subject_id_string = implode(',', $sanitized_subject_id);
                    }

                    if($class_id == ''){
                        $error_class = "Field must not be empty";
                    }
                    if($subject_id_string == ''){
                        $error_subject = "Field must not be empty";
                    }

                    if(!empty($class_id) || !empty($subject_id_string)){
                        $query = "INSERT INTO tbl_teacher (user_id, class_id, subject_id) VALUES('$user_id', '$class_id', '$subject_id_string') ";
                        $row_insert = $db->insert($query);

                        if($row_insert){
                            echo "Class inserted successfully";
                            // $msg = "Class inserted successfully";
                        }else{
                            echo "Class not inserted";
                            // $msg = "Class not inserted";
                        }
                    }


                }
            ?>

            <div class="add-class-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">class</label>
                        <select name="class_id" id="class">
                            <option value="">Selec a class</option>
                            <?php 
                                 $query = "SELECT * FROM tbl_class";
                                 $class_list = $db->select($query);

                                 if($class_list){
                                    while($result = $class_list->fetch_assoc()){

                            ?>
                            <option value="<?php echo $result['id'] ?>"><?php echo $result['class'] ?></option>
                            <?php } } ?>
                        </select>
                        <?php 
                            echo isset($error_class) ? $error_class : '' ;
                        ?>
                    </div>
                    <div class="form-group" id="selected-subject">
                        <label for="">subject</label>
                    </div>
                        <?php 
                            echo isset($error_subject) ? $error_subject : '' ;
                        ?>
                    <!-- <div class="form-group">
                        <label for="">section</label>
                        <select name="section" id="">
                            <option value="">Selec a section</option>
                            <option value="">A</option>
                            <option value="">B</option>
                            <option value="">C</option>
                        </select>
                    </div> -->
                    <div class="form-group">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <!-- class area end -->

<?php include '../inc/footer.php'; ?>