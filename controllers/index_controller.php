<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

use ldeq\models\ProjectModel;

Class IndexController{

    public function index(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

    	$getProjects = new ProjectModel();
        return $getProjects->getAllProjects();

    }

}