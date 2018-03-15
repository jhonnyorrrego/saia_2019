<?php
include_once('lib/nusoap.php');  
include_once('define_info_qr.php'); 
 
$cliente = new nusoap_client(SERVIDOR_INFO_QR);
$request=@$_REQUEST['key_cripto'];
$cadena=json_encode($request);
$html = $cliente->call('generar_html_info_qr', array($cadena));
$html = json_decode($html,1);	
echo($html['html']);
?>
