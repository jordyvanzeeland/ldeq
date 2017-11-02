<?php 

namespace ldeq\api;

Class Twig{

	public $loader;
	public $twig;

    public function __construct(){
    	$this->loader = new \Twig_Loader_Filesystem('views');
    	$this->twig = new \Twig_Environment($this->loader);
    }

	public function View($Template, $ActionKey, $ActionValue){
		return $this->twig->render($Template, array($ActionKey => $ActionValue));
	}

			
}