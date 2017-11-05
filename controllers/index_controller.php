<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

Class IndexController{

    public function index(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

    	$DbLogin = new Query;
		$DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
		$GetProjects = $DbLogin->Select('ldeq_projects', ['*']);

		return $GetProjects;

    }

}