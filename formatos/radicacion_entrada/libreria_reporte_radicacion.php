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

function seleccionar_destino($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
    $input="<input type='checkbox' name='$idft_destino_radicacion'>";
    return $input;
}

function mostrar_mensajeros_dependencia($idft_destino_radicacion){
    global $ruta_db_superior, $conn;
    
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo, concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    if($cargo[0]['cargo']=="mensajero"){
        $select.="<input type='text' name='responsable_{$idft_destino_radicacion}' value='".$cargo[0]['nombre']."' readonly>";
    }else{  
    $datos=busca_filtro_tabla('','ft_destino_radicacion','idft_destino_radicacion='.$idft_destino_radicacion,'',conn);
    $destino=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$datos[0]['nombre_destino'],"",$conn);
    $responsable=busca_filtro_tabla("","ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c","b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$destino[0]['iddependencia'],"",$conn);
    $select="<select class='mensajeros' name='responsable_{$idft_destino_radicacion}' style='width:150px;'>";
    $select.="<option value=''>Seleccione</option>";
    for($i=0;$i<$responsable['numcampos'];$i++){
        $mensajero=busca_filtro_tabla("concat(nombres,' ',apellidos) AS nombre","vfuncionario_dc","iddependencia_cargo={$responsable[$i]['mensajero_ruta']}");
        if($responsable[$i]['mensajero_ruta']==$datos[0]['mensajero_encargado']){
            $select.="<option value='{$responsable[$i]['mensajero_ruta']}' data-idft='$idft_destino_radicacion' selected>".$mensajero[0]['nombre']."</option>";
        }else{
            $select.="<option value='{$responsable[$i]['mensajero_ruta']}'>".$mensajero[0]['nombre']."</option>";
        }
        
    }
    $select.="</select>";
    }
    return $select;
}

function ver_items($iddocumento, $numero) {
  return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$numero.'"><center><span class="badge">'.$numero.'</span></center></div>');
} 


function condicion_adicional(){
    global $ruta_db_superior, $conn;
    
    $funcionario_codigo=usuario_actual('funcionario_codigo');
    $cargo=busca_filtro_tabla("lower(cargo) AS cargo","vfuncionario_dc a","a.funcionario_codigo=".$funcionario_codigo,"",$conn);
    if($cargo[0]['cargo']=="mensajero"){
        $condicion="AND B.mensajero_encargado=".$cargo[0]['iddependencia_cargo'];
    }  
    //return $condicion;
}

