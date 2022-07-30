<?php 
    class authModel extends ConnectDB{
        public function login($username, $password){
            $sql = "SELECT * FROM `employee` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password'";
            $user = mysqli_query($this->connection, $sql);
            
            $user = mysqli_fetch_array($user);

            if (isset($user['EMPLOYEE_ID'])){
                $_SESSION['id']     = $user['EMPLOYEE_ID'];
                $_SESSION['name']   = $user['NAME'];
                $_SESSION['avatar'] = $user['AVATAR_URL'];
                $_SESSION['role']   = $user['ROLE'];
                return true;
            }else{
                return false;
            }
        }
        public function getInfo($id){
            $sql = "SELECT `employee`.`EMPLOYEE_ID`, `employee`.`MANAGER_ID`, `employee`.`NAME`, `employee`.`EMAIL`,
                    `employee`.`PHONE`, `employee`.`STATUS`, `department`.`NAME` as `DEPART_NAME` FROM `employee` 
                    JOIN `department` ON `employee`.`DEPART_ID` = `department`.`DEPART_ID`
                    WHERE `employee`.`EMPLOYEE_ID` = '$id'";
            $data = mysqli_query($this->connection, $sql);
            $data = mysqli_fetch_array($data);
            $user = [
                'EMPLOYEE_ID'   => $data['EMPLOYEE_ID'],
                'MANAGER_ID'    => $data['MANAGER_ID'],
                'NAME'          => $data['NAME'],
                'EMAIL'         => $data['EMAIL'],
                'PHONE'         => $data['PHONE'],
                'STATUS'        => $data['STATUS'],
                'DEPART_NAME'   => $data['DEPART_NAME'],
            ];
            return $user;
        }
    }