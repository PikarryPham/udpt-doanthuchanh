<?php
    class api_uc002Controller extends Controllers {
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
        // API 1: Thêm một thông tin request OT
        public function create_ot() {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $summary            = "Create New Request OT";
            $EMPLOYEE_ID        = $_POST["EMPLOYEE_ID"];
            $MANAGER_ID         = $_POST["MANAGER_ID"];
            $UPDATE_DATE        = date('Y-m-d h:i:s');
            $REASON             = addslashes($_POST["REASON"]);
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
                if (isset($_POST["date-ot-$i"])){
                    $date_ot = $_POST["date-ot-$i"];
                    $hour_ot = $_POST["hour-ot-$i"];
                    $OTRequestDetails[$index] = [
                        "DATE"  => $date_ot,
                        "HOUR"  => $hour_ot
                    ];
                    $index++;
                }
            }
            
            $model  = $this->model('ot_requestModel');

            $ROT_ID = $model->createOT($EMPLOYEE_ID, $MANAGER_ID, $REASON, $UPDATE_DATE, $STATUS, $MANAGER_COMMENT, $START_DATE, $ESTIMATED_HOURS, $END_DATE, $UNSUBMIT_REASON, $NOTIFICATION_FLAG);
            
            if ($ROT_ID != 0){
                if ($model->createOtDetail($ROT_ID, $OTRequestDetails)){
                    echo $this->data_export(200,"OT Request Created Successfully", $summary, ["ROT_ID" => $ROT_ID], true);
                }else{
                    echo $this->data_export(400,"Missing Required Information", $summary, null, false);
                }
            }else{
                echo $this->data_export(400,"Missing Required Information", $summary, null, false);
            }
        }
        
        // API 2: Sửa một thông tin request OT Canceled
        public function canceled_request_ot($data = []){
            $model   = $this->model('ot_requestModel');
            $summary = "Unsubmit Employee’s Request OT Information";

            $EMPLOYEE_ID        = $_POST['EMPLOYEE_ID'];
            $UNSUBMIT_REASON    = $_POST['UNSUBMIT_REASON'];
            $STATUS             = "Canceled";
            $UPDATE_DATE        = date('Y-m-d h:i:s');

            if (isset($data[0])){
                $id = $data[0];
            }else{
                echo $this->data_export(400,"Missing Required Information", $summary, null, false);
                exit();
            }

            if ($model->Canceled_request_ot($id,$EMPLOYEE_ID, $UNSUBMIT_REASON, $STATUS, $UPDATE_DATE)){
                echo $this->data_export(200,"Unsubmit Employee’s OT Information Successfully", $summary, null, true);
            }else{
                echo $this->data_export(405,"Unable to update Employee’s request OT with id $id", $summary, null, false);
            }
        }

        // API 2: Sửa một thông tin request OT 
        public function edit_request_ot($data = []){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $model   = $this->model('ot_requestModel');
            $summary = "Unsubmit Employee’s Request OT Information";

            if (isset($data[0])){
                $id = $data[0];
            }else{
                echo $this->data_export(400,"Missing Required Information", $summary, null, false);
                exit();
            }

            $EMPLOYEE_ID        = $_POST["EMPLOYEE_ID"];
            $MANAGER_ID         = $_POST["MANAGER_ID"];
            $REASON             = addslashes($_POST["REASON"]);
            $UPDATE_DATE        = date('Y-m-d h:i:s');
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
                if (isset($_POST["date-ot-$i"])){
                    $date_ot = $_POST["date-ot-$i"];
                    $hour_ot = $_POST["hour-ot-$i"];
                    $OTRequestDetails[$index] = [
                        "DATE"  => $date_ot,
                        "HOUR"  => $hour_ot
                    ];
                    $index++;
                }
            }

            $result_check = $model->edit_request_ot($id, $EMPLOYEE_ID, $MANAGER_ID, $REASON, $UPDATE_DATE, $STATUS, $MANAGER_COMMENT, $START_DATE, $ESTIMATED_HOURS, $END_DATE, $UNSUBMIT_REASON, $NOTIFICATION_FLAG);
            if ($result_check){
                $model->delete_request_ot_details($id);
                $model->createOtDetail($id, $OTRequestDetails);
                echo $this->data_export(200,"Updated Employee’s OT Information Successfully", $summary, null, true);
            }else{
                echo $this->data_export(405,"Unable to update Employee’s request OT with id $id", $summary, null, false);
            }

        }

        // API 3: Xóa một thông tin request OT
        public function destroy_request_ot($data = []){
            $model   = $this->model('ot_requestModel');
            $summary = "Delete An Employee’s Request OT";

            if (isset($data[0])){
                $id = $data[0];
            }else{
                echo $this->data_export(400,"Missing Required Information", $summary, null, false);
                exit();
            }

            if ($model->delete_request_ot($id)){
                echo $this->data_export(200,"An OT Request Of Employee Has Been Delete Successfully", $summary, null, true);
            }else{
                echo $this->data_export(404,"Employee’s OT Request Not Found", $summary, null, false);
            }

        }

        // API 4: Xóa một thông tin chi tiết trong 1 request OT bất kỳ
        public function destroy_request_ot_detail($data = []){
            $model   = $this->model('ot_requestModel');
            $summary = "Delete The Employee’s Specified Request OT Information Detail Of Specified Request OT";
            if (sizeof($data)){
                $id = $data[0];
            }else{
                echo $this->data_export(400,"Missing Required Information", $summary, null, false);
                exit();
            }

            if ($model->delete_request_ot_detail($id)){
                echo $this->data_export(200,"Delete the OT Request Detail Successfully!", $summary, null, true);
            }else{
                echo $this->data_export(404,"Request OT Detail Not Found", $summary, null, false);
            }

        }

        // API 5: Xem danh sách các thông tin chi tiết trong 1 request OT bất kỳ (có phân trang)
        public function ot_request_details($data = []) {
            $summary = "Get Employee’s Request OT Information Detail Of Specified Request OT Sort By DATE DESC AND PAGINATE";
            
            if (isset($data[0])){
                $ot_request_id = $data[0];
            }else{
                echo $this->data_export(404,"Request OT Not Found", $summary, null, false);
                exit();
            }

            $limit = 20;
            $offset = 0;
            $order_column = "date";
            $sort_by = "asc";

            if (isset($_GET['limit'])){
                $limit = $_GET['limit'];
            }
            if (isset($_GET['offset'])){
                $offset = $_GET['offset'];
            }
            if (isset($_GET['sort_by'])){
                $order_column = $_GET['sort_by'];
                if ($order_column[0] == '-'){
                    $sort_by = "desc";
                }
                $order_column = substr($order_column, 1);
            }
            $model               = $this->model('ot_requestModel');
            $ot_request_details  = $model->get_all_ot_request_details($ot_request_id, $limit, $offset, $order_column, $sort_by);

            $resultset = [
                "resultset" => [
                    "count"         => $model->count_data('request ot detail'),
                    "offset"        => $offset,
                    "limit"         => $limit,
                    "order_column"  => $order_column,
                    "sort_by"       => $sort_by,
                ]
            ];

            $information_requests = [
                "value"     => $ot_request_details,
                "metadata" => $resultset,
            ];

            if ($ot_request_details != []){
                echo $this->data_export(200,"Request OT Details Of Request OT With Id 1 Have Been Found", $summary, $information_requests, false);
            }else{
                echo $this->data_export(404,"Request OT Not Found", $summary, null, false);
            }
        }
        // API 6: Lấy danh sách các request OT hiện có (có phân trang)
        // http://localhost/udpt-quanlynhanvien/api_uc002/ot_requests&limit=5&offset=2&sort_by=-create_date
        public function ot_requests() {
            $summary = "Get All Employee’s Request OT Information Sort By CREATE_DATE DESC AND PAGINATE";
            $limit = 5;
            $offset = 0;
            $order_column = "ROT_ID";
            $sort_by = "desc";

            if (isset($_GET['limit'])){
                $limit = $_GET['limit'];
            }
            if (isset($_GET['offset'])){
                $offset = $_GET['offset'];
            }
            if (isset($_GET['sort_by'])){
                $order_column = $_GET['sort_by'];
                if ($order_column[0] == '-'){
                    $sort_by = "desc";
                }
                $order_column = substr($order_column, 1);
            }
            if (isset($_GET['EMPLOYEE_ID'])){
                $type = "EMPLOYEE_ID";
                $ID = $_GET['EMPLOYEE_ID'];
            }else if (isset($_GET['MANAGER_ID'])){
                $type = "MANAGER_ID";
                $ID = $_GET['MANAGER_ID'];
            }else{
                echo $this->data_export(404,"Request OT Not Found", $summary, null, false);
                exit();
            }

            $model        = $this->model('ot_requestModel');
            $ot_requests  = $model->get_all_information_request($type, $ID, $limit, $offset, $order_column, $sort_by);

            $resultset = [
                "resultset" => [
                    "count"         => $model->count_data('request ot', "WHERE `$type` = '$ID'"),
                    "offset"        => $offset,
                    "limit"         => $limit,
                    "order_column"  => $order_column,
                    "sort_by"       => $sort_by,
                ]
            ];

            $information_requests = [
                "value"     => $ot_requests,
                "metadata" => $resultset,
            ];
            if ($ot_requests != []){
                echo $this->data_export(200,"Employee’s Request OTs Have Been Found", $summary, $information_requests, true);
            }else{
                echo $this->data_export(404,"Request OT Not Found", $summary, null, false);
            }
        }
        // API 7 Xem một thông tin OT Request bất kỳ
        public function ot_request($data = []) {
            $model = $this->model('ot_requestModel');
            if (isset($data[0])){
                $ot_requests = $model->getOneRequestOt($data[0]);
            }else{
                $ot_requests = [];
            }
            if ($ot_requests != []){
                echo $this->data_export(200,"An Employee’s OT Request Have Been Found", "Get A Specified Employee’s OT Request", $ot_requests, true);
            }else{
                echo $this->data_export(404,"OT Request Information Not Found", "Get A Specified Employee’s OT Request", null, false);
            }
        }
        // Gửi mail
        public function send_mail(){
            include "./mail/mailer.php";
            mail_send_as_content("cong.pttc@gmail.com","cong","hello deom", "content nef");
        }
    }