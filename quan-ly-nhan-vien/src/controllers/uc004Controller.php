<?php
class uc004Controller extends Controllers{
    public function middleware(){
        if (!isset($_SESSION['id'])){
            header("Location: " . $this->host_name);
        }
    }

    public function pageDecrease() {
        if (isset($_SESSION["wfhRequestCurrentPage"])) {
            $currentPage = $_SESSION["wfhRequestCurrentPage"];
            if ($currentPage > 1) {
                $_SESSION["wfhRequestCurrentPage"] = $currentPage - 1;
            }
        }

        header("Location: " . $this->host_name . "/uc004/index");
    }

    public function pageIncrease() {
        if (isset($_SESSION["wfhRequestCurrentPage"])) {
            $currentPage = $_SESSION["wfhRequestCurrentPage"];
            if ($currentPage < $_SESSION["wfhRequestTotalPage"]) {
                $_SESSION["wfhRequestCurrentPage"] = $currentPage + 1;
            }
        }

        header("Location: " . $this->host_name . "/uc004/index");
    }



    public function index() {
        $this->middleware();

        $employeeID = $_SESSION['id'];
        $currentPage = 1;

        if (isset($_SESSION["wfhRequestCurrentPage"])) {
            $currentPage = $_SESSION["wfhRequestCurrentPage"];
        } else {
            $_SESSION["wfhRequestCurrentPage"] = 1;
        }

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-requests?current_page=$currentPage&employee_id=$employeeID");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);

        $value = $res->{200}->content->examples->ListRequestWFH->value;
        $totalPages = $res->{200}->content->examples->ListRequestWFH->totalPages;
        $_SESSION["wfhRequestTotalPage"] = $totalPages;
        $value = json_decode(json_encode($value), true);

        if (count((array)$value) > 0) {
            $this->view("main", "UC004/index", [$value, $totalPages, $currentPage]);
        } else {
            $this->view("main", "UC004/empty-wfh-request", []);
        }
    }

    public function delete() {
        $rwfhID = $_POST['rwfhID'];
        $post = ['RWFH_ID' => $rwfhID,];

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/delete-wfh-request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);

        header("Location: " . $this->host_name . "/uc004/index");
    }

    public function add() {
        $this->middleware();

        $employeeID = $_SESSION['id'];
        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/employee?employeeID=$employeeID");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        $valueEmployee = $res->{200}->content->examples->EmployeeInfo->value;
        $valueEmployee = json_decode(json_encode($valueEmployee), true);
        $valueManager = $res->{200}->content->examples->ManagerInfo->value;
        $valueManager = json_decode(json_encode($valueManager), true);

        $this->view("main", "UC004/add-wfh-request", [$valueEmployee,$valueManager]);
    }

    public function createWFHRequest() {
        $this->middleware();

        $employeeID = $_POST['employeeID'];
        $managerID = $_POST['managerID'];
        $reason = $_POST['reason'];
        $fromDate = $_POST['start-date'];
        $toDate = $_POST['end-date'];
        $notificationFlag = $_POST['fl_up'] == "yes" ? 1 : 0;
        $listWFHDetail = explode(" ", $_POST['listWFHDetail']);
        $status = $_POST['employeeID'];;
        $post = ['EMPLOYEE_ID' => $employeeID, 'MANAGER_ID' => $managerID, 'REASON' => $reason, 'STATUS' => $status ,'FROM_DATE' => $fromDate, 'TO_DATE' => $toDate, 'NOTIFICATION_FLAG' => $notificationFlag ];

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        $value = $res->{200}->description;
        $rwfhID = $res->{200}->rwfhid;
        $value = json_decode(json_encode($value, true));
        if ($value="WFH Request Created Successfully"){
            $i = 0;
            while ($i < count($listWFHDetail) - 1){
                $date = $listWFHDetail[$i];
                $post = ['DATE' => $date];
                $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-request/$rwfhID");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response= curl_exec($ch);
                curl_close($ch);               
                $i++;
            }
            $this->view("main", "UC004/successfully", []);
            // Loop through listWFHDetail, doi voi moi gia tri, thì sẽ gọi API add detail
        } else {
            $result=false;
        }
        // 
    }

    public function update() {
        $this->middleware();

        $rwfhID = $_POST['updateRwfhID'];
        $employeeID = $_SESSION['id'];

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/employee?employeeID=$employeeID");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        $valueEmployee = $res->{200}->content->examples->EmployeeInfo->value;
        $valueEmployee = json_decode(json_encode($valueEmployee), true);
        $valueManager = $res->{200}->content->examples->ManagerInfo->value;
        $valueManager = json_decode(json_encode($valueManager), true);

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-request?rWfhID=$rwfhID");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        $rwfhData = $res->{200}->content->examples->DetailRequestWFH->value;
        $rwfhData = json_decode(json_encode($rwfhData), true);
        $detailRwfhData = $res->{200}->content->examples->listDetail->value;
        $detailRwfhData = json_decode(json_encode($detailRwfhData), true);

        $this->view("main", "UC004/edit-wfh-request", [$valueEmployee, $valueManager, $rwfhData[0], $detailRwfhData, $rwfhID]);
    }

    public function updateWFHRequest() {
        $this->middleware();

        $rwfhID = $_POST['rwfhID'];
        $reason = $_POST['reason'];
        $fromDate = $_POST['start-date'];
        $toDate = $_POST['end-date'];
        $notificationFlag = $_POST['fl_up'] == "yes" ? 1 : 0;
        $listWFHDetail = explode(" ", $_POST['listWFHDetail']);
        $patch = ['RWFH_ID' => $rwfhID, 'REASON' => $reason,'FROM_DATE' => $fromDate, 'TO_DATE' => $toDate, 'NOTIFICATION_FLAG' => $notificationFlag ];

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $patch);
        $response = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($response);
        $value = $res->{200}->description;
        $value = json_decode(json_encode($value, true));


        if ($value="WFH Request Update Successfully"){
            // DELETE ALL REQUEST belong to that rwfhID
            $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-request/delete-wfh-request-details/$rwfhID");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            $response = curl_exec($ch);
            curl_close($ch);

            // Loop through listWFHDetail, doi voi moi gia tri, thì sẽ gọi API add detail
            $i = 0;
            while ($i < count($listWFHDetail) - 1){
                $date = $listWFHDetail[$i];
                $post = ['DATE' => $date];
                $ch = curl_init("https://hidden-headland-19528.herokuapp.com/wfh-request/$rwfhID");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $response= curl_exec($ch);
                curl_close($ch);               
                $i++;
            }
            $this->view("main", "UC004/successfully", []);
        } else {
            $result=false;
        }
    }

    public function submit() {
        $rwfhID = $_POST['rwfhID'];

        $patch = ['RWFH_ID' => $rwfhID];

        $ch = curl_init("https://hidden-headland-19528.herokuapp.com/submit-wfh-request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $patch);
        $response = curl_exec($ch);
        curl_close($ch);

        $this->view("main", "UC004/successfully", []);
    }
}