<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function nombre_cliente($datos_cliente){
  global $conn;
	$datos=busca_filtro_tabla("B.nombre","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos_cliente,"",$conn);
	return($datos[0]['nombre']);
}

function tipo_vehiculo($tipo){
	global $conn;
	$datos=busca_filtro_tabla("A.nombre_vehiculo","ft_datos_vehiculo A","A.idft_datos_vehiculo=".$tipo,"",$conn);
	$tipo_vehiculo=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos[0]['nombre_vehiculo'],"",$conn);
	return($tipo_vehiculo[0]['nombre']);
}

function enlace_documento_confirmacion($iddocumento){
	global $conn;
  return("ordenar.php?key=".$iddocumento."&amp;accion=mostrar&amp;mostrar_formato=1");
}

function mostrar_documento_reporte($iddocumento){
	global $conn;
	$numero=busca_filtro_tabla("numero","documento","iddocumento=".$iddocumento,"",$conn);
	if($numero[0][0]!=0 || $numero[0][0]!='numero'){
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="Documento No.'.$numero[0][0].'"><center><span class="badge">'.$numero[0][0].'</span></center></div>');
	}else{
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="Documento No.0"><center><span class="badge">0</span></center></div>');
	}
}

function mostrar_nombre_cliente($datos_cliente){
	global $conn;
	$datos=busca_filtro_tabla("B.nombre","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos_cliente,"",$conn);
	
	return(mayusculas($datos[0]['nombre']));
}

function mostrar_tipo_vehiculo($datos_vehiculo){
	global $conn;
	$info_vehiculo=busca_filtro_tabla("A.nombre_vehiculo","ft_datos_vehiculo A","A.idft_datos_vehiculo=".$datos_vehiculo,"",$conn);
	$vehiculo=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$info_vehiculo[0][0],"",$conn);

	return(mayusculas($vehiculo[0]['nombre']));
}

function mostrar_costo_reparacion($iddocumento){
	global $conn;
	$datos_papa=busca_filtro_tabla("B.documento_iddocumento","ft_confir_negoci_vehiculo A, ft_orden_trabajo_vehiculo B, ft_planea_orden_trabajo C","A.idft_confir_negoci_vehiculo=B.ft_confir_negoci_vehiculo AND B.idft_orden_trabajo_vehiculo=C.ft_orden_trabajo_vehiculo AND A.documento_iddocumento=".$iddocumento,"B.documento_iddocumento desc",$conn);
	
	$costo=busca_filtro_tabla("B.costo_trabajo","ft_orden_trabajo_vehiculo A, ft_planea_orden_trabajo B","A.idft_orden_trabajo_vehiculo=B.ft_orden_trabajo_vehiculo AND A.documento_iddocumento=".$datos_papa[0]['documento_iddocumento'],"",$conn);

	if($costo['numcampos']){
		for($i=0;$i<$costo['numcampos'];$i++){
			$costo_reparacion+=$costo[$i]['costo_trabajo'];
		}
		$costo_total="$".number_format($costo_reparacion,0,"",".");
		return($costo_total);
	}else{
		return("SIN INFORMACIÓN");
	}
}

function fecha_orden_trabajo($iddocumento){
	global $conn;
	$datos=busca_filtro_tabla("B.fecha_orden_trabajo","ft_confir_negoci_vehiculo A, ft_orden_trabajo_vehiculo B","A.idft_confir_negoci_vehiculo=B.ft_confir_negoci_vehiculo AND A.documento_iddocumento=".$iddocumento,"",$conn);
	if($datos['numcampos']){
		for($i=0;$i<$datos['numcampos'];$i++){
			$fecha_orden=$datos[$i]['fecha_orden_trabajo'];
		}
		return($fecha_orden);
	}else{
		return("SIN INFORMACIÓN");
	}
}
?>