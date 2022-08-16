<?php
    class Document extends ConnectDB{
        public function getAllDocument(){
            $document_api = "http://127.0.0.1:5000/document";
            $data = [];
            $data = file_get_contents($document_api);
            $new_res = json_decode($data,true);
            return $new_res["data"];
        }
    }
?>