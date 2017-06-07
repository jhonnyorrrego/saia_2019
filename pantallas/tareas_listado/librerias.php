<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once(dirname(__FILE__)."/../../db.php");


//----------------------------------
function mostrar_tipo_tarea($tipo_tarea){
	$cadena="";	
	switch ($tipo_tarea) {
		case 1:
			$cadena="Personal";
		break;	
		case 2:
			$cadena="Cumplimiento";
		break;	
		case 3:
			$cadena="Rutinaria";
		break;	
	}
	return $cadena;
}

function mostrar_funcionarios($idfuncionarios,$vector=false){
	$separados= explode(",", $idfuncionarios);
	$vector_funcionarios=array();
	$cadena='';
	
	for ($i=0; $i < count($separados) ; $i++) { 
		$serie=busca_filtro_tabla("","funcionario","idfuncionario=".$separados[$i],"",$conn);

		if($vector){
			$vector_funcionarios[]=$serie[0]['nombres']." ".$serie[0]['apellidos'];
		}else{
			$cadena.=$serie[0]['nombres']." ".$serie[0]['apellidos'].",";
		}	
	}

	if($vector){
		return $vector_funcionarios;
	}else{
		return $cadena;
	}	
	
	
}

function mostrar_prioridad_tarea($idtarea, $prioridad,$progreso,$tipo_mostrar=0){
	$cadena="";	
	if($prioridad =="0"){ 
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-amarillo'></i> <span id='span-prioridad_".$idtarea."'>Baja</span> &nbsp; &nbsp;<span class='pull-right' id='progreso_titulo_".$idtarea."'>".$progreso."%</span>" ;
		$cadena2="Baja";
	}
	if($prioridad =="1"){
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-naranja'></i> <span id='span-prioridad_".$idtarea."'>Media</span> &nbsp; &nbsp;<span class='pull-right' id='progreso_titulo_".$idtarea."'>".$progreso."%</span>";
		$cadena2="Media";
	}
	if($prioridad =="2"){
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-morado'></i> <span id='span-prioridad_".$idtarea."'>Alta</span> &nbsp; &nbsp;<span class='pull-right' id='progreso_titulo_".$idtarea."'>".$progreso."%</span>";
		$cadena2="Alta";
	}
	if($prioridad =="3"){
		$cadena="<i id='icon-prioridad_".$idtarea."' class='icon-flag-rojo'></i>  <span id='span-prioridad_".$idtarea."'>Cr&iacute;tica</span>&nbsp; &nbsp; <span class='pull-right' id='progreso_titulo_".$idtarea."'>".$progreso."%</span>";
		$cadena2="Cr&iacute;tica";
	}

	$cadena="<span class='pull-right'>".$cadena."</span>";
	if($tipo_mostrar==1){
		$cadena=$cadena2;
	}
	return $cadena;
}

function condicion_actualizar_responsable(){
	global $ruta_db_superior;
	
	return("generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 AND a.responsable_tarea=".usuario_actual('idfuncionario'));

}
function condicion_actualizar_coparticipante(){
	global $ruta_db_superior;
	$funcionario_idfuncionario=usuario_actual('idfuncionario');
	$condicion_coparticipantes_unico=" AND ( a.co_participantes LIKE '%,".$funcionario_idfuncionario.",%' OR a.co_participantes LIKE '%,".$funcionario_idfuncionario."' OR a.co_participantes LIKE '".$funcionario_idfuncionario.",%' OR  a.co_participantes='".$funcionario_idfuncionario."' )";
	return("generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 ".$condicion_coparticipantes_unico);

}
function condicion_actualizar_seguidor(){
	global $ruta_db_superior;
	$funcionario_idfuncionario=usuario_actual('idfuncionario');
	$condicion_seguidores_unico=" AND ( a.seguidores LIKE '%,".$funcionario_idfuncionario.",%' OR a.seguidores LIKE '%,".$funcionario_idfuncionario."' OR a.seguidores LIKE '".$funcionario_idfuncionario.",%' OR  a.seguidores='".$funcionario_idfuncionario."' )";
	return("generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 ".$condicion_seguidores_unico);

}
function condicion_actualizar_evaluador(){
	global $ruta_db_superior;
	
	return("generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 AND a.evaluador=".usuario_actual('idfuncionario'));

}
function usuario_actual_codigo(){
	return usuario_actual('idfuncionario');
}

function condicion_actualizar_tareas_total(){
		
	$funcionario_idfuncionario=usuario_actual('idfuncionario');
	$condicion_coparticipantes=" OR ( a.co_participantes LIKE '%,".$funcionario_idfuncionario.",%' OR a.co_participantes LIKE '%,".$funcionario_idfuncionario."' OR a.co_participantes LIKE '".$funcionario_idfuncionario.",%' OR  a.co_participantes='".$funcionario_idfuncionario."' )";
	$condicion_seguidores=" OR ( a.seguidores LIKE '%,".$funcionario_idfuncionario.",%' OR a.seguidores LIKE '%,".$funcionario_idfuncionario."' OR a.seguidores LIKE '".$funcionario_idfuncionario.",%' OR  a.seguidores='".$funcionario_idfuncionario."' )";
	$condicion_evaluador=" OR a.evaluador=".$funcionario_idfuncionario;
	$condicion_tareas_total="generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 AND ( a.responsable_tarea=".$funcionario_idfuncionario."".$condicion_coparticipante.$condicion_coparticipantes.$condicion_seguidores.$condicion_evaluador."  )"; 
	return($condicion_tareas_total);
}


?>