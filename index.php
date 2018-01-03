<?php

namespace ldeq;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use ldeq\api\Session;
use ldeq\models\ProjectModel;

include('views/header.php');

$Session = new Session();

if(!isset($_SESSION['username'])) {
	require_once __DIR__.'/models/Login_model.php';
	require_once __DIR__.'/controllers/login_controller.php';
	require_once __DIR__.'/views/login/login_view.php';

	$LoginModel = New \LoginModel();
	$LoginController = New \LoginController($LoginModel);
	$LoginView = New \LoginView($LoginController, $LoginModel);

	print $LoginView->index();
}

$url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'],'/')) : '/';

if($_SERVER['REQUEST_URI'] == '/wachtwoorden/'){

		require_once __DIR__.'/models/index_model.php';
		require_once __DIR__.'/controllers/index_controller.php';
		require_once __DIR__.'/views/index/index_view.php';

		$indexModel = New \IndexModel();
		$indexController = New \IndexController($indexModel);
		$indexView = New \IndexView($indexController, $indexModel);

		print $indexView->index();
}else{
	$requestedController = $url[1]; 
	$requestedAction = isset($url[2])? $url[2] :'';
	$requestedParams = array_slice($url, 2); 
	$ctrlPath = __DIR__.'/controllers/'.$requestedController.'_controller.php';

	if (file_exists($ctrlPath)){	

	    require_once __DIR__.'/models/'.ucfirst($requestedController).'_model.php';
	    require_once __DIR__.'/controllers/'.$requestedController.'_controller.php';
	    require_once __DIR__.'/views/'.$requestedController.'/'.$requestedController.'_view.php';

	 //    $ProjectModel = New ProjectModel();
		// $ProjectController = New \ProjectController($ProjectModel);
		// $ProjectView = New \ProjectView($ProjectController, $ProjectModel);

		// print $ProjectView->details();

	    $modelName      = ucfirst($requestedController).'Model';
	    $controllerName = \ucfirst($requestedController).'Controller';
	    $viewName       = \ucfirst($requestedController).'View';

	    $controllerObj  = new $controllerName();
	    $viewObj        = new $viewName( $controllerObj);

	    if ($requestedAction != ''){
	        // then we call the method via the view
	        // dynamic call of the view
	        print $viewObj->$requestedAction($requestedParams);

	    }

	}else{

	    include('views/404.html');
	}
}

include('views/footer.php');