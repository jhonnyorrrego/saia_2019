<?php
set_time_limit(0);

if (!@$_SESSION["LOGIN" . $_REQUEST["llave_saia"]] && $_REQUEST["conexion_remota"]) {
	@session_start();
	$_SESSION["LOGIN" . $_REQUEST["llave_saia"]] = $_REQUEST["conexion_usuario"];
	$_SESSION["usuario_actual"] = $_REQUEST["conexion_actual"];
	$_SESSION["conexion_remota"] = 1;
} else if (!@$_REQUEST["LOGIN"] && @$_REQUEST["usuario_actual"]) {
	@session_start();
	$_SESSION["LOGIN" . $_REQUEST["LLAVE_SAIA"]] = $_REQUEST["LOGIN"];
	$_SESSION["usuario_actual"] = $_REQUEST["usuario_actual"];
	$_SESSION["conexion_remota"] = 1;
}
if(!$_SESSION["LOGIN" . LLAVE_SAIA] && @$_REQUEST["LOGIN"] && @$_REQUEST["usuario_actual"]) {
	@session_start();
	$_SESSION["LOGIN" . LLAVE_SAIA] = $_REQUEST["LOGIN"];
	$_SESSION["usuario_actual"] = $_REQUEST["usuario_actual"];
	$_SESSION["conexion_remota"] = 1;
	global $usuactual;
	$usuactual = $_REQUEST["LOGIN"];
}


$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");


if(@$_REQUEST['iddoc']){
	$iddoc=$_REQUEST['iddoc'];
	$tipo_exportacion=busca_filtro_tabla("exportar","formato a, documento b","lower(a.nombre)=lower(b.plantilla) AND b.iddocumento=".$iddoc,"",$conn);
	$existe=false;
	if($tipo_exportacion['numcampos']){
		if(file_exists($ruta_db_superior.'class_impresion_'.$tipo_exportacion[0]['exportar'].'.php')){
			$existe=true;
			include_once($ruta_db_superior.'class_impresion_'.$tipo_exportacion[0]['exportar'].'.php');
			}
					}
	if(!$existe){
		echo('<cente>No se ha definido un M&eacute;todo Exportaci&oacute;n para esta plantilla, favor contactar al administrador del sistema! </center>');
				}
				}


?>
