<?php

namespace ldeq\api;

use ldeq\api\Query;

Class Authentication{

	public $username;
	public $password;
	public $username_err;
	public $password_err;

	public function AuthenticationForm(){

	}

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
		    	$Query = (new ldeq\api\Query())->Select('ldeq_users', ['username', 'password'], 'username=' . $_POST["username"]);
		    	$Result = mysql_query($Query);

		    	if(mysql_num_rows($Result) == 1){

		    		$row = mysql_fetch_assoc($Result);

		    		if(password_verify($_POST['password'], $row['password'])){
		    			session_start();
                        $_SESSION['username'] = $username;      
                        header("location: welcome.php");
		    		}
		    	}
		    }
		}

	}

}