<?php
class uc016Controller extends Controllers{
    // public function middleware(){
    //     if (!isset($_SESSION['id'])){
    //         header("Location: " . $this->host_name);
    //     }
    // }

    // public function index(){
    //     echo "hellu";
    // }

    public function document(){
        $model = $this->model('document');
        $data = $model->getAllDocument();
        //$this->middleware();
        $this->view("main","UC016/index",$data);
    }

    public function uploadDocument(){
        $model = $this->model('document');
        //$this->middleware();
        $this->view("main","UC016/insertDocument");
    }

    public function getDocument() {
        $model   = $this->model('document');
        $data    = $model->getAllDocument();
        echo $data;
        return $data;
    }
}