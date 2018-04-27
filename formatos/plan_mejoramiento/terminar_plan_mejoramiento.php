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
if (isset($_REQUEST["iddoc"]) && $_REQUEST["opt"] == 1) {
	$retorno["msn"] = "Error al actualizar el estado del plan";
	$sql1 = "update ft_plan_mejoramiento set observ_termino='".$_REQUEST["observ_termino"]."',estado_plan_mejoramiento=3,idfun_termino=".$_SESSION["idfuncionario"].",fecha_termino=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." where documento_iddocumento=" . $_REQUEST["iddoc"];
	phpmkr_query($sql1) or die(json_encode($retorno));
	$retorno["exito"] = 1;
}
echo json_encode($retorno);
?>