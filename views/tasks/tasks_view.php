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

    public function add(){
    	$Tasks = $this->controller->add();
        return (new Twig())->View('tasks/add.html', array('Tasks' => $Tasks));
    }

    public function details($id){
    	$Task = $this->controller->task($id);
    	return (new Twig())->View('tasks/details.html', array('Tasks' => $Task[0], 'Hours' => $Task[1]));
    }

    public function edit($id){
    	$Task = $this->controller->task($id);
    	return (new Twig())->View('tasks/edit.html', array('Task' => $Task[0], $this->controller->edit($id)));
    }

    public function delete($id){
    	return (new Twig())->View('tasks/delete.html', array('Tasks' => $this->controller->delete($id)));
    }

}