<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior."db.php");
include_once ($ruta_db_superior."class_transferencia.php");
$dato = busca_filtro_tabla("", "ft_plan_mejoramiento,documento", "documento_iddocumento=iddocumento AND documento_iddocumento=" . $_REQUEST["iddocumento"], "", $conn);

$datos["archivo_idarchivo"] = $_REQUEST["iddocumento"];
$datos["nombre"] = "TRANSFERIDO";
$datos["tipo_destino"] = 1;
$datos["tipo"] = "";
$datos["ver_notas"]="";
$datos_adicionales["notas"] = "";
$fecha = date("Y-m-d H:i:s");
switch($_REQUEST["tipo"]) {
	case 1 :
		//Elaborado por:
		$tipo = "elaborado";
		$destinos = array($dato[0]["revisado"]);
		
		transferir_archivo_prueba($datos, $destinos, $datos_adicionales);
		break;
	case 2 :
		//Revisado por:
		$tipo = "revisado";
		$destinos = array($dato[0]["aprobado"]);
		transferir_archivo_prueba($datos, $destinos, $datos_adicionales);
		break;
	case 3 :
		//Aprobado por:
		$sql_aprobar_plan = "UPDATE ft_plan_mejoramiento SET estado_plan_mejoramiento=2,fecha_suscripcion=" . fecha_db_almacenar($fecha, "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $_REQUEST["iddocumento"];
		phpmkr_query($sql_aprobar_plan);
		$hallazgo = busca_filtro_tabla("", "ft_hallazgo", "ft_plan_mejoramiento=" . $dato[0]["idft_plan_mejoramiento"], "", $conn);
		$destino1 = extrae_campo($hallazgo, "responsable_seguimiento", "U");
		$destino2 = extrae_campo($hallazgo, "responsables", "U");
		$datos_adicionales["notas"] = "'El plan de mejoramiento No" . $dato[0]["numero"] . " fue Aprobado y Cerrado, por lo tanto ya no puede ser editado.'";
		transferir_archivo_prueba($datos, array_merge($destino1, $destino2), $datos_adicionales);
		$tipo = "aprobado";
		break;
}
$sql = "UPDATE ft_plan_mejoramiento SET fecha_" . $tipo . "=" . fecha_db_almacenar($fecha, "Y-m-d H:i:s") . " WHERE documento_iddocumento=" . $_REQUEST["iddocumento"];
phpmkr_query($sql, $conn);
?>