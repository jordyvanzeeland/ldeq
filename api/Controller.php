<?php

Namespace ldeq\api;

Class TestController{

	public function getPage($url){
		if($_SERVER['REQUEST_URI'] == '/ldeq/'){
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

			    $modelName      = ucfirst($requestedController).'Model';
			    $controllerName = \ucfirst($requestedController).'Controller';
			    $viewName       = \ucfirst($requestedController).'View';

			    $controllerObj  = new $controllerName();
			    $viewObj        = new $viewName( $controllerObj);

			    if ($requestedAction != ''){
			        print $viewObj->$requestedAction($requestedParams);
			    }

			}else{

			    include('views/404.html');
			}
		}
	}
}

Class Controller{

	private $controller;

	public function __construct($url){

		if(!isset($_SESSION['username'])) {
			$this->controller = new LoginController();
		}else{
			switch($url){
				case '/':
				echo 'Home';
					$this->controller = new HomepageController();
				break;
				case explode('/', ltrim($_SERVER['REQUEST_URI'],'/')) :
				echo 'Page';
					$this->controller = new PageController();
				break;
			}
		}
	}

	public function showController($controller){
		return $this->controller->Controller($controller);
	}
}

interface ControllerInterface{
	public function Controller($Controller);
}

Class LoginController{

	public function Controller($Controller){
		require_once __DIR__.'/../models/Login_model.php';
		require_once __DIR__.'/../controllers/login_controller.php';
		require_once __DIR__.'/../views/login/login_view.php';

		$LoginModel = New \LoginModel();
		$LoginController = New \LoginController($LoginModel);
		$LoginView = New \LoginView($LoginController, $LoginModel);

		print $LoginView->index();
	}

}

Class HomepageController{

	public function Controller($Controller){
		require_once '/ldeq/models/index_model.php';
		require_once '/ldeq//controllers/index_controller.php';
		require_once '/ldeq/views/index/index_view.php';

		$indexModel = New \IndexModel();
		$indexController = New \IndexController($indexModel);
		$indexView = New \IndexView($indexController, $indexModel);

		print $indexView->index();
	}

}

Class PageController{

	public function Controller($url){
		$requestedController = $url[1]; 
		$requestedAction = isset($url[2])? $url[2] :'';
		$requestedParams = array_slice($url, 2); 
		$ctrlPath = __DIR__.'/../controllers/'.$requestedController.'_controller.php';

		if (file_exists($ctrlPath)){	
		    require_once __DIR__.'/../models/'.ucfirst($requestedController).'_model.php';
		    require_once __DIR__.'/../controllers/'.$requestedController.'_controller.php';
		    require_once __DIR__.'/../views/'.$requestedController.'/'.$requestedController.'_view.php';

		    $modelName      = ucfirst($requestedController).'Model';
		    $controllerName = ucfirst($requestedController).'Controller';
		    $viewName       = ucfirst($requestedController).'View';

		    $controllerObj  = new $controllerName();
		    $viewObj        = new $viewName( $controllerObj);

		    if ($requestedAction != ''){
		        print $viewObj->$requestedAction($requestedParams);
		    }

		}else{

		    include('views/404.html');
		}
	}

}