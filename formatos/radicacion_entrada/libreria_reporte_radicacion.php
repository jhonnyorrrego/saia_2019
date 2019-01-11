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
include_once($ruta_db_superior.'distribucion/funciones_distribucion.php');


function mostrar_tipo_origen_reporte($tipo_origen){
    global $ruta_db_superior, $conn;
    
    if($tipo_origen==1){
        return "Externo";
    }else{
        return "Interno";
    }
}

function mostrar_origen_reporte($iddistribucion){
    global $ruta_db_superior, $conn;

	$datos=busca_filtro_tabla('tipo_origen,origen','distribucion','iddistribucion='.$iddistribucion,'',$conn);
    $nombre_origen=retornar_origen_destino_distribucion($datos[0]['tipo_origen'],$datos[0]['origen']); 
    return ($nombre_origen);	
	
}

function mostrar_destino_reporte($iddistribucion){
    global $ruta_db_superior, $conn;

	$datos=busca_filtro_tabla('tipo_destino,destino','distribucion','iddistribucion='.$iddistribucion,'',$conn);
    $nombre_destino=mostrar_destino_distribucion($datos[0]['tipo_destino'],$datos[0]['destino']); 
    return ($nombre_destino);
}

function mostrar_ruta_reporte($iddistribucion){
    global $ruta_db_superior, $conn;
    
	$datos=busca_filtro_tabla('tipo_origen,estado_recogida,origen,tipo_destino,destino,ruta_origen,ruta_destino','distribucion','iddistribucion='.$iddistribucion,'',$conn);

	$nombre_ruta_distribucion=mostrar_nombre_ruta_distribucion($datos[0]['tipo_origen'],$datos[0]['estado_recogida'],$datos[0]['ruta_origen'],$datos[0]['ruta_destino'],$datos[0]['tipo_destino']);
	
	return($nombre_ruta_distribucion);
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
	$consulta_interno=busca_filtro_tabla("","documento d,ft_radicacion_entrada a, distribucion b, vfuncionario_dc c","(lower(d.estado)='aprobado' and a.documento_iddocumento=d.iddocumento and a.documento_iddocumento=b.documento_iddocumento and a.tipo_destino=2 and b.destino=c.iddependencia_cargo and b.tipo_destino=1  AND a.tipo_origen<>1  ) ".$where,"",$conn);
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
	$consulta_externo=busca_filtro_tabla("","documento d,ft_radicacion_entrada a, distribucion b, vfuncionario_dc c","(lower(d.estado)='aprobado' and a.documento_iddocumento=d.iddocumento and a.documento_iddocumento=b.documento_iddocumento and a.tipo_destino=2 and b.destino=c.iddependencia_cargo and b.tipo_destino=1  AND a.tipo_origen=1  ) ".$where,"",$conn);
	$cadena='<div style="text-align:center;font-size:25pt;font-weight:bold">&nbsp;&nbsp;&nbsp;'.$consulta_externo['numcampos'].'</div>';
	echo($cadena);		
}
function mopstrar_nombre_ventanilla_radicacion($ventanilla_radicacion){
	global $conn;
	
	$ventanillas=busca_filtro_tabla("valor","cf_ventanilla","idcf_ventanilla=".$ventanilla_radicacion,"",$conn);
	if($ventanillas['numcampos']){
		return($ventanillas[0]['valor']);
	}else{
		return('Sin ventanilla definida');
	}
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
?>