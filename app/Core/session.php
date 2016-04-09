<?php 
namespace Core;

class Session
{
	private static $sessionStarted = false;

	public static function init()
	{
		if(self::$sessionStarted === false){ 
			session_start();
			self::$sessionStarted = true;
		}
	}

	public static function set($vals)
	{
		self::init();
		
		foreach ($vals as $key => $value) 
		{
			$_SESSION[$key] = $value;
		}

	}

	public static function get($key = false){

		self::init();

		if($key != false && !empty($_SESSION[$key])){

			return $_SESSION[$key];
		}
	}

	public static function pull($key)
	{

		self::init();

		if(!empty($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
	
	}

	public static function display($key = null)
	{

		self::init();

		if (!empty($_SESSION[$key])){
			return $_SESSION[$key];
		}
		else{
			return $_SESSION;
		}
	}

	public static function destroy($key = false)
	{

		self::init();

		if(!empty($_SESSION[$key])){
			unset($_SESSION[$key]);
		}
		else{
			session_unset();
         	session_destroy();
		}

	}

	public  static function setFlash($key, $value)
    {
        self::init();

        $_SESSION[$key] = $value;
    }

    public static function displayFlash($key)
    {
        self::init();

        if(!empty($_SESSION[$key])){
            $this->message = $_SESSION[$key];
            unset($_SESSION[$key]);
        }

        return $this->message;
    }

    public static function hasFlash($key)
    {
        self::init();

        if(!empty($_SESSION[$key]))
            return true;
        else
            return false;
    }
}

 ?>