<?php 

use ldeq\api\Twig;

Class ProjectView{

    function __construct($controller){
        $this->controller = $controller;
    }

    public function add(){
    	$Projecten = $this->controller->add();
        return (new Twig())->View('Project/Add.html', array('Project' => $Projecten));
    }

    public function details($id){
    	$Project = $this->controller->project($id);
    	return (new Twig())->View('Project/Project.html', array('Project' => $Project));
    }

    public function edit($id){
    	$GetProject = $this->controller->project($id);
    	return (new Twig())->View('Project/Edit.html', array('Project' => $GetProject, $this->controller->edit($id)));
    }

    public function delete($id){
    	return (new Twig())->View('Project/Delete.html', array('Project' => $this->controller->delete($id)));
    }

}

// 