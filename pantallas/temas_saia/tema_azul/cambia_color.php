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

$valores['icono_saia'] = 'logosaia_azul.png';
$valores['letra_tabs'] = '#0B7BB6';
$valores['letra_panel_kaiten'] = '#FFFFFF';
$valores['label_info'] = '#0B7BB6';
$valores['imagen_minimizar'] = '#69B3E3';
$valores['icono_maximizar'] = '#69B3E3';
$valores['fondo_tab'] = '#EDF9FF,#EDF9FF';
$valores['foco_input'] = '#CCCCCC';
$valores['enlace_hover'] = '#006699';
$valores['color_letra_ppal'] = '#0B7BB6';
$valores['color_encabezado_list'] = '#57B0DE';
$valores['color_encabezado'] = '#57B0DE';
$valores['btn_primary'] = '#6BA5DD,#0044CC';
$valores['boton_hover'] = '#0044cc';
$valores['borde_input'] = '#CCCCCC';
$valores['barra_inferior'] = '#69B3E3';
$valores['barra_busqueda'] = '#6BA5DD,#196BBA';
$valores['letra_tabs_superior'] = '#0B7BB6';

if ($_REQUEST['color'] != '') {
	unlink($ruta_db_superior . "asset/img/layout/logosaia.png");
	copy($ruta_db_superior . "pantallas/temas_saia/tema_azul/logosaia_azul.png", $ruta_db_superior . "asset/img/layout/logosaia.png");
	foreach ($valores as $key => $value) {
		if (strpos($value, "#") !== false) {
			if (is_file($ruta_db_superior . "asset/img/layout/" . $value)) {
				unlink($ruta_db_superior . "asset/img/layout/" . $value);
				copy($ruta_db_superior . "pantallas/temas_saia/tema_azul/" . $value, $ruta_db_superior . "asset/img/layout/" . $value);
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