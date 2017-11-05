<?php 

namespace ldeq\api;

Class Twig{

	public $loader;
	public $twig;

    public function __construct(){
    	$this->loader = new \Twig_Loader_Filesystem('views');
    	$this->twig = new \Twig_Environment($this->loader, array(
    		'debug' => true,
    	));
    	$this->twig->addExtension(new \Twig_Extension_Debug());
    }

	public function View($Template, $Action){
		//$Data = implode(", ", $Action);
		return $this->twig->render($Template, $Action);
	}

			
}