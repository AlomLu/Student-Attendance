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

        
        public function currentDate(){
            $currenDate = new DateTime("now", new DateTimeZone("Asia/Dhaka"));

            // $currenDate= $currenDate->format("Y-m-d");
            $currenDate= $currenDate->format("F d, Y");
            return $currenDate;

        
        }

        // public function selectedDate($selelcted_date){

        //     // $selectedDate = date("Y-m-d", strtotime($selelcted_date));
        //     $selectedDate = date("F d, Y", strtotime($selelcted_date));
        //     return $selectedDate;

        //     // $selelcted_date_array = explode('-', $selected_date);
        //     // $year = $selelcted_date_array[0];
        //     // $month = $selelcted_date_array[1];
        //     // $date = $selelcted_date_array[2];

        //     // return [$year, $month, $date];
        // }

        public function dateMontYearFormat($date){
            $date = strtotime($date);
            $dateMonthYear = date("F d Y", $date);

            return $dateMonthYear;
        }

        public function currentMonth(){
            $current_month = new DateTime("now", new DateTimeZone("Asia/Dhaka"));
            $current_month = $current_month->format("F");

            return $current_month;
        }

    }
?>