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
    $destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
	$responsable=busca_filtro_tabla("","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c,documento d","a.documento_iddocumento=d.iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$destino[0]['iddependencia'],"",$conn);
	
    $select="<select class='mensajeros' ".$disable." data-idft='$idft_destino_radicacion' name='responsable_{$idft_destino_radicacion}' style='width:150px;'>";
    
    if($responsable['numcampos']==1){
            
            $mensajero=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo=".$responsable[0]['mensajero_ruta'],"",$conn);
            
            if($responsable[0]['mensajero_ruta']==$datos[0]['mensajero_encargado']){
                $select.="<option value='".$responsable[0]['mensajero_ruta']."' selected>".$mensajero[0]['nombre']."</option>";
            }else{
                $select.="<option value='".$responsable[0]['mensajero_ruta']."'>".$mensajero[0]['nombre']."</option>";
                $sql="UPDATE ft_destino_radicacion SET mensajero_encargado=".$responsable[0]['mensajero_ruta']." WHERE idft_destino_radicacion=$idft_destino_radicacion";

                phpmkr_query($sql);
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
            $input="<input type='checkbox' name='recepcion[]' value='".$idft_destino_radicacion.'|'.$cargo[0]['iddependencia_cargo']."'>";
        }else{
           $input="Pendiente planilla";
       }
        
    }
    return $input;
}