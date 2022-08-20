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
            $this->middleware();
            if($this->getMiddleware('AuthMiddlewares')->isEmployee()) { 
                $this->view("main","UC001/index",$data); // KIEM TRA LAI VIEW DUNG DUONG DAN CHUA
            }
            else {
              //THEM  MAN HINH HIEN THI CHO ADMIN
            }
            // $model = $this->model('CICO');
            // $data = $model->getAllCICO();
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
        public function request_management(){
            $this->middleware();
            $this->view("main","UC07/index",[]);
        }
        public function verify_request_leave(){
            $this->middleware();
            $model=$this->model("uc07model");
            $data=$model->listAll_leave();
            $this->view("main","UC07/leave_page_1",$data);
        }

        public function verify_request_leave_reject_page(){
            $this->middleware();
            $_SESSION['cur_leave_request_id']=$_POST["request_id"];
            $this->view("main","UC07/leave_page_2",[]);
        }

        public function verify_request_leave_accept(){
            $this->middleware();
            $request_id=$_POST['request_id'];
            $model=$this->model("uc07model");
            $model->accept_request_leave($request_id);
            $data=$model->listAll_leave();
            $this->view("main","UC07/leave_page_1",$data);
        }

        public function verify_request_leave_reject(){
            $this->middleware();
            $request_id=$_SESSION['cur_leave_request_id'];
            $comment=$_POST['reject_reason'];
            $model=$this->model("uc07model");
            $model->reject_request_leave($request_id,$comment);
            $data=$model->listAll_leave();
            $this->view("main","UC07/leave_page_1",$data);
        }

        public function verify_request_leave_submit(){
            $this->middleware();
            $request_id=$_POST['request_id'];
            $manager_id=7;#trong trường hợp này sẽ set mặc định vì không thể chạy nhiều api nhwung thực tế sẽ dùng api để tìm ra manager của $_SESSION['id']
            $model=$this->model("uc07model");
            $model->submit_request_leave($request_id,$manager_id);
            $data=$model->listAll_leave();
            $this->view("main","UC07/leave_page_1",$data);
        }

        public function verify_request_wfh(){
            $this->middleware();
            $model=$this->model("uc07model");
            $data=$model->listAll_wfh();
            $this->view("main","UC07/wfh_page_1",$data);
        }

        public function verify_request_wfh_reject_page(){
            $this->middleware();
            $_SESSION['cur_wfh_request_id']=$_POST["request_id"];
            $this->view("main","UC07/wfh_page_2",[]);
        }

        public function verify_request_wfh_accept(){
            $this->middleware();
            $request_id=$_POST['request_id'];
            $model=$this->model("uc07model");
            $model->accept_request_wfh($request_id);
            $data=$model->listAll_wfh();
            $this->view("main","UC07/wfh_page_1",$data);
        }

        public function verify_request_wfh_reject(){
            $this->middleware();
            $request_id=$_SESSION['cur_wfh_request_id'];
            $comment=$_POST['reject_reason'];
            $model=$this->model("uc07model");
            $model->reject_request_wfh($request_id,$comment);
            $data=$model->listAll_wfh();
            $this->view("main","UC07/wfh_page_1",$data);
        }

        public function verify_request_ot(){
            $this->middleware();
            $model=$this->model("uc07model");
            $data=$model->listAll_ot();
            $this->view("main","UC07/ot_page_1",$data);
        }

        public function verify_request_ot_reject_page(){
            $this->middleware();
            $_SESSION['cur_ot_request_id']=$_POST["request_id"];
            $this->view("main","UC07/ot_page_2",[]);
        }

        public function verify_request_ot_accept(){
            $this->middleware();
            $request_id=$_POST['request_id'];
            $model=$this->model("uc07model");
            $model->accept_request_ot($request_id);
            $data=$model->listAll_ot();
            $this->view("main","UC07/ot_page_1",$data);
        }

        public function verify_request_ot_reject(){
            $this->middleware();
            $request_id=$_SESSION['cur_ot_request_id'];
            $comment=$_POST['reject_reason'];
            $model=$this->model("uc07model");
            $model->reject_request_ot($request_id,$comment);
            $data=$model->listAll_ot();
            $this->view("main","UC07/ot_page_1",$data);
        }

        public function verify_request_goal(){
            $this->middleware();
            $model=$this->model("uc07model");
            $data=$model->listAll_goal();
            $this->view("main","UC07/goal_page_1",$data);
        }

        public function verify_request_goal_reject_page(){
            $this->middleware();
            $_SESSION['cur_goal_request_id']=$_POST["request_id"];
            $this->view("main","UC07/goal_page_2",[]);
        }

        public function verify_request_goal_accept(){
            $this->middleware();
            $request_id=$_POST['request_id'];
            $model=$this->model("uc07model");
            $model->accept_request_goal($request_id);
            $data=$model->listAll_goal();
            $this->view("main","UC07/goal_page_1",$data);
        }

        public function verify_request_goal_reject(){
            $this->middleware();
            $request_id=$_SESSION['cur_goal_request_id'];
            $comment=$_POST['reject_reason'];
            $model=$this->model("uc07model");
            $model->reject_request_goal($request_id,$comment);
            $data=$model->listAll_goal();
            $this->view("main","UC07/goal_page_1",$data);
        }
        //khuc nay them ne
		public function recruitment(){
            $this->middleware();
            if($this->getMiddleware('AuthMiddlewares')->isEmployee()) { 
                $this->view("main","main/authorization_error");
            }
            else {
                $model=$this->model("uc14model");
                $data=$model->listAll();
                $this->view("main","UC14/index",$data);
            }
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
        #khucnaythemNUA, NHO UNCOMMENT MIDDLE WARE TRONG CONTROLLER
        public function manage_employee(){
            $this->middleware();
            if($this->getMiddleware('AuthMiddlewares')->isEmployee()) { 
                $this->view("main","main/authorization_error");
            }
            else {
                //rendermanhinhemployee
            }
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