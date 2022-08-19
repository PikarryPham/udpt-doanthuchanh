<?php 
class uc006Model extends ConnectDB{
    // Cap nhat pass cho nguoi dung
    public function recoverPass($email, $newpass){
        $sql = "UPDATE employee SET PASSWORD='$newpass' WHERE EMAIL='$email'";
        if(mysqli_query($this->connection, $sql)){
            return true;
        } else { return false; };
    }
}