<?php
require_once('lib/nusoap.php');
include_once('define_remoto.php');

$cliente = new nusoap_client(SERVIDOR_REMOTO.'/servidor_remoto_radicacion_pqr.php');
	$error = $cliente->getError();
	if($error){
		echo "<b>Error => </b>".$error;
	}

if($_REQUEST['cargar_todo']==1){
	$texto="";
	$iniciativa = $cliente->call('consultar_iniciativa', array($texto));
	$sector = $cliente->call('consultar_sector', array($texto));
	$cluster = $cliente->call('consultar_cluster', array($texto));
	$region = $cliente->call('consultar_region', array($texto));
	$numero_radicado = $cliente->call('consultar_numero_radicado', array($texto));
	
	$resultado['iniciativa']=$iniciativa;
	$resultado['sector']=$sector;
	$resultado['cluster']=$cluster;
	$resultado['region']=$region;
	$resultado['numero_radicado']=$numero_radicado;
	echo(json_encode($resultado));
}
if($_REQUEST['idserie']){
	$datos_select=$cliente->call('datos_select', array($_REQUEST['idserie']));
	$resultado['resultado']=$datos_select;
	echo(json_encode($resultado));
}
?>