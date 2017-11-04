<?php

Class IndexModel{

	public function index(){

		if($Session->__Get('username')){
			echo 'Index';
		}

	}

}