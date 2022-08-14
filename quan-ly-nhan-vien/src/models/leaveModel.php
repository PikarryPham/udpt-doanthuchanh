<?php

class leaveModel extends ConnectDB
{
    public function get_leave_history($data)
    {
        $employee_id = $data['employee_id'];
        $leave_typeid = $data['leave_typeid'];
        $create_date = $data['create_date'];

        $sql = "SELECT * FROM `leave_type_history` 
                WHERE `EMPLOYEE_ID` = '$employee_id' 
                AND `LEAVE_TYPEID` = '$leave_typeid' 
                AND YEAR(`CREATE_DATE`) = '$create_date'";

        $result = mysqli_query($this->connection, $sql);

        $rows = [];
        while ($row = mysqli_fetch_array($result)) {
            $rows['USED_DAY'] = $row['USED_DAY'];
            $rows['REMAINING_DAY'] = $row['REMAINING_DAY'];
        }

        return $rows;
    }

    public function update_leave_history($data)
    {
        $employee_id = $data['employee_id'];
        $leave_typeid = $data['leave_typeid'];
        $create_date = $data['create_date'];
        $used_day = $data['used_day'] - $data['number_days'];
        $remaining_day = $data['remaining_day'] + $data['number_days'];

        $sql = "UPDATE `leave_type_history`
                SET `USED_DAY` = '$used_day', `REMAINING_DAY` = '$remaining_day' 
                WHERE `EMPLOYEE_ID` = '$employee_id' 
                AND `LEAVE_TYPEID` = '$leave_typeid' 
                AND YEAR(`CREATE_DATE`) = '$create_date'";

        return mysqli_query($this->connection, $sql);
    }

    public function get_all_leave_types()
    {
        $sql = "SELECT * FROM `leave_type`";
        $result = mysqli_query($this->connection, $sql);

        return mysqli_fetch_all($result);
    }

    public function get_leave_type_histories($userId, $year)
    {
        $sql = "SELECT * FROM `leave_type_history` 
                WHERE `EMPLOYEE_ID` = '$userId' 
                AND YEAR(`CREATE_DATE`) = '$year'";
        $result = mysqli_query($this->connection, $sql);

        $rows = [];
        while ($row = mysqli_fetch_array($result)) {
            $rows[$row[1]] = $row;
        }

        return $rows;
    }
}