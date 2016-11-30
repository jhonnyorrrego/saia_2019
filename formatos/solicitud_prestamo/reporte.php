<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");



function ejecutor_cread($dependencia) {
	global $conn;
	
	$nombre_solicitante=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","iddependencia_cargo=".$dependencia,"",$conn);
//return($nombre_solicitante['sql']);
	$nombre=$nombre_solicitante[0]['nombres']." ".$nombre_solicitante[0]['apellidos'];
	
	if($nombre != ""){
		return ($nombre);
	}
	
}



function ubicacion_documento($iddoc){
	global $conn;

	$formato=busca_filtro_tabla("idformato","formato","nombre='solicitud_prestamo'","",$conn);
	//return ($iddoc);
	
	$ubicacion=mostrar_valor_campo('documento_archivo',$formato[0]['idformato'],$iddoc,1);

	if($ubicacion != ""){
		return ($ubicacion);
	}
}


function decodificar_html($valor){
	$result=str_replace("</p>", "", $valor);
	$result=str_replace("<p>", "", $result);
	return(utf8_decode($result));
}
function ver_documento($iddocumento,$radicado,$html){
	$enlace = "<div class='link kenlace_saia' enlace='ordenar.php?accion=mostrar&amp;amp;mostrar_formato=1&amp;amp;key=".$iddocumento."' conector='iframe' titulo='Documento No - ".$radicado."'>".$html."</div>";
	return($enlace);
}

function ver_nombre_rol($iddoc){
	global $conn;
	
	 $solicitante=busca_filtro_tabla("e.archivo_idarchivo,e.nombre,e.destino,e.origen","buzon_entrada e","e.archivo_idarchivo=".$iddoc." AND e.nombre='APROBADO'","e.fecha DESC",$conn);
	 
	 
	 $nombre_solicitante=busca_filtro_tabla("nombres,apellidos","vfuncionario_dc","funcionario_codigo=".$solicitante[0]['destino'],"",$conn);
	 
	 
//return($nombre_solicitante['sql']);
	if($nombre_solicitante['numcampos']){
		$nombre=$nombre_solicitante[0]['nombres']." ".$nombre_solicitante[0]['apellidos'];
	
	//if($nombre != ""){
		return ($nombre);
	}

	
	//}
	
}

function ver_fecha($iddocumento,$radicado,$fecha){
	if($fecha=="fecha_creacion"){
		$fecha=date("Y-m-d");
	}
	$date = new DateTime($fecha);
	
	$enlace=ver_documento($iddocumento,$radicado,date_format($date, 'Y-m-d H:i'));
	return($enlace);
}

function ver_documento_solicitado($iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_solicitud_prestamo","documento_iddocumento=".$iddoc,"",$conn);
	
	$info="";
	
	if($datos[0]['numero_expediente'] != ""){
		$info.="Expediente: ".$datos[0]['numero_expediente']."<br />";
	}
	
	if($datos[0]['no_caja'] != ""){
		$info.="Caja: ".$datos[0]['no_caja']."<br />";
	}
	
	if($datos[0]['numero_folios'] != ""){
		$info.="Folios: ".$datos[0]['numero_folios']."<br />";
	}
	
	$observaciones=htmlentities(strip_tags("<br />".$datos[0]['observaciones']));
	$info.= "<br />".$observaciones;
	return($info);
}

function prestamo_documento($iddoc){
	global $conn;
	$html="<div id='devolucion_doc_".$iddoc."'>";
	
	$datos=busca_filtro_tabla("d.ejecutor,d.fecha_creacion","ft_solicitud_prestamo sp,ft_entrega_prestamo ep,documento d","d.iddocumento=ep.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO') and sp.idft_solicitud_prestamo=ep.ft_solicitud_prestamo and  sp.documento_iddocumento=".$iddoc,"",$conn);
	if($datos['numcampos']>0){
		$date = new DateTime($datos[0]['fecha_creacion']);
		$nombres=busca_filtro_tabla("","vfuncionario_dc","funcionario_codigo=".$datos[0]['ejecutor'],"",$conn);
		$html.="<b>Funcionario:</b> ".$nombres[0]['nombres']." ".$nombres[0]['apellidos']."<br/>";
		$html.="<b>Fecha:</b> ".date_format($date, 'Y-m-d H:i');
	}

	
	/*
	$datos=busca_filtro_tabla("fecha_prestamo_rep,funcionario_prestamo_rep,estado_devolucion","ft_solicitud_prestamo","documento_iddocumento=".$iddoc,"",$conn);
	
	if($datos[0]['funcionario_prestamo_rep']==""){
		$html.="<center><input class='prestamo_' type='checkbox' iddocumento='".$iddoc."' id='prestamo_".$iddoc."' name='prestamo_".$iddoc."' /></center>";
	}else{
		$date = new DateTime($datos[0]['fecha_prestamo_rep']);
		$nombres=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$datos[0]['funcionario_prestamo_rep'],"",$conn);
		$html.="<b>Funcionario:</b> ".$nombres[0]['nombres']." ".$nombres[0]['apellidos']."<br/>";
		$html.="<b>Fecha:</b> ".date_format($date, 'Y-m-d H:i');
	}
	*/
	
	$html.="</div>";
	return($html);
}

function devolucion_documento($iddoc){
	global $conn;
	$html="<div id='devolucion_doc_".$iddoc."'>";
	 
 	$datos=busca_filtro_tabla("fecha_devolucion,usuario_devolucion","ft_solicitud_prestamo sp,ft_entrega_prestamo ep,documento d","d.iddocumento=ep.documento_iddocumento and d.estado not in ('ELIMINADO','ANULADO') and sp.idft_solicitud_prestamo=ep.ft_solicitud_prestamo and  sp.documento_iddocumento=".$iddoc,"",$conn);
	if($datos['numcampos']>0 && $datos[0]['usuario_devolucion']!=""){
		$date = new DateTime($datos[0]['fecha_devolucion']);
		$nombres=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$datos[0]['usuario_devolucion'],"",$conn);
		$html.="<b>Funcionario:</b> ".$nombres[0]['nombres']." ".$nombres[0]['apellidos']."<br/>";
		$html.="<b>Fecha:</b> ".date_format($date, 'Y-m-d H:i');
	}

	
	$html.="</div>";
	return($html);
}

function filtrar_elaborador($usuario){
	if($usuario!='usuario'){
		$ejecutor=$usuario;
	}
	else{
		$ejecutor=usuario_actual('funcionario_codigo');
	}
	return(" AND dsp.ejecutor='".$ejecutor."' ");
}
/*AJAX*/
if(isset($_REQUEST['opt'])){
	
	if($_REQUEST['iddocumento_prestamo']!=""){
		$update_devolucion="UPDATE ft_solicitud_prestamo SET fecha_prestamo_rep='".date('Y-m-d H:m')."',funcionario_prestamo_rep='".usuario_actual('idfuncionario')."',estado_devolucion='0' WHERE documento_iddocumento in (".$_REQUEST['iddocumento_prestamo'].")";
		//phpmkr_query($update_devolucion);
	}
	if($_REQUEST['iddocumento_devolucion']!=""){
		$update_devolucion="UPDATE ft_solicitud_prestamo SET fecha_devolucion_rep='".date('Y-m-d H:m')."',funcionario_devolucion_rep='".usuario_actual('idfuncionario')."',estado_devolucion='1' WHERE documento_iddocumento in (".$_REQUEST['iddocumento_devolucion'].")";
		//phpmkr_query($update_devolucion);
	}
}
function prestamo_expediente($iddoc){
	$hijo=busca_filtro_tabla("b.prestamo_expediente","ft_solicitud_prestamo a,ft_entrega_prestamo b","a.idft_solicitud_prestamo=b.ft_solicitud_prestamo and a.documento_iddocumento=".$iddoc,"",$conn);
	if($hijo[0]['prestamo_expediente']==1){
		$prestamo='Si';
	}else if($hijo[0]['prestamo_expediente']==2){
		$prestamo='No';
	}
	return($prestamo);
}



function ver_estado_documento($iddoc){
	
	$datos_solicitud = busca_filtro_tabla("b.estado_devolucion","ft_solicitud_prestamo a, ft_entrega_prestamo b","a.idft_solicitud_prestamo=b.ft_solicitud_prestamo AND a.documento_iddocumento=".$iddoc,"",$conn);
	
	$estado="";
	
	if($datos_solicitud[0]['estado_devolucion'] == 1){
		
		$estado="Devuelto";		
	}else{
		$estado="En Préstamo";	
	}
	return ($estado);
	
}

?>