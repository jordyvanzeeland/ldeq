<?php

use ldeq\api\Session;

Class IndexController{

    public function index(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

    }

}