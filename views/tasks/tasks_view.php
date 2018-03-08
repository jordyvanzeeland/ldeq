<?php

use ldeq\api\Twig;

Class TasksView{

	function __construct($controller){
        $this->controller = $controller;
    }

    public function index(){
    	$Tasks = $this->controller->index();
        return (new Twig())->View('tasks/tasks.html', array('Tasks' => $Tasks));
    }

}