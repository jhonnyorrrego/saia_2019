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

function filtro_modulo_admin() {
	$html = "permiso_admin=0";
	$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
	if ($configuracion["numcampos"] && trim($configuracion[0]["valor"]) == trim($_SESSION["LOGIN" . LLAVE_SAIA])) {
		$html = "1=1";
	}
	return ($html);
}

function barra_superior_modulo($idmodulo){
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar modulo" enlace="moduloadd.php?key='.$idmodulo.'&accion=editar" conector="iframe"><i class="icon-wrench"></i></button>
<!--button type="button" class="btn btn-mini eliminar_modulo tooltip_saia" titulo="Eliminar modulo" id="'.$idmodulo.'"><i class="icon-trash"></i></button-->
<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" titulo="Seleccionar modulo" idregistro="'.$idmodulo.'"><i class="icon-download"></i></button>
<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idmodulo.'" titulo="Deseleccionar modulo"><i class="icon-edit"></i></button>
</div>';
return(($texto));
}

function nombre_padre($idpadre){
	global $conn;
	$nombre = busca_filtro_tabla("nombre", "modulo", "idmodulo=" . $idpadre, "", $conn);
	return ($nombre[0]["nombre"]);
}
?>