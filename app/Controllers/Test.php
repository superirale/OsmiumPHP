<?php 
namespace Controllers;
use Core\View as View;
use Core\Request as Request;

class Test extends \Core\Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'here';exit;
	}

}