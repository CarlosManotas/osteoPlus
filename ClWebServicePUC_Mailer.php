<?php

class ClWebServicePUC_Mailer extends CsWebServicePUC {

	private $smtp;
	private $smtpPort;
	private $from;
	private $smtpAccount;
	private $smtpPass;
	
	public $subject;
	public $body;

	public function __construct($url)
    {
        parent::__construct($url);
    }

	public function send()
	{
		$response = parent::send();

		if ($response) {
			require 'libs/class.phpmailer.php';

			$this->readXMLConfig();

			$mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = $this->smtp;
			$mail->Port = $this->smtpPort;
			$mail->Username = $this->smtpAccount;
			$mail->Password = $this->smtpPass;
			$mail->SetFrom($this->from);
			//$mail->AddReplyTo("noreply@tvemart.com","No Reply");	
			$mail->Subject = $this->subject;
			$mail->AddAddress($this->email);
			$mail->Body = $this->body;
			$mail->IsHTML(true);

			$mail->Send();
		}

		return $response;
	}

	private function readXMLConfig()
	{
		$xml = simplexml_load_file("XMLConfigSMTP.xml");

		
		$config = $xml->SMTP_CONFIG;

		$this->smtp = (string)$config->SMTP_SERVER;
		$this->smtpPort = (string)$config->SMTP_PORT;
		$this->from = (string)$config->EMAIL_FROM;
		$this->smtpAccount = (string)$config->SMTP_USER;
		$this->smtpPass = $this->decrypt($config->SMTP_PASSWORD);
	}

	private function decrypt($str)
	{
		return base64_decode((string)$str);
	}
} 