<?php
include_once("db.php"); 
include_once("class_transferencia.php");

require ('vendor/autoload.php');
require_once 'filesystem/SaiaStorage.php';
include_once "StorageUtils.php";

//datos_documento($iddocumento);
function datos_documento($doc,$etiqueta=""){
	global $conn;
	$alm_backup = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);
	$ruta_backup = date("Y-m-d") . "/" . $etiqueta . $doc;
	$ruta_temp_backup = StorageUtils::obtener_tempdir();
	// crear_destino($ruta_backup);
	$sql_doc = crear_insert("documento", "iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("buzon_entrada", "archivo_idarchivo", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("buzon_salida", "archivo_idarchivo", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("pagina", "id_documento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("comentario_img", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("anexos", "documento_iddocumento", $doc, $ruta_temp_backup);

	$sql_doc .= crear_insert("salidas", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("respuesta", "destino", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("respuesta", "origen", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("almacenamiento", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("asignacion", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("control", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("expediente_doc", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("reserva", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("ruta", "documento_iddocumento", $doc, $ruta_temp_backup);
	$sql_doc .= crear_insert("solicitud", "documento_iddocumento", $doc, $ruta_temp_backup);
  
  $archivo = '/documento_'.$doc.'_'.date("Y-m-d").'.txt';    
	$fp = fopen($ruta_temp_backup . $archivo, "w+");
	if (fwrite($fp, $sql_doc) === FALSE) {
   echo ("No fue posible escribir los sql al archivo ".$archivo);
	}
	comprimir($doc, $alm_backup, $ruta_backup, $ruta_temp_backup);
  fclose($fp);
  
 return true;  
}

function crear_insert($ntabla, $idcampo, $doc, $ruta_temp_backup) {
	if (MOTOR == 'MySql') {
		$texto = crear_insert_mysql($ntabla, $idcampo, $doc, $ruta_temp_backup);
	} else if (MOTOR == 'Oracle') {
		$texto = crear_insert_oracle($ntabla, $idcampo, $doc, $ruta_temp_backup);
	} else if (MOTOR == 'SqlServer') {
		$texto = crear_insert_sqlserver($ntabla, $idcampo, $doc, $ruta_temp_backup);
	} else if (MOTOR == 'MSSql') {
		$texto = crear_insert_sqlserver($ntabla, $idcampo, $doc, $ruta_temp_backup);
	}
 	return $texto;
}

function crear_insert_oracle($ntabla, $idcampo, $doc, $ruta_temp_backup) {
 	global $conn;
 	$texto1 =""; 
 	$datos = busca_filtro_tabla("*","".$ntabla,"$idcampo='$doc'","",$conn);
 	if($datos["numcampos"]>0){
  	if($ntabla=='documento' && $datos[0]["plantilla"]!=""){
  		$tabla_formato = busca_filtro_tabla("nombre_tabla","formato","nombre like '".strtolower($datos[0]["plantilla"])."'","",$conn);        
			$texto1 = crear_insert($tabla_formato[0]["nombre_tabla"], "documento_iddocumento", $doc, $ruta_temp_backup);
			if ($datos[0]["pdf"] != "") {
				copiar_archivo($datos[0]["pdf"], '', $ruta_temp_backup);
			}
   	}
   	$tabla = busca_filtro_tabla("column_name,table_name,data_type","user_tab_columns","table_name = '".strtoupper($ntabla)."'","",$conn); 
  	for($j=0; $j<$datos["numcampos"]; $j++){
			if ($ntabla == 'anexos') {
				copiar_archivo($datos[$j]["ruta"], $datos[$j]["etiqueta"], $ruta_temp_backup);
			}
   		if($ntabla=='pagina'){
				copiar_archivo($datos[$j]["ruta"], "", $ruta_temp_backup);
				copiar_archivo($datos[$j]["imagen"], "", $ruta_temp_backup);
   		}   
   		$texto1 .= "\n\rINSERT INTO ".$ntabla." (";
   		$texto = ""; 
   		$campos ="";
   		for($i=0; $i<$tabla["numcampos"]; $i++){
    		$campos .= ",".strtolower($tabla[$i]["column_name"]);
    		switch ($tabla[$i]["data_type"]){
      		case "VARCHAR2":
						if ($datos[$j][strtolower($tabla[$i]["column_name"])] != "") {
        			$texto .= "'".$datos[$j][strtolower($tabla[$i]["column_name"])]."',";
						} else {
        			$texto .="NULL,"; 
						}
      		break;
      		case "NUMBER":
						if ($datos[$j][strtolower($tabla[$i]["column_name"])] != "") {
        			$texto .= $datos[$j][strtolower($tabla[$i]["column_name"])].",";
						} else {
        			$texto .="NULL,";  
						}
      		break;
      		case "DATE":      
       			if($datos[$j][strtolower($tabla[$i]["column_name"])]!=""){
        			$fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["column_name"],'Y-m-d H:i:s')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
        			$texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d H:i:s').",";
						} else {
        			$texto .="NULL,"; 
						}
      		break;
      		case "CLOB":
       			$texto .="'".$datos[$j][strtolower($tabla[$i]["column_name"])]."',";
      		break;       
    		}      
   		}
   		$texto1 .= substr($campos, 1).") VALUES (".substr($texto, 0, strlen($texto)-1).");";
  	}
  	$eliminar = "DELETE FROM ".$ntabla." WHERE ".$idcampo." = ".$doc;
  	phpmkr_query($eliminar,$conn);
	}
 	return $texto1; 
}

function crear_insert_mysql($ntabla, $idcampo, $doc, $ruta_temp_backup) {
 	global $conn;
 	$texto1 =""; 
 	$datos = busca_filtro_tabla("*","".$ntabla,"$idcampo='$doc'","",$conn); 

 	if($datos["numcampos"]>0){
		if($ntabla=='documento' && $datos[0]["plantilla"]!=""){
			$tabla_formato = busca_filtro_tabla("nombre_tabla","formato","nombre like '".strtolower($datos[0]["plantilla"])."'","",$conn);
			$texto1 = crear_insert($tabla_formato[0]["nombre_tabla"], "documento_iddocumento", $doc, $ruta_temp_backup);
			if ($datos[0]["pdf"] != "") {
				copiar_archivo($datos[0]["pdf"], '', $ruta_temp_backup);
			}
   	}
   	$tabla = ejecuta_filtro_tabla("SHOW COLUMNS FROM ".strtolower($ntabla),$conn);
  	for($j=0; $j<$datos["numcampos"]; $j++){
			if ($ntabla == 'anexos') {
				copiar_archivo($datos[$j]["ruta"], $datos[$j]["etiqueta"], $ruta_temp_backup);
			}
   		if($ntabla=='pagina'){
				copiar_archivo($datos[$j]["ruta"], "", $ruta_temp_backup);
				copiar_archivo($datos[$j]["imagen"], "", $ruta_temp_backup);
   		}   
   		$texto1 .= "\n\rINSERT INTO ".$ntabla." (";
   		$texto = ""; 
   		$campos ="";
   		for($i=0; $i<$tabla["numcampos"]; $i++){
    		$campos .= ",".strtolower($tabla[$i]["Field"]);
				$type = preg_replace('/[[:digit:]/.]/i', '', $tabla[$i]["Type"]);
    		$type=str_replace("()","",$type);
    		switch ($type){
      		case "varchar":
						if ($datos[$j][strtolower($tabla[$i]["Field"])] != "") {
        			$texto .= "'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
						} else {
        		$texto .="NULL,"; 
						}
      		break;
      		case "int":
						if ($datos[$j][strtolower($tabla[$i]["Field"])] != "") {
        			$texto .= $datos[$j][strtolower($tabla[$i]["Field"])].",";
						} else {
        			$texto .="NULL,";  
						}
      		break;
      		case "date":      
       			if($datos[$j][strtolower($tabla[$i]["Field"])]!=""){
        			$fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["Field"],'Y-m-d H:i:s')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
        			$texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d H:i:s').",";
						} else {
        		$texto .="NULL,"; 
						}
      		break;
      		case "text":
       			$texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
      		break;
      		default:
       			$texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
      		break;       
    		}      
   		}
   		$texto1 .= substr($campos, 1).") VALUES (".substr($texto, 0, strlen($texto)-1).");";
  	}
  	$eliminar = "DELETE FROM ".$ntabla." WHERE ".$idcampo." = ".$doc;
  	phpmkr_query($eliminar,$conn);
	}  
 	return $texto1; 
}

function crear_insert_sqlserver($ntabla, $idcampo, $doc, $ruta_temp_backup) {
 	global $conn;
 	$texto1 =""; 
 	$datos = busca_filtro_tabla("*","".$ntabla,"$idcampo='$doc'","",$conn);

 	if($datos["numcampos"]>0){
		if($ntabla=='documento' && $datos[0]["plantilla"]!=""){
			$tabla_formato = busca_filtro_tabla("nombre_tabla","formato","nombre like '".strtolower($datos[0]["plantilla"])."'","",$conn);
			$texto1 = crear_insert($tabla_formato[0]["nombre_tabla"], "documento_iddocumento", $doc, $ruta_temp_backup);
			if ($datos[0]["pdf"] != "") {
				copiar_archivo($datos[0]["pdf"], '', $ruta_temp_backup);
			}
   	}
   	$tabla=ejecuta_filtro_tabla("select COLUMN_NAME as Field, DATA_TYPE as Type from Information_Schema.Columns where TABLE_NAME='".strtolower($ntabla)."'",$conn);
  	for($j=0; $j<$datos["numcampos"]; $j++){
			if ($ntabla == 'anexos') {
				copiar_archivo($datos[$j]["ruta"], $datos[$j]["etiqueta"], $ruta_temp_backup);
			}
   		if($ntabla=='pagina'){
				copiar_archivo($datos[$j]["ruta"], "", $ruta_temp_backup);
				copiar_archivo($datos[$j]["imagen"], "", $ruta_temp_backup);
   		}   
   		$texto1 .= "\n\rINSERT INTO ".$ntabla." (";
   		$texto = ""; 
   		$campos ="";
   		for($i=0; $i<$tabla["numcampos"]; $i++){
    		$campos .= ",".strtolower($tabla[$i]["Field"]);
				$type = preg_replace('/[[:digit:]/.]/i', '', $tabla[$i]["Type"]);
    		$type=str_replace("()","",$type);
    		//echo $type;
    		switch ($type){
      		case "nvarchar":
						if ($datos[$j][strtolower($tabla[$i]["Field"])] != "") {
        			$texto .= "'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
						} else {
        		$texto .="NULL,"; 
						}
      		break;
      		case "int":
						if ($datos[$j][strtolower($tabla[$i]["Field"])] != "") {
        			$texto .= $datos[$j][strtolower($tabla[$i]["Field"])].",";
						} else {
        			$texto .="NULL,";  
						}
      		break;
					case "bigint":
						if ($datos[$j][strtolower($tabla[$i]["Field"])] != "") {
        			$texto .= $datos[$j][strtolower($tabla[$i]["Field"])].",";
						} else {
        			$texto .="NULL,";  
						}
      		break;
      		case "date":      
       			if($datos[$j][strtolower($tabla[$i]["Field"])]!=""){
        			$fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["Field"],'Y-m-d')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
        			$texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d').",";
						} else {
        		$texto .="NULL,"; 
						}
      		break;
      		case "datetime":      
       			if($datos[$j][strtolower($tabla[$i]["Field"])]!=""){
        			$fecha = busca_filtro_tabla(fecha_db_obtener($tabla[$i]["Field"],'Y-m-d H:i:s')." as fecha",$ntabla,"$idcampo=$doc","",$conn);
        			$texto .= fecha_db_almacenar($fecha[0]["fecha"],'Y-m-d H:i:s').",";
						} else {
        		$texto .="NULL,";
						}
      		break;
      		case "text":
       			$texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
      		break;
      		default:
       			$texto .="'".$datos[$j][strtolower($tabla[$i]["Field"])]."',";
      		break;       
    		}      
   		}
   		$texto1 .= substr($campos, 1).") VALUES (".substr($texto, 0, strlen($texto)-1).");";
  	}
  	$eliminar = "DELETE FROM ".$ntabla." WHERE ".$idcampo." = ".$doc;
  	phpmkr_query($eliminar,$conn);
	}  
 	return $texto1; 
}

function copiar_archivo($origen, $nombre, $ruta_temp_backup) {
  $nombre=strrchr($origen,'/');
	if (is_file($origen) && is_dir($ruta_temp_backup)) {
		$resultado = copy($origen, $ruta_temp_backup . $nombre);
	} else {
		echo ("Problemas con rutas de archivos para hacer el backup. Ruta origen $origen - Ruta destino $ruta_temp_backup");
	}
 	return(true);      
}

function comprimir($doc, $alm_backup, $ruta_backup, $ruta_temp_backup) {
	require_once("libreria_zipfile.php");
	if ($dh = @opendir("$ruta_temp_backup")) {
 		$zipTest = new zipfile();	
   	while (false !== ($obj = readdir($dh))){ 
    	if($obj == '.' || $obj == '..'){ 
      	continue;
      } 
			if (is_file($ruta_temp_backup . '/' . $obj)) {
       	$i=0; 
				$zipTest->add_file($ruta_temp_backup . "/" . $obj, $obj);
      }
    } 
   	closedir($dh); 
	}  
	$filename = "/archivos_$doc.zip";
	$alm_backup->almacenar_contenido($ruta_backup . $filename, $zipTest->file());
	//$fd = fopen($ruta_backup . "/../" . $filename, "wb");
	//$out = fwrite($fd, $zipTest->file());
	//fclose($fd);
	return true;
}
?>
