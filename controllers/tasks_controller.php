<?php

use ldeq\models\TasksModel;

Class TasksController{

	public function index(){

		return (new TasksModel())->getAllTasks();

	}

}