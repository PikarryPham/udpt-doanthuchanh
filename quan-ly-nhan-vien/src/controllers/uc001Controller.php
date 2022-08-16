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
}