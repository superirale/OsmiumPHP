<?php 
use \Core\Router as Router;
use \Core\Config as Config;
use \Core\Database as Database;

define('DEVELOPMENT_ENVIRONMENT', true);

if(file_exists(__DIR__.'vendor/autoload.php')) {
	require_once __DIR__.'vendor/autoload.php';
}


$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// initialise configuration class
new Config();
//initialize db config
new Database();

if(DEVELOPMENT_ENVIRONMENT == true) {
	ini_set('display_errors',1);
}
else{
	ini_set('display_errors',0);
}
//Define Routes
$router = new Router();
include('routes.php');
$router->run();