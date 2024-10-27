<?php 
    class Database{
        public $host = DB_HOST;
        public $user = DB_USER;
        public $pass = DB_PASS;
        public $dbname = DB_NAME;

        public $link;

        public $error;
        public $success;

        public function __construct(){
            $this->connectDB();
        }

        public function connectDB(){
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            
            if(!$this->link){
                $this->error = "Connection fail".$this->link->connect_errno;
                return false;
            }else{
                $this->success = "Connection Succeeded";
                return true;
            }
        }
    }

?>