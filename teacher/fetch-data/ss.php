<?php 
                            $query_classes = "SELECT * FROM tbl_teacher WHERE user_id = '$user_id' ";
                            $teacher_classes = $db->select($query_classes);
                            if($teacher_classes){
                                while($row = $teacher_classes->fetch_assoc()){
                                    $class_id =$row['class_id'];
                                    

                                    $query_class_name = "SELECT * FROM tbl_class WHERE id = '$class_id' ";
                                    $class_list = $db->select($query_class_name);

                                    if($class_list){
                                        while($result_class = $class_list->fetch_assoc()){
                                            $class_name = $result_class['class'];
                                    
                                            $query_subject_id = "SELECT * FROM tbl_teacher WHERE user_id = '$user_id' AND class_id = '$get_class_id' ";
                                            $subject_id = $db->select($query_subject_id);

                                            if($subject_id){
                                                while($row = $subject_id->fetch_assoc()){
                                                    $subject_id_string = $row['subject_id'];

                                                    $subject_id_array = explode(',', $subject_id_string);

                                                    foreach($subject_id_array as $subject){
                                                        $query_subject = "SELECT * FROM tbl_subject WHERE id = '$subject' ";
                                                        $subject_list = $db->select($query_subject);

                                                        if($subject_list){
                                                            while($subject_name = $subject_list->fetch_assoc()){
                                                                

                                                            
                            
                        ?>
                        <tr>
                            <td><?php echo $class_name ?></td>
                            <td><?php echo $subject_name['subject_name'] ?></td>
                          
                          
                          
                            
                        </tr>
                        <?php } } } } } } } } } ?>