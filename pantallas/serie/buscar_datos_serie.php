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
$retorno = array(
	"exito" => 0,
	"msn" => ""
);
if ($_REQUEST["idserie"]) {
	$serie_padre = busca_filtro_tabla("", "serie", "idserie=" . $_REQUEST['idserie'], "", $conn);
	if ($serie_padre["numcampos"]) {
		$x_dias_entrega = $serie_padre[0]["dias_entrega"];
		$x_codigo = $serie_padre[0]["codigo"];
		$x_retencion_gestion = $serie_padre[0]["retencion_gestion"];
		$x_retencion_central = $serie_padre[0]["retencion_central"];
		$x_conservacion = $serie_padre[0]["conservacion"];
		$x_seleccion = $serie_padre[0]["seleccion"];
		$x_otro = $serie_padre[0]["otro"];
		$x_procedimiento = $serie_padre[0]["procedimiento"];
		$x_digitalizacion = $serie_padre[0]["digitalizacion"];
		$x_copia = $serie_padre[0]["copia"];
		$x_nombre = $serie_padre[0]["nombre"];

		$vector = array(
			'dias_entrega' => $x_dias_entrega,
			'codigo' => $x_codigo,
			'retencion_gestion' => $x_retencion_gestion,
			'retencion_central' => $x_retencion_central,
			'conservacion' => $x_conservacion,
			'seleccion' => $x_seleccion,
			'otro' => $x_otro,
			'procedimiento' => $x_procedimiento,
			'digitalizacion' => $x_digitalizacion,
			'copia' => $x_copia,
			'nombre' => $x_nombre
		);
		$retorno["exito"]=1;
		$retorno=array_merge($retorno,$vector);
	}else{
		$retorno["msn"]="No se encontraron datos";
	}
}
echo(json_encode($retorno));
?>