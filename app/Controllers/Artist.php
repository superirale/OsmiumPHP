<?php 
namespace Controllers;
use Core\View as View;
use Core\Request as Request;

class Artist extends \Core\Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function signUp()
	{
		
		if(!empty($_POST)){
			
			$params = array(
						'name' => $_POST['name'],
						'email' => $_POST['email'],
						'phone' => $_POST['phone'],
						'description' => $_POST['description'],
						'city' => $_POST['city']
						);

			$params = $this->gump->sanitize($params);
			
			$is_valid = $this->gump->is_valid($params, [
			    'name' => 'required|min_len,3',
			    'email' => 'required|valid_email',
			    'city' => 'required|min_len,3'
			]);

			if($is_valid === true) {
				$name_arr = explode(" ", $params['name']);

				$MailChimp = new \Drewm\MailChimp('66fecc9b247d36721e703e511cfb5c2e-us11');
				
				$result = $MailChimp->call('lists/subscribe', array(
			                'id'                => '1e0857e385',
			                'email'             => array('email'=> $params['email']),
			                'merge_vars'        => array('FNAME'=> $name_arr[0], 'LNAME'=> $name_arr[1]),
			                'double_optin'      => false,
			                'update_existing'   => true,
			                'replace_interests' => false,
			                'send_welcome'      => false,
			            ));
				// dump($result);exit;
				if($result)
					Request::redirect('notice');
				else
					$this->data['error'][0] = "Cannot make request";
				// if(\Models\Artist::create($params))
				// 	Request::redirect('done');
				// else
				// 	$this->data['error'][0] = "Cannot sign up";
			}
			else{
				$this->data['errors'] = $is_valid;
			}
		}
		View::renderTemplate('header', $this->data);
		View::render('artists/signup', $this->data);
		View::renderTemplate('footer', $this->data);
	}

	public function artistList()
	{
		View::renderTemplate('header', $this->data);
		View::render('artists/list', $this->data);
		View::renderTemplate('footer', $this->data);
	}
}