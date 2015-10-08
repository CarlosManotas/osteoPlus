<?php

require 'libs/nusoap.php';
require 'CsWebServicePUC.php';
require 'ClWebServicePUC_Mailer.php';
require 'WSFactory.php';
// Productivo
$url = 'http://www.tvemart.com/service/newServer.php';

// Desarrollo
//http://www.tvemart.com/service/check_formularios.php
//$url = 'http://www.tvemart.com/service/newserver_dev.php';
//$datos = $_POST['datos'];

$apellido = '_';
$comentarios = "_";
$ok_mailing = 1;

/**
 * {{ ------DISEÑADORES -----------}}
 */
	//Si se debe enviar un email al visitante poner SI
	$enviar_mail = 'NO';
	//El producto de la pagina en cuestion
	$producto = 'Osteo-Plus';
	//El ID de la campaña en cuestion
	$id_camp = '4058';
	//El sitio donde debe ir la aplicacion luego de mandar el formulario
	$redirigir_a = 'gracias.html';
	//$respuesta =  "Cuantos kilos quiere bajar?";

	//Si se debe enviar mail al cliente poner el asunto 
	// y el cuerpo del email.
	$asunto = "Gracias por su consulta.";
	$cuerpo_mail = "<p>Estimado/a se recibió su mail.</p>";

/**
 * {{ ----FIN_DISEÑADORES ---------}}
 */



$cs = WSFactory::createWS($enviar_mail, $url);

$cs->product = $producto;
$cs->campaignId = $id_camp;
//$cs->answer = $respuesta;

//extract($_POST['datos']);
$nombre = $_POST['nombre']?:$_POST['nombre2'];
$cod = $_POST['cod']?:$_POST['cod2'];
$telefono = $_POST['telefono']?:$_POST['telefono2'];
$email = $_POST['email']?:$_POST['email2'];


$cs->name = htmlentities($nombre, ENT_QUOTES);
$cs->surname = htmlentities($apellido, ENT_QUOTES);
$cs->phone = htmlentities($cod.$telefono, ENT_QUOTES);
$cs->email = $email;
$cs->query = $comentarios;
$cs->mailing = $ok_mailing;
$cs->customerIp = $_SERVER['REMOTE_ADDR'];

if ($cs instanceof ClWebServicePUC_Mailer) {
	$cs->subject = $asunto;
	$cs->body = $cuerpo_mail;
}

if($cs->send()) {
	header("Location: $redirigir_a");
} else {
	echo "Estamos experimentando problemas tecnicos,
		por favor intente mas tarde, disculpe las molestias.";
}

?>
