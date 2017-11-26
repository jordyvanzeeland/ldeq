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
    	$GetProject = $this->controller->project($id);
    	return (new Twig())->View('Projecten/Edit.html', array('Project' => $GetProject, $this->controller->edit($id)));
    }

    public function delete($id){
    	return (new Twig())->View('Projecten/Delete.html', array('Project' => $this->controller->delete($id)));
    }

}

// 