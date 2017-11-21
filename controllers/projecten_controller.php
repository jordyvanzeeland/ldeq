<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

Class ProjectenController{

    public function add(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

        if(isset($_POST['submit'])){

            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $AddProject = $DbLogin->Insert('ldeq_projects', ['ProjectName', 'ProjectUrl', 'ProjectCat'],  [$_POST['projectname'], $_POST['projecturl'], $_POST['projectcat']]);

            return $AddProject;
        }

        

    }

}