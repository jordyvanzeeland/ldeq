<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

use ldeq\models\ProjectModel;

Class IndexController{

    public function index(){

    	$getProjects = new ProjectModel();
        return $getProjects->getAllProjects();

    }

}