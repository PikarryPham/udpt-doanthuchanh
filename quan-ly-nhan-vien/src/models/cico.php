<?php
    class CICO extends ConnectDB{
        public function getAllCICO(){
            if ($_SESSION['id']) {
            $cico_api = "https://guarded-island-72965.herokuapp.com/get-all-check-in-check-out-time/".$_SESSION['id'];
            $data = [];
            $data = file_get_contents($cico_api);
            $new_res = json_decode($data,true);
            return $new_res["data"];
            }
        }

        public function getAllCICOAdmin(){
            $data_api = "https://guarded-island-72965.herokuapp.com/get-all-cico-admin";
            $data = [];
            $data = file_get_contents($data_api);
            $new_res = json_decode($data,true);
            return $new_res["data"];
        }

        public function filterCICO(){
            if ($_POST['date']) {
                // $source = '2012-07-31';
                // $date = new DateTime($source);
                // echo $date->format('d.m.Y'); // 31.07.2012
                // echo $date->format('d-m-Y'); // 31-07-2012

                $cico_api = "https://guarded-island-72965.herokuapp.com/filter-all-cico/".$_POST['date'];
                $data = [];
                $data = file_get_contents($cico_api);
                $new_res = json_decode($data,true);
                return $new_res["data"];
            }
        }
    }
?>