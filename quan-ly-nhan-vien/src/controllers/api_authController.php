<?php
class api_authController extends Controllers{
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
    public function get_user($data = []) {
        $model   = $this->model('authModel');
        $summary = "get information about user";
        if (isset($data[0])){
            $id = $data[0];
        }else{
            echo $this->data_export(400,"Missing Required Information", $summary, null, false);
            exit();
        }
        $user    = $model->getInfo($id);
        echo $this->data_export(200,"get user success", $summary, $user, true);
    }
}