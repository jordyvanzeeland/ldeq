<?php

namespace ldeq\api;

Class Session{

	protected static $init = false;
    
    public function __set( $key, $value ) {
        $_SESSION[$key] = $value;
    }
    
    public function __get( $key ) {
        return $_SESSION[$key];
    }
    
    public function __isset( $key ) {
        return array_key_exists( $key, $_SESSION );
    }
    
    public function __unset( $key ) {
        unset( $_SESSION[$key] );
    }
    
    public function __toString() {
        return print_r( $_SESSION , true); 
    }
    
    public function destroy(){
        return session_destroy();
    }

}