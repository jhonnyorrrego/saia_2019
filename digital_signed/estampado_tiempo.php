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

if(@$_REQUEST["verificar"] == 1){
	$respuesta = verificar_estampa(@$_REQUEST["idpagina"]);
	echo codifica_encabezado($respuesta);
}


/*
 * <clase>estampar_imagen</clase>
 * <parametros>
 * $idimagenes = id de las imagenes (campo "consecutivo") las cuales van a ser estampadas
 * $digitalizacion = Datos de la imagen como la ruta, iddocumento de la imagen. 
 * </parametros>
 * <responsabilidades>
 * Proceso de estampar imagen despues de haber digitalizado.
 * </responsabilidades>
*/
function estampar_imagen($idimagenes,$digitalizacion){
	global $conn;
	
	$paginas = busca_filtro_tabla("","pagina","id_documento=".$digitalizacion["id_documento"]." and consecutivo in(".implode(",",$idimagenes).")","",$conn);
	
	for($i=0;$i<$paginas["numcampos"];$i++){
		proceso_estampado($paginas[$i]["consecutivo"]);
	}
}

/*
 * <clase>proceso_estampado</clase>
 * <parametros>
 * $idpagina = id de la imagen (campo "consecutivo")
 * </parametros>
 * <responsabilidades>
 * Proceso de estampar imagen despues de haber digitalizado.
 * </responsabilidades>
*/
function proceso_estampado($idpagina){
	global $conn,$ruta_db_superior;
	//Saco la informacion de la configuracion
	$config = busca_filtro_tabla("","configuracion","tipo='estampado'","",$conn);
	for($i=0;$i<$config["numcampos"];$i++){
		if($config[$i]["nombre"] == 'componente_estampar_ruta'){
			$componente_estampar = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'componente_verificar_ruta'){
			$componente_verificar = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'certificado_firma_ruta'){
			$certificado_firma = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'password'){
			$pass = $config[$i]["valor"];
		}
	}
	
	$datos = busca_filtro_tabla("","pagina","consecutivo=".$idpagina,"",$conn);
	$ruta = '"'.$ruta_db_superior.$datos[0]["ruta"].'"';
	$nombre_estampa = 'doc'.$datos[0]["id_documento"].'pag'.$datos[0]["pagina"].'.p15';
	
	//-----Creando ruta para la estampa--------------------
	$ruta1 = explode("documentos",$datos[0]["ruta"]);
	$ruta_estampa = $ruta_db_superior.$ruta1[0].'documentos/'.$nombre_estampa;
	try{
	  //Componente para estampar
	  //$jarStamp                    = "java -jar digital_signed/Stamp.jar";
	  $jarStamp                    = "java -jar ".$ruta_db_superior.$componente_estampar;
	  //Componente para verificar
	  //$jarVerifyStamp              = "java -jar digital_signed/VerifyStamp.jar";
	  $jarVerifyStamp              = "java -jar ".$ruta_db_superior.$componente_verificar;
	  //Ruta del archivo que se va a estampar
	  //$rutaArchivo                 = '"../APROBADO/2012-02/3/documentos/doc3pag1.jpg"';
	  $rutaArchivo                 = $ruta;
	  //El certificado con el cual se va a firmar la petici�n de la estampa
	  //$rutaCertificado        = '"digital_signed/CertEstampa_Clientes.p12"';
	  $rutaCertificado        = '"'.$ruta_db_superior.$certificado_firma.'"';
	  //Password del certificado
	  //$password                    = "tNl8F61o";
	  $password                    = $pass;
	  //La ruta del archivo que contendr� la estampa correspondiente al archivo $rutaArchivo
	  //$rutaArchivoEstampado   = '"../APROBADO/2012-02/3/documentos/doc3pag1.p15"';
	  $rutaArchivoEstampado   = '"'.$ruta_estampa.'"';
	  //Funcionalidad para estampar  
	  //echo exec($jarStamp." ".$rutaArchivo." ".$rutaArchivoEstampado." ".$rutaCertificado." ".$password, $arraySalida, $response);
	  //var_dump($arraySalida);
	  if ($response == 0){
	    //echo "<br/>Ejecutado";
		  
		  $sql = "INSERT INTO pagina_estampado (pagina_idpagina,ruta_archivo) values(".$idpagina.",'".$ruta_estampa."')";
		  
		  //echo $sql;
		  phpmkr_query($sql);
	  }
	  else{
	    //echo "<br/>Error";
	  }
	}
	catch (Exception $ex){
	      //echo $ex;
	}
}
/*
 * <clase>Verificar_estampa</clase>
 * <parametros>
 * $idpagina = id de la imagen (campo "consecutivo")
 * </parametros>
 * <responsabilidades>
 * Proceso para verificar la estampa de la imagen digitalizada
 * </responsabilidades>
*/
function verificar_estampa($idpagina){
	global $conn,$ruta_db_superior;	
	//Saco la informacion de la configuracion
	$config = busca_filtro_tabla("","configuracion","tipo='estampado'","",$conn);
	
	for($i=0;$i<$config["numcampos"];$i++){
		if($config[$i]["nombre"] == 'componente_estampar_ruta'){
			$componente_estampar = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'componente_verificar_ruta'){
			$componente_verificar = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'certificado_firma_ruta'){
			$certificado_firma = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'password'){
			$pass = $config[$i]["valor"];
		}
	}
	
	$datos = busca_filtro_tabla("","pagina","consecutivo=".$idpagina,"",$conn);
	$ruta = '"'.$ruta_db_superior.$datos[0]["ruta"].'"';
	
	//-----Creando ruta para la estampa--------------------
	$ruta_estampado = busca_filtro_tabla("","pagina_estampado","pagina_idpagina=".$idpagina,"idpagina_estampado desc",$conn);
	//print_r($ruta_estampado);
	if($ruta_estampado["numcampos"] > 0){
		$ruta_estampa = $ruta_db_superior.$ruta_estampado[0]["ruta_archivo"];
		try{
		  //Componente para estampar
		  //$jarStamp                    = "java -jar digital_signed/Stamp.jar";
		  $jarStamp                    = "java -jar ".$ruta_db_superior.$componente_estampar;
		  //Componente para verificar
		  //$jarVerifyStamp              = "java -jar digital_signed/VerifyStamp.jar";
		  $jarVerifyStamp              = "java -jar ".$ruta_db_superior.$componente_verificar;
		  //Ruta del archivo que se va a estampar
		  //$rutaArchivo                 = '"../APROBADO/2012-02/3/documentos/doc3pag1.jpg"';
		  $rutaArchivo                 = $ruta;
		  //El certificado con el cual se va a firmar la petici�n de la estampa
		  //$rutaCertificado        = '"digital_signed/CertEstampa_Clientes.p12"';
		  $rutaCertificado        = '"'.$ruta_db_superior.$certificado_firma.'"';
		  //Password del certificado
		  //$password                    = "tNl8F61o";
		  $password                    = $pass;
		  //La ruta del archivo que contendr� la estampa correspondiente al archivo $rutaArchivo
		  //$rutaArchivoEstampado   = '"../APROBADO/2012-02/3/documentos/doc3pag1.p15"';
		  $rutaArchivoEstampado   = '"'.$ruta_estampa.'"';
		  //Funcionalidad para verificar la estampa y extraer la hora y fecha de la estampa.  
		  $respuesta = exec($jarVerifyStamp." ".$rutaArchivoEstampado." ".$rutaArchivo." ".$rutaCertificado." ".$password, $arraySalida, $response);		  
		  if(@$arraySalida[42] == ""){
		    $retorno = ("El documento corresponde al digitalizado con SAIA");
		  }
		  else{
		    $retorno = ("Se han realizado modificaciones sobre el documento o la estampa de tiempo no corresponde a la original.");
		  }
		}
		catch (Exception $ex){
		      //echo $ex;
		}
	}
	else
		$retorno = ("La pagina no tiene estampa");
	return $retorno;
		
}
function proceso_estampado_pdf($ruta_original){
global $conn, $ruta_db_superior;

try{
  $config = busca_filtro_tabla("","configuracion","tipo='estampado'","",$conn);
	for($i=0;$i<$config["numcampos"];$i++){
		if($config[$i]["nombre"] == 'componente_estampar_pdf_ruta'){
			$componente_estampar = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'certificado_firma_ruta'){
			$certificado_firma = $config[$i]["valor"];
		}
		else if($config[$i]["nombre"] == 'password'){
			$pass = $config[$i]["valor"];
		}
	}
	$nuevo_nombre = str_replace(".pdf","_sinstp.pdf",$ruta_original);
  //Cuando genera el PDF se envía la ruta del documento incluyendo el rut_db_superior, se debe tener cuidado con estas rutas.
  $jarStamp                    = "java -jar ".$ruta_db_superior.$componente_estampar;
  //Ruta del archivo que se va a estampar
  //$rutaArchivo                 = '"../APROBADO/2012-02/3/documentos/doc3pag1.jpg"';
  rename($ruta_original,$nuevo_nombre);
  //echo 'Rename '.$ruta_original.' , '.$nuevo_nombre.'<br>';
  $rutaArchivo                 = '"'.$nuevo_nombre.'"';
  //El certificado con el cual se va a firmar la petici�n de la estampa
  //$rutaCertificado        = '"digital_signed/CertEstampa_Clientes.p12"';
  $rutaCertificado        = '"'.$ruta_db_superior.$certificado_firma.'"';
  //Password del certificado
  //$password                    = "tNl8F61o";
  $password                    = $pass;
  $rutaArchivoEstampado   = '"'.$ruta_original.'"';
  //Razón de la firma
  $signReason = '"Razon de la firma"';
  //Lugar de la firma
  $signLocation = '"Pereira-Colombia"';
  //Nombre del campo de firma
  $signFieldName = '""';
  //Funcionalidad para estampar
  
  //exec($jarStamp." ".$rutaArchivo." ".$rutaArchivoEstampado." ".$rutaCertificado." ".$password." ".$rutaCertificado." ".$password." ".$signReason." ".$signLocation." ".$signFieldName, $arraySalida, $response);
  
  if(@$response == 0){
    unlink($nuevo_nombre);
    //echo ('Borrar '.$nuevo_nombre);
  }
  else{
    rename($nuevo_nombre,$ruta_original);
	//echo ($nuevo_nombre.' , '.$ruta_original.'<br>');
  }
}
catch (Exception $ex){
		      echo $ex;
		}
}
?>