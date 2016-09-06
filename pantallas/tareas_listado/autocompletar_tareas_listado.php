<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."class.funcionarios.php");


if(@$_REQUEST['nombre_tarea']){
	
	
	if(@$_REQUEST['rol_tareas']){
		switch($_REQUEST['rol_tareas']){
			case 'todos':
				$condicion="a.cod_padre=0 AND a.estado_tarea<>'TERMINADO' AND (a.responsable_tarea=".usuario_actual('idfuncionario');
				$condicion.=" OR FIND_IN_SET('".usuario_actual('idfuncionario')."', a.co_participantes)";
				$condicion.=" OR FIND_IN_SET('".usuario_actual('idfuncionario')."', a.seguidores)";
				$condicion.=" OR a.evaluador=".usuario_actual('idfuncionario');
				$condicion.=")";				
				break;
			case 'seguidor':
				$condicion="a.cod_padre=0  AND (a.listado_tareas_fk<>-1 AND  FIND_IN_SET('".usuario_actual('idfuncionario')."', a.seguidores) )";
				break;
				
			case 'coparticipante':
				$condicion="a.cod_padre=0  AND (a.listado_tareas_fk<>-1 AND  FIND_IN_SET('".usuario_actual('idfuncionario')."', a.co_participantes) )";
				break;	
			case 'responsable':
				$condicion="a.cod_padre=0  AND (a.listado_tareas_fk<>-1 AND  a.responsable_tarea=".usuario_actual('idfuncionario')." )";
				break;	
 			case 'evaluador':
				$condicion="a.cod_padre=0  AND (a.listado_tareas_fk<>-1 AND  a.evaluador=".usuario_actual('idfuncionario')." )";
				break;	
 			case 'tareas_rapidas':
				$condicion="a.cod_padre=0  AND (a.listado_tareas_fk=-1 AND  a.creador_tarea=".usuario_actual('idfuncionario')." )";
				break;				
 			case 'tareas_vencidas':
 				$fecha=date('Y-m-d');
				$fecha_final = strtotime ( "-1 day" , strtotime ( $fecha ) ) ;	
				$fecha_validar = date ( 'Y-m-d' , $fecha_final ); 			
				$condicion="a.fecha_limite<>'0000-00-00' AND a.cod_padre=0  AND (a.listado_tareas_fk<>-1 AND a.estado_tarea IN('PENDIENTE','EJECUCION') AND a.fecha_limite<='".$fecha_validar."' AND a.responsable_tarea=".usuario_actual('idfuncionario')." )";
				break;	
 			case 'tareas_terminadas':
				$condicion="a.cod_padre=0  AND (a.estado_tarea='TERMINADO' AND a.listado_tareas_fk<>-1  AND a.responsable_tarea=".usuario_actual('idfuncionario')." )";
				break;
 			case 'tarea_unica':
				$condicion=" a.idtareas_listado=".@$_REQUEST['idtareas_listado_unico'];
				break;					
			default:
				$condicion='1=1';	
				break;											
		}	
	}	

	$condicion.=" AND a.generica=0"; //TAREAS PREDETERMINADA NO LAS MUESTRA
	$tareas=busca_filtro_tabla("a.*","tareas_listado a","lower(a.nombre_tarea) LIKE '%".strtolower($_REQUEST['nombre_tarea'])."%' AND ".$condicion,"",$conn);
	
	$html.="<ul>";
	if($tareas['numcampos']){
		for($i=0;$i<$tareas['numcampos'];$i++){
			
			$datos_listado=busca_filtro_tabla("macro_proceso","listado_tareas","idlistado_tareas=".$tareas[$i]['listado_tareas_fk'],"",$conn);
			
			$datos_macro_proceso=busca_filtro_tabla("s.nombre as nombre_proceso,sp.nombre as nombre_macro","serie s, serie sp","s.cod_padre=sp.idserie AND sp.estado=1 and s.estado=1 AND s.idserie=".$datos_listado[0]['macro_proceso'],"sp.nombre",$conn);
			if($datos_macro_proceso['numcampos']){
				$descripcion=$datos_macro_proceso[0]['nombre_macro'].'/'.$datos_macro_proceso[0]['nombre_proceso'].' - '.$tareas[$i]['nombre_tarea'];
			}else{
				$descripcion=$tareas[$i]['nombre_tarea'];
			}
			
			$html.="<li onclick=\"cargar_datos_tareas(".$tareas[$i]['idtareas_listado'].",'".$descripcion."')\">".$descripcion."</li>";	
		}
	}else{
		$html.="<li onclick=\"cargar_datos_tareas(0)\">NO hay tareas con el nombre ingresado</li>";
	}
	$html.="</ul>";
	echo($html);
	
}






?>