<?php 

use ldeq\api\Twig;

Class LoginView{

    function __construct($controller){
        $this->controller = $controller;
    }

    public function index(){
        return (new Twig())->View('Login/Login.html', $this->controller->index());
    }

}

// 