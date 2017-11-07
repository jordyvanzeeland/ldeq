<?php

use ldeq\api\Query;

$DbLogin = new PDO('mysql:host=localhost;dbname=ldeq;charset=utf8mb4', 'root', '');
$DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
$GetProjects = $DbLogin->Select('ldeq_projects', ['*'], 'ProjectName LIKE "%' . $_POST['Search'] . '%"');
return $GetProjects;

?>