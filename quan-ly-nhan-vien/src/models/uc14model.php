<?php

class uc14model extends ConnectDB{
    public $cv_id;
    public $manager_id;
    public $employee_id;
    public $name;
    public $email;
    public $url;
    public $academic_transcript_url;
    public $job_title;
    public $comment;
    public $date_of_application;
    public $status;

    public function listAll(){
        $listAll_api="http://127.0.0.1:5014/listall_manager";
        $request=array("manager_id"=>$_SESSION['id']);
        $options = array(
            'http' => array(
              'method'  => 'GET',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $listAll_api, false, $context );
        $data = json_decode($result);
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function viewdetail($cv_id){
        $detail_api="http://127.0.0.1:5014/viewdetail";
        $request=array("cv_id"=>$cv_id);
        
        $options = array(
            'http' => array(
              'method'  => 'GET',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $detail_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function update_status($cv_id,$cur_status,$comment){
        $update_api="http://127.0.0.1:5014/updatestatus";
        if ($cur_status=="Pending"){
            $status="Screening";
        }
        else if($cur_status=="Screening"){
            $status="Interviewing";
        }
        else if ($cur_status=="Interviewing"){
            $status="Offering";
        }
        else if($cur_status=="Offering"){
            $status="Approved";
        }
        else if ($cur_status=="Archived"){
            $status="Screening";
        }
        else if($cur_status=="Approved"){
            return Null;
        }

        $request=array("cv_id"=>$cv_id,"status"=>$status,"comment"=>$comment);
        
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $update_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function update_status_archived($cv_id,$cur_status,$comment){
        $update_api="http://127.0.0.1:5014/updatestatus";
        if ($cur_status=="Archived"){
            return null;
        }
        $status="Archived";

        $request=array("cv_id"=>$cv_id,"status"=>$status,"comment"=>$comment);
        
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $update_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }
}

?>