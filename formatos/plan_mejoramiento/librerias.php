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

function ver_documento($iddocumento, $numero) {
	return ('<div class="link kenlace_saia" enlace="ordenar.php?key=' . $iddocumento . '&amp;accion=mostrar&amp;mostrar_formato=1" titulo="Radicado No ' . $numero . '" conector="iframe"> <span class="badge">' . $numero . '</span></div>');
}

function where_plan_mejoramiento() {
	$perm = new PERMISO();
	$ok = $perm -> acceso_modulo_perfil("reporte_plan_mejoramiento_admin");
	if ($ok) {
		$html = "1=1";
	} else {
		$html = "ejecutor=" . $_SESSION["usuario_actual"];
	}
	return $html;
}
?>