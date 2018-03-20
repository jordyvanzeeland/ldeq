<?php 

use ldeq\api\Twig;

Class SystemsView{

    function __construct($controller){
        $this->controller = $controller;
    }

    public function index(){
        $Systems = $this->controller->index();
        return (new Twig())->View('systems/systems.html', array('Systems' => $Systems));
    }

    public function add(){
    	$System = $this->controller->add();
        return (new Twig())->View('systems/add.html', array('System' => $System));
    }

    public function details($id){
    	$System = $this->controller->system($id);
        return (new Twig())->View('systems/system.html', array('System' => $System));
    }

    public function edit($id){
    	$GetSystem = $this->controller->edit($id);
    	return (new Twig())->View('systems/edit.html', array('System' => $GetSystem, $this->controller->edit($id)));
    }

    public function delete($id){
    	return (new Twig())->View('systems/delete.html', array('System' => $this->controller->delete($id)));
    }

}

// 