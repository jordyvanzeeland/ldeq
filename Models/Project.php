<?php

use ldeq\api\Query;

Class Project{

	public function getAllProjects(){

		$DbLogin = new Query;
		$DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
		$GetProjects = $DbLogin->Select('ldeq_projects', ['*']);

		return $GetProjects;

	}

}