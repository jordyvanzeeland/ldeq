<?php

use ldeq\api\Query;

$DbLogin = new \PDO('mysql:host=localhost;dbname=ldeq;charset=utf8mb4', 'root', '');

if($_POST['Category'] != 0){
	$Query = 'SELECT * FROM ldeq_projects WHERE ProjectCat = ' . $_POST['Category'];
}else{
	$Query = 'SELECT * FROM ldeq_projects';
}

$Results = $DbLogin->prepare($Query);
$Results->execute();

echo json_encode($Results->fetchAll());

?>