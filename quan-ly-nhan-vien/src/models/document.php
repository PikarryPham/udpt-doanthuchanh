<?php
    class Document extends ConnectDB{
        public function getAllDocument(){
            $document_api = "https://whispering-wave-23569.herokuapp.com/document";
            $data = [];
            $data = file_get_contents($document_api);
            $new_res = json_decode($data,true);
            return $new_res["data"];
        }
    }
?>