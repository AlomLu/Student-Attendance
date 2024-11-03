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

        public function lastSevenDate($current_date){
            // $currenDate = new DateTime("now", new DateTimeZone("Asia/Dhaka"));

            // $currenDate_format = $currenDate->format("F d, Y");
            $currenDate_format = $current_date->format("F d, Y");

            $currenDate_array = explode(',', $currenDate_format);
            $currenDtate_string = $currenDate_array['0'];
            $year = $currenDate_array['1'];

            $date_array = explode(' ', $currenDtate_string);

            $month =  $date_array[0];
            $date =  $date_array[1];
            // $date = '3';
            $loopLimit = $date-2;  

            $dates = [];
            for($date; $date > $loopLimit; $date--){
                $dates[] = "$month $date, $year";
                // for($i = 0; $i >= -5; $i--){
                   
                // }
                // return implode(',', $is);
            }
            
            return implode('.', $dates);
          
            
            
        }
    }
?>