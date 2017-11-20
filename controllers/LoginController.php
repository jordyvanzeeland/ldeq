<?php

namespace ldeq\api;

use ldeq\api\Authentication;

Class LoginController{

    // public function index(){
        
    //     return (new Authentication())->Authenticate();

    // }

    private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function sayWelcome()
        {
            return $this->model->welcomeMessage();
        }

}