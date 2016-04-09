<?php 
namespace Core;

class Request
{
	
	public static function all()
	{
		$gump = new \GUMP();
		$inputs = array();
		$input['key'] = $gump->sanitize($_REQUEST);
	
		if(!empty($input))
			return $input;
		else
			return null;
	}

	public static function get($key)
	{
		if($_REQUEST[$key] && !empty($_REQUEST[$key]))
		{
			$gump = new \GUMP();
			$gump->sanitize($_REQUEST);
			return $_REQUEST[$key];
		}
	}

	public static function set($key, $value)
	{
		$_REQUEST[$key] = $value;
	}

	public static function env($key, $value = '')
	{
		if(!empty($value))
		{
			putenv("$key=$value");
		}
		return getenv("$key");
	}

	public function redirect($url, $permanent = false)
	{
		if($permanent)
		{
			header('HTTP/1.1 301 Moved Permanently');
		}
		header('Location: '.$url);
		exit();
	}

}

 ?>