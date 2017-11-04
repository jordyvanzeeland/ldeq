<?php 

use ldeq\api\Twig;

Class IndexView{

    function __construct($controller, $model){
        $this->controller = $controller;
        $this->model = $model;
    }

    public function index(){
        return (new Twig())->View('Index.html', 'action', $this->controller->index());
    }

}

// 