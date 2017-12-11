<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

use ldeq\model\Project;

Class IndexController{

    public function index(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

    	$getProjects = new Project();
        return $getProjects->getAllProjects();

    }

    public function LiveSearch(){
    	$DbLogin = new Query;
		$DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
		$GetProjects = $DbLogin->Select('ldeq_projects', ['*'], 'ProjectName LIKE "%' . $_POST['Search'] . '%"');
		return $GetProjects;
    }

}