<?php
namespace ldeq;

use ldeq\api\Query;
use ldeq\api\Authentication;
use ldeq\api\Session;

require_once __DIR__ . '/vendor/autoload.php';

$Session = new Session();

if(!$Session->__Get('username')){
	echo 'Geen sessie';
}else{
	echo 'sessie';
}

require_once('views/header.php');

require_once('views/footer.php');




