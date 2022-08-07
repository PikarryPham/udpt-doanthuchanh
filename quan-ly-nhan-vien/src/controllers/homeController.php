<?php
    class homeController extends Controllers{
        public function index(){
            $username = "";
            $password = "";

            if(isset($_COOKIE['username'])) {
                $username=$_COOKIE['username'];
            }
            if(isset($_COOKIE['password'])) {
                $password=$_COOKIE['password'];
            }

            $this->view("home","",[$username,$password]);
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

        public function check_in_check_out(){
            $this->middleware();
            $this->view("main","UC001/index",[]);
        }

        public function document(){
            // $uc16 = new uc016Controller();
            // $uc16->getDocument();
            // $uc16->index();
            $model = $this->model('document');
            $data = $model->getAllDocument();
            //$this->middleware();
            $this->view("main","UC016/index",$data);
        }

        public function middleware(){
            if (!isset($_SESSION['id'])){
                header("Location: " . $this->host_name);
            }
        }
        public function sign_in(){
            $username = $_POST["username"];
            $password = $_POST["password"];
            $rememberPass = $_POST["remember-me"];

            $model = $this->model('authModel');
            
            if ($model->login($username, $password)){
                header("Location: " . $this->host_name . "/home/main_uc");
                if ($rememberPass) {
                    setcookie ("username", $username, time() + (86400 * 30), "/"); //save in 30 days
                    setcookie ("password", $password, time() + (86400 * 30), "/");
                }
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