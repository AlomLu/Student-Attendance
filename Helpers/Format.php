<?php 
    class Format{
        public function validation($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        public function dateFormat($data){
            $data = strtotime($data);
            $data = date("F d, Y",$data);

            return $data;
        }
    }
?>