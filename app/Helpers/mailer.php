<?php 
namespace Helpers;

class Mailer
{
	public $subject;

	public $body;

	public $toaddress;

	public $toname;

	public $status;

	//todo including an attachment


	function __construct($to = array(), $subject, $data = array(), $template = 'default')
    {

      	$this->body = file_get_contents(EMAIL_TEMPLATE_PATH.$template.'.html');

    	foreach ($data as $key => $value) {
    		$this->body = str_replace("<".$key.">", $value, $this->body);
    	}

        $this->toaddress = $to['email'];
        $this->toname = $to['name'];

        $this->subject = EMAIL_SENDER_NAME.' | '.$subject;

        $this->send();
    } 

    public function send()
    {
    	
    	$transport = \Swift_SmtpTransport::newInstance(EMAIL_HOST_NAME, EMAIL_PORT)
					->setUsername(EMAIL_USERNAME)
					->setPassword(EMAIL_PASSWORD);

		$message = \Swift_Message::newInstance();

		//Give the message a subject
	    $message->setSubject($this->subject)
			      ->setFrom(EMAIL_SENT_FROM)
			      ->setTo($this->toaddress)
			      ->setBody('Here is the message sent with swiftmailer')
			      ->addPart($this->body, 'text/html');
	 
	    //Create the Mailer using your created Transport
	    $mailer = \Swift_Mailer::newInstance($transport);
	 
	    //Send the message
	    $result = $mailer->send($message);
	 
	    if ($result) {
	      $this->status =  1;
	    
	    }
	    else{
	      $this->status =  0;
	    }

    }

}
