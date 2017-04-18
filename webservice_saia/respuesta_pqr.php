<?php
if(!@$_SESSION["LOGIN"]){
  @session_start();
  $_SESSION["LOGIN"]="radicador_web";
  $_SESSION["usuario_actual"]="111222333";
  $_SESSION["conexion_remota"]=1;
}

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

function respuesta_pqr($datos){
	global $conn;

	$datos = json_decode($datos);

	$where ="";

	switch ($datos->tipo) {
		case 'identificacion':
			$where = "a.documento =".$datos->valor;
		break;
		case 'numero_radicado':
			$where = "b.numero =".$datos->valor;
		break;
	}

	if($where){
		$documento = busca_filtro_tabla("a.idft_pqrsf, a.tipo, a.comentarios, b.numero, ".fecha_db_obtener("b.fecha","Y-m-d h:i:s")." as fecha, b.pdf,a.estado_reporte","ft_pqrsf a, documento b","a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ".$where," numero desc",$conn);


			//$respuesta_pqr = busca_filtro_tabla("b.numero,b.iddocumento","ft_respuesta_recepcion_peticion a, documento b","a.documento_iddocumento=b.iddocumento and lower(estado) not in('eliminado','anulado') and a.ft_recepcion_peticion=".$documento[0]["idft_recepcion_peticion"],"",$conn);

			//return(json_encode($respuesta_pqr));

	}else{
		$documento["numcampos"] = 0;
	}

  return(json_encode($documento));
}

function consultar_pqr($identificacion,$criterio){
	global $conn;
  $texto="";
	if($criterio==0){
  	$documentos =busca_filtro_tabla("iddocumento","ft_pqrs a, documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and identificacion='$identificacion'","d.fecha desc",$conn);
  //return("prueba");
		if($documentos["numcampos"]){
			$texto=contenido_documento(PROTOCOLO_CONEXION.RUTA_PDF."/" . FORMATOS_CLIENTE . "pqrs/pqr_por_persona.php?identificacion=$identificacion&remoto=1&idfunc=111222333&tipo=6");
	  	return("0|".$texto);
	  }else
	  	return("0|No hay PQR registrada para este documento.");
	}else if($criterio==1){
		$documentos =busca_filtro_tabla("iddocumento","ft_pqrs a, documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and d.numero='$identificacion'","d.fecha desc",$conn);
	  if($documentos["numcampos"]){
	  	$texto=contenido_documento(PROTOCOLO_CONEXION.RUTA_PDF."/" . FORMATOS_CLIENTE . "pqrs/pqr_por_persona.php?numero_radicado=$identificacion&remoto=1&idfunc=111222333&tipo=6");
  	return("0|".$texto);
	  }else
	  	return("0|No hay PQR registrada para este radicado.");
	}
}

function consultar_roles($datos){
	global $conn;
	$roles_institucion=busca_filtro_tabla("a.idserie as id,a.nombre as nombre","serie a,serie b","a.cod_padre =b.idserie AND b.nombre like 'Rol%en%la%organizacion'","a.nombre",$conn);
	$campo= "<option value=''>Seleccione......</option>";
	for($i=0; $i<$roles_institucion['numcampos'];$i++){
		$campo.='<option value="'.$roles_institucion[$i]['id'].'">'.$roles_institucion[$i]['nombre'].'</option>';
	}

	return($campo);
}
function consultar_pdf($datos){
	global $conn;
  $resultado="";
  $arreglo=explode("/-/",$datos);
  foreach($arreglo AS $key=>$valor){
	  $arreglo2=explode("/~/",$valor);
	  $_REQUEST[$arreglo2[0]]=$arreglo2[1];
  }
 	$respuesta=busca_filtro_tabla("pdf,lower(plantilla)","documento","iddocumento=".$_REQUEST["iddoc"],"",$conn);
 	if($respuesta[0][0]){
    $direccion=PROTOCOLO_CONEXION.RUTA_PDF."/".$respuesta[0][0];

	  $direccion=str_replace('saia/../../../../almacenamiento','almacenamiento',$direccion);
		if($direccion==''){
			$direccion=str_replace('saia/../../../../almacenamiento','',$direccion);
		}
  }
  else
  	$direccion=PROTOCOLO_CONEXION.RUTA_PDF."/html2ps/public_html/demo/html2ps.php?plantilla=".$respuesta[0][1]."&iddoc=".$_REQUEST["iddoc"];
 return($direccion);
}

function contenido_documento($direccion){
	$mh = curl_multi_init();
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$direccion);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  $contenido=curl_exec ($ch);
  curl_close ($ch);
  return($contenido);
}
function generar_captcha($datos){
  $numero1=rand(1,20);
  $numero2=rand(1,20);
  $signo=array("+","-");//,"*","/");
  $signof=$signo[rand(0,1)];
  $resultado=$numero1.$signof.$numero2;
  switch($signof){
    case "+":
      $resultadof=$numero1+$numero2;
    break;
    case "-":
      $resultadof=$numero1-$numero2;
    break;
    case "*":
      $resultadof=$numero1*$numero2;
    break;
    case "/":
      $resultadof=$numero1/$numero2;
    break;
  }
  $texto.= strlen($resultado);
  $texto.= strlen($resultadof);
  $texto='<input type="text" name="pregunta" value="'.$resultado.'" disabled size="5" class="input-mini">=<input type="hidden" id="resultado_ecuacion" value="'.($resultadof).'"><input type="text" value="" equalTo="#resultado_ecuacion" class="input-mini">';
  return($texto);
}
function numero_radicado(){
	$consulta=busca_filtro_tabla("","contador","nombre like '%radicacion_entrada%'","",$conn);
	return($consulta[0]["consecutivo"]);
}
function consultar_secretarias(){
	global $conn;
	//$campo=busca_filtro_tabla("B.idcampos_formato,B.valor","formato A, campos_formato B","A.idformato=B.formato_idformato AND A.nombre LIKE 'pqrs' AND B.nombre LIKE 'secretaria'","",$conn);
	//$secretarias=ejecuta_filtro_tabla($campo[0]["valor"],$conn);

	$secretarias = busca_filtro_tabla("iddependencia, nombre","dependencia","iddependencia<>16916 and (nombre like'SECRETARIA%' or iddependencia in(17496,17116))","nombre asc",$conn);

	$texto='<option value="">Seleccionar...</option>';
	for($i=0; $i < $secretarias["numcampos"]; $i++){
	  $texto.='<option value="'.$secretarias[$i]["iddependencia"].'">'.$secretarias[$i]["nombre"].'</option>';
	}
	return($texto);
}
?>