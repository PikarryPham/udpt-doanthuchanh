<?php
    class homeController extends Controllers{
        public function index(){
            $this->view("home","form",[]);
        }
        public function main_uc(){
            $this->middleware();
            $this->view("main","main/main",[]);
        }
        public function pa_manage(){
            $this->middleware();
            $this->view("main","main/pa_manage",[]);
        }public function leave_manage(){
            $this->middleware();
            $this->view("main","main/leave_manage",[]);
        }
        public function middleware(){
            if (! isset($_SESSION['id'])){
                header("Location: " . $this->host_name);
            }
        }
        public function sign_in(){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $model = $this->model('authModel');
            
            if ($model->login($username, $password)){
                header("Location: " . $this->host_name . "/home/main_uc");
            }else{
                header("Location: " . $this->host_name);
            }
        }
        public function sign_out(){
            session_destroy();
            header("Location: " . $this->host_name );
        }
    }
?>