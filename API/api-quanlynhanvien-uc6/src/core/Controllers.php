<?php
    class Controllers{
        public $host_name = "http://localhost/quan-ly-nhan-vien";
        
        protected function model($model){
            require_once "./src/models/". $model .".php";
            return new $model;
        }
        protected function view($template,$view,$data=[]){
            $host_name = $this->host_name;
            require_once "./src/views/template/". $template .".php";
        }
    }
?>