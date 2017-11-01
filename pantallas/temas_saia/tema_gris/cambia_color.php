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
$valores['label_info']='#0B7BB6';
$valores['imagen_minimizar']='#A99F8E';
$valores['icono_maximizar']='#A99F8E';
$valores['fondo_tab']='#A99F8E,#A99F8E';
$valores['foco_input']='#cccccc';
$valores['enlace_hover']='#A99F8E';
$valores['color_letra_ppal']='#A99F8E';
$valores['color_encabezado_list']='#A99F8E';
$valores['color_encabezado']='#A99F8E';
$valores['btn_primary']='#A99F8E,#A99F8E';
$valores['boton_hover']='#A99F8E';
$valores['borde_input']='#cccccc';
$valores['barra_inferior']='#A99F8E';
$valores['barra_busqueda']='#A99F8E,#A99F8E';
$valores['letra_tabs_superior']='#6E6E6E';
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