<?php

use ldeq\api\Authentication;

Class LoginController{

    public function index(){
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            return (new Authentication())->Authenticate();
        }

    }

}