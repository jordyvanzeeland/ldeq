<?php session_start();

require_once __DIR__ . '/vendor/autoload.php';

use ldeq\api\Session;

include('views/header.php');

$Session = new Session();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

if($url == '/'){

	if(!$Session->__get('username')){
    		header('Location: /ldeq/login/index');
    }else{	
		require_once __DIR__.'/Models/index_model.php';
		require_once __DIR__.'/Controllers/index_controller.php';
		require_once __DIR__.'/Views/Index/index_view.php';

		$indexModel = New IndexModel();
		$indexController = New IndexController($indexModel);
		$indexView = New IndexView($indexController, $indexModel);

		print $indexView->index();
	}
}else{
	$requestedController = $url[0]; 
	$requestedAction = isset($url[1])? $url[1] :'';
	$requestedParams = array_slice($url, 2); 
	$ctrlPath = __DIR__.'/Controllers/'.$requestedController.'_controller.php';

	if (file_exists($ctrlPath)){

	    require_once __DIR__.'/Models/'.$requestedController.'.php';
	    require_once __DIR__.'/Controllers/'.$requestedController.'_controller.php';
	    require_once __DIR__.'/Views/'.$requestedController.'/'.$requestedController.'_view.php';

	    $modelName      = ucfirst($requestedController);
	    $controllerName = ucfirst($requestedController).'Controller';
	    $viewName       = ucfirst($requestedController).'View';

	    $controllerObj  = new $controllerName( new $modelName );
	    $viewObj        = new $viewName( $controllerObj, new $modelName );


	    // If there is a method - Second parameter
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