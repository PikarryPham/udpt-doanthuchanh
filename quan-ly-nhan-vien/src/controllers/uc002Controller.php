<?php
class uc002Controller extends Controllers{
    public function middleware(){
        if (!isset($_SESSION['id'])){
            header("Location: " . $this->host_name);
        }
    }
    public function index(){
        $this->middleware();
        $this->view("main","UC002/index",[]);
    }
    public function test(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $EMPLOYEE_ID        = $_POST["EMPLOYEE_ID"];
        $MANAGER_ID         = $_POST["MANAGER_ID"];
        $REASON             = addslashes($_POST["REASON"]);
        $UPDATE_DATE        = date('d-m-y h:i:s');
        $CREATE_DATE        = $_POST["CREATE_DATE"];
        $STATUS             = $_POST["STATUS"];
        $MANAGER_COMMENT    = null;
        $START_DATE         = $_POST["START_DATE"];
        $ESTIMATED_HOURS    = $_POST["ESTIMATED_HOURS"];
        $END_DATE           = $_POST["END_DATE"];
        $UNSUBMIT_REASON    = null;
        $NOTIFICATION_FLAG  = $_POST["NOTIFICATION_FLAG"];
        $OTRequestDetails = [];

        $number_ot = $_POST['number-ot'];
        $index = 0;
        for ($i = 1 ; $i < $number_ot ; $i++){
            if (isset($_POST["date-ot-1"])){
                $date_ot = $_POST["date-ot-$i"];
                $hour_ot = $_POST["hour-ot-$i"];
                $OTRequestDetails[$index] = [
                    "DATE"  => $date_ot,
                    "HOUR"  => $hour_ot
                ];
                $index++;
            }
        }
        echo $NOTIFICATION_FLAG;

    }
}