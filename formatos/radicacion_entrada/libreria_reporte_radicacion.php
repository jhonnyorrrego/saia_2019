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
        $origen=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo=".$datos[0]['area_responsable'],"",$conn);
    }
    return ($origen[0]['nombre']);
}

function mostrar_destino_reporte($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
    $datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',conn);
    
    if($datos[0]['tipo_destino']==1){
        $destino=busca_filtro_tabla("b.nombre","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[0]['nombre_destino'],"",$conn);
    }else{
        $destino=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
    }
    return ($destino[0]['nombre']);
    
}

function mostrar_ruta_reporte($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
    $datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',conn);
    
    if($datos[0]['tipo_destino']==1){
        $destino=busca_filtro_tabla("b.nombre, a.cargo , a.ciudad, a.direccion","datos_ejecutor a, ejecutor b","b.idejecutor=a.ejecutor_idejecutor AND a.iddatos_ejecutor=".$datos[0]['nombre_destino'],"",$conn);
   	    $ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$destino[0]['ciudad'],"",$conn);
   	    $ubicacion=$ciudad[0]['nombre'].' '.$destino[0]['direccion'];
    }else{
        $destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
        $ubicacion=$destino[0]['dependencia'];
    }
    return ($ubicacion);
}

function planilla_mensajero($idft_destino_radicacion,$mensajero_encargado,$estado_item){
    global $ruta_db_superior, $conn;
    $html="";
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($mensajero_encargado=='mensajero_encargado'){
        $html.="Sin Mensajero Asignado";
    }else{
        $planillas=busca_filtro_tabla("c.numero,c.iddocumento","ft_item_despacho_ingres a,ft_despacho_ingresados b, documento c","a.ft_despacho_ingresados=b.idft_despacho_ingresados AND b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') AND a.ft_destino_radicacio=".$idft_destino_radicacion,"",$conn);
        if($planillas['numcampos']){
            for($i=0;$i<$planillas['numcampos'];$i++){
                $html.='<div class="link kenlace_saia" enlace="ordenar.php?key='.$planillas[$i]['iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$planillas[$i]['numero'].'"><center><span class="badge">'.$planillas[$i]['numero']."</span></center></div>\n";
            }
        }
        //$html.="<input type='checkbox' class='planilla_mensajero' ".$disable." mensajero='".$mensajero_encargado."' value='$idft_destino_radicacion'>";
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
        $html.="Sin Mensajero Asignado";
    }else{
        $planillas=busca_filtro_tabla("c.numero,c.iddocumento","ft_item_despacho_ingres a,ft_despacho_ingresados b, documento c","a.ft_despacho_ingresados=b.idft_despacho_ingresados AND b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') AND a.ft_destino_radicacio=".$idft_destino_radicacion,"",$conn);
        if($planillas['numcampos']){
            for($i=0;$i<$planillas['numcampos'];$i++){
                //$html.='<div class="link kenlace_saia" enlace="ordenar.php?key='.$planillas[$i]['iddocumento'].'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$planillas[$i]['numero'].'"><center><span class="badge">'.$planillas[$i]['numero']."</span></center></div>\n";
            }
        }
        $html.="<input type='checkbox' class='planilla_mensajero' ".$disable." mensajero='".$mensajero_encargado."' value='$idft_destino_radicacion'>";
    }
    return $html;
}

function mostrar_mensajeros_dependencia($idft_destino_radicacion,$estado_item){
    global $ruta_db_superior, $conn;
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo, concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    $disable="";
    if($estado_item=='finalizado'){
        $disable="disabled";
    }
    if($cargo[0]['cargo']=="mensajero"){
        $select.="<input type='text' name='responsable_{$idft_destino_radicacion}' value='".$cargo[0]['nombre']."' readonly>";
    }else{  
    $datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',conn);
	
	$tipo_mensajeria_radicacion=busca_filtro_tabla("tipo_mensajeria,area_responsable","ft_radicacion_entrada","idft_radicacion_entrada=".$datos[0]['ft_radicacion_entrada'],"",$conn);
	if($tipo_mensajeria_radicacion[0]['tipo_mensajeria']==2 && !$datos[0]['estado_recogida']){
		$datos[0]['nombre_destino']=$tipo_mensajeria_radicacion[0]['area_responsable'];
	}
	
    $destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
	$responsable=busca_filtro_tabla("mensajero_ruta","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$destino[0]['iddependencia'],"",$conn);
	
    $select="<select class='mensajeros' ".$disable." data-idft='$idft_destino_radicacion' name='responsable_{$idft_destino_radicacion}' style='width:150px;'>";
    
    if($responsable['numcampos']==1){
            
            $mensajero=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo=".$responsable[0]['mensajero_ruta'],"",$conn);
            
            if($responsable[0]['mensajero_ruta']==$datos[0]['mensajero_encargado']){
                $select.="<option value='".$responsable[0]['mensajero_ruta']."' selected>".$mensajero[0]['nombre']."</option>";
            }else{
            	$select.="<option value='' selected>Seleccione</option>";
                $select.="<option value='".$responsable[0]['mensajero_ruta']."'>".$mensajero[0]['nombre']."</option>";
            }
    }else{
        
        $select.="<option value=''>Seleccione</option>";
        for($i=0;$i<$responsable['numcampos'];$i++){
            $mensajero=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo={$responsable[$i]['mensajero_ruta']}","",$conn);
            if($responsable[$i]['mensajero_ruta']==$datos[0]['mensajero_encargado']){
                $select.="<option value='{$responsable[$i]['mensajero_ruta']}' selected>".$mensajero[0]['nombre']."</option>";
            }else{
                $select.="<option value='{$responsable[$i]['mensajero_ruta']}'>".$mensajero[0]['nombre']."</option>";
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
    
    if(@$_REQUEST['variable_busqueda']){
        $condicion="AND B.mensajero_encargado=".$_REQUEST['variable_busqueda'];
    }else{
        $funcionario_codigo=usuario_actual('funcionario_codigo');
        $cargo=busca_filtro_tabla("lower(cargo) AS cargo, iddependencia_cargo","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
        for($i=0;$i<$cargo['numcampos'];$i++){
        if($cargo[$i]['cargo']=="mensajero"){
            $condicion="AND B.mensajero_encargado=".$cargo[$i]['iddependencia_cargo'];
        }
        }
    }
    return $condicion;
}

function filtrar_mensajero(){
    global $ruta_db_superior, $conn;
    
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo, iddependencia_cargo","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    for($j=0;$j<$cargo['numcampos'];$j++){
    if($cargo[$j]['cargo']!="mensajero"){
    
    $select="<select class='pull-left btn btn-mini dropdown-toggle' style='height:22px; margin-left: 30px;' name='filtro_mensajeros' id='filtro_mensajeros'>";
    $select.="<option value=''>Todos Los Mensajeros</option>";
    $datos=busca_filtro_tabla("iddependencia_cargo, concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","lower(cargo)='mensajero' AND estado_dc=1","",$conn);
    //print_r($datos);die();
    $filtrar_mensajero=@$_REQUEST['variable_busqueda'];
    for($i=0;$i<$datos['numcampos'];$i++){
        $selected='';	
		if($filtrar_mensajero){
			if($filtrar_mensajero==$datos[$i]['iddependencia_cargo']){
				$selected='selected';
			}
		}	
			
        $select.="<option value='{$datos[$i]['iddependencia_cargo']}' ".$selected.">{$datos[$i]['nombre']}</option>";
		
    }
    $select.="</select>";
    }else{
    	$select="";
    }
	}
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
        $planillas=busca_filtro_tabla("c.numero,c.iddocumento","ft_item_despacho_ingres a,ft_despacho_ingresados b, documento c","a.ft_despacho_ingresados=b.idft_despacho_ingresados AND b.documento_iddocumento=c.iddocumento AND c.estado NOT IN('ELIMINADO','ANULADO') AND a.ft_destino_radicacio=".$idft_destino_radicacion,"",$conn);
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
	if($tipo_mensajeria==2 && ($estado_recogida==0 || $estado_recogida=='estado_recogida') ){
		$tramite='RECOGIDA';
	}
	return($tramite);
}
?>