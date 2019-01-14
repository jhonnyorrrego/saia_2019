<?php
require_once("radicar_plantilla_saia.php");
$adicionales=@$_REQUEST["adicionales"];
$datos=explode(",",$adicionales);
$fin=count($datos);
for($i=0;$i<$fin;$i++){
	$datos2=explode("/",$datos[$i]);
	$descripcion="";
	if($datos2[1]==1){
		$descripcion="Bien";
	}
	else if($datos2[1]==2){
		$descripcion="Problemas";
	}
	$nuevos_datos[$datos2[0]]=$descripcion;
}
$datos=file_get_contents("http://basic.netsaia.com/saia_cerok/verificacion_cliente/llama_ws_saia.php");
$datos = json_decode($datos, true);
echo($datos);
die("--");
$documento=json_encode($nuevos_datos);
radicacion_webservice(@$_REQUEST["dato1"],@$_REQUEST["dato2"],@$_REQUEST["dato3"],$documento,@$_REQUEST["documento_cliente"]);
?>