<?php include '../inc/header.php'; ?>

        <!-- class area start -->
        <div class="class-area">
            <h3>add new class</h3>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
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
                                $('#selected-class').html(data);

                                console.log(data);
                            }
                        })
                    })
                })
            </script>
            <div class="add-class-form">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">class</label>
                        <select name="class" id="class">
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
                    </div>
                    <div class="form-group" id="selected-class">
                        <label for="">subject</label>
                        <!-- <div class="subject">
                            <div class="single-subject">

                            </div>
                        </div> -->
                        <!-- <select name="" id="selected-class">
                            <option value="">select subject</option>
                        </select> -->
                        <!-- <input type="checkbox" name="" id="selected-class"> -->
                    </div>
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