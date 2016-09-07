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

function mostrar_nombre_macroproceso($listado_tareas_fk){
    global $conn,$ruta_db_superior;
    
    $macro_proceso=busca_filtro_tabla("c.nombre","listado_tareas a, serie b,serie c","b.cod_padre=c.idserie AND a.macro_proceso=b.idserie AND a.idlistado_tareas=".$listado_tareas_fk,"",$conn);
    if(!$macro_proceso['numcampos']){
        return('Sin Macroproceso Asignado');
    }
    return(htmlspecialchars_decode($macro_proceso[0]['nombre']));
}
function mostrar_nombre_proceso($listado_tareas_fk){
    global $conn,$ruta_db_superior;
    
    $proceso=busca_filtro_tabla("b.nombre","listado_tareas a, serie b","a.macro_proceso=b.idserie AND a.idlistado_tareas=".$listado_tareas_fk,"",$conn);
    if(!$proceso['numcampos']){
        return('Sin Proceso Asignado');
    }
    return(htmlspecialchars_decode($proceso[0]['nombre']));
}
function mostrar_nombre_listado_tareas($listado_tareas_fk){
    global $conn,$ruta_db_superior;
    
    $listado=busca_filtro_tabla("nombre_lista","listado_tareas a","a.idlistado_tareas=".$listado_tareas_fk,"",$conn);
    if(!$listado['numcampos']){
        return('Sin Listado Asignado');
    }
    return(htmlspecialchars_decode($listado[0]['nombre_lista']));
}
function mostrar_nombre_funcionario_avance($funcionario_idfuncionario){
    global $conn,$ruta_db_superior;
    
    $datos_fun=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$funcionario_idfuncionario,"",$conn);
    $nombre_fun=ucwords(strtolower($datos_fun[0]['nombres'].' '.$datos_fun[0]['apellidos']));
    return($nombre_fun);
}
function mostrar_tiempo_estimado($tiempo_estimado){
    global $conn,$ruta_db_superior;
    
    list($h, $m, $s) = explode(':', $tiempo_estimado); 
    $segundos = ($h * 3600) + ($m * 60) + $s; 
    return( conversor_segundos_hm(intval($segundos)) );
}
function mostrar_tiempo_registrado($tiempo_registrado){
    global $conn,$ruta_db_superior;
    
    return( conversor_segundos_hm(intval($tiempo_registrado)) );
}
function condicion_logueado_filtro(){ // CONDICION
    global $conn,$ruta_db_superior;
     $condicion="b.cod_padre=0 AND b.generica=0"; //sin subtareas y sin tareas genericas
    if(!@$_REQUEST['variable_busqueda']){
        $condicion.=" AND a.funcionario_idfuncionario=".usuario_actual('idfuncionario');
        $condicion.=" AND a.fecha_inicio='".date('Y-m-d')."'";
    }
     return($condicion);
}
function mostrar_total_tiempo_registrado(){
     global $conn,$ruta_db_superior;

    $condicion="b.cod_padre=0 AND b.generica=0"; //sin subtareas y sin tareas genericas
    if(!@$_REQUEST['variable_busqueda']){
        $condicion.=" AND a.funcionario_idfuncionario=".usuario_actual('idfuncionario');
        $condicion.=" AND a.fecha_inicio='".date('Y-m-d')."'";      
    }
    if(@$_REQUEST["idbusqueda_filtro_temp"]){
      $filtro_temp=busca_filtro_tabla("","busqueda_filtro_temp","idbusqueda_filtro_temp IN(".$_REQUEST["idbusqueda_filtro_temp"].")","",$conn);
      if($filtro_temp["numcampos"]){
        $cadena1='';
        for($i=0;$i<$filtro_temp["numcampos"];$i++){
        	$cadena1=parsear_cadena($filtro_temp[$i]["detalle"]);
          $cadena.=$cadena1;
          if(@$filtro_temp[$i+1]["detalle"]){
            $cadena.=' AND ';
          } 
        }
        $condicion.=" AND (".stripslashes($cadena).")";
      }
    }
    $datos=busca_filtro_tabla("a.tiempo_registrado","tareas_listado_tiempo a left join tareas_listado b on a.fk_tareas_listado=b.idtareas_listado left join listado_tareas c on b.listado_tareas_fk=c.idlistado_tareas",$condicion,"",$conn);
    $vector_tiempo_registrado=extrae_campo($datos,'tiempo_registrado','D');
    $suma_tiempo_registrado=array_sum($vector_tiempo_registrado);
    return( conversor_segundos_hm(intval($suma_tiempo_registrado)) );
}
function mostrar_total_tiempo_estimado(){
    global $conn,$ruta_db_superior;
    
     $condicion="b.cod_padre=0 AND b.generica=0"; //sin subtareas y sin tareas genericas
    if(!@$_REQUEST['variable_busqueda']){
        $condicion.=" AND a.funcionario_idfuncionario=".usuario_actual('idfuncionario');
        $condicion.=" AND a.fecha_inicio='".date('Y-m-d')."'";      
    }
    if(@$_REQUEST["idbusqueda_filtro_temp"]){
      $filtro_temp=busca_filtro_tabla("","busqueda_filtro_temp","idbusqueda_filtro_temp IN(".$_REQUEST["idbusqueda_filtro_temp"].")","",$conn);
      if($filtro_temp["numcampos"]){
        $cadena1='';
        for($i=0;$i<$filtro_temp["numcampos"];$i++){
        	$cadena1=parsear_cadena($filtro_temp[$i]["detalle"]);
          $cadena.=$cadena1;
          if(@$filtro_temp[$i+1]["detalle"]){
            $cadena.=' AND ';
          } 
        }
        $condicion.=" AND (".stripslashes($cadena).")";
      }
    }
    $datos=busca_filtro_tabla("b.tiempo_estimado","tareas_listado_tiempo a left join tareas_listado b on a.fk_tareas_listado=b.idtareas_listado left join listado_tareas c on b.listado_tareas_fk=c.idlistado_tareas",$condicion,"",$conn);
    $vector_tiempo_registrado=extrae_campo($datos,'tiempo_estimado','D');   
    $suma_segundos=0;
    for($i=0;$i<count($vector_tiempo_registrado);$i++){
        list($h, $m, $s) = explode(':', $vector_tiempo_registrado[$i]); 
        $segundos = ($h * 3600) + ($m * 60) + $s; 
        $suma_segundos=$suma_segundos+$segundos;
    }
  
  
    return( conversor_segundos_hm(intval($suma_segundos)) );           

    
    
}




?>