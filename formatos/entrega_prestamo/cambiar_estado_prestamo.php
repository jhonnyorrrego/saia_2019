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
include_once ($ruta_db_superior . "db.php");

$iddocumento = $_REQUEST['iddocumento'];
$observaciones = @$_REQUEST["observacion"];
$fecha = date('Y-m-d H:i:s');

$sql1 = "UPDATE ft_entrega_prestamo SET estado_devolucion='1', observaciones_devolu='" . $observaciones . "', fecha_devolucion=" . fecha_db_almacenar($fecha, 'Y-m-d H:i:s') . ", usuario_devolucion='" . usuario_actual('idfuncionario') . "' WHERE documento_iddocumento=" . $iddocumento;
//print_r($sql1);die();
phpmkr_query($sql1);

$texto = "<b>Usuario que realiza la devolucion:</b> " . ucwords(strtolower(usuario_actual('nombres') . " " . usuario_actual('apellidos'))) . "<br><b>Observaciones:</b> " . $observaciones . "<br><b>Fecha:</b> " . $fecha;
echo $texto;
?>