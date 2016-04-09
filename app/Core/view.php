<?php 
namespace Core;

class View 
{
	
	public static function render($path, $data = array())
	{
		$loader = new \Twig_Loader_Filesystem(VIEW_DIR);	
		$twig 	= new \Twig_Environment($loader);

		echo $twig->render("$path.html", $data);
	}

	public static function renderTemplate($path, $data = array()){
		
		$loader = new \Twig_Loader_Filesystem(TEMPLATE_DIR);	
		$twig = new \Twig_Environment($loader);

		echo $twig->render("$path.html", $data);
	}

	public static function renderJson($data = array())
	{
		header('Content-Type: application/json');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();
	}
}