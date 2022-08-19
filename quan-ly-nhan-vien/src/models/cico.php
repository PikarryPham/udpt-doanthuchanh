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

        public function getAllCICOAdmin(){
            $data_api = "http://127.0.0.1:5000/get-all-cico-admin";
            $data = [];
            $data = file_get_contents($data_api);
            $new_res = json_decode($data,true);
            return $new_res["data"];
        }

        public function filterCICO(){
            if ($_GET['date_search']) {
                // $source = '2012-07-31';
                // $date = new DateTime($source);
                // echo $date->format('d.m.Y'); // 31.07.2012
                // echo $date->format('d-m-Y'); // 31-07-2012
                echo $_GET['date_search'];
                // $cico_api = "http://127.0.0.1:5000/get-all-check-in-check-out-time/".$_GET['date_search'];
                // $data = [];
                // $data = file_get_contents($cico_api);
                // $new_res = json_decode($data,true);
                // return $new_res["data"];
            }
        }
    }
?>