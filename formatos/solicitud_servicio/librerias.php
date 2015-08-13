<?php
function ver_documento_servicio($iddocumento,$numero){
	global $conn;
	$texto="<div class='kenlace_saia' conector='iframe' enlace='ordenar.php?key=".$iddocumento."&mostrar_formato=1' title='Radicado No ".$numero."' titulo='Radicado No ".$numero."' style='cursor:pointer'><span class='badge'>".$numero."</span></div>";
	return($texto);
}
function obtener_fecha_solicitud($fecha){
	global $conn,$ruta_db_superior;
	include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
	$dato=date_parse($fecha);
	$texto=$dato["day"]." de ".mes($dato["month"])." del ".$dato["year"];
	return($texto);
}
function obtener_ciudad($ciudad){
	global $conn;
	$municipio=busca_filtro_tabla("","municipio A","A.idmunicipio=".$ciudad,"",$conn);
	return(ucfirst(strtolower($municipio[0]["nombre"])));
}
function listar_unidades($fk_idsolicitud_afiliacion){
	global $conn;
	$afiliaciones=busca_filtro_tabla("","ft_solicitud_afiliacion A, documento B","A.idft_solicitud_afiliacion in(".$fk_idsolicitud_afiliacion.") AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
	$texto=array();
	for($i=0;$i<$afiliaciones["numcampos"];$i++){
		$texto[]="<div class='kenlace_saia' conector='iframe' enlace='ordenar.php?key=".$afiliaciones[$i]["documento_iddocumento"]."&mostrar_formato=1' title='Radicado No ".$afiliaciones[$i]["numero"]."' titulo='Radicado No ".$afiliaciones[$i]["numero"]."' style='cursor:pointer'><span class='badge'>Ver afiliacion ".$afiliaciones[$i]["numero"]."</span></div>";
	}
	return(implode("<br />",$texto));
}
function obtener_serie($idserie){
	global $conn;
	$serie=busca_filtro_tabla("","serie A","A.idserie=".$idserie,"",$conn);
	return(ucfirst(strtolower($serie[0]["nombre"])));
}
function obtener_tipo_solicitud_servi($tipo_solicitud_servi){
	$texto="";
	if($tipo_solicitud_servi==1){
		$texto='<span class="btn-success">Normal</span>';
	}
	else if($tipo_solicitud_servi==2){
		$texto='<span class="btn-danger">Urgente</span>';
	}
	return($texto);
}
function obtener_tipo_privilegios($tipo_privilegios){
	$texto="";
	if($tipo_privilegios==1){
		$texto="Privado";
	}
	else if($tipo_privilegios==2){
		$texto="Consulta general";
	}
	return($texto);
}
function obtener_requiere_recoleccion($requiere_recoleccion){
	$texto="";
	if($requiere_recoleccion==1){
		$texto="Si";
	}
	else if($requiere_recoleccion==2){
		$texto="No";
	}
	return($texto);
}
function recepcion($idft_solicitud_servicio){
	global $conn;
	$recepcion=busca_filtro_tabla("A.fecha_radicacion_doc,B.numero,B.iddocumento","ft_radica_doc_mercantil A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO') AND numero_solicitud='".$idft_solicitud_servicio."'","",$conn);
	if($recepcion["numcampos"]){
		$datos_fecha=date_parse($recepcion[0]["fecha_radicacion_doc"]);
		$fecha=$datos_fecha["day"]." de ".mes($datos_fecha["month"])." del ".$datos_fecha["year"];
		$texto="<div class='kenlace_saia' conector='iframe' enlace='ordenar.php?key=".$recepcion[0]["iddocumento"]."&mostrar_formato=1' title='Radicado No ".$recepcion[0]["numero"]."' titulo='Radicado No ".$recepcion[0]["numero"]."' style='cursor:pointer'><span class='badge'>".$fecha."</span></div>";
	}
	else{
		$texto='<span class="btn-danger">Pendiente</span>';
	}
	return($texto);
}
function verificacion($idft_solicitud_servicio){
	global $conn;
	$recepcion=busca_filtro_tabla("","ft_radica_doc_mercantil A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO') AND numero_solicitud='".$idft_solicitud_servicio."'","",$conn);
	if($recepcion["numcampos"]){
		$afiliaciones1=busca_filtro_tabla("","ft_verifica_informacion A, documento B","A.ft_radica_doc_mercantil=".$recepcion[0]["idft_radica_doc_mercantil"]." AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
		
		if($afiliaciones1["numcampos"]){
			$afiliaciones=busca_filtro_tabla("","ft_verifica_informacion A, documento B","A.ft_radica_doc_mercantil=".$recepcion[0]["idft_radica_doc_mercantil"]." AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO') AND presenta_inconsisten='0'","",$conn);
			$texto="";
			if($afiliaciones["numcampos"]){
				$texto='<span class="btn-danger">No cumple</span>';
			}
			else{
				$texto='<span class="btn-success">cumple</span>';
			}
		}
		else{
			$texto='<span class="btn-danger">No hay verificaciones</span>';
		}
	}
	else{
		$texto='<span class="btn-danger">No hay recepcion</span>';
	}
	return($texto);
}
function cantidad_solicitudes_funcion(){
	$solicitudes=busca_filtro_tabla("count(B.iddocumento) as cantidad","ft_solicitud_servicio A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO','ACTIVO')","",$conn);
	$texto="<div style='text-align:center'><h1>".$solicitudes[0]["cantidad"]."</h1><b>SOLICITUDES</b></div>";
	return($texto);
}
?>