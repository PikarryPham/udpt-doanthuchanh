<?php
class uc006Controller extends Controllers{
    public function middleware() {
        if (!isset($_SESSION['id'])){
            header("Location: " . $this->host_name);
        }
    }

    public function forgot() {
        $this->view("home","UC006/forgot",["true"]);
    }

    public function otp() {
        if (isset($_REQUEST["otp"])) {
            $userOTP = $_REQUEST["otp"];
            $systemOTP = $_SESSION["otp"];

            if ($userOTP == $systemOTP) {
                header("Location: " . $this->host_name . "/uc006/recoverpass");
            } else {
                $this->view("home","UC006/otp",["wrongotp"]);
            }
        }

        $this->view("home","UC006/otp",["empty"]);
    }

    public function recoverpass() {
        $email = $_SESSION['email'];
        $newPassword = "";

        if (isset($_REQUEST["newpassword"])) {
            $newPassword = $_REQUEST["newpassword"];
            $post = ['EMAIL' => $email, 'NEWPASSWORD' => $newPassword];
            #$ch = curl_init('http://localhost:8888/udpt-doanthuchanh/API/api-quanlynhanvien-uc6/api_uc006/recover_pass');
            $ch = curl_init('http://localhost/API/api-quanlynhanvien-uc6/api_uc006/recover_pass');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($response);
            $result = $res->success;

            if ($result == true) {
                header("Location: " . $this->host_name);
            } else {
                $this->view("home","UC006/recoverpass",[$email,'errorpass']);
            }
            
        }
        $this->view("home","UC006/recoverpass",[$email,'empty']);
    }

    public function onForgotPass() {
        $email = "";
        if (isset($_REQUEST["email"])) {
            $email = $_REQUEST["email"];
        }
        
        $model = $this->model('uc006Model');
        if($model->checkEmailExist($email)) {
            $post = ['EMAIL' => $email,];
            //change to  correct api path
            #$ch = curl_init('http://localhost:8888/udpt-doanthuchanh/API/api-quanlynhanvien-uc6/api_uc006/send_otp');
            $ch = curl_init('http://localhost/API/api-quanlynhanvien-uc6/api_uc006/send_otp');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $response = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($response);
            $OTP = $res->data;

            if ($OTP == 0) {
                $this->view("home","UC006/forgot",["mailerror"]);
            } else {
                $_SESSION["otp"] = $OTP;
                $_SESSION["email"] = $email;
                header("Location: " . $this->host_name . "/uc006/otp");
            }
        } else {
            $this->view("home","UC006/forgot",["false"]);
        }
    }
}