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

$valores['icono_saia'] = 'logosaia_rojo.png';
$valores['letra_tabs'] = '#FFFFFF';
$valores['letra_panel_kaiten'] = '#FFFFFF';
$valores['label_info'] = '#FE2E2E';
$valores['imagen_minimizar'] = '#808285';
$valores['icono_maximizar'] = '#808285';
$valores['fondo_tab'] = '#6E6E6E,#808285';
$valores['foco_input'] = '#808285';
$valores['enlace_hover'] = '#808285';
$valores['color_letra_ppal'] = '#808285';
$valores['color_encabezado_list'] = '#808285';
$valores['color_encabezado'] = '#808285';
$valores['btn_primary'] = '#6E6E6E,#808285';
$valores['boton_hover'] = '#808285';
$valores['borde_input'] = '#cccccc';
$valores['barra_inferior'] = '#E8001E';
$valores['barra_busqueda'] = '#6E6E6E,#808285';
$valores['letra_tabs_superior'] = '#E8001E';
$valores['color_letra_modulos'] = '#808285';
$valores['color_letra_buzones'] = '#E8001E';
$valores['color_letra_login'] = '#808285';
$valores['noty_text'] = '#6E6E6E';

if ($_REQUEST['color'] != '') {
	unlink($ruta_db_superior . "asset/img/layout/logosaia.png");
	copy($ruta_db_superior . "pantallas/temas_saia/tema_rojo/logosaia_rojo.png", $ruta_db_superior . "asset/img/layout/logosaia.png");
	foreach ($valores as $key => $value) {
		if (strpos($value, "#") !== false) {
			if (is_file($ruta_db_superior . "asset/img/layout/" . $value)) {
				unlink($ruta_db_superior . "asset/img/layout/" . $value);
				copy($ruta_db_superior . "pantallas/temas_saia/tema_rojo/" . $value, $ruta_db_superior . "asset/img/layout/" . $value);
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