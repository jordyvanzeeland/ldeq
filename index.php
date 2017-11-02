<?php session_start();

require_once __DIR__ . '/vendor/autoload.php';

use ldeq\api\Session;

include('views/header.php');

$Session = new Session();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';
// var_dump($url);

if(!$Session->__Get('username')){
	header('/ldeq/login/index');
}else{
	echo 'sessie';
}

$requestedController = $url[0]; 
$requestedAction = isset($url[1])? $url[1] :'';
$requestedParams = array_slice($url, 2); 
$ctrlPath = __DIR__.'/Controllers/'.$requestedController.'_controller.php';

if (file_exists($ctrlPath)){

    require_once __DIR__.'/Models/'.$requestedController.'_model.php';
    require_once __DIR__.'/Controllers/'.$requestedController.'_controller.php';
    require_once __DIR__.'/Views/'.$requestedController.'_view.php';

    $modelName      = ucfirst($requestedController).'Model';
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

    header('HTTP/1.1 404 Not Found');
    die('404 - The file - '.$ctrlPath.' - not found');
    //require the 404 controller and initiate it
    //Display its view
}

include('views/footer.php');