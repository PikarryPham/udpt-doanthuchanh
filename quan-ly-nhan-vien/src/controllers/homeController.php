<?php
    class homeController extends Controllers{
        public function index(){
            $username = "";
            $password = "";
            $isCorrectPassword = "empty";

            if (isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
            }
            if (isset($_COOKIE['password'])) {
                $password = $_COOKIE['password'];
            }
            if (isset($_SESSION["isCorrectPassword"])) {
                $isCorrectPassword = $_SESSION["isCorrectPassword"];
            }

            $this->view("home","UC006/login",[$username,$password,$isCorrectPassword]);
        }
        public function main_uc(){
            $this->middleware();
            $this->view("main","main/main",[]);
        }
        public function pa_manage(){
            $this->middleware();
            $this->view("main","main/pa_manage",[]);

        }
        
        public function leave_manage(){
            // if($this->getMiddleware('AuthMiddlewares')->isEmployee()) { 
            //     $this->view("main","main/leave_manage",[]);
            // }
            $this->middleware();
            $this->view("main","main/leave_manage",[]);
        }

        public function manage_request() {
            $this->middleware();
            $this->view("main","main/UC007/index",[]);
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
		
		public function recruitment(){
            $this->middleware();
            $model=$this->model("uc14model");
            $data=$model->listAll();
            $this->view("main","UC14/index",$data);
        }
        public function recruitment_detail(){
            $this->middleware();
            //$link = $_SERVER["REQUEST_URI"];
            //$cv_id=basename($link);
            //$cv_id=6;
            $cv_id=$_POST["CV_ID"];
            $model=$this->model("uc14model");
            $data=$model->viewdetail($cv_id);
            $this->view("main","UC14/detail",$data);
        }

        public function recruitment_update_status(){
            $this->middleware();
            $cv_id=$_POST["CV_ID"];
            $cur_status=$_POST["STATUS"];
            $comment=$_POST["COMMENT"];
            $model=$this->model("uc14model");
            $model->update_status($cv_id,$cur_status,$comment);
            $data=$model->viewdetail($cv_id);
            $this->view("main","UC14/detail",$data);
        }

        public function recruitment_update_status_archived(){
            $this->middleware();
            $cv_id=$_POST["CV_ID"];
            $cur_status=$_POST["STATUS"];
            $comment=$_POST["COMMENT"];
            $model=$this->model("uc14model");
            $model->update_status_archived($cv_id,$cur_status,$comment);
            $data=$model->viewdetail($cv_id);
            $this->view("main","UC14/detail",$data);
        }
		
        public function sign_in(){
            $username = "";
            $password = "";
            $rememberPass = false;
            if (isset($_POST["username"])) {
                $username = $_POST["username"];
            }
            if (isset($_POST["password"])) {
                $password = $_POST["password"];
            }
            if (isset($_POST["remember-me"])) {
                $rememberPass = $_POST["remember-me"];
            }

            $model = $this->model('authModel');
            
            if ($model->login($username, $password)){
                header("Location: " . $this->host_name . "/home/main_uc");
                if ($rememberPass) {
                    setcookie ("username", $username, time() + (86400 * 30), "/"); //save in 30 days
                    setcookie ("password", $password, time() + (86400 * 30), "/");
                }
            } else {
                $_SESSION["isCorrectPassword"] = "wrongusernameorpassword";
                header("Location: " . $this->host_name);
            }
        }
        public function sign_out(){
            session_destroy();
            header("Location: " . $this->host_name );
        }
    }
?>