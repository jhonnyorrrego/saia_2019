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

include_once($ruta_db_superior."db.php");

function mostrar_tipo_origen_reporte($tipo_origen){
    global $ruta_db_superior, $conn;
    
    if($tipo_origen==1){
        return "Externo";
    }else{
        return "Interno";
    }
}

function mostrar_origen_reporte($idft_radicacion_entrada){
    global $ruta_db_superior, $conn;
    
    $datos=busca_filtro_tabla('','ft_radicacion_entrada','idft_radicacion_entrada='.$idft_radicacion_entrada,'',conn);
    
    if($datos[0]['tipo_origen']==1){
        $origen=busca_filtro_tabla("b.nombre","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[0]['persona_natural'],"",$conn);

    }else{
    	$array_concat=array("nombres","' '","apellidos");
		$cadena_concat=concatenar_cadena_sql($array_concat);
        $origen=busca_filtro_tabla($cadena_concat." AS nombre","vfuncionario_dc","iddependencia_cargo=".$datos[0]['area_responsable'],"",$conn);
    }
    return ($origen[0]['nombre']);
}

function mostrar_destino_reporte($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
    $datos=busca_filtro_tabla('tipo_destino,nombre_destino,destino_externo','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',$conn);
    
    if($datos[0]['tipo_destino']==1){
        $destino=busca_filtro_tabla("b.nombre","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[0]['nombre_destino'],"",$conn);
        if(!$destino['numcampos']){
        	$destino=busca_filtro_tabla("b.nombre","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[0]['destino_externo'],"",$conn);
        }		
    }else{
    	$array_concat=array("nombres","' '","apellidos");
		$cadena_concat=concatenar_cadena_sql($array_concat);    	
        $destino=busca_filtro_tabla($cadena_concat." AS nombre","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
    }
    return ($destino[0]['nombre']);
    
}

function mostrar_ruta_reporte($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
	$datos=busca_filtro_tabla('tipo_origen,estado_recogida,nombre_origen,tipo_destino,nombre_destino','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',$conn);
	
	$texto_nombre_ruta='';
    
    if($datos[0]['tipo_origen']==2 && !$datos[0]['estado_recogida']){  //SI ES RECOGIDA
    	$iddependencia=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_origen'],"",$conn);
		$nombre_ruta=busca_filtro_tabla("a.nombre_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$iddependencia[0]['iddependencia'],"",$conn);
		$texto_nombre_ruta=$nombre_ruta[0]['nombre_ruta'];
    }else if($datos[0]['tipo_destino']==2 && $datos[0]['estado_recogida']){  //SI ES ENTREGA INTERNA POSTERIOR A RECOGIDA
    	$iddependencia=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
		$nombre_ruta=busca_filtro_tabla("a.nombre_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$iddependencia[0]['iddependencia'],"",$conn);
		$texto_nombre_ruta=$nombre_ruta[0]['nombre_ruta'];
    }else if($datos[0]['tipo_origen']==1 && $datos[0]['tipo_destino']==2){  //SI ES ENTREGA INTERNA DE UN ORIGEN EXTERNO
    	$iddependencia=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
		$nombre_ruta=busca_filtro_tabla("a.nombre_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$iddependencia[0]['iddependencia'],"",$conn);
		$texto_nombre_ruta=$nombre_ruta[0]['nombre_ruta'];	
    }else if($datos[0]['tipo_destino']==1 && $datos[0]['estado_recogida']){
    	$texto_nombre_ruta='Ruta Externa';
    }    
	return($texto_nombre_ruta);
}

function planilla_mensajero($idft_destino_radicacion,$mensajero_encargado,$estado_item){
    global $ruta_db_superior, $conn;
    $html="";
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($mensajero_encargado=='mensajero_encargado'){
        $html.="No tiene planilla asociada"; //Pendiente
    }else{
        $condicion_item=" AND ( iddestino_radicacion LIKE '%,".$idft_destino_radicacion.",%' OR iddestino_radicacion LIKE '%,".$idft_destino_radicacion."' OR  iddestino_radicacion LIKE '".$idft_destino_radicacion.",%' OR  iddestino_radicacion='".$idft_destino_radicacion."')"; 
        $planillas=busca_filtro_tabla("c.numero,c.iddocumento","ft_despacho_ingresados b, documento c","b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') ".$condicion_item,"",$conn);
        
        if($planillas['numcampos']){
            for($i=0;$i<$planillas['numcampos'];$i++){
                $html.='<div class="link kenlace_saia" enlace="ordenar.php?key='.$planillas[$i]['iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$planillas[$i]['numero'].'"><center><span class="badge">'.$planillas[$i]['numero']."</span></center></div>\n";
            }
        }else{
            $html="No tiene planilla asociada"; //No se han generado planillas
        }
    }
    return $html;
}
function planilla_mensajero2($idft_destino_radicacion,$mensajero_encargado,$estado_item){
    global $ruta_db_superior, $conn;
    $html="";
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($mensajero_encargado=='mensajero_encargado'){
        $html.="Pendiente";
    }else{
    	$tipo_mensajero=busca_filtro_tabla("tipo_mensajero","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
		if($tipo_mensajero[0]['tipo_mensajero']=="0"){
			$tipo_mensajero[0]['tipo_mensajero']='i';
            }
		
		
        $html.="<input type='checkbox' class='planilla_mensajero' ".$disable." mensajero='".$mensajero_encargado."-".$tipo_mensajero[0]['tipo_mensajero']."' value='$idft_destino_radicacion'>";
    }
    return $html;
}

function mostrar_mensajeros_dependencia($idft_destino_radicacion,$estado_item){
    global $ruta_db_superior, $conn;
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $array_concat=array("nombres","' '","apellidos");
	$cadena_concat=concatenar_cadena_sql($array_concat);     
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo, ".$cadena_concat." AS nombre","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($cargo[0]['cargo']=="mensajero"){
        $select.="<input type='text' name='responsable_{$idft_destino_radicacion}' value='".$cargo[0]['nombre']."' readonly>";
    }else{  
    $datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',conn);
	
	$tipo_mensajeria_radicacion=busca_filtro_tabla("tipo_mensajeria,area_responsable,tipo_destino","ft_radicacion_entrada","idft_radicacion_entrada=".$datos[0]['ft_radicacion_entrada'],"",$conn);
	
	if(($tipo_mensajeria_radicacion[0]['tipo_mensajeria']==2  || $tipo_mensajeria_radicacion[0]['tipo_mensajeria']==1) && !$datos[0]['estado_recogida']){
		$datos[0]['nombre_destino']=$tipo_mensajeria_radicacion[0]['area_responsable'];
	}else if($datos[0]['estado_recogida'] && $tipo_mensajeria_radicacion[0]['tipo_destino']==1){
		$destino_externo=busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","lower(cargo) LIKE 'mensajer%extern%' AND estado_dc=1","",$conn);
		$datos[0]['nombre_destino']=$destino_externo[0]['iddependencia_cargo'];
	}
	
    if($datos[0]['estado_recogida'] && $tipo_mensajeria_radicacion[0]['tipo_destino']==1){
    	$array_concat=array("nombres","' '","apellidos");
    	$cadena_concat=concatenar_cadena_sql($array_concat);
    	$mensajeros_externos=busca_filtro_tabla("iddependencia_cargo as id,".$cadena_concat." AS nombre","vfuncionario_dc","lower(cargo) LIKE 'mensajer%extern%' AND estado_dc=1","",$conn);
		
		$array_mensajeros_externos=array();
		for($me=0;$me<$mensajeros_externos['numcampos'];$me++){
			$array_mensajeros_externos[$me]['id']=$mensajeros_externos[$me]['id'].'-i';
			$array_mensajeros_externos[$me]['nombre']=$mensajeros_externos[$me]['nombre'];
		}

		$empresas_transportadoras=busca_filtro_tabla("idcf_empresa_trans as id,nombre","cf_empresa_trans","","",$conn);
		for($me=0;$me<$empresas_transportadoras['numcampos'];$me++){
			$array_mensajeros_externos[$me+$mensajeros_externos['numcampos']]['id']=$empresas_transportadoras[$me]['id'].'-e';
			$array_mensajeros_externos[$me+$mensajeros_externos['numcampos']]['nombre']=$empresas_transportadoras[$me]['nombre'];
		}


		$responsable['numcampos']=0;
    }else{
    	$destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
		$responsable=busca_filtro_tabla("mensajero_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$destino[0]['iddependencia'],"",$conn);
	}
    $select="<select class='mensajeros' ".$disable." data-idft='$idft_destino_radicacion' name='responsable_{$idft_destino_radicacion}' style='width:150px;'>";
    
	
    
    if($responsable['numcampos']==1){
    		$array_concat=array("nombres","' '","apellidos");
			$cadena_concat=concatenar_cadena_sql($array_concat);             
            $mensajero=busca_filtro_tabla($cadena_concat." AS nombre","vfuncionario_dc","iddependencia_cargo=".$responsable[0]['mensajero_ruta'],"",$conn);
            
            if($responsable[0]['mensajero_ruta']==$datos[0]['mensajero_encargado']){
                $select.="<option value='".$responsable[0]['mensajero_ruta']."-i' selected>".$mensajero[0]['nombre']."</option>";
            }else{
            	$select.="<option value='' selected>Seleccione</option>";
                $select.="<option value='".$responsable[0]['mensajero_ruta']."-i'>".$mensajero[0]['nombre']."</option>";
            }
    }else if(count($array_mensajeros_externos)){
    	$select.="<option value='' selected>Seleccione</option>";
    	
		for($me=0;$me<count($array_mensajeros_externos);$me++){
			$selected='';
			if($array_mensajeros_externos[$me]['id']==$datos[0]['mensajero_encargado'].'-'.$datos[0]['tipo_mensajero']){
				$selected='selected';
			}	
				
			$select.="<option value='".$array_mensajeros_externos[$me]['id']."' ".$selected.">".$array_mensajeros_externos[$me]['nombre']."</option>";
		}    	
    
    }else{
        
        $select.="<option value=''>Seleccione</option>";
        for($i=0;$i<$responsable['numcampos'];$i++){
    		$array_concat=array("nombres","' '","apellidos");
			$cadena_concat=concatenar_cadena_sql($array_concat);          	
            $mensajero=busca_filtro_tabla($cadena_concat." AS nombre","vfuncionario_dc","iddependencia_cargo={$responsable[$i]['mensajero_ruta']}","",$conn);
            if($responsable[$i]['mensajero_ruta']==$datos[0]['mensajero_encargado']){
                $select.="<option value='".$responsable[$i]['mensajero_ruta']."-i' selected>".$mensajero[0]['nombre']."</option>";
            }else{
                $select.="<option value='".$responsable[$i]['mensajero_ruta']."-i'>".$mensajero[0]['nombre']."</option>";
            }
            
        }
        
    }
    }
    $select.="</select>";
    return $select;
}

function ver_items($iddocumento, $numero,$fecha_radicacion_entrada,$tipo) {
    if($tipo==1){
        $radic="E";
    }elseif($tipo==2){
        $radic="I";
    }
    $dateTime = strtotime($fecha_radicacion_entrada);

  return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$numero.'"><center><span class="badge">'.date('Y-m-d', $dateTime)."-".$numero."-".$radic.'</span></center></div>');
} 


function condicion_adicional(){
    global $ruta_db_superior, $conn;
    
    $condicion="";
    if(@$_REQUEST['variable_busqueda']){
		$vector_mensajero=explode('-',$_REQUEST['variable_busqueda']);
        $condicion=" AND B.mensajero_encargado=".$vector_mensajero[0]." AND B.tipo_mensajero='".$vector_mensajero[1]."'";
    }
    return $condicion;
}

function filtrar_mensajero(){
    global $ruta_db_superior, $conn;
    
    $select="<select class='pull-left btn btn-mini dropdown-toggle' style='height:22px; margin-left: 10px;' name='filtro_mensajeros' id='filtro_mensajeros'>";
    $select.="<option value=''>Todos Los Mensajeros</option>";
	$array_concat=array("nombres","' '","apellidos");
	$cadena_concat=concatenar_cadena_sql($array_concat);
    $datos=busca_filtro_tabla("iddependencia_cargo, ".$cadena_concat." AS nombre","vfuncionario_dc","lower(cargo)='mensajero' AND estado_dc=1","",$conn);
    $filtrar_mensajero=@$_REQUEST['variable_busqueda'];
    for($i=0;$i<$datos['numcampos'];$i++){
        $selected='';	
		if($filtrar_mensajero){
			if($filtrar_mensajero==$datos[$i]['iddependencia_cargo']."-i"){
				$selected='selected';
			}
		}	
			
        $select.="<option value='".$datos[$i]['iddependencia_cargo']."-i' ".$selected.">".$datos[$i]['nombre']."&nbsp;-&nbsp;Mensajero</option>";
		
    }

	$mensajeros_externos=busca_filtro_tabla("iddependencia_cargo, ".$cadena_concat." AS nombre","vfuncionario_dc","lower(cargo) LIKE 'mensajer%extern%' AND estado_dc=1","",$conn);
	
    for($i=0;$i<$mensajeros_externos['numcampos'];$i++){
        $selected='';	
		if($filtrar_mensajero){
			if($filtrar_mensajero==$mensajeros_externos[$i]['iddependencia_cargo']."-i"){
				$selected='selected';
	}
		}	
			
        $select.="<option value='".$mensajeros_externos[$i]['iddependencia_cargo']."-i' ".$selected.">".$mensajeros_externos[$i]['nombre']."&nbsp;-&nbsp;Mensajero Externo</option>";
		
    }
	
	
	$empresas_transportadoras=busca_filtro_tabla("idcf_empresa_trans as id,nombre","cf_empresa_trans","","",$conn);
    for($i=0;$i<$empresas_transportadoras['numcampos'];$i++){
        $selected='';	
		if($filtrar_mensajero){
			if($filtrar_mensajero==$empresas_transportadoras[$i]['id']."-e"){
				$selected='selected';
			}
		}	
			
        $select.="<option value='".$empresas_transportadoras[$i]['id']."-e' ".$selected.">".$empresas_transportadoras[$i]['nombre']."&nbsp;-&nbsp;Empresa Transportadora</option>";
		
    }		

    $select.="</select>";
	
    return $select;
}


function aceptar_recepcion($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
    $datos=busca_filtro_tabla("","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo, iddependencia_cargo","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    
    if($datos[0]['recepcion']!=0){
        $input="<input type='checkbox' id='recepcion' data-idftidft='$idft_destino_radicacion' value='".$cargo[0]['iddependencia_cargo']."' checked disabled>";
        $funcionario=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$datos[0]['recepcion'],"",$conn);
        $input.="</br>".$funcionario[0]['nombres']." ".$funcionario[0]['apellidos']."<br>".$datos[0]['recepcion_fecha'];
    }else{
        //$planillas=busca_filtro_tabla("c.numero,c.iddocumento","ft_item_despacho_ingres a,ft_despacho_ingresados b, documento c","a.ft_despacho_ingresados=b.idft_despacho_ingresados AND b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') AND a.ft_destino_radicacio=".$idft_destino_radicacion,"",$conn);
	$condicion_item=" AND ( iddestino_radicacion LIKE '%,".$idft_destino_radicacion.",%' OR iddestino_radicacion LIKE '%,".$idft_destino_radicacion."' OR  iddestino_radicacion LIKE '".$idft_destino_radicacion.",%' OR  iddestino_radicacion='".$idft_destino_radicacion."')";
        $planillas=busca_filtro_tabla("c.numero,c.iddocumento","ft_despacho_ingresados b, documento c","b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') ".$condicion_item,"",$conn);
        if($planillas['numcampos']){
            $input="<input type='checkbox' name='recepcion[]' value='".$idft_destino_radicacion.'|'.$cargo[0]['iddependencia_cargo']."|".$datos[0]['ft_radicacion_entrada']."'>";
        }else{
           $input="Pendiente planilla";
       }
        
    }
    return $input;
}



function condicion_adicional_indicadores(){
	global $conn;	
	
	$condicion_adicional_indicadores='';
	if(@$_REQUEST['idbusqueda_grafico']){
		$graficos=busca_filtro_tabla("","busqueda_grafico A,busqueda_grafico_serie B","A.idbusqueda_grafico=B.busqueda_grafico_idbusqueda_grafico AND A.idbusqueda_grafico=".@$_REQUEST["idbusqueda_grafico"]." AND A.estado=1","",$conn);
		if($graficos['numcampos']){
			if($graficos[0]["condicion_adicional"]!=''){
				$condicion_adicional_indicadores=$graficos[0]["condicion_adicional"];
			}
		}		
	}
	return($condicion_adicional_indicadores);
}
function mostrar_cantidad_origen_interno(){
	global $conn;
		
	$where='';
	if(@$_REQUEST["idbusqueda_filtro_temp"]){
		$datos_adicional=busca_filtro_tabla("","busqueda_filtro_temp A","A.idbusqueda_filtro_temp=".$_REQUEST["idbusqueda_filtro_temp"],"",$conn);
		$where=" AND (".parsear_cadena_condicion(stripslashes($datos_adicional[0]["detalle"])).")";
	}
	$consulta_interno=busca_filtro_tabla("","documento d,ft_radicacion_entrada a, ft_destino_radicacion b, vfuncionario_dc c","(lower(d.estado)='aprobado' and a.despachado=1 and a.documento_iddocumento=d.iddocumento and a.idft_radicacion_entrada=b.ft_radicacion_entrada and a.tipo_destino=2 and b.nombre_destino=c.iddependencia_cargo and b.tipo_destino=2  AND a.tipo_origen<>1  ) ".$where,"",$conn);
	$cadena='<div style="text-align:center;font-size:25pt;font-weight:bold">&nbsp;&nbsp;&nbsp;'.$consulta_interno['numcampos'].'</div>';
	echo($cadena);	
}
function mostrar_cantidad_origen_externo(){
	global $conn;

	$where='';
	if(@$_REQUEST["idbusqueda_filtro_temp"]){
		$datos_adicional=busca_filtro_tabla("","busqueda_filtro_temp A","A.idbusqueda_filtro_temp=".$_REQUEST["idbusqueda_filtro_temp"],"",$conn);
		$where=" AND (".parsear_cadena_condicion(stripslashes($datos_adicional[0]["detalle"])).")";
	}
	$consulta_externo=busca_filtro_tabla("","documento d,ft_radicacion_entrada a, ft_destino_radicacion b, vfuncionario_dc c","(lower(d.estado)='aprobado' and a.despachado=1 and a.documento_iddocumento=d.iddocumento and a.idft_radicacion_entrada=b.ft_radicacion_entrada and a.tipo_destino=2 and b.nombre_destino=c.iddependencia_cargo and b.tipo_destino=2  AND a.tipo_origen=1  ) ".$where,"",$conn);
	$cadena='<div style="text-align:center;font-size:25pt;font-weight:bold">&nbsp;&nbsp;&nbsp;'.$consulta_externo['numcampos'].'</div>';
	echo($cadena);		
}
function parsear_cadena_condicion($cadena1){
global $conn;
$cadena1=str_replace("|+|"," AND ",$cadena1);
$cadena1=str_replace("|=|"," = ",$cadena1);
$cadena1=str_replace("|like|"," like ",$cadena1);
$cadena1=str_replace("|-|"," OR ",$cadena1);
$cadena1=str_replace("|<|"," < ",$cadena1);
$cadena1=str_replace("|>|"," > ",$cadena1);
$cadena1=str_replace("|>=|"," >= ",$cadena1);
$cadena1=str_replace("|<=|"," <= ",$cadena1);
$cadena1=str_replace("|in|"," in ",$cadena1);
$cadena1=str_replace("||"," LIKE ",$cadena1);
return $cadena1;
}
function mostrar_estado_finalizado($idft_destino_radicacion,$nombre_estado){
    global $ruta_db_superior, $conn;
 
    $datos=busca_filtro_tabla("","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);    
    if($datos[0]['recepcion']!=0){
        $input=$nombre_estado;
        $funcionario=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$datos[0]['recepcion'],"",$conn);
        $input.="</br>".$funcionario[0]['nombres']." ".$funcionario[0]['apellidos']."<br>".$datos[0]['recepcion_fecha'];
    }
    return $input;
}

function mostrar_tramite_radicacion($idft_destino_radicacion,$tipo_mensajeria,$estado_recogida){
    global $ruta_db_superior, $conn;
	
	$tramite='ENTREGA';
	if(($tipo_mensajeria==2 || $tipo_mensajeria==1) && ($estado_recogida==0 || $estado_recogida=='estado_recogida') ){
		$tramite='RECOGIDA';
	}
	return($tramite);
}
function generar_accion_destino_radicacion($idft_destino_radicacion,$mensajero_encargado,$estado_item){
    global $ruta_db_superior, $conn;	

    $html="";
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($mensajero_encargado=='mensajero_encargado'){
        $html.="Pendiente";
    }else{
    	$tipo_mensajero=busca_filtro_tabla("tipo_mensajero","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
		if($tipo_mensajero[0]['tipo_mensajero']=="0"){
			$tipo_mensajero[0]['tipo_mensajero']='i';
            }
		
		
        $html.="<input type='checkbox' class='planilla_mensajero' ".$disable." mensajero='".$mensajero_encargado."-".$tipo_mensajero[0]['tipo_mensajero']."' value='$idft_destino_radicacion'>";
    }
    return $html;


}
function generar_accion_destino_radicacion_endistribucion($idft_destino_radicacion,$mensajero_encargado,$estado_item){
    global $ruta_db_superior, $conn;	


    $datos=busca_filtro_tabla("ft_radicacion_entrada","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo, iddependencia_cargo","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);


    $html="";
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($mensajero_encargado=='mensajero_encargado'){
        $html.="Pendiente";
    }else{
    	$tipo_mensajero=busca_filtro_tabla("tipo_mensajero","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
		if($tipo_mensajero[0]['tipo_mensajero']=="0"){
			$tipo_mensajero[0]['tipo_mensajero']='i';
            }
		
		
		$check_guia="<input type='checkbox' class='asignar_planilla_finalizar' value='".$idft_destino_radicacion."' >";
		$input="<input style='display:none;' id='endistribucion_f_".$idft_destino_radicacion."' type='checkbox' name='recepcion[]' value='".$idft_destino_radicacion.'|'.$cargo[0]['iddependencia_cargo']."|".$datos[0]['ft_radicacion_entrada']."'>";
        $html.=$check_guia.$input."<input style='display:none;' id='endistribucion_p_".$idft_destino_radicacion."' type='checkbox' class='planilla_mensajero' ".$disable." mensajero='".$mensajero_encargado."-".$tipo_mensajero[0]['tipo_mensajero']."' value='$idft_destino_radicacion'>";
    }
    return $html;


}
function mostrar_estado_destino_radicacion($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
	
	$mensaje_retorno='';
	$estado_destino_radicacion=busca_filtro_tabla("estado_item","ft_destino_radicacion","idft_destino_radicacion=".$idft_destino_radicacion,"",$conn);
	if(intval($estado_destino_radicacion[0]['estado_item'])==3){
		$mensaje_retorno='Finalizado';
	}else{
		$like_destino_radicacion=generar_cadena_like_comas('a.iddestino_radicacion',$idft_destino_radicacion);
		$tiene_planilla=busca_filtro_tabla("a.idft_despacho_ingresados","ft_despacho_ingresados a,documento b","a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado'  AND ".$like_destino_radicacion,"",$conn);
		
		if(!$tiene_planilla['numcampos']){
			$mensaje_retorno='Pendiente por distribuir';
		}else{
			$mensaje_retorno='En distribuci&oacute;n';
		}
	}

	return($mensaje_retorno);
		
}
function select_finalizar_generar_item(){
	$cadena_acciones.="<select id='finalizar_generar_item' class='pull-left btn btn-mini' style='height:22px; margin-left: 10px;'>";
		$cadena_acciones.="<option value=''>Acciones...</option>";
		$cadena_acciones.="<option value='boton_seleccionar_registros'>Generar Planilla</option>";
		$cadena_acciones.="<option value='boton_finalizar_entrega'>Finalizar Tr&aacute;mite</option>";
	$cadena_acciones.="</select>";	
	return($cadena_acciones);
}
?>