<?php 

namespace ldeq\api;

use PDO;

Class Query{

	public $DbHost;
	public $DbUser;
	public $DbPass;
	public $DbName;

	public function __construct(){
		$this->DbHost = 'localhost';
		$this->DbUser = 'root';
		$this->DbPass = '';
		$this->DbName = 'ldeq';
	}

	public function Connect($DbHost, $DbUser, $DbPass, $DbName){

		$pdo = new PDO('mysql:host=' . $DbHost . ';dbname=' . $DbName . ';charset=utf8mb4', $DbUser, $DbPass);

		return $pdo;

	}

	public function Select($Table, $Columns = [], $Where = null){
		
		$pdo = $this->Connect($this->DbHost, $this->DbUser, $this->DbPass, $this->DbName);
		$Columns = implode(", ", $Columns);

		if($Where){
			$Query = 'SELECT ' . $Columns . ' FROM ' . $Table . ' WHERE ' . $Where;
		}else{
			$Query = 'SELECT ' . $Columns . ' FROM ' . $Table;
		}

		$Results = $pdo->prepare($Query);
		$Results->execute();
		$Row = $Results->fetchAll();

		return $Row;

	}

	public function Insert($Table, $Columns = null, $Values = []){

		$pdo = $this->Connect($this->DbHost, $this->DbUser, $this->DbPass, $this->DbName);
		
		if($Columns){
			$Columns = implode(", ", $Columns);
		}

		$Values = "'" . implode ( "', '", $Values ) . "'";

		if($Columns){
			$Query = 'INSERT INTO ' . $Table . ' (' . $Columns . ') VALUES (' . $Values . ')';
		}else{
			$Query = 'INSERT INTO ' . $Table . ' VALUES (' . $Values . ')';
		}
		
		$Results = $pdo->prepare($Query);
		$Results->execute();
		$Row = $Results->fetchAll();

		return $Row;

	}

}