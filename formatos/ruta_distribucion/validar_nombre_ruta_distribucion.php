<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");

$retorno = array('exito' => 0);
if (isset($_REQUEST["nombre_ruta"]) && trim($_REQUEST["nombre_ruta"])!="") {
	$parte="";	
	if($_REQUEST["opt"]==1){
		$parte=" and b.iddocumento<>".$_REQUEST["iddoc"];
	}
	$existe = busca_filtro_tabla("idft_ruta_distribucion", "ft_ruta_distribucion a,documento b", " b.estado NOT IN ('ELIMINADO','ANULADO') AND a.documento_iddocumento=b.iddocumento AND lower(a.nombre_ruta) LIKE '" . strtolower($_REQUEST['nombre_ruta']) . "'".$parte, "", $conn);
	if ($existe['numcampos']) {
		$retorno['exito'] = 1;
	}
}

echo(json_encode($retorno));
?>