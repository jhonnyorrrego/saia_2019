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

include_once($ruta_db_superior."formatos/riesgos_proceso/librerias_riesgos.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
function filtrar_proceso($datos){
	global $conn;
	$ft_proceso=$_REQUEST["variable_busqueda"];
	if($ft_proceso)
		$where=" and ft_proceso=".$ft_proceso;
	else
		$where="";
	return $where;
}
function riesgo_numero($consecutivo,$iddocumento){
	global $conn;
	
	$riesgo = busca_filtro_tabla("descripcion","ft_riesgos_proceso","documento_iddocumento=".$iddocumento,"",$conn);	
	
	return($consecutivo."-".strip_tags(html_entity_decode($riesgo[0]['descripcion'])));
}

function probabilidad_reporte($probabilidad){
	global $conn;
	$x_probabilidad=probabilidad($probabilidad);
	return(str_replace("<br>"," ",$x_probabilidad));
}


function impacto_reporte($impacto){
	global $conn;
	$x_impacto=str_replace("&oacute;","ó",impacto($impacto));
	return(str_replace("<br>"," ",$x_impacto));
}
function evaluacion_reporte($probabilidad,$impacto){
	global $conn;
	$evaluacion=tabla_evaluacion($probabilidad,$impacto);
	$color_celda=color_evaluacion($evaluacion);
	$texto=texto_evaluacion($evaluacion);
	
	return('<div style="background:'.$color_celda.'">'.$texto.'</div>');
}
function controles_reporte($idft_riesgos_proceso){
	global $conn, $datos;
	$datos=busca_filtro_tabla("descripcion_control, idft_control_riesgos","ft_control_riesgos a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$idft_riesgos_proceso,"",$conn);
	$texto='';
	$texto.='<table style="width:100%;border-collapse:collapse">';
	for($i=0;$i<$datos["numcampos"];$i++){
		$texto.="<tr>";
		$texto.="<td>".ucfirst(strtolower(strip_tags(codifica_encabezado(html_entity_decode($datos[$i]["descripcion_control"])))))."</td>";
		$texto.="</tr>";
	}
	$texto.="</table>";
	return($texto);
}
function calificacion_probabilidad($id,$probabilidad, $retornar_valor = null){
	global $conn, $probabilidad_auto;
	
	$valoraciones=valoraciones($id);
	
	$probabilidad_auto=nuevo_punto_matriz($probabilidad,$valoraciones[0]);
	
	if($retornar_valor){
		return($probabilidad_auto);
	}
	
	$x_probabilidad=probabilidad($probabilidad_auto);
	
	return(str_replace("<br>"," ",$x_probabilidad));
}
function calificacion_impacto($id,$impacto,$retornar_valor = null){
	global $conn, $impacto_auto;
	$valoraciones=valoraciones($id);
	
	$impacto_auto=nuevo_punto_matriz($impacto,$valoraciones[1]);
	
	if($retornar_valor){
		return($impacto_auto);
	}
	
	$x_impacto=str_replace("&oacute;","&amp;oacute;",impacto($impacto_auto));
	$x_impacto=str_replace("<br>","<br />",impacto($impacto_auto));
	$x_impacto=str_replace("<br>","<br />",impacto($impacto_auto));
	
	return (html_entity_decode($x_impacto));
}
function nueva_evaluacion_reporte($id){
	global $conn, $probabilidad_auto, $impacto_auto;
	$evaluacion_auto=tabla_evaluacion($probabilidad_auto,$impacto_auto,1);
	$color_celda_auto=color_evaluacion($evaluacion_auto);
	$texto=texto_evaluacion($evaluacion_auto,1);
	return('<div style="background:'.$color_celda_auto.'">'.$texto.'</div>');
}
function nueva_evaluacion_reporte2($id){
	global $conn, $probabilidad_auto, $impacto_auto;
	$evaluacion_auto=tabla_evaluacion($probabilidad_auto,$impacto_auto,2);
	$color_celda_auto=color_evaluacion($evaluacion_auto);
	$texto=texto_evaluacion($evaluacion_auto,2);
	return('<div style="background:'.$color_celda_auto.'">'.$texto.'</div>');
}
function acciones_reporte($idft_riesgos_proceso){
	global $datos;
	$texto='';
	$texto.='<table style="width:100%;border-collapse:collapse">';
	for($i=0;$i<$datos["numcampos"];$i++){
		$texto.="<tr>";
		$texto.="<td>".strip_tags(html_entity_decode(acciones($datos[$i]["idft_control_riesgos"],"acciones_accion")))."</td>";
		$texto.="</tr>";
	}
	$texto.="</table>";
	return($texto);
}
function respuesta_reporte($idft_riesgos_proceso){
	global $conn,$datos;
	
	$texto='';
	$texto.='<table style="width:100%;border-collapse:collapse">';
	for($i=0;$i<$datos["numcampos"];$i++){
		$texto.="<tr>";
		$texto.="<td>".strip_tags(codifica_encabezado(html_entity_decode(acciones($datos[$i]["idft_control_riesgos"],"reponsables"))))."</td>";
		$texto.="</tr>";
	}
	$texto.="</table>";
	return($texto);
}
function indicador_reporte($idft_riesgos_proceso){
	global $conn,$datos;
	$texto='';
	$texto.='<table style="width:100%;border-collapse:collapse">';
	for($i=0;$i<$datos["numcampos"];$i++){
		$texto.="<tr>";
		$texto.="<td>".ucfirst(strtolower(strip_tags(html_entity_decode(acciones($datos[$i]["idft_control_riesgos"],"indicador")))))."</td>";
		$texto.="</tr>";
	}
	$texto.="</table>";
	return($texto);
}
function acciones($id,$campo){
	global $conn;
	$acciones=busca_filtro_tabla($campo.", iddocumento","ft_acciones_riesgo a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and acciones_control='".$id."'","",$conn);
	$texto='';
	for($i=0;$i<$acciones["numcampos"];$i++){
		if($campo!='reponsables'){
			$texto.=ucfirst(strtolower($acciones[$i][$campo]));
		}
		else{
		    $idformato_acciones_riesgo=busca_filtro_tabla("idformato","formato","nombre='acciones_riesgo'","",$conn);
			$texto.=mostrar_valor_campo($campo,$idformato_acciones_riesgo[0]['idformato'],$acciones[$i]["iddocumento"],1);
		}
		if(($i+1)<$acciones["numcampos"])$texto.='<br><br>';
	}
	return $texto;
}
function logro_reporte($id){
	global $conn;
	$texto=seguimiento($id,"logro");
	return($texto);
}
function observaciones_reporte($id){
	global $conn;
	$texto=seguimiento($id,"observaciones");
	return($texto);
}
function seguimiento($id,$campo){
	global $conn;
	$seguimiento=busca_filtro_tabla($campo,"ft_seguimiento_riesgo a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO') and ft_riesgos_proceso=".$id,"",$conn);
	$texto='';
	for($i=0;$i<$seguimiento["numcampos"];$i++){
		$texto.=ucfirst(strtolower(strip_tags(codifica_encabezado(html_entity_decode($seguimiento[$i][$campo])))));
		if(($i+1)<$seguimiento["numcampos"])$texto.=' ';
	}
	return($texto);
}
?>