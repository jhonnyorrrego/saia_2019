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
global $conn;
$usu_actual=usuario_actual("idfuncionario");

/*
if(isset($_REQUEST['nombre_tarea']) && $_REQUEST["opt"]==1){
	$info=busca_filtro_tabla("l.nombre_lista,t.idtareas_listado,t.nombre_tarea,t.descripcion_tarea","listado_tareas l JOIN tareas_listado t ON l.idlistado_tareas=t.listado_tareas_fk LEFT JOIN permiso_listado_tareas p ON p.fk_listado_tareas=l.idlistado_tareas and p.entidad_identidad=1"," (l.creador_lista=".$usu_actual." OR p.llave_entidad=".$usu_actual.") and (t.nombre_tarea like '".$_REQUEST["nombre_tarea"]."%' OR l.nombre_lista like '".$_REQUEST["nombre_tarea"]."%' )","nombre_lista,nombre_tarea",$conn);
	$html="<ul>";
	if($info['numcampos']){
		for($i=0;$i<$info['numcampos'];$i++){
			$descripcion=$info[$i]['nombre_lista']." - ".$info[$i]['nombre_tarea']." - ".substr($info[$i]['descripcion_tarea'], 0,50)."...";
			$html.="<li onclick=\"cargar_datos(".$info[$i]['idtareas_listado'].")\">".$descripcion."</li>";
		}
	}else{
		$html.="<li onclick=\"cargar_datos(0)\">NO se encuentra la tarea</li>";
	}
	$html.="</ul>";
	echo $html;
}*/

if($_REQUEST["opt"]==1){
	if(@$_REQUEST['select']){
    	$condicion_listado="";
    	if(@$_REQUEST['listado_tareas_fk']){
    		$condicion_listado=" AND a.idlistado_tareas=".$_REQUEST['listado_tareas_fk'];
    	}
    	$idserie_macro=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE 'macroprocesos%-%procesos'","",$conn);
    	$macro=busca_filtro_tabla("idserie","serie","cod_padre=".$idserie_macro[0]['idserie']." and estado=1","nombre",$conn);
    	$option='<option value="0" selected>Seleccione...</option>';
    	if($macro["numcampos"]){	
    		
    		$idserie_macro=extrae_campo($macro,"idserie");
    		$datos_admin_funcionario=busca_datos_administrativos_funcionario(0);
    		$identidad_series_funcionario=array_merge($datos_admin_funcionario["series_funcionario"],$datos_admin_funcionario["series_cargo"]);
    		$identidad_series_funcionario=array_unique($identidad_series_funcionario);
    		$cidseries_fun=busca_filtro_tabla("","entidad_serie","identidad_serie IN(".implode(',',$identidad_series_funcionario).")","",$conn);
    		$series_funcionario=extrae_campo($cidseries_fun,'serie_idserie');	
    		
    		$datos_macro_proceso=busca_filtro_tabla("s.idserie as idserie_proceso,sp.idserie as idserie_macro,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie AND sp.estado=1 and s.estado=1 and s.cod_padre in (".implode(",", $idserie_macro).") and s.idserie IN(".implode(',',$series_funcionario).")","sp.nombre",$conn);
    		
    		if($datos_macro_proceso['numcampos']){
    			for($j=0;$j<$datos_macro_proceso['numcampos'];$j++){
    				
    				$datos=busca_filtro_tabla("a.idlistado_tareas,a.nombre_lista","listado_tareas a","( a.macro_proceso=".$datos_macro_proceso[$j]['idserie_proceso']." )".$condicion_listado,"",$conn);
    				
    				if($datos['numcampos']){
    					for($i=0;$i<$datos['numcampos'];$i++){
    						
    						//$descripcion=$datos_macro_proceso[$j]['nombre_padre']." / ".$datos_macro_proceso[$j]['nombre']." - ".$datos[$i]['nombre_lista'];	
    						$tareas_del_listado=busca_filtro_tabla("nombre_tarea,idtareas_listado","tareas_listado","generica=1 AND listado_tareas_fk=".$datos[$i]['idlistado_tareas'],"nombre_tarea ASC",$conn);
    						
    						if($tareas_del_listado['numcampos']){
    							for($x=0;$x<$tareas_del_listado['numcampos'];$x++){
    								$option.='<option value="'.$tareas_del_listado[$x]['idtareas_listado'].'">'.$tareas_del_listado[$x]['nombre_tarea'].'</option>';
    							}
    						}
    					}									
    				}				
    				
    				$idlistados_anteriores=extrae_campo($datos,'idlistado_tareas');
    				
    				$datos_permiso=busca_filtro_tabla("a.idlistado_tareas,a.nombre_lista","listado_tareas a, permiso_listado_tareas b","a.idlistado_tareas=b.fk_listado_tareas AND b.llave_entidad=".usuario_actual('idfuncionario')." AND ( a.macro_proceso=".$datos_macro_proceso[$j]['idserie_proceso']." )".$condicion_listado,"",$conn);
    				
    				if($datos_permiso['numcampos']){
    					for($i=0;$i<$datos_permiso['numcampos'];$i++){
    						if(!in_array($datos_permiso[$i]['idlistado_tareas'], $idlistados_anteriores)){
    							$tareas_del_listado_permiso=busca_filtro_tabla("nombre_tarea,idtareas_listado","tareas_listado","generica=1 AND listado_tareas_fk=".$datos_permiso[$i]['idlistado_tareas'],"",$conn);		
    							
    							if($tareas_del_listado_permiso['numcampos']){
    								for($x=0;$x<$tareas_del_listado_permiso['numcampos'];$x++){
    									$option.='<option value="'.$tareas_del_listado_permiso[$x]['idtareas_listado'].'">'.$tareas_del_listado_permiso[$x]['nombre_tarea'].'</option>';
    								}
    							}							
    									
    						}
    					}									
    				}	//FIN ID DATOS_PERMISO			
    			}	//FIN FOR DATOS_MACROPROCESO		
    		} //FIN IF DATOS_MACROPROCESO NUMCAMPOS
    	} //fin IF MACRO NUMCAMPOS	
    	
    	echo($option);
    	
    } //FIN IF REQUEST SELECT	
    
    if(@$_REQUEST['autocompletar']){
        
    	$condicion_listado="";
    	if(@$_REQUEST['listado_tareas_fk']){
    		$condicion_listado=" AND a.idlistado_tareas=".$_REQUEST['listado_tareas_fk'];
    	}
    	$idserie_macro=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE 'macroprocesos%-%procesos'","",$conn);
    	$macro=busca_filtro_tabla("idserie","serie","cod_padre=".$idserie_macro[0]['idserie']." and estado=1","nombre",$conn);
    	$html="<ul>";
    	if($macro["numcampos"]){	
    		
    		$idserie_macro=extrae_campo($macro,"idserie");
    		$datos_admin_funcionario=busca_datos_administrativos_funcionario(0);
    		$identidad_series_funcionario=array_merge($datos_admin_funcionario["series_funcionario"],$datos_admin_funcionario["series_cargo"]);
    		$identidad_series_funcionario=array_unique($identidad_series_funcionario);
    		$cidseries_fun=busca_filtro_tabla("","entidad_serie","identidad_serie IN(".implode(',',$identidad_series_funcionario).")","",$conn);
    		$series_funcionario=extrae_campo($cidseries_fun,'serie_idserie');	
    		
    		$datos_macro_proceso=busca_filtro_tabla("s.idserie as idserie_proceso,sp.idserie as idserie_macro,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie AND sp.estado=1 and s.estado=1 and s.cod_padre in (".implode(",", $idserie_macro).") and s.idserie IN(".implode(',',$series_funcionario).")","sp.nombre",$conn);
    		
    		
    		
    		if($datos_macro_proceso['numcampos']){
    		    
    			for($j=0;$j<$datos_macro_proceso['numcampos'];$j++){
    				
    				$datos=busca_filtro_tabla("a.idlistado_tareas,a.nombre_lista","listado_tareas a","( a.macro_proceso=".$datos_macro_proceso[$j]['idserie_proceso']." )".$condicion_listado,"",$conn);
    				$cadena_fk_listado_tareas=implode(',',extrae_campo($datos,'idlistado_tareas'));
    				
    				$tareas_del_listado=busca_filtro_tabla("nombre_tarea,idtareas_listado","tareas_listado","nombre_tarea LIKE '%".@$_REQUEST['nombre_tarea']."%'AND generica=1 AND listado_tareas_fk IN(".$cadena_fk_listado_tareas.")","nombre_tarea ASC",$conn);
    						
    				if($tareas_del_listado['numcampos']){
    					for($x=0;$x<$tareas_del_listado['numcampos'];$x++){
    						$descripcion=$tareas_del_listado[$x]['nombre_tarea'];	
    					    $html.="<li onclick=\"cargar_datos_tareas_listado(".$tareas_del_listado[$x]['idtareas_listado'].",'".$descripcion."')\">".$descripcion."</li>";	
    					}
    				}
    								
    			}	//FIN FOR DATOS_MACROPROCESO		
    		} //FIN IF DATOS_MACROPROCESO NUMCAMPOS
    	} //fin IF MACRO NUMCAMPOS	        
        
        if($html=="<ul>"){
            $html.="<li onclick=\"cargar_datos_tareas_listado(0,'No se encontraron Tareas')\">No se encontraron Tareas</li>";	
        }
        
        $html.="</ul>";
        echo($html);
        
        
        
        
    }
}


if(isset($_REQUEST['idtareas_listado']) && $_REQUEST["opt"]==3){
	
	
	$tarea_listado=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST['idtareas_listado'],"",$conn);
	
	$retorno=array();
	$retorno['nombre_tarea']=$tarea_listado[0]['nombre_tarea'];
	$retorno['info_recurrencia']=$tarea_listado[0]['info_recurrencia'];
	$retorno['prioridad']=$tarea_listado[0]['prioridad'];
	$retorno['tiempo_estimado']=$tarea_listado[0]['tiempo_estimado'];
	$vector_tiempo_estimado=explode(':',$tarea_listado[0]['tiempo_estimado']);
	$retorno['tiempo_estimado_h']=$vector_tiempo_estimado[0];
	$retorno['tiempo_estimado_i']=$vector_tiempo_estimado[1];
	$retorno['idtareas_listado']=$_REQUEST['idtareas_listado'];
	
	$lista_editar=$tarea_listado[0]["listado_tareas_fk"];		
	$listado_tareas=busca_filtro_tabla("idlistado_tareas,nombre_lista,macro_proceso","listado_tareas","idlistado_tareas=".$lista_editar,"",$conn);			
	$datos_macro_proceso=busca_filtro_tabla("s.idserie as idserie_proceso,sp.idserie as idserie_macro,s.nombre,sp.nombre as nombre_padre","serie s, serie sp","s.cod_padre=sp.idserie AND s.idserie=".$listado_tareas[0]['macro_proceso']."  and sp.estado=1 and s.estado=1","sp.nombre",$conn);			
	$id=$lista_editar;	
	$descripcion=$datos_macro_proceso[0]['nombre_padre']." / ".$datos_macro_proceso[0]['nombre']." - ".$listado_tareas[0]['nombre_lista'];
	$cadena = "<table id='informacion_buscar_radicado_listado_tareas'><tr id='fila_listado_tareas_" . $id . "'><td>" . $descripcion . "</td><td><img style='cursor:pointer' src='" . $ruta_db_superior . "imagenes/eliminar_nota.gif' id='icono_eliminar_".$lista_editar."' registro='" . $id . "' onclick='eliminar_asociado_listado_tareas(" . $id . ");'></td></tr></table>";			
	$retorno['descripcion_proceso_listado']=$cadena;
	$retorno['listado_tareas_fk']=$lista_editar;
	echo json_encode($retorno);
}



if(isset($_REQUEST['idtarea']) && $_REQUEST["opt"]==2){
	$retorno=array(); $retorno["exito"]=0; $retorno["msn"]="";
	$campos=array("nombre_tarea","tipo_tarea","descripcion_tarea","prioridad","enviar_email");
	$info=busca_filtro_tabla(implode(",", $campos),"tareas_listado","idtareas_listado=".$_REQUEST["idtarea"],"",$conn);
	if($info["numcampos"]){
		foreach ($campos as $nombre) {
			$retorno[$nombre]=codifica_encabezado(html_entity_decode($info[0][$nombre]));
		}
		$info_recurrencia=busca_filtro_tabla("idtareas_listado_recur","tareas_listado_recur","fk_tareas_listado=".$_REQUEST["idtarea"],"",$conn);
		
		if($info_recurrencia['numcampos']){
			$retorno['idtareas_listado_recur']=$info_recurrencia[0]['idtareas_listado_recur'];
		}
		$retorno["exito"]=1;
	}else{
		$retorno["msn"]="Error al cargar los datos";
	}
	echo json_encode($retorno);
}
?>