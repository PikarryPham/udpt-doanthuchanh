<?php
    class Controllers{
        public $host_name = "http://localhost/quan-ly-nhan-vien";
        public $api_uc002 = "http://localhost/API/api-quanlynhanvien-uc2/api_uc002";
        public $api_uc010 = "";
        public $api_uc013temp = "";
        
        protected function model($model){
            require_once "./src/models/". $model .".php";
            return new $model;
        }
        protected function view($template,$view,$data=[]){
            $host_name = $this->host_name;
            $api_uc002 = $this->api_uc002;
            require_once "./src/views/template/". $template .".php";
        }
    }
?>