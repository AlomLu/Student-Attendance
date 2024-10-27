<?php 
    class Session{
        
        public static function init(){
            session_start();
        }

        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }

        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }

        public static function checkSession(){
            self::init();
            if(self::get('login') == false){
                self::destroy();

                header('Location: ../auth/login.php');
                exit();
            }
        }

        public static function checkLogin(){
            self::init();
            switch(self::get('user_role_id')){
                case '1';
                    header('Location: ../student/student-dashboard.php');
                    exit();
                case '2';
                    header('Location: ../teacher/teacher-dashboard.php');
                    exit();
            }
        }



        public static function destroy(){
            session_destroy();

            header('Location: ../auth/login.php');
        } 


    }
?>