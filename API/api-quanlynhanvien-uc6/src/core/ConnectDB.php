<?php
    class ConnectDB{
        protected $connection;
        private $hostname = 'main-service.cizg8kaur6ll.ap-south-1.rds.amazonaws.com';
        private $user = 'admin';
        // private $password = '';
        private $password = 'admin123456';
        private $nameDB = 'main_service';
        
        // kết nối với DB
        function __construct(){
            $this->connection = mysqli_connect("$this->hostname","$this->user","$this->password","$this->nameDB");
            if (!$this->connection){
                die ('Failed to connect with server');
            }  
            mysqli_set_charset($this->connection,'utf8');
        }
    }
?>