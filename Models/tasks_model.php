<?php

namespace ldeq\models;

use ldeq\api\Query;

Class TasksModel{

	public function getAllTasks(){
		$GetTasks = (new Query)->Select('ldeq_tasks', ['*']);
		return $GetTasks;
	}

	public function getTask($id = null){
		if(!empty($id)){
            $Task = (new Query)->select('ldeq_tasks', ['*'], 'id=' . $id[1]);
            $TaskHours = (new Query())->select('ldeq_hours', ['*'], 'task_id=' . $id[1]);
            return array($Task, $TaskHours);
        }
	}

	public function addTask(){
		if(isset($_POST['submit'])){

            $AddProject = (new Query)->Insert(
                'ldeq_tasks', 
                    ['task_name', 'task_description', 'task_dateCreated', 'task_dateUpdated'], 
                    [$_POST['taskname'], $_POST['taskdescription'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s')]
            );

            header('Location: /ldeq/tasks/');

            return $AddProject;
        }
	}

	public function updateTask($id = null){
		if(!empty($id)){
            if(isset($_POST['submit'])){

                $Task = (new Query)->Update(
                    'ldeq_tasks', 
                    ['task_name', 'task_description', 'task_dateUpdated'], 
                    [$_POST['taskname'], $_POST['taskdescription'], date('Y-m-d H:i:s')],
                    'id = ' . $id[1]
                );

                header('Location: /ldeq/tasks/details/' . $id[1]);

                return $Task;
            }
      	}
	}

	public function deleteTask($id = null){
		if(!empty($id)){
            $Delete = (new Query)->Delete('ldeq_tasks', $id[1]);
            header('Location: /ldeq/tasks');

            return $Delete;
        }
	}

	public function getTaskHours($id = null){
		if(!empty($id)){
            $Hours = (new Query)->select('ldeq_hours', ['*'], 'task_id=' . $id[1]);
            return $Hours;
        }
	}

	public function addHours($task_id = null){
		if(isset($_POST['submit'])){

            $AddHours = (new Query())->Insert(
                'ldeq_hours', 
                    ['task_id', 'task_hours', 'hours_description', 'hours_dateCreated'], 
                    [$task_id[1], $_POST['hours'], $_POST['hoursdescription'], date('Y-m-d H:i:s')]
            );

            header('Location: /ldeq/tasks/details/' . $task_id[1]);

            return $AddHours;
        }
	}

	public function deleteHours($id = null, $task_id = null){
		if(!empty($id)){
            $Delete = (new Query())->Delete('ldeq_hours', $id[1]);
            header('Location: /ldeq/tasks/');

            return $Delete;
        }
	}

}