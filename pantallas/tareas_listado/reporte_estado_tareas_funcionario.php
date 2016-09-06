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


function mostrar_tareas_actuales($idtareas_listado){
	global $conn,$ruta_db_superior;
	
	$tareas=busca_filtro_tabla("a.nombre_tarea","tareas_listado a","a.idtareas_listado=".$idtareas_listado,"a.fecha_planeada ASC",$conn);
	$cadena=ucfirst(strtolower($tareas[0]['nombre_tarea']));
	return($cadena);	
}

function mostrar_hora_tareas_actuales($idtareas_listado){
	global $conn,$ruta_db_superior;
	
	$tareas=busca_filtro_tabla(fecha_db_obtener("a.fecha_planeada","h:i %p")." AS hora_minutos_tarea,".fecha_db_obtener("a.fecha_planeada","H")." AS hora_tarea, a.nombre_tarea","tareas_listado a","a.idtareas_listado=".$idtareas_listado." ","a.fecha_planeada ASC",$conn);

	$cadena='';
	if($tareas['numcampos']){
		
		for($i=0;$i<$tareas['numcampos'];$i++){
			if($tareas[$i]['hora_tarea']!='00'){
				if($tareas[$i]['hora_tarea']==date('H')){
					$cadena.=$tareas[$i]['hora_minutos_tarea'];
				}
			}
		}		
	}
	return($cadena);	
}	


function mostrar_nombre_macroproceso($listado_tareas_fk){
	global $conn,$ruta_db_superior;

	$lista_macroproceso=busca_filtro_tabla("","listado_tareas a","a.idlistado_tareas=".$listado_tareas_fk,"",$conn);
	$macroproceso=busca_filtro_tabla("b.nombre as nombre_proceso, p.nombre as nombre_macro","serie b, serie p","b.cod_padre=p.idserie AND b.idserie IN(".$lista_macroproceso[0]['macro_proceso'].")","",$conn);
	
	$cadena='';
	for($i=0;$i<$macroproceso['numcampos'];$i++){
		$cadena.='. '.$macroproceso[$i]['nombre_macro'];
		if($i+1!=$macroproceso['numcampos']){
			$cadena.='<br>';
		}
	}
	return($cadena);
}


function mostrar_nombre_proceso($listado_tareas_fk){
	global $conn,$ruta_db_superior;

	$lista_macroproceso=busca_filtro_tabla("","listado_tareas a","a.idlistado_tareas=".$listado_tareas_fk,"",$conn);
	$macroproceso=busca_filtro_tabla("b.nombre as nombre_proceso, p.nombre as nombre_macro","serie b, serie p","b.cod_padre=p.idserie AND b.idserie IN(".$lista_macroproceso[0]['macro_proceso'].")","",$conn);
	
	$cadena='';
	for($i=0;$i<$macroproceso['numcampos'];$i++){
		$cadena.='. '.$macroproceso[$i]['nombre_proceso'];
		if($i+1!=$macroproceso['numcampos']){
			$cadena.='<br>';
		}
	}
	return($cadena);	
}

function condicion_reporte_estado_tareas_funcionario(){
	global $conn,$ruta_db_superior;	
	
	$condicion="a.estado=1 AND b.listado_tareas_fk=c.idlistado_tareas AND b.idtareas_listado=d.fk_tareas_listado AND (b.responsable_tarea=a.idfuncionario OR find_in_set('a.idfuncionario', b.co_participantes)) AND b.listado_tareas_fk<>-1 AND ".fecha_db_obtener("d.fecha_planeada","h %p")."='".date('h A')."' AND ".fecha_db_obtener("d.fecha_planeada","Y-m-d")."='".date('Y-m-d')."' ";
	return($condicion);
}

?>