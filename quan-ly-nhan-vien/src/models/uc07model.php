<?php

class uc07model extends ConnectDB{


    public function listAll_leave(){
        $listAll_leave_api="http://127.0.0.1:5007/listall";
        $request=array("manager_id"=>5);
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
        $reject_leave_api="http://127.0.0.1:5007/reject_leave_request";
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
        $reject_leave_api="http://127.0.0.1:5007/submit_for_approve";
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
        $accept_leave_api="http://127.0.0.1:5007/approve_leave_request";
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
        $listAll_leave_api="http://127.0.0.1:5072/listall_manager";
        $request=array("manager_id"=>6);
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
        $reject_leave_api="http://127.0.0.1:5072/reject_goal_request";
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
        $accept_leave_api="http://127.0.0.1:5072/approve_goal_request";
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
        $listAll_leave_api="http://127.0.0.1:5071/listall_manager";
        $request=array("manager_id"=>6);
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
        $reject_leave_api="http://127.0.0.1:5071/reject_ot_request";
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
        $accept_leave_api="http://127.0.0.1:5071/approve_ot_request";
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
        $listAll_leave_api="http://127.0.0.1:5073/listall_manager";
        $request=array("manager_id"=>4);
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
        $reject_leave_api="http://127.0.0.1:5073/reject_wfh_request";
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
        $accept_leave_api="http://127.0.0.1:5073/approve_wfh_request";
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