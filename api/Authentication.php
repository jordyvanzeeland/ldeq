<?php

namespace ldeq\api;

use ldeq\api\Query;
use ldeq\api\Session;
use PDO;

Class Authentication{

	public $username;
	public $password;
	public $username_err;
	public $password_err;

	public function Authenticate(){

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if(empty(trim($_POST["username"]))){
		        $username_err = 'Please enter username.';
		    } else{
		        $username = trim($_POST["username"]);
		    }
    
		    if(empty(trim($_POST['password']))){
		        $password_err = 'Please enter your password.';
		    } else
		        $password = trim($_POST['password']);
		    }

		    if(empty($username_err) && empty($password_err)){
		    	$DbLogin = new Query;
		    	$pdo = $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
		    	$Query = (new Query())->Select('ldeq_users', ['username', 'password'], 'username="' . $_POST["username"] . '"');
		    	$Sql = $pdo->prepare($Query);
		    	$Sql->execute();
		    	$row = $Sql->fetch(PDO::FETCH_ASSOC);

		    		if(password_verify($_POST['password'], $row['password'])){
		    			echo 'Je bent ingelogd';
		    			$Session = new Session();
		    			$Session->Start();
		    			$Session->__Set('username', $username);  
                        
		    		}else{
		    			echo 'Je bent niet ingelogd';
		    		}
	    	}else{
	    		echo 'Er is geen gebruiker gevonden met deze gebruikersnaam';
	    	}
	}
}
