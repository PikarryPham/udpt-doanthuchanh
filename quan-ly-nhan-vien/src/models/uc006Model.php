<?php 
    class uc006Model extends ConnectDB{
        public function checkEmailExist($email) {
            $sql = "SELECT email FROM employee WHERE EMAIL = '$email'";
            $email = mysqli_query($this->connection, $sql);
            if(mysqli_fetch_array($email)){
                return true;
            } else { return false; }
        }
        
        public function sendOTP($email) {
            // Generate random code with 6 numbers
            $OTP = rand(100000,999999);
            
            $mailer = new PHPMailer(true); 
            $mailer->IsSMTP();
            $mailer->Host       = "smtp.gmail.com";
            $mailer->Port       = 465;
	        $mailer->SMTPDebug  = 2;
            $mailer->SMTPAuth   = true;
            $mailer->SMTPSecure = 'ssl';
            $mailer->Username   = "baohuyen1411@gmail.com";
            $mailer->Password   = "mgpepyozarejxsgr";
            
            $mailer->FROM = "baohuyen1411@gmail.com";
            $mailer->addAddress($email);

            $mailer->Subject = 'OTP to recover your password';
            $mailer->Body    = "Use " . $OTP . " to recover your password!";

            if(!$mailer->send()) {
                return 0;
            } else {
                return $OTP;
            }
        }
    }