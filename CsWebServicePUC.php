<?php

class CsWebServicePUC {

	public $name;
	public $surname;
	public $product;
	public $email;
	public $phone;
	public $question;
	public $answer;
	public $landing;
	public $campaignId;
	public $customerIp;
	public $mailing;
	public $contactTime;
	public $query;

	protected $url;
	protected $xml;
	protected $soapClient;

	public function __construct($url)
	{
		$this->url = $url;
		$this->xml = new SimpleXMLElement('<xml/>');
		$this->soapClient = new nusoap_client($this->url);
	}

	public function send()
	{
		$this->createXML();

		$this->soapClient->setCredentials("tv3m4rt","dea35h6hs3500o1","basic");

		if ($this->soapClient->fault) {
	        echo 'No se pudo completar la operaci&oacute;n';
	        die();
		}

		if ($this->getResponseWS()) {
			return true;
		}

		return false;
	}

	private function createXML()
	{
		$request = $this->xml->addChild('request');
		$params = $request->addchild('params');

		$form = $params->addchild('form');
		$form->nombre = $this->name;
		$form->apellido = $this->surname;
		$form->producto = $this->product;
		$form->email = $this->email;
		$form->telefono = $this->phone;
		$form->campaniaid = $this->campaignId;
		$form->consulta = $this->query;
		$form->pregunta = $this->question;
		$form->respuesta = $this->answer;
		$form->landing = $this->landing;
		$form->horario_contacto = $this->contactTime;
		$form->ok_mailing = $this->mailing;
		$form->ipaddresscustomer = $this->customerIp;

	}

	private function getResponseWS()
	{
		$xml = $this->soapClient->call('insertComment', array(
			'xml' => $this->xml->asXML()
		));

		$xm = simplexml_load_string($xml);

		$response = $xm->request->response;
		if ((string) $response->result == 'OK') {
			return true;
		} else {
			return false;
		}
	}
}