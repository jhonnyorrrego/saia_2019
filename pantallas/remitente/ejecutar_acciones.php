<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/remitente/librerias.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("idejecutores");
desencriptar_sqli('form_info');

if (@$_REQUEST["ejecutar_remitente"]) {
	if (!@$_REQUEST["tipo_retorno"]) {
		$_REQUEST["tipo_retorno"] = 1;
	}
	if ($_REQUEST["tipo_retorno"]) {
		echo(json_encode($_REQUEST["ejecutar_remitente"]()));
	} else {
		$_REQUEST["ejecutar_remitente"]();
	}
}
function set_remitente() {
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al guardar";
	$exito = 0;
	$campos = array("cargo", "empresa", "direccion", "telefono", "email", "titulo", "ciudad", "codigo", "ejecutor_idejecutor");
	$valores = array();
	$valores_busqueda = array();
	foreach ($campos AS $key => $campo) {
		if (@$_REQUEST[$campo]) {
			array_push($valores, $_REQUEST[$campo]);
			array_push($valores_busqueda,$campo."='".$_REQUEST[$campo]."' ");
		} else {
			array_push($valores, "");
			array_push($valores_busqueda,"(".$campo."='' OR ".$campo." IS NULL )");
		}
	}
	$remitente=busca_filtro_tabla("","datos_ejecutor",implode(" AND ",$valores_busqueda));
	if(!$remitente["numcampos"]){
		$sql2 = "INSERT INTO datos_ejecutor(" . implode(",", $campos) . ") VALUES('" . implode("','", $valores) . "')";
		phpmkr_query($sql2);
		$iddatos_ejecutor = phpmkr_insert_id();
		$retorno -> sql = $sql2;
		$retorno -> mensaje = "Datos guardados";
	}
	else{
		$retorno -> mensaje = "Los datos de remitente ya se encuentran registrados ";
		$retorno -> sql = $remitente["sql"];
		$iddatos_ejecutor=$remitente[0]["iddatos_ejecutor"];
	}
	if ($iddatos_ejecutor) {
		$exito = 1;
	}
	if ($exito) {
		$retorno -> iddatos_ejecutor = $iddatos_ejecutor;
		$retorno -> exito = 1;

	}
	return ($retorno);
}

function actualizar_estado_remitente(){
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al actualizar Informacion";
	$exito = 0;
	if($_REQUEST["estado"]==1 || $_REQUEST["estado"]==0){
		$update_remitente="UPDATE ejecutor SET estado=".$_REQUEST["estado"]." WHERE idejecutor IN (".$_REQUEST["idejecutores"].")";
		phpmkr_query($update_remitente) or die($retorno);
		$retorno -> sql = $update_remitente;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Estado Actualizado";
	}
	return ($retorno);
}

function insert_remitente(){
	$retorno = new stdClass;
	$retorno -> exito = 0;
	$retorno -> mensaje = "Error al Ingresar la Informacion";
	$exito = 0;
	if(trim($_REQUEST["nombre"])!="" && $_REQUEST["identificacion"]!=0 && trim($_REQUEST["identificacion"])!=""){
		$inser="INSERT INTO ejecutor (nombre,identificacion,tipo_ejecutor) VALUES ('".($_REQUEST["nombre"])."','".$_REQUEST["identificacion"]."',".@$_REQUEST["tipo_ejecutor"].")";
		phpmkr_query($inser) or die($retorno);
		$idejecutor = phpmkr_insert_id();
		$retorno -> idejecutor = $idejecutor;
		$retorno -> exito = 1;
		$retorno -> mensaje = "Datos Guardados";
	}
	return ($retorno);
}
?>