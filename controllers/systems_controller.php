<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

use ldeq\models\SystemsModel;

Class SystemsController{

    public function index(){

        return (new SystemsModel())->getAllSystems();

    }

    public function add(){

      return (new SystemsModel())->addSystem();

    }

    public function project($id = null){

        return (new SystemsModel())->getSystem($id);
    
    }

    public function edit($id = null){

        return (new SystemsModel())->updateSystem($id);

    }

    public function Delete($id){

        return (new SystemsModel())->deleteSystem($id);

    }

}