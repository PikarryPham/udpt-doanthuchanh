<?php
    class CICO extends ConnectDB{
        public function getAllCICO(){
            if ($_SESSION['id']) {
            $cico_api = "http://127.0.0.1:5000/get-all-check-in-check-out-time/".$_SESSION['id'];
            $data = [];
            $data = file_get_contents($cico_api);
            $new_res = json_decode($data,true);
            return $new_res["data"];
            }
        }

        public function insertCICO(){
            //$this->connection 
            $document_api = "http://127.0.0.1:5000/insert-document";
            $data = [];
            $data = file_get_contents($document_api);
            return $data;
        }
    }
?>