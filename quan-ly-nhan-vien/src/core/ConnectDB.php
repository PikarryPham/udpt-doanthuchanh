<?php
    class ConnectDB{
        protected $connection;
        private $hostname = 'localhost';
        private $user = 'root';
        private $password = '';
        #private $password = 'root';
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