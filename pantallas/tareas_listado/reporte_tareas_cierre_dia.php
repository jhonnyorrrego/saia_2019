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
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");

global $fecha_avance;
$fecha_avance=@$_REQUEST['variable_busqueda'];

function condicion_reporte_tareas_cierre_dia(){
	$condicion="a.estado=1 AND a.idfuncionario NOT IN (2,4)";
	return($condicion);
}
function mostrar_fecha_cierre(){
	global $fecha_avance;
	return($fecha_avance);
}
function mostrar_tiempo_responsable($idfuncionario){
	global $conn,$ruta_db_superior,$fecha_avance;
	
	$avances_responsable=busca_filtro_tabla("","tareas_listado a, tareas_listado_tiempo b","a.generica=0 AND a.idtareas_listado=b.fk_tareas_listado AND b.funcionario_idfuncionario=".$idfuncionario." AND a.responsable_tarea=".$idfuncionario." AND ".fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$fecha_avance."'","",$conn);
	$vector_tiempo_registrado=extrae_campo($avances_responsable,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);
	return( conversor_segundos_hm($tiempo_registrado) );
}
function mostrar_tiempo_coparticipante($idfuncionario){
	global $conn,$ruta_db_superior,$fecha_avance;
	
	$avances_coparticipante=busca_filtro_tabla("","tareas_listado a, tareas_listado_tiempo b","a.generica=0 AND a.idtareas_listado=b.fk_tareas_listado AND b.funcionario_idfuncionario=".$idfuncionario." AND FIND_IN_SET('".$idfuncionario."', a.co_participantes) AND ".fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$fecha_avance."'","",$conn);
	$vector_tiempo_registrado=extrae_campo($avances_coparticipante,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);
	return( conversor_segundos_hm($tiempo_registrado) );	
}
function mostrar_tiempo_seguidor($idfuncionario){
	global $conn,$ruta_db_superior,$fecha_avance;
	
	$avances_coparticipante=busca_filtro_tabla("","tareas_listado a, tareas_listado_tiempo b","a.generica=0 AND a.idtareas_listado=b.fk_tareas_listado AND b.funcionario_idfuncionario=".$idfuncionario." AND FIND_IN_SET('".$idfuncionario."', a.seguidores) AND ".fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$fecha_avance."'","",$conn);
	$vector_tiempo_registrado=extrae_campo($avances_coparticipante,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);
	return( conversor_segundos_hm($tiempo_registrado) );	
}
function mostrar_tiempo_evaluador($idfuncionario){
	global $conn,$ruta_db_superior,$fecha_avance;
	
	$avances_coparticipante=busca_filtro_tabla("","tareas_listado a, tareas_listado_tiempo b","a.generica=0 AND a.idtareas_listado=b.fk_tareas_listado AND b.funcionario_idfuncionario=".$idfuncionario." AND FIND_IN_SET('".$idfuncionario."', a.evaluador) AND ".fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$fecha_avance."'","",$conn);
	$vector_tiempo_registrado=extrae_campo($avances_coparticipante,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);
	return( conversor_segundos_hm($tiempo_registrado) );	
}
function mostrar_tiempo_total($idfuncionario,$nombre_funcionario){
	global $conn,$ruta_db_superior,$fecha_avance;
	
	$avances_coparticipante=busca_filtro_tabla("","tareas_listado a, tareas_listado_tiempo b","a.generica=0 AND a.idtareas_listado=b.fk_tareas_listado AND b.funcionario_idfuncionario=".$idfuncionario." AND (FIND_IN_SET('".$idfuncionario."', a.evaluador) OR FIND_IN_SET('".$idfuncionario."', a.seguidores) OR FIND_IN_SET('".$idfuncionario."', a.co_participantes) OR a.responsable_tarea=".$idfuncionario.") AND ".fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$fecha_avance."'","",$conn);
	$vector_tiempo_registrado=extrae_campo($avances_coparticipante,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);
	$tiempo_convertido=conversor_segundos_hm($tiempo_registrado);
	
	
	$cadena_tareas_involucradas=implode(',',extrae_campo($avances_coparticipante,'idtareas_listado'));
	
	
	$componente_reporte_filtrado=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='reporte_tareas_cierre_dia_filtrada' ","",$conn);
	
	$cadena='<div class="kenlace_saia" style="cursor:pointer" titulo="Avance a tareas del funcionario '.$nombre_funcionario.' en la fecha '.$fecha_avance.'" title="Avance a tareas del funcionario '.$nombre_funcionario.' en la fecha '.$fecha_avance.'" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente='.$componente_reporte_filtrado[0]['idbusqueda_componente'].'&variable_busqueda='.$idfuncionario.'|'.$fecha_avance.'|'.$cadena_tareas_involucradas.'" conector="iframe"><span style="cursor:pointer;">'.$tiempo_convertido.'</span></div>';
	
	
	return($cadena);	
}





?>
