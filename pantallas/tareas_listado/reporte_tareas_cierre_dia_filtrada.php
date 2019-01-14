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

global $idfuncionario_fecha_registro_idtareas;
$idfuncionario_fecha_registro_idtareas=explode('|',@$_REQUEST['variable_busqueda']);


function condicion_reporte_tareas_cierre_dia_filtrada(){
	global $idfuncionario_fecha_registro_idtareas;
	
	
	$condicion=fecha_db_obtener('b.fecha_inicio','Y-m-d')."='".$idfuncionario_fecha_registro_idtareas[1]."' AND a.generica=0 AND  a.idtareas_listado IN(".$idfuncionario_fecha_registro_idtareas[2].")";
	return($condicion);
}
function mostrar_avance_tarea($idtareas_listado){
	global $conn,$ruta_db_superior,$idfuncionario_fecha_registro_idtareas;
	
	$tiempo_tarea=busca_filtro_tabla("","tareas_listado_tiempo","fecha_inicio='".$idfuncionario_fecha_registro_idtareas[1]."' AND funcionario_idfuncionario=".$idfuncionario_fecha_registro_idtareas[0]." AND fk_tareas_listado=".$idtareas_listado,"",$conn);
	$vector_tiempo_registrado=extrae_campo($tiempo_tarea,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);	
	$tiempo_convertido=conversor_segundos_hm($tiempo_registrado);
	return($tiempo_convertido);
}

function mostrar_rol($responsable_tarea,$co_participantes,$seguidores,$evaluador){
	global $conn,$ruta_db_superior,$idfuncionario_fecha_registro_idtareas;
	
	$roles='';
	$vector_co_participantes=explode(',',$co_participantes);
	$vector_seguidores=explode(',',$seguidores);
	$vector_evaluador=explode(',',$evaluador);
	if($responsable_tarea==$idfuncionario_fecha_registro_idtareas[0]){
		$roles.='Responsable, ';
	}
	if(in_array($idfuncionario_fecha_registro_idtareas[0],$vector_co_participantes)){
	    $roles.='Co-participante, ';
	}
	if(in_array($idfuncionario_fecha_registro_idtareas[0],$vector_seguidores)){
	    $roles.='Seguidor, ';
	}	
	if(in_array($idfuncionario_fecha_registro_idtareas[0],$vector_evaluador)){
	    $roles.='Evaluador, ';
	}
	$roles = trim($roles,', ');
	return($roles);
}
function mostrar_progreso($progreso){
	
	if($progreso=='progreso'){
		return('0%');
	}else{
		return($progreso.'%');
	}
	
}


function mostrar_enlace_nombre_tarea($idtareas_listado,$nombre_tarea){
	global $conn;
	
	$componente_tareas_listado=busca_filtro_tabla("idbusqueda_componente","busqueda_componente"," lower(nombre)='tareas_listado_reporte' ","",$conn);	
	$url="pantallas/busquedas/consulta_busqueda_subtareas_listado2.php?idbusqueda_componente=".$componente_tareas_listado[0]['idbusqueda_componente']."&ocultar_subtareas=1&rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico=".$idtareas_listado;
	$cadena='<div class="kenlace_saia" style="cursor:pointer" titulo="Tarea '.$nombre_tarea.'" title="Tarea '.$nombre_tarea.'" enlace="'.$url.'" conector="iframe"><span style="cursor:pointer;">'.$nombre_tarea.'</span></div>';
	return($cadena);
}


function mostrar_avance_total_tarea($idtareas_listado){
	global $conn,$ruta_db_superior;
	
	$tiempo_tarea=busca_filtro_tabla("","tareas_listado_tiempo","fk_tareas_listado=".$idtareas_listado,"",$conn);
	$vector_tiempo_registrado=extrae_campo($tiempo_tarea,'tiempo_registrado','D');
	$tiempo_registrado=array_sum($vector_tiempo_registrado);	
	$tiempo_convertido=conversor_segundos_hm($tiempo_registrado);
	return($tiempo_convertido);
}


function exportar_reporte_cierre_dia($datos_reporte){
	global $conn,$ruta_db_superior;
	
	$enlace_exportar_reporte_cierre_dia="<button class='btn btn-mini btn-success pull-left exportar_reporte_cierre_dia' variable_busqueda='".$datos_reporte['variable_busqueda']."' idbusqueda_componente='".$datos_reporte['idbusqueda_componente']."' title='Cierre D&iacute;a' enlace=''>Cierre D&iacute;a</button>";
	return($enlace_exportar_reporte_cierre_dia);
}
?>
