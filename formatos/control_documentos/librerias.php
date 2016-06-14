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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."class_transferencia.php");

function obtener_enlace_documento($iddocumento,$numero){

	if($numero!=0 || $numero!='numero'){
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado '.$numero.'"><center><span class="badge">'.$numero.'</span></center></div>');
	}else{
		return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado 0"><center><span class="badge">0</span></center></div>');
	}	
}


function obtener_proceso_subproceso($listado_procesos){	
	
	$proceso = explode("|",$listado_procesos);	
	
	switch($proceso[0]){
		case "1":
			$proceso = busca_filtro_tabla("a.nombre, a.idft_proceso as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_proceso a, documento b, formato c","a.documento_iddocumento=b.iddocumento AND lower(b.plantilla) like(lower(c.nombre)) and a.idft_proceso=".$proceso[1],"",$conn);
		break;
		case "2":
			$proceso = busca_filtro_tabla("a.nombre, a.idft_macroproceso_calidad as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_macroproceso_calidad a, documento b, formato c","a.documento_idocumento=b.iddocumento AND LOWER(b.plantilla) LIKE(LOWER(c.nombre)) AND a.idft_macroproceso_calidad=".$proceso[1],"",$conn);
		break;	
	}
	
	return($proceso[0]['nombre']);
}

function obtener_origen($origen_documento){

	switch($origen_documento){
		case 1:
			$origen = "Externo";
		break;
		case 2:
			$origen = "Interno";
		break;
	}
	return($origen);
}

function obtener_almacenamiento($almacenamiento){
	
	switch($almacenamiento){
		case 1:
			$tipo = "F&iacute;sico";
		break;
		case 2:
			$tipo = "Virtual";
		break;
	}
	return($tipo);
}

function obtener_serie_documental($serie_idserie){
	global $conn;
	
	$serie= busca_filtro_tabla("nombre, codigo","serie","idserie=".$serie_idserie,"",$conn);
		
	if($serie["numcampos"]){
		$serie = $serie[0]["codigo"]." - ".$serie[0]["nombre"];
	}else{
		$serie = "No tiene serie asignada";
	}	
	return($serie);	
}


function obtener_version_documento($iddocumento_calidad){
	global $conn;
		
	$documento_version = busca_filtro_tabla_limit("carga_inicial,iddocumento_version, max(numero_version) as version","documento_version","documento_iddocumento=".$iddocumento_calidad," group by carga_inicial,iddocumento_version, numero_version order by numero_version desc",intval(0),intval(0),$conn);
	
	if($documento_version[0]["carga_inicial"]==1){
		if($documento_version["numcampos"]){
			$version = ('<div class="link kenlace_saia" enlace="versionamiento/listar_versiones.php?iddocumento_version='.$documento_version[0]["iddocumento_version"].'&carga_inicial=1&iddocumento='.$iddocumento_calidad.'" conector="iframe" titulo="Version No '.$documento_version[0]["version"].'"><center><span class="badge">'.$documento_version[0]["version"].'</span></center></div>');			

		}
	}else{
		if($documento_version["numcampos"]){
			$version = ('<div class="link kenlace_saia" enlace="versionamiento/listar_versiones.php?iddocumento_version='.$documento_version[0]["iddocumento_version"].'&iddocumento='.$iddocumento_calidad.'" conector="iframe" titulo="Version No '.$documento_version[0]["version"].'"><center><span class="badge">'.$documento_version[0]["version"].'</span></center></div>');			
			
		}
	}
	
	return($version);		
}

function obtener_fecha_vigencia_documento($fecha){
	
	$fecha = date_parse($fecha);
	
	$mes = obtener_mes_letra($fecha['month']);	
	
	if(!(strlen($fecha['day']) > 1)){
		$dia = str_pad($fecha['day'], 2, "0", STR_PAD_LEFT);
	}else{
		$dia = $fecha['day'];
	}	
	$fecha = $dia.' de '.ucfirst($mes).' de '.$fecha['year'];
	
	return($fecha);
}

function obtener_revisor_documento($revisado){
	global $conn;
	
	$funcionario = busca_filtro_tabla("nombres, apellidos","funcionario","funcionario_codigo=".$revisado,"",$conn);
	
	$nombre = ucwords(strtolower($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]));
	
	return($nombre);
}

function obtener_aprobador_documento($aprobado){
	global $conn;
	
	$funcionario = busca_filtro_tabla("nombres, apellidos","funcionario","funcionario_codigo=".$aprobado,"",$conn);
	
	$nombre = ucwords(strtolower($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]));
	
	return($nombre);
}

function obtener_ultima_version_documento(){
	global $conn;
	
	$iddocumento = busca_filtro_tabla("max(b.documento_iddocumento) as iddocumento_control_documento","documento a,ft_control_documentos b, documento_version c, documento d","a.iddocumento=b.documento_iddocumento and lower(a.estado) not in('eliminado', 'anulado' ,'activo') and d.iddocumento=c.documento_iddocumento and lower(d.estado) not in('eliminado', 'anulado') and b.iddocumento_calidad = c.documento_iddocumento","group by c.documento_iddocumento",$conn);		
	
	//$iddocumento = extrae_campo($iddocumento,"iddocumento_control_documento","U");	
	//$iddocumento = implode(",",$iddocumento);
	
	//return($iddocumento);
	return($iddocumento["sql"]);
}

function obtener_ultima_version_documento2(){
	global $conn;
	
	$iddocumento = busca_filtro_tabla("max(b.documento_iddocumento) as iddocumento_control_documento","documento a,ft_control_documentos b, documento_version c","a.iddocumento=b.documento_iddocumento and lower(a.estado) not in('eliminado', 'anulado','activo') and b.iddocumento_calidad = c.documento_iddocumento and tipo_solicitud!=3","group by c.documento_iddocumento",$conn);		
	
	//$iddocumento = extrae_campo($iddocumento,"iddocumento_control_documento","U");	
	//$iddocumento = implode(",",$iddocumento);
	
	//return($iddocumento);
	return($iddocumento["sql"]);
}

function obtener_version_documento_obsoleto($iddocumento_version){
	global $conn;
	
	$documento_version = busca_filtro_tabla("iddocumento_version,numero_version, documento_iddocumento","documento_version","iddocumento_version=".$iddocumento_version,"",$conn);
	
	if($documento_version["numcampos"]){
		$version = ('<div class="link kenlace_saia" enlace="versionamiento/listar_versiones.php?iddocumento_version='.$documento_version[0]["iddocumento_version"].'&iddocumento='.$documento_version[0]["documento_iddocumento"].'" conector="iframe" titulo="Version No '.$documento_version[0]["numero_version"].'"><center><span class="badge">'.$documento_version[0]["numero_version"].'</span></center></div>');			
	}
	
	return($version);	
}
function mostrar_nombre_doc($nombre){
	$nombre=str_replace("&amp;nbsp;", " ", $nombre);
	return(html_entity_decode($nombre));
	
}
?>

