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

if (@$_REQUEST['idft_proceso']) {
	$coordenadas = busca_filtro_tabla("coordenadas", "ft_proceso", "idft_proceso=" . $_REQUEST['idft_proceso'], "");
	$retorno = array();
	$retorno['coordenadas'] = 0;
	if ($coordenadas['numcampos'] && @$coordenadas[0]['coordenadas'] != '' && !is_null(@$coordenadas[0]['coordenadas'])) {
		$retorno['coordenadas'] = $coordenadas[0]['coordenadas'];
	}
	echo(json_encode($retorno));
}
?>