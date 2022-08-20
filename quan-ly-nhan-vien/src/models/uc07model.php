<?php

class uc07model extends ConnectDB{


    public function listAll_leave(){
        $listAll_leave_api="https://safe-dusk-48254.herokuapp.com/listall";
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
        $result = file_get_contents( $listAll_leave_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function reject_request_leave($request_id,$comment){
        $reject_leave_api="https://safe-dusk-48254.herokuapp.com/reject_leave_request";
        $request=array("request_id"=>$request_id,"status"=>"Rejected","comment"=>"$comment");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $reject_leave_api, false, $context);
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function submit_request_leave($request_id,$manager_id){
        $reject_leave_api="https://safe-dusk-48254.herokuapp.com/submit_for_approve";
        $request=array("request_id"=>$request_id,"manager_id"=>$manager_id);
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $reject_leave_api, false, $context);
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function accept_request_leave($request_id){
        $accept_leave_api="https://safe-dusk-48254.herokuapp.com/approve_leave_request";
        $request=array("request_id"=>$request_id,"status"=>"Approved");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $accept_leave_api, false, $context);
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }
#########################################################################
    public function listAll_goal(){
        $listAll_leave_api="https://calm-retreat-48309.herokuapp.com/listall_manager";
        $request=array("manager_id"=>$_SESSION['id']); #$_SESSION['id']
        $options = array(
            'http' => array(
              'method'  => 'GET',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $listAll_leave_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function reject_request_goal($request_id,$comment){
        $reject_leave_api="https://calm-retreat-48309.herokuapp.com/reject_goal_request";
        $request=array("request_id"=>$request_id,"status"=>"Rejected","comment"=>"$comment");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
        $context  = stream_context_create( $options );
        $result = file_get_contents( $reject_leave_api, false, $context);
        $data = json_decode($result);
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function accept_request_goal($request_id){
        $accept_leave_api="https://calm-retreat-48309.herokuapp.com/approve_goal_request";
        $request=array("request_id"=>$request_id,"status"=>"Approved");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $accept_leave_api, false, $context);
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }
#####################################################################################
    public function listAll_ot(){
        $listAll_leave_api="https://agile-lowlands-42188.herokuapp.com/listall_manager";
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
        $result = file_get_contents( $listAll_leave_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function reject_request_ot($request_id,$comment){
        $reject_leave_api="https://agile-lowlands-42188.herokuapp.com/reject_ot_request";
        $request=array("request_id"=>$request_id,"status"=>"Rejected","comment"=>"$comment");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
        $context  = stream_context_create( $options );
        $result = file_get_contents( $reject_leave_api, false, $context);
        $data = json_decode($result);
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function accept_request_ot($request_id){
        $accept_leave_api="https://agile-lowlands-42188.herokuapp.com/approve_ot_request";
        $request=array("request_id"=>$request_id,"status"=>"Approved");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $accept_leave_api, false, $context);
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

#####################################################################################
    public function listAll_wfh(){
        $listAll_leave_api="https://mysterious-reaches-96040.herokuapp.com/listall_manager";
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
        $result = file_get_contents( $listAll_leave_api, false, $context );
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function reject_request_wfh($request_id,$comment){
        $reject_leave_api="https://mysterious-reaches-96040.herokuapp.com/reject_wfh_request";
        $request=array("request_id"=>$request_id,"status"=>"Rejected","comment"=>"$comment");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
        $context  = stream_context_create( $options );
        $result = file_get_contents( $reject_leave_api, false, $context);
        $data = json_decode($result);
        //$data=file_get_contents($listAll_api);
        return $data;
    }

    public function accept_request_wfh($request_id){
        $accept_leave_api="https://mysterious-reaches-96040.herokuapp.com/approve_wfh_request";
        $request=array("request_id"=>$request_id,"status"=>"Approved");
        $options = array(
            'http' => array(
              'method'  => 'PATCH',
              'content' => json_encode($request),
              'header'=>  "Content-Type: application/json\r\n" .
                          "Accept: application/json\r\n"
              )
        );
          
        $context  = stream_context_create( $options );
        $result = file_get_contents( $accept_leave_api, false, $context);
        $data = json_decode($result);
        
        //$data=file_get_contents($listAll_api);
        return $data;
    }
}

?>