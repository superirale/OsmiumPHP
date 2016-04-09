<?php 
namespace Core;
use \Core\Request;
class Config
{
	
	public function __construct()
	{
		ob_start();
		date_default_timezone_set('Africa/Lagos');
	
		define('DB_HOST', Request::env('DB_HOST'));
		define('DB_USER', Request::env('DB_HOST'));
		define('DB_NAME', Request::env('DB_NAME'));
		define('DB_PASS', Request::env('DB_PASS'));
		define('DB_TYPE', Request::env('DB_DRIVER'));	

		//PATH CONFIG
		define('TEMPLATE', Request::env('TEMPLATE'));
		define('BASE_URL', Request::env('BASE_URL'));
		define('TEMPLATE_PATH', BASE_URL."app/Public/templates/".TEMPLATE.'/');



		define('DS', DIRECTORY_SEPARATOR);
		define('VIEW_DIR', 'app/Views/');
		define('TEMPLATE_DIR', 'app/Public/templates/'.TEMPLATE.'/');

		//MAIL CONFIG
		define('EMAIL_TEMPLATE_PATH', BASE_URL. Request::env('EMAIL_TEMPLATE_PATH'));
		define('EMAIL_SENT_FROM', Request::env('EMAIL_SENT_FROM'));
		define('EMAIL_REPLY_TO', Request::env('EMAIL_REPLY_TO'));
		define('EMAIL_SENDER_NAME', Request::env('EMAIL_SENDER_NAME'));
		define('EMAIL_HOST_NAME', Request::env('EMAIL_HOST_NAME'));
		define('EMAIL_PORT', (int) Request::env('EMAIL_PORT'));
		define('EMAIL_USERNAME', Request::env('EMAIL_USERNAME'));
		define('EMAIL_PASSWORD', Request::env('EMAIL_PASSWORD'));
		define('EMAIL_TIMEOUT', (int) Request::env('EMAIL_TIMEOUT'));
		
	}
}

