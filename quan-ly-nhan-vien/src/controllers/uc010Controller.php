<?php

class uc010Controller extends Controllers
{
    public function middleware()
    {
        if (!isset($_SESSION['id'])) {
            header("Location: " . $this->host_name);
        }
    }

    public function index()
    {
        $this->middleware();
        $this->view("main", "UC010/index", []);
    }

    public function update_leave_history()
    {
        $this->middleware();
        $model = $this->model('leaveModel');

        $postData = [
            'employee_id' => $_POST["employee_id"],
            'leave_typeid' => $_POST["leave_typeid"],
            'create_date' => $_POST["create_date"],
            'number_days' => $_POST["number_days"],
        ];

        $leaveHistory = $model->get_leave_history($postData);
        if (!empty($leaveHistory)) {
            $postData['used_day'] = $leaveHistory['USED_DAY'];
            $postData['remaining_day'] = $leaveHistory['REMAINING_DAY'];

            $response = $model->update_leave_history($postData);
            if ($response) {
                return $this->response_data(200, "Update leave type history success", [], true);
            }

            return $this->response_data(500, "Invalid data", [], false);
        }

        return $this->response_data(404, "Leave history not found", [], false);
    }

    public function get_data_summaries()
    {
        $this->middleware();
        $model = $this->model('leaveModel');

        $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $year = isset($_POST['year']) ? $_POST['year'] : '';

        if (!empty($userId) && !empty($year)) {
            $leaveTypes = $model->get_all_leave_types();
            $leave_type_histories = $model->get_leave_type_histories($userId, $year);

            $data = [
                'leave_types' => $leaveTypes,
                'leave_type_histories' => $leave_type_histories
            ];

            return $this->response_data(200, "Get data summaries success", $data, true);
        }

        return $this->response_data(500, "Invalid data", [], false);
    }

    public function response_data($status, $message, $data, $success)
    {
        $arr = [
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "success" => $success,
        ];

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($arr);
    }
}

?>