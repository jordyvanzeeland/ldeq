<?php

use ldeq\api\Session;
use ldeq\api\Query;
use ldeq\api\Twig;

Class ProjectenController{

    public function add(){

    	$Session = new Session();

    	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    	}

        if(isset($_POST['submit'])){

            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $AddProject = $DbLogin->Insert(
                'ldeq_projects', 
                ['ProjectName', 'ProjectUrl', 'FtpHost', 'FtpUser', 'FtpPass', 'DbHost', 'DbUser', 'DbPass', 'WpUser', 'WpPass'],  
                [$_POST['projectname'], $_POST['projecturl'], $_POST['ftphost'], $_POST['ftpuser'], $_POST['ftppass'], $_POST['dbhost'], $_POST['dbuser'], $_POST['dbpass'], $_POST['wpuser'], $_POST['wppass']]
            );

            header('Location: /ldeq/');

            return $AddProject;
        }

    }

    public function project($id = null){
        if(!empty($id)){
            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $Project = $DbLogin->select('ldeq_projects', ['*'], 'id=' . $id[0]);

            return $Project;
        }
    }

    public function edit($id = null){
        if(!empty($id)){
            if(isset($_POST['submit'])){
                $DbLogin = new Query;
                $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
                $Project = $DbLogin->Update(
                    'ldeq_projects', 
                    ['ProjectName', 'ProjectUrl', 'FtpHost', 'FtpUser', 'FtpPass', 'DbHost', 'DbUser', 'DbPass', 'WpUser', 'WpPass'], 
                    [$_POST['projectname'],$_POST['projecturl'],$_POST['ftphost'],$_POST['ftpuser'],$_POST['ftppass'],$_POST['dbhost'],$_POST['dbuser'],$_POST['dbpass'],$_POST['wpuser'],$_POST['wppass']],
                    'id = ' . $id[0]
                );

                header('Location: /ldeq/projecten/project/' . $id[0]);

                return $Project;
            }
        }
    }

    public function Delete($id){
        if(!empty($id)){
            $DbLogin = new Query;
            $DbLogin->Connect($DbLogin->DbHost, $DbLogin->DbUser, $DbLogin->DbPass, $DbLogin->DbName);
            $Delete = $DbLogin->Delete('ldeq_projects', $id[0]);

            header('Location: /ldeq/');

            return $Delete;
        }
    }

}