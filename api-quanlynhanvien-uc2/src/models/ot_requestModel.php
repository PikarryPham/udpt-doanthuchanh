<?php 
class ot_requestModel extends ConnectDB{
    // Lấy tổng số bản gi;
    public function count_data($table, $add = ""){
        $sql = "SELECT COUNT(*) AS `number` FROM `$table` $add";
        $data = mysqli_query($this->connection, $sql);
        $data = mysqli_fetch_array($data)['number'];
        return $data;
    }

    public function check_isset($table, $column1, $value1, $column2, $value2){
        $sql = "SELECT COUNT(*) AS `number` FROM `$table` WHERE `$column1` = '$value1' AND `$column2` = '$value2'";
        $data = mysqli_query($this->connection, $sql);
        $data = mysqli_fetch_array($data)['number'];
        return $data;
    }

    // Tạo 1 bản ghi ot request mới
    public function createOT($EMPLOYEE_ID, $MANAGER_ID, $REASON, $UPDATE_DATE, $STATUS, $MANAGER_COMMENT, $START_DATE, $ESTIMATED_HOURS, $END_DATE, $UNSUBMIT_REASON, $NOTIFICATION_FLAG){
        $sql = "INSERT INTO `request ot`(`EMPLOYEE_ID`, `MANAGER_ID`, `REASON`, `UPDATE_DATE`, `STATUS`, `MANAGER_COMMENT`, `START_DATE`, `ESTIMATED_HOURS`, `END_DATE`, `UNSUBMIT_REASON`, `NOTIFICATION_FLAG`) VALUES ('$EMPLOYEE_ID', '$MANAGER_ID', '$REASON', '$UPDATE_DATE', '$STATUS', '$MANAGER_COMMENT', '$START_DATE', '$ESTIMATED_HOURS', '$END_DATE', '$UNSUBMIT_REASON', '$NOTIFICATION_FLAG')";
        mysqli_query($this->connection, $sql);
        
        if ($this->connection->error != ""){
            return 0;
        }else{
            $sql = "SELECT `ROT_ID` FROM `request ot` WHERE `EMPLOYEE_ID` = '$EMPLOYEE_ID' AND `MANAGER_ID` = '$MANAGER_ID' ORDER BY `ROT_ID` DESC limit 1";
            $data = mysqli_query($this->connection, $sql);
            $data = mysqli_fetch_array($data)['ROT_ID'];
            return $data;
        }
    }

    // Canceled request ot
    public function Canceled_request_ot($id,$EMPLOYEE_ID, $UNSUBMIT_REASON, $status){        
        if ($this->check_isset('request ot','ROT_ID',$id,'EMPLOYEE_ID',$EMPLOYEE_ID) == 0){
            return false;
        }else{
            $sql = "UPDATE `request ot` SET `UNSUBMIT_REASON` = '$UNSUBMIT_REASON' , `STATUS` = '$status' WHERE `ROT_ID` = '$id' AND `EMPLOYEE_ID` = '$EMPLOYEE_ID'";
            mysqli_query($this->connection, $sql);
            return true;
        }
    }

    // edit request ot_request
    public function edit_request_ot($id, $EMPLOYEE_ID, $MANAGER_ID, $REASON, $UPDATE_DATE, $STATUS, $MANAGER_COMMENT, $START_DATE, $ESTIMATED_HOURS, $END_DATE, $UNSUBMIT_REASON, $NOTIFICATION_FLAG){
        if ($this->check_isset('request ot','ROT_ID',$id,'EMPLOYEE_ID',$EMPLOYEE_ID) == 0){
            return false;
        }else{
            $sql = "UPDATE `request ot` SET `REASON`='$REASON',`UPDATE_DATE`='$UPDATE_DATE',`STATUS`='$STATUS',`MANAGER_COMMENT`='$MANAGER_COMMENT',`START_DATE`='$START_DATE',`ESTIMATED_HOURS`='$ESTIMATED_HOURS',`END_DATE`='$END_DATE',`UNSUBMIT_REASON`='$UNSUBMIT_REASON',`NOTIFICATION_FLAG`='$NOTIFICATION_FLAG' WHERE `ROT_ID` = '$id'";
            mysqli_query($this->connection, $sql);
            return true;
        }
    }

    // delete request ot detail
    public function delete_request_ot_detail($id){
        if ($this->check_isset('request ot detail','ROTDETAIL_ID',$id,'ROTDETAIL_ID',$id) == 0){
            return false;
        }else{
            $sql = "DELETE FROM `request ot detail` WHERE `ROTDETAIL_ID` = '$id'";
            mysqli_query($this->connection, $sql);
            return true;
        }
    }

    // delete muntyple request ot detail
    public function delete_request_ot_details($id){
        $sql = "DELETE FROM `request ot detail` WHERE `ROT_ID` = '$id'";
        mysqli_query($this->connection, $sql);
    }

    // delete an request ot
    public function delete_request_ot($id){
        if ($this->check_isset('request ot','ROT_ID',$id,'ROT_ID',$id) == 0){
            return false;
        }else{
            $this->delete_request_ot_details($id);
            $sql = "DELETE FROM `request ot` WHERE `ROT_ID` = '$id'";
            mysqli_query($this->connection, $sql);
            return true;
        }
    }

    // tạo nhiểu bảng ghi ot request detail
    public function createOtDetail($ROT_ID, $data = []){
        foreach($data as $d){
            $DATE   =   $d['DATE'];
            $HOUR   =   $d['HOUR'];
            $sql = "INSERT INTO `request ot detail`(`ROT_ID`, `DATE`, `HOUR`) VALUES ('$ROT_ID', '$DATE', '$HOUR')";
            mysqli_query($this->connection, $sql);
            if ($this->connection->error != ""){
                return false;
            }
        }
        return true;
    }

    // Xem một thông tin OT Request bất kỳ
    public function getOneRequestOt($ROT_ID){
        $sql = "SELECT * FROM `request ot` WHERE `ROT_ID` = '$ROT_ID'";
        $data = mysqli_query($this->connection, $sql);
        $data = mysqli_fetch_array($data);

        if (isset($data['ROT_ID'])){
            $ot_request = [
                "ROT_ID"    => $data["ROT_ID"],
                "EMPLOYEE_ID" => $data["EMPLOYEE_ID"],
                "MANAGER_ID" => $data["MANAGER_ID"],
                "REASON"    => $data["REASON"],
                "CREATE_DATE"=>$data["CREATE_DATE"],
                "UPDATE_DATE"=>$data["UPDATE_DATE"],
                "STATUS" => $data["STATUS"],
                "MANAGER_COMMENT" => $data["MANAGER_COMMENT"],
                "START_DATE"    => $data["START_DATE"],
                "ESTIMATED_HOURS"=> $data["ESTIMATED_HOURS"],
                "END_DATE" => $data["END_DATE"],
                "UNSUBMIT_REASON" => $data["UNSUBMIT_REASON"],
                "NOTIFICATION_FLAG" => $data["NOTIFICATION_FLAG"],
                "OTRequestDetails" =>$this->get_request_ot_detail($ROT_ID),
            ];
            return $ot_request;
        }else{
            return [];
        }    
    }
    // Xem một thông tin OT Request detail bất kỳ
    public function get_request_ot_detail($ROT_ID){
        $sql = "SELECT * FROM `request ot detail` WHERE `ROT_ID` = '$ROT_ID' ORDER BY `DATE` ASC";
        $data = mysqli_query($this->connection, $sql);
        $ot_request = [];
        foreach($data as $index=>$d){
            $ot_request[$index] = [
                "ROT_ID" => $d["ROT_ID"],
                "DATE"   => $d["DATE"],
                "HOUR"   => $d["HOUR"],
            ];
        }
        return $ot_request;
    }

    // Xem nhieu thông tin OT Request bất kỳ
    public function get_all_information_request($type, $ID, $limit, $offset, $order_column, $sort_by){
        $sql = "SELECT * FROM `request ot` WHERE `$type` = '$ID'
        ORDER BY `$order_column` $sort_by LIMIT $limit OFFSET $offset";
        $datas = mysqli_query($this->connection, $sql);
        
        if ($this->connection->error != ""){
            return [];
        }

        $ot_requests = [];
        foreach($datas as $index=>$data){
            $ot_requests[$index] = [
                "id"    => $data["ROT_ID"],
                "EMPLOYEE_ID" => $data["EMPLOYEE_ID"],
                "MANAGER_ID" => $data["MANAGER_ID"],
                "REASON"    => $data["REASON"],
                "CREATE_DATE"=>$data["CREATE_DATE"],
                "UPDATE_DATE"=>$data["UPDATE_DATE"],
                "STATUS" => $data["STATUS"],
                "MANAGER_COMMENT" => $data["MANAGER_COMMENT"],
                "START_DATE"    => $data["START_DATE"],
                "ESTIMATED_HOURS"=> $data["ESTIMATED_HOURS"],
                "END_DATE" => $data["END_DATE"],
            ];
        }
        return $ot_requests;
    }

    public function get_all_ot_request_details($ROT_ID, $limit, $offset, $order_column, $sort_by){
        $sql = "SELECT * FROM `request ot detail` WHERE `ROT_ID` = '$ROT_ID' ORDER BY `$order_column` $sort_by LIMIT $limit OFFSET $offset";
        $data = mysqli_query($this->connection, $sql);
        $ot_request_detail = [];
        
        if ($this->connection->error != ""){
            return [];
        }
        
        foreach($data as $index=>$d){
            $ot_request_detail[$index] = [
                "ROTDETAIL_ID " => $d["ROTDETAIL_ID"],
                "ROT_ID"        => $d["ROT_ID"],
                "DATE"          => $d["DATE"],
                "HOUR"          => $d["HOUR"],
            ];
        }
        return $ot_request_detail;
    }
}