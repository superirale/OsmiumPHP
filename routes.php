<?php
$router->get('/', array(new \Controllers\Home, 'index'));
$router->post('/', array(new \Controllers\Home, 'index'));

$router->get('/signup', array(new \Controllers\Artist, 'signUp'));
$router->post('/signup', array(new \Controllers\Artist, 'signUp'));

$router->get('/artists/list', array(new \Controllers\Artist, 'artistList'));
$router->get('/notice', array(new \Controllers\Home, 'notice'));

$router->get('/test', function (){
	$MailChimp = new \Drewm\MailChimp('66fecc9b247d36721e703e511cfb5c2e-us11');
	// print_r($MailChimp->call('lists/list'));
	$result = $MailChimp->call('lists/subscribe', array(
                'id'                => '2936996752',
                'email'             => array('email'=>'davy@usman.com.ng'),
                'merge_vars'        => array('FNAME'=>'Davy', 'LNAME'=>'Jones'),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));
			print_r($result);
});
