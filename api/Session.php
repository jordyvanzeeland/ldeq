<?php

namespace ldeq\api;

Class Session{

	protected static $Init = false;
    
    public function Start() {
        self::$Init = session_start();
    }

	public function __Set($Key, $Value){
		if($_SESSION){
			$_SESSION[$Key] = $Value;
		}
	}

	public function __Get($Key){
		if($_SESSION){
			return $_SESSION[$Key];
		}
	}

	public function __Unset( $Key ) {
		if($_SESSION){
        	unset( $_SESSION[$Key] );
    	}
    }

    public function __isset( $Key ) {
        return array_key_exists( $Key, $_SESSION );
    }

    public function Destroy(){
        return session_destroy();
    }

}