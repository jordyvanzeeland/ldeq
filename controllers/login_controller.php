<?php

use ldeq\api\Authentication;

Class LoginController{

    public function index(){

    	$array = [];
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            echo (new Authentication())->Authenticate();
        }else{
        	return $array;
        }
    }

}