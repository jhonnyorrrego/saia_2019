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
include('db.php');
include_once("librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");


	$cadena="'login_wey'";
	$cadena=str_replace("'","",$cadena);
	//stripslashes
	echo $cadena;

die();

$formatos=busca_filtro_tabla("idformato,etiqueta","formato","cod_padre IS NULL OR cod_padre='' ","etiqueta ASC",$conn);

for($i=0;$i<$formatos['numcampos'];$i++){
	echo('<p><strong>'.($i+1).') '.ucwords(strtolower($formatos[$i]['etiqueta'])).' ('.$formatos[$i]['idformato'].')</strong></p>');
	$hijos=tiene_hijos($formatos[$i]['idformato']);
	if($hijos['hijos']){
		$lista_hijos=lista_hijos($hijos['cuales']);
	}
	//print_r($hijos);
	
	
}
function tiene_hijos($idformato){
	global $conn;

	$hijos=busca_filtro_tabla("idformato","formato","cod_padre=".$idformato,"",$conn);
	
	$retorno=array();
	$retorno['hijos']=0;
	if($hijos['numcampos']){
		$retorno['hijos']=1;
		$retorno['cuales']=implode(',',extrae_campo($hijos,'idformato'));
	}
	return($retorno);
}
function lista_hijos($cuales){
	global $conn;
	
	$hijos=busca_filtro_tabla("etiqueta,idformato","formato","idformato IN(".$cuales.")","etiqueta ASC",$conn);
	if($hijos['numcampos']){
		for($i=0;$i<$hijos['numcampos'];$i++){
			echo('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - '.ucwords(strtolower($hijos[$i]['etiqueta'])).' ('.$hijos[$i]['idformato'].')<br/>');
		}
	}
}






die();
$respuesta=enviar_correo(11641);

function enviar_correo($iddoc){
	global $conn,$ruta_db_superior;
	
	
	$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	$nombre_funcionario=busca_filtro_tabla("","funcionario a, dependencia_cargo b","a.funcionario_codigo=".$consulta[0]["ejecutor"],"",$conn);
	
	$datos_documento=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	print_r($datos_documento[0]['pdf'].'<br />');
	
	$ruta=crear_pdf_documento_tcpdf($datos_documento[0]);
	print_r("Ruta curl".$ruta.'<br />');
	
	$datos_documento=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	
	//$ruta_nueva=str_replace("_0_", "_".$datos_documento[0]['numero']."_", $datos_documento[0]['pdf']);
	//print_r("Ruta nueva".$ruta_nueva.'<br />');
	
	phpmkr_query("UPDATE documento SET pdf='" . $ruta . "' WHERE iddocumento=".$iddoc);
	$datos_documento=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
	
	print_r("Ruta actualizada".$datos_documento[0]['pdf'].'<br />');
	
	die();
	$nombre=$nombre_funcionario[0]['nombres']." ".$nombre_funcionario[0]['apellidos'];
	
	
	$permiso=busca_filtro_tabla("a.nombre,b.motivo_permiso","serie a,ft_solicitud_permiso b","a.idserie=b.motivo_permiso AND b.documento_iddocumento=".$iddoc,"",$conn);
	
	$motivo=html_entity_decode($permiso[0]['nombre']);
	$numero_radicado=$datos_documento[0]['numero'];
	
	$anexos = array($datos_documento[0]['pdf']);

	$destinos = array('1088303313');
	
	$asunto="Solicitud de permiso aprobada"." - ".$nombre." - ".strip_tags($motivo);

	$mensaje="La solicitud de permiso No. ".$numero_radicado." ha sido aprobada";
	
	//$resp=enviar_mensaje("","codigo",$destinos,$asunto,$mensaje,$anexos,"",$iddoc);	
}


		
?>