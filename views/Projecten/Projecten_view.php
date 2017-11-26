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

    public function project($id){
    	$Project = $this->controller->project($id);
    	return (new Twig())->View('Projecten/Project.html', array('Project' => $Project));
    }

    public function edit($id){
    	$Project = $this->controller->edit($id);
    	return (new Twig())->View('Projecten/Edit.html', array('Project' => $Project));
    }

}

// 