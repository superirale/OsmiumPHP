<?php 
namespace Controllers;
use Core\View as View;
use Core\Request as Request;

class Home extends \Core\Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(!empty($_POST)){
			
			$params = array(
						'name' => $_POST['name'],
						'email' => $_POST['email'],
						'phone' => $_POST['phone'],
						'service_type_id' => $_POST['service_type_id'],
						'no_clients' => $_POST['no_clients'],
						'city' => $_POST['city']
						);

			$params = $this->gump->sanitize($params);

			$is_valid = $this->gump->is_valid($params, [
			    'name' => 'required|min_len,3',
			    'email' => 'required|valid_email',
			    'service_type_id' => 'required|numeric|min_len,1',
			    'no_clients' => 'required|numeric|min_len,1',
			    'city' => 'required|alpha|min_len,3',
			]);

			if($is_valid === true) {
				$name_arr = explode(" ", $params['name']);

				$MailChimp = new \Drewm\MailChimp('66fecc9b247d36721e703e511cfb5c2e-us11');
				
				$result = $MailChimp->call('lists/subscribe', array(
			                'id'                => '2936996752',
			                'email'             => array('email'=> $params['email']),
			                'merge_vars'        => array('FNAME'=> $name_arr[0], 'LNAME'=> $name_arr[1]),
			                'double_optin'      => false,
			                'update_existing'   => true,
			                'replace_interests' => false,
			                'send_welcome'      => false,
			            ));
				
				if($result)
					Request::redirect('notice');
				else
					$this->data['error'][0] = "Cannot make request";

				// if(\Models\Request::create($params))
				// 	Request::redirect('done');
				// else
				// 	$this->data['error'][0] = "Cannot make request";
			}
			else{
				$this->data['errors'] = $is_valid;
				// dump($this->data);
			}
		}
		View::renderTemplate('header', $this->data);
		View::render('home/index', $this->data);
		View::renderTemplate('footer', $this->data);
	}

	public function notice()
	{
		View::renderTemplate('header', $this->data);
		View::render('home/notice', $this->data);
		View::renderTemplate('footer', $this->data);
	}
}