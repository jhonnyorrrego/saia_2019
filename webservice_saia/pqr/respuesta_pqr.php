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

	$where = "a.documento like '".$datos->valor."' and b.numero ='".$datos->valor2."'";
		
	/*switch ($datos->tipo) {
		case '1':
			$where = "a.documento like '".$datos->valor."'";
		break;
		case '2':
			$where = "b.numero ='".$datos->valor."'";
		break;		
	}*/

	if($where){
		$documento = busca_filtro_tabla("b.numero, ".fecha_db_obtener("b.fecha","Y-m-d h:i:s")." as fecha, b.pdf, b.iddocumento, a.comentarios as resumen_hechos","ft_pqrsf a, documento b","a.documento_iddocumento=b.iddocumento and lower(b.estado) not in('eliminado','anulado') and ".$where," numero desc",$conn);

		if($documento["numcampos"]){
			for($i=0;$i<$documento["numcampos"];$i++){
				$respuesta_pqr = busca_filtro_tabla("a.pdf as pdf_respuesta,b.destino","documento a, respuesta b","a.iddocumento=b.destino and lower(a.estado) not in('eliminado','anulado','activo') and lower(a.plantilla) not in('clasificacion_pqrsf') and b.origen=".$documento[$i]["iddocumento"],"",$conn);
				$numero_respuesta=busca_filtro_tabla("","documento","iddocumento=".$respuesta_pqr[0]['destino'],"",$conn);
				$documento[$i]["numero_respuesta"]=$numero_respuesta[0]['numero'];
				if($respuesta_pqr["numcampos"]){
					for($j=0;$j<$respuesta_pqr["numcampos"];$j++){
						if($respuesta_pqr[$j]["pdf_respuesta"]){
							$documento[$i]["pdf_respuesta"]=$respuesta_pqr[$j]["pdf_respuesta"];
							break;
						}
					}
				}
			}
		}
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
			$texto=contenido_documento(PROTOCOLO_CONEXION.RUTA_PDF. "/" . FORMATOS_CLIENTE . "pqrs/pqr_por_persona.php?identificacion=$identificacion&remoto=1&idfunc=111222333&tipo=6");
	  	return("0|".$texto);
	  }else
	  	return("0|No hay PQR registrada para este documento.");
	}else if($criterio==1){
		$documentos =busca_filtro_tabla("iddocumento","ft_pqrs a, documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and d.numero='$identificacion'","d.fecha desc",$conn);
	  if($documentos["numcampos"]){
	  	$texto=contenido_documento(PROTOCOLO_CONEXION.RUTA_PDF. "/" . FORMATOS_CLIENTE . "pqrs/pqr_por_persona.php?numero_radicado=$identificacion&remoto=1&idfunc=111222333&tipo=6");
  	return("0|".$texto);
	  }else
	  	return("0|No hay PQR registrada para este radicado.");
	}
}

function consultar_ciudad($datos){
	global $conn;
	$datos = json_decode($datos);
	$configuracion=busca_filtro_tabla("valor","configuracion A","A.nombre='key_notificacion_web'","",$conn);

	$key=$datos->key;
	$cadena=md5(date('Ymd').$configuracion[0]["valor"]);
	if($key != $cadena)return false;

	switch($datos->tipo){
		case 1:
			$idpais = 1;
			$iddepartamento = 11;
			$idmunicipio = 883;

			$paises = busca_filtro_tabla("","pais","","nombre ASC",$conn);

			$select_pais .= "<option value=''>Seleccione..</option>";
			for($i=0; $i<$paises['numcampos'];$i++){
				if($paises[$i]['idpais'] == $idpais){
					$select_pais .= "<option value='".$paises[$i]['idpais']."' selected>".$paises[$i]['nombre']."</option>";
				}else{
					$select_pais .= "<option value='".$paises[$i]['idpais']."'>".$paises[$i]['nombre']."</option>";
				}
			}

			$departamentos = busca_filtro_tabla("","departamento","pais_idpais=".$idpais,"nombre ASC",$conn);

			$select_departementos .= "<option value=''>Seleccione..</option>";
			for($j=0; $j<$departamentos['numcampos'];$j++){
				if($departamentos[$j]['iddepartamento'] == $iddepartamento){
					$select_departementos .= "<option value='".$departamentos[$j]['iddepartamento']."' selected>".$departamentos[$j]['nombre']."</option>";
				}else{
					$select_departementos .= "<option value='".$departamentos[$j]['iddepartamento']."'>".$departamentos[$j]['nombre']."</option>";
				}
			}

			$municipio = busca_filtro_tabla("idmunicipio,nombre","municipio","departamento_iddepartamento=".$iddepartamento,"GROUP BY idmunicipio,nombre ORDER BY nombre ASC",$conn);

			$select_municipios .= "<option value=''>Seleccione..</option>";
			for($k=0; $k < $municipio['numcampos'] ; $k++){
				if($municipio[$k]['idmunicipio'] == $idmunicipio){
					$select_municipios .= "<option value='".$municipio[$k]['idmunicipio']."' selected>".$municipio[$k]['nombre']."</option>";
				}else{
					$select_municipios .= "<option value='".$municipio[$k]['idmunicipio']."'>".$municipio[$k]['nombre']."</option>";
				}
			}

			$datos = array(
											"pais"         => $select_pais,
											"departamento" => $select_departementos,
											"municipio"		 => $select_municipios
							 );
		break;
		case 2:

			$departamentos = busca_filtro_tabla("","departamento","pais_idpais=".$datos->pais,"nombre ASC",$conn);

			$select_departementos .= "<option value=''>Seleccione..</option>";
			for($j=0; $j<$departamentos['numcampos'];$j++){
				if($departamentos[$j]['iddepartamento'] == $iddepartamento){
					$select_departementos .= "<option value='".$departamentos[$j]['iddepartamento']."' selected>".$departamentos[$j]['nombre']."</option>";
				}else{
					$select_departementos .= "<option value='".$departamentos[$j]['iddepartamento']."'>".$departamentos[$j]['nombre']."</option>";
				}
			}

			$municipio = busca_filtro_tabla("idmunicipio,nombre","municipio","departamento_iddepartamento=".$departamentos[0]["iddepartamento"],"GROUP BY idmunicipio,nombre ORDER BY nombre ASC",$conn);

			$select_municipios .= "<option value=''>Seleccione..</option>";
			for($k=0; $k < $municipio['numcampos'] ; $k++){
				if($municipio[$k]['idmunicipio'] == $idmunicipio){
					$select_municipios .= "<option value='".$municipio[$k]['idmunicipio']."' selected>".$municipio[$k]['nombre']."</option>";
				}else{
					$select_municipios .= "<option value='".$municipio[$k]['iddepartamento']."'>".$municipio[$k]['nombre']."</option>";
				}
			}

			$datos = array(
											"departamento" => $select_departementos,
											"municipio"		 => $select_municipios
							);
		break;
		case 3:

			$municipio = busca_filtro_tabla("idmunicipio,nombre","municipio","departamento_iddepartamento=".$datos->departamanto,"GROUP BY idmunicipio,nombre ORDER BY nombre ASC",$conn);

			$select_municipios .= "<option value=''>Seleccione..</option>";
			for($k=0; $k < $municipio['numcampos'] ; $k++){
				if($municipio[$k]['idmunicipio'] == $idmunicipio){
					$select_municipios .= "<option value='".$municipio[$k]['idmunicipio']."' selected>".$municipio[$k]['nombre']."</option>";
				}else{
					$select_municipios .= "<option value='".$municipio[$k]['idmunicipio']."'>".$municipio[$k]['nombre']."</option>";
				}
			}

			$datos = array(

											"municipio"		 => $select_municipios
										);
		break;
	}
	return(json_encode($datos));
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
  if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {  
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  }
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