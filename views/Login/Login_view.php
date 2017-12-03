<?php 

use ldeq\api\Twig;

Class LoginView{

    function __construct($controller, $model){
        $this->controller = $controller;
        $this->model = $model;
    }

    public function index(){
        return (new Twig())->View('Login/Login.html', $this->controller->index());
    }

}

// 