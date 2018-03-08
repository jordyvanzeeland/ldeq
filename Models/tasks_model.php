<?php

namespace ldeq\models;

use ldeq\api\Query;

Class TasksModel{

	public function getAllTasks(){
		$GetTasks = (new Query)->Select('ldeq_tasks', ['*']);
		return $GetTasks;
	}

}