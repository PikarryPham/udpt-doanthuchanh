<?php
class uc001Controller extends Controllers{
    public function index(){
        $model = $this->model('CICO');
        $data = $model->getAllCICO();
        //$this->middleware();
        $this->view("main","UC001/index",$data);
    }

    public function insertCICO(){
        $this->view("main","UC001/insertCICO");
    }

    public function updateCICO(){
        $this->view("main","UC001/updateCICO");
    }

    // public function viewCICOAdmin(){
    //     $model = $this->model('CICO');
    //     $data = $model->getAllCICOAdmin();
    //     $this->view("main","UC001/viewAdminCICO",$data);
    //     if (!empty($_GET['date_search'])) {
    //         echo $_GET['date_search'];
    //         $model = $this->model('CICO');
    //         $data = $model->filterCICO();
    //         $this->view("main","UC001/viewAdminCICO",$data);
    //     }
    // }
    public function viewCICOAdmin(){
        $model = $this->model('CICO');
        $data = $model->getAllCICOAdmin();
        $this->view("main","UC001/viewAdminCICO",$data);
    }
}