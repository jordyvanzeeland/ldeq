<?php

Class ProjectenModel{

	public function index(){

		if($Session->__Get('username')){
			echo 'Index';
		}

	}

}