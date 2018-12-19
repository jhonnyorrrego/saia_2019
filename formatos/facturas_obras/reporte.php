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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

function ver_documentos($radicado, $iddoc) {
	$enlace = "<div class='link kenlace_saia' enlace='ordenar.php?mostrar_formato=1&amp;amp;key=" . $iddoc . "' conector='iframe' titulo='Radicado No " . $radicado . "'><span class='badge'>" . $radicado . "</span></div>";
	return ($enlace);
}

function color_vence_factura($fecha,$dias){
	$html="";
	if($fecha!="" && $fecha!="vence_factura"){
		$array_color=array(0=>'class="badge badge-info"',1=>'class="badge badge-warning"',2=>'class="badge badge-success"');
		$dia=intval($dias);
		if($dia<=0){
			$color=0;
		}else if($dia>0 && $dia<6){
			$color=1;
		}else{
			$color=2;
		}
		$html='<span '.$array_color[$color].'>'.$fecha.'</span>';	
	}
	return($html);
}