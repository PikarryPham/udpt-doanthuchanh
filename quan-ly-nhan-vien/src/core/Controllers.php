<?php

class Controllers
{
    #public $host_name = "http://localhost:8888/udpt-doanthuchanh/quan-ly-nhan-vien";
    public $host_name = "http://localhost/quan-ly-nhan-vien";
    public $api_uc002 = "http://localhost/API/api-quanlynhanvien-uc2/api_uc002";
    public $base_api_external = "https://lit-eyrie-06760.herokuapp.com";
    public $api_uc010;
    public $api_uc010_update_history; 
    public $api_uc010_summary;
    public $uc0131_132  = "https://damp-shelf-80253.herokuapp.com/api/uc0131_132";

    public function __construct()
    {
        $this->api_uc010 = $this->base_api_external . "/api/uc10";
        $this->api_uc010_update_history = $this->host_name . "/uc010/update_leave_history";
        $this->api_uc010_summary = $this->host_name . "/uc010/get_data_summaries";
    }

    protected function model($model)
    {
        require_once "./src/models/" . $model . ".php";
        
        return new $model;
    }

    protected function view($template, $view, $data = [])
    {
        $host_name = $this->host_name;
        $api_uc002 = $this->api_uc002;
        $uc0131_132 = $this->uc0131_132;
        $api_uc010 = $this->api_uc010;
        $api_uc010_update_history = $this->api_uc010_update_history;
        $api_uc010_summary = $this->api_uc010_summary;

        require_once "./src/views/template/" . $template . ".php";
    }
    protected function getMiddleware($middleware) {
        require_once "./src/middlewares/". $middleware .".php";
        return new $middleware;
    }
}

?>