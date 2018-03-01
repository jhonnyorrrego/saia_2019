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
$valores['label_info']='#666666';
$valores['imagen_minimizar']='#A5CE5D';
$valores['icono_maximizar']='#A5CE5D';
$valores['fondo_tab']='#A5CE5D,#A5CE5D';
$valores['foco_input']='#CCCCCC';
$valores['enlace_hover']='#A5CE5D';
$valores['color_letra_ppal']='#666666';
$valores['color_encabezado_list']='#666666';
$valores['color_encabezado']='#666666';
$valores['btn_primary']='#666666,#A5CE5D';
$valores['boton_hover']='#A5CE5D';
$valores['borde_input']='#CCCCCC';
$valores['barra_inferior']='#A5CE5D';
$valores['barra_busqueda']='#A5CE5D,#666666';
$valores['letra_tabs_superior']='#666666';
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