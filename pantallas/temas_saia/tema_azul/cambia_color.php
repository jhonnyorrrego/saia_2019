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
$valores['letra_tabs']='#0B7BB6';
$valores['letra_panel_kaiten']='#FFFFFF';
$valores['label_info']='#0B7BB6';
$valores['imagen_minimizar']='#69B3E3';
$valores['icono_maximizar']='#69B3E3';
$valores['fondo_tab']='#EDF9FF,#EDF9FF';
$valores['foco_input']='#CCCCCC';
$valores['enlace_hover']='#006699';
$valores['color_letra_ppal']='#0B7BB6';
$valores['color_encabezado_list']='#57B0DE';
$valores['color_encabezado']='#57B0DE';
$valores['btn_primary']='#6BA5DD,#0044CC';
$valores['boton_hover']='#0044cc';
$valores['borde_input']='#CCCCCC';
$valores['barra_inferior']='#69B3E3';
$valores['barra_busqueda']='#6BA5DD,#196BBA';
$valores['letra_tabs_superior']='#0B7BB6';
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