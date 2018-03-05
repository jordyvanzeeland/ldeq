<?php 

namespace ldeq\api;

use PDO;

interface QueryInterface{
    public function Connect();
    public function Select($Table, $Columns = [], $Where = null);
    public function Insert($Table, $Columns = null, $Values = []);
    public function Update($Table, $Columns = [], $Values = [], $where);
    public function Delete($Table, $Id);
}

Class Query implements QueryInterface{

	public function Connect(){

		global $db_config;
	    if ($db_config['env'] == "development") {
	      $config = $db_config['development'];
	    }else{
	      $config = $db_config['production'];
	    }
	    $pdo = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'] . ';charset=utf8mb4', $config['username'], $config['password']);
	    return $pdo;

	}

	public function Select($Table, $Columns = [], $Where = null){
		
		$pdo = $this->Connect();
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

		$pdo = $this->Connect();
		
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

	public function Update($Table, $Columns = [], $Values = [], $where){
		
		$pdo = $this->Connect();

		$Query = '';  
		$condition = ''; 
		$i = 0; 
		foreach($Values as $key => $Value){  
		    $Query .= $Columns[$i] . "='".$Value."', ";  
		    $i++;
		}  
		$Query = substr($Query, 0, -2);  

		$Query = "UPDATE ".$Table." SET ".$Query." WHERE ".$where."";  
		
		$Results = $pdo->prepare($Query);
		$Results->execute();
		$Row = $Results->fetchAll();

		return $Row;


	} 

	public function Delete($Table, $Id){

		$pdo = $this->Connect();
		$Query = 'Delete FROM ' . $Table . ' WHERE id = ' . $Id;  

		$Results = $pdo->prepare($Query);
		$Results->execute();
		$Row = $Results->fetchAll();

		return $Row;

	}

}