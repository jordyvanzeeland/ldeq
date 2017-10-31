<?php

namespace ldeq\api;

use ldeq\api\Query;
use ldeq\api\Session;

Class Authentication{

	public $username;
	public $password;
	public $username_err;
	public $password_err;

	public function Register(){
		$Query = (new Query())->Insert('ldeq_users', ['username', 'password', 'email', 'fullname'], ['ldeq', password_hash('Welkom01', PASSWORD_DEFAULT), 'ldeq@test.nl', 'Ldeq Test']);
		mysql_query($Query);
	}

	public function Authenticate(){

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			
			if(empty(trim($_POST["username"]))){
		        $username_err = 'Please enter username.';
		    } else{
		        $username = trim($_POST["username"]);
		    }
    
		    if(empty(trim($_POST['password']))){
		        $password_err = 'Please enter your password.';
		    } else{
		        $password = trim($_POST['password']);
		    }

		    if(empty($username_err) && empty($password_err)){
		    	$Query = (new Query())->Select('ldeq_users', ['username', 'password'], 'username="' . $_POST["username"] . '"');
		    	$Result = mysql_query($Query);

		    	if(mysql_num_rows($Result) == 1){

		    		$row = mysql_fetch_assoc($Result);

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

	}

}