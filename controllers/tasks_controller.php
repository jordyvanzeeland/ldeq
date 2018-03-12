<?php

use ldeq\models\TasksModel;

Class TasksController{

	public function index(){

		return (new TasksModel())->getAllTasks();

	}

	public function add(){

      return (new TasksModel())->addTask();

    }

    public function task($id = null){

        return (new TasksModel())->getTask($id);
    
    }

    public function edit($id = null){

        return (new TasksModel())->updateTask($id);

    }

    public function Delete($id){

        return (new TasksModel())->deleteTask($id);

    }

}