<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

use ldeq\models\ProjectModel;

Class ProjectController{

    public function add(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

      return (new ProjectModel())->addProject();

    }

    public function project($id = null){

        return (new ProjectModel())->getProject($id);
    
    }

    public function edit($id = null){

        return (new ProjectModel())->updateProject($id);

    }

    public function Delete($id){

        return (new ProjectModel())->deleteProject($id);

    }

}