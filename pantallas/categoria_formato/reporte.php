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

function validar_activo_inactivo_categoria_formato($idcategoria_formato, $estado) {
	if ($estado == 1) {
		$esconder = "#enlace_activar_categoria_formato_" . $idcategoria_formato;
	} else {
		$esconder = "#enlace_inactivar_categoria_formato_" . $idcategoria_formato;
	}

	$cadena = "
    <style>
        " . $esconder . "{display:none;}
    </style>
    ";
	return ($cadena);
}

function enlaces_categoria_formato($idcategoria, $nombre) {
	if ($_SESSION["tipo_dispositivo"] == "movil") {
		$clase_info = "kenlace_saia";
		$clase_info2 = "kenlace_saia";
	} else {
		$clase_info = "enlace_detalles_categoria_formato";
		$clase_info2 = "enlace_editar_categoria_formato";
	}

	$html = '<div class="btn btn-mini ' . $clase_info . ' pull-right" idregistro="' . $idcategoria . '" conector="iframe" enlace="pantallas/categoria_formato/detalles_categoria_formato.php?idcategoria_formato=' . $idcategoria . '" titulo="Ver ' . $nombre . '">
		<i class="icon-info-sign"></i>
	</div>
	<div class="btn btn-mini ' . $clase_info2 . ' pull-right" idregistro="' . $idcategoria . '" conector="iframe" titulo="Editar ' . $nombre . '" enlace="pantallas/categoria_formato/editar_categoria_formato.php?idcategoria_formato=' . $idcategoria . '&idbusqueda_componente=' . $_REQUEST['idbusqueda_componente'] . '">
		<i class="icon-edit"></i>
	</div>	
	<div class="btn btn-mini enlace_inactivar_categoria_formato pull-right" idregistro="' . $idcategoria . '" titulo="' . $nombre . '" id="enlace_inactivar_categoria_formato_' . $idcategoria . '">
		<i class="icon-ban-circle"></i>
	</div>	
	<div class="btn btn-mini enlace_activar_categoria_formato pull-right" idregistro="' . $idcategoria . '" titulo="' . $nombre . '" id="enlace_activar_categoria_formato_' . $idcategoria . '">
		<i class="icon-ok"></i>
	</div>';
	return $html;
}
?>