<?php 

	$DbHost = 'localhost:3306';
	$DbUser = 'ldeq_pws';
	$DbPass = 'hEqa88?3';
	$DbName = 'ldeq_pws';
	$pdo = new PDO('mysql:host=' . $DbHost . ';dbname=' . $DbName . ';charset=utf8mb4', $DbUser, $DbPass);
	$Query = "UPDATE ldeq_users SET password=". password_hash('X!n!x123', PASSWORD_DEFAULT) ." WHERE id=3";  
		
	$Results = $pdo->prepare($Query);
	$Results->execute();
?>