<?php 

use ldeq\api\Twig;

Class IndexView{

    function __construct($controller, $model){
        $this->controller = $controller;
        $this->model = $model;
    }

    public function index(){
    	$Projects = $this->controller->index();
        return (new Twig())->View('index/index.html', array('Projects' => $Projects));
    }

}

// 