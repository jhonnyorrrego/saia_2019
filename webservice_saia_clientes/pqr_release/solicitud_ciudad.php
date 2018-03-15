<?php
include_once('define_remoto.php');
require_once('lib/nusoap.php');
ini_set("display_errors",false);
$cliente = new nusoap_client(SERVIDOR_REMOTO.'/servidor_respuesta_pqr.php');

$datos = json_encode($_REQUEST);

$resultado = $cliente->call('consultar_ciudad', array($datos));

echo($resultado);
?>
