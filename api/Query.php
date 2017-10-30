<?php 

namespace ldeq\api;

Class Query{

	private $DbHost;
	private $DbUser;
	private $DbPass;
	private $DbName;

	public function __construct(){
		$this->DbHost = 'localhost';
		$this->DbUser = 'root';
		$this->DbPass = '';
		$this->DbName = 'ldeq';
	}

	public function Connect($DbHost, $DbUser, $DbPass, $DbName){

		mysql_connect($DbHost, $DbUser, $DbPass) or die('Can\'t connect to database');
		mysql_select_db($DbName);

	}

	public function Select($Table, $Columns = [], $Where){
		
		$this->Connect($this->DbHost, $this->DbUser, $this->DbPass, $this->DbName);
		$Columns = implode(", ", $Columns);

		if($Where){
			$Query = 'SELECT ' . $Columns . ' FROM ' . $Table . ' WHERE ' . $Where;
		}else{
			$Query = 'SELECT ' . $Columns . ' FROM ' . $Table;
		}

		return $Query;

	}

	public function Insert($Table, $Columns = null, $Values){

		$this->Connect($this->DbHost, $this->DbUser, $this->DbPass, $this->DbName);
		
		if($Columns){
			$Columns = implode(", ", $Columns);
		}
		
		$Values = "'" . implode ( "', '", $Values ) . "'";

		if($Columns){
			$Query = 'INSERT INTO ' . $Table . ' (' . $Columns . ') VALUES (' . $Values . ')';
		}else{
			$Query = 'INSERT INTO ' . $Table . ' VALUES (' . $Values . ')';
		}
		
		return $Query;

	}

}