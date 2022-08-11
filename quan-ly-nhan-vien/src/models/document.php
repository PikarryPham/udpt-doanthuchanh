<?php
    class Document extends ConnectDB{
        // protected $document_id;
        // protected $manager_id;
        // protected $title;
        // protected $content;
        // protected $categories;
        
        public function getAllDocument(){
            //$this->connection 
            $document_api = "http://127.0.0.1:5000/document";
            $data = [];
            $data = file_get_contents($document_api);
            $new_res = json_decode($data,true);
            //$data = 'hehe';
            // if (isset($data)) {
            //     return $data;
            // }
            return $new_res["data"];
            //return json_encode($data);
        }

        public function insertDocument(){
            //$this->connection 
            $document_api = "http://127.0.0.1:5000/insert-document";
            $data = [];
            $data = file_get_contents($document_api);
            //$data = 'hehe';
            // if (isset($data)) {
            //     return $data;
            // }
            return $data;
            //return json_encode($data);
        }
    }
?>