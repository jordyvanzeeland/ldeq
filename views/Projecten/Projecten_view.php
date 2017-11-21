<?php 

use ldeq\api\Twig;

Class ProjectenView{

    function __construct($controller, $model){
        $this->controller = $controller;
        $this->model = $model;
    }

    public function add(){
    	$Projecten = $this->controller->add();
        return (new Twig())->View('Projecten/Add.html', array('Projecten' => $Projecten));
    }

}

// 