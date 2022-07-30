<?php
    class uc010Controller extends Controllers {
        public function middleware(){
            if (!isset($_SESSION['id'])){
                header("Location: " . $this->host_name);
            }
        }
        public function index(){
            $this->middleware();
            $this->view("main","UC010/index",[]);
        }
    }
?>