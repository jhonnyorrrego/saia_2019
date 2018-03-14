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

$valores['icono_saia'] = 'logosaia_gris.png';
$valores['letra_tabs'] = '#FFFFFF';
$valores['letra_panel_kaiten'] = '#FFFFFF';
$valores['label_info'] = '#0B7BB6';
$valores['imagen_minimizar'] = '#696E6F';
$valores['icono_maximizar'] = '#696E6F';
$valores['fondo_tab'] = '#696E6F,#696E6F';
$valores['foco_input'] = '#cccccc';
$valores['enlace_hover'] = '#696E6F';
$valores['color_letra_ppal'] = '#696E6F';
$valores['color_encabezado_list'] = '#696E6F';
$valores['color_encabezado'] = '#696E6F';
$valores['btn_primary'] = '#696E6F,#696E6F';
$valores['boton_hover'] = '#696E6F';
$valores['borde_input'] = '#cccccc';
$valores['barra_inferior'] = '#696E6F';
$valores['barra_busqueda'] = '#696E6F,#696E6F';
$valores['letra_tabs_superior'] = '#6E6E6E';

if ($_REQUEST['color'] != '') {
	unlink($ruta_db_superior . "asset/img/layout/logosaia.png");
	copy($ruta_db_superior . "pantallas/temas_saia/tema_gris/logosaia_gris.png", $ruta_db_superior . "asset/img/layout/logosaia.png");
	foreach ($valores as $key => $value) {
		if (strpos($value, "#") === false) {
			if (is_file($ruta_db_superior . "asset/img/layout/" . $value)) {
				unlink($ruta_db_superior . "asset/img/layout/" . $value);
				copy($ruta_db_superior . "pantallas/temas_saia/tema_gris/" . $value, $ruta_db_superior . "asset/img/layout/" . $value);
			}
		}
		$update = "update configuracion set valor='" . $value . "' where nombre = '" . $key . "'";
		phpmkr_query($update);
	}
	echo 1;
} else {
	echo 0;
}
?>