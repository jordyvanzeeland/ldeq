<?php

use ldeq\api\Query;

$DbLogin = new \PDO('mysql:host=localhost;dbname=ldeq;charset=utf8mb4', 'root', '');

if($_POST['Search'] != ''){
	$Query = 'SELECT * FROM ldeq_projects WHERE ProjectName LIKE "%' . $_POST['Search'] . '%"';
}else{
	$Query = 'SELECT * FROM ldeq_projects WHERE ProjectName';
}

$Results = $DbLogin->prepare($Query);
$Results->execute();

echo json_encode($Results->fetchAll());

?>