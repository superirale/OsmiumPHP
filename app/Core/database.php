<?php 
namespace Core;
use Illuminate\Database\Capsule\Manager as Capsule;
class Database 
{
	
	function __construct()
	{
		$capsule = new Capsule;

        $capsule->addConnection(array(
                'driver'    => 'mysql',
                'host'      => DB_HOST,
                'database'  => DB_NAME,
                'username'  => DB_USER,
                'password'  => DB_PASS,
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => ''
        ));

        $capsule->bootEloquent();
	}	
}