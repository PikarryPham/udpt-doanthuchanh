<?php
    class api_uc006Controller extends Controllers {
        public function index() {
            echo $this->data_export(404,"Request OT Not Found", null, null, false);
        }

        public function data_export($status, $message, $messageDetail, $data, $success) {
            $arr = [
                "status"        => $status, 
                "message"       => $message,
                "summary" => $messageDetail,
                "data"          => $data,
                "success"       => $success,
            ];
            
            return json_encode($arr);
        }
        
        // API 1: Send OTP
        public function send_otp() {
            include "./mail/mailer.php";

            // Generate random code with 6 numbers
            $OTP = rand(100000,999999);
            $email = $_POST['EMAIL'];

            // Send mail
            mail_send_as_content($email, "User", "OTP to recover your password", "Use " . $OTP . " to recover your password!");
            echo $this->data_export(200, "Have sent OTP to your email account", "", $OTP, true);
        }

        public function recover_pass(){
            $email = $_POST['EMAIL'];
            $newPass = $_POST['NEWPASSWORD'];
            $model = $this->model('uc006Model');
            if ($model->recoverPass($email, $newPass)) {
                echo $this->data_export(200,"Change password successfully","Change password for user has email".$email,null,true);
            } else {
                // echo $this->data_export(500,"Internal server error","Internal server error",null,false);
                
            }
        }

        // Gửi mail
        public function send_mail(){
            include "./mail/mailer.php";
            mail_send_as_content("cong.pttc@gmail.com","cong","hello deom", "content nef");
        }

    }