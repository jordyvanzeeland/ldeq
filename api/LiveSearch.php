<?php

use ldeq\api\Query;

Class LiveSearch{

	public $DbLogin;

	public function __construct(){
		$this->DbLogin = new \PDO('mysql:host=localhost;dbname=ldeq;charset=utf8mb4', 'root', '');
	}

	public function Search($Table, $ColumnName, $Search){

		if($_POST['Search'] != ''){
			$Query = 'SELECT * FROM ' . $Table . ' WHERE '. $ColumnName .' LIKE "%' . $_POST['Search'] . '%"';
		}else{
			$Query = 'SELECT * FROM ' . $Table;
		}

		$Results = $DbLogin->prepare($Query);
		$Results->execute();

		echo json_encode($Results->fetchAll());
	}

}