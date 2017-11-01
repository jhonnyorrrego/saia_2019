<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
$valores['icono_saia']='logosaia.png';
$valores['letra_tabs']='#FFFFFF';
$valores['letra_panel_kaiten']='#FFFFFF';
$valores['label_info']='#FE2E2E';
$valores['imagen_minimizar']='#808285';
$valores['icono_maximizar']='#808285';
$valores['fondo_tab']='#6E6E6E,#808285';
$valores['foco_input']='#808285';
$valores['enlace_hover']='#808285';
$valores['color_letra_ppal']='#808285';
$valores['color_encabezado_list']='#808285';
$valores['color_encabezado']='#808285';
$valores['btn_primary']='#6E6E6E,#808285';
$valores['boton_hover']='#808285';
$valores['borde_input']='#cccccc';
$valores['barra_inferior']='#E8001E';
$valores['barra_busqueda']='#6E6E6E,#808285';
$valores['letra_tabs_superior']='#E8001E';
$valores['color_letra_modulos']='#808285';
$valores['color_letra_buzones']='#E8001E';
$valores['color_letra_login']='#808285';
$valores['noty_text']='#6E6E6E';
if($_REQUEST['color']!=''){
	foreach ($valores as $key => $value){
		if(strpos($value, "#")===false) {
			if(is_file($ruta_db_superior."asset/img/layout/".$value)){
				copy($ruta_db_superior."pantallas/temas_saia/tema_".$_REQUEST['color']."/".$value,$ruta_db_superior."asset/img/layout/".$value);
			}else if(is_file($ruta_db_superior."imagenes/login/".$value)){
				copy($ruta_db_superior."pantallas/temas_saia/tema_".$_REQUEST['color']."/".$value,$ruta_db_superior."imagenes/login/".$value);
			}
		}else{
			$update="update configuracion set valor='".$value."' where nombre = '".$key."'";
			phpmkr_query($update);
		}
	}
	echo 1;
}else{
	echo 0;
}
?>