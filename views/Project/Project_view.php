<?php 

use ldeq\api\Twig;

Class ProjectView{

    function __construct($controller){
        $this->controller = $controller;
    }

    public function add(){
    	$Projecten = $this->controller->add();
        return (new Twig())->View('project/add.html', array('Project' => $Projecten));
    }

    public function details($id){
    	$Project = $this->controller->project($id);
    	return (new Twig())->View('project/project.html', array('Project' => $Project));
    }

    public function edit($id){
    	$GetProject = $this->controller->project($id);
    	return (new Twig())->View('project/edit.html', array('Project' => $GetProject, $this->controller->edit($id)));
    }

    public function delete($id){
    	return (new Twig())->View('project/delete.html', array('Project' => $this->controller->delete($id)));
    }

}

// 