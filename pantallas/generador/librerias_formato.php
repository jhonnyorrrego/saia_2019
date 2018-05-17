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
include_once($ruta_db_superior."librerias_saia.php");

function crear_contador($contador) {
	global $conn;
	
	$cont = busca_filtro_tabla("*", "contador", "nombre LIKE '" . $contador . "'", "", $conn);
	if(!$cont["numcampos"]) {
		$sql = "INSERT INTO contador(consecutivo, nombre) VALUES(1,'" . $contador . "')";
		guardar_traza($strsql, "ft_" . $contador);
		phpmkr_query($sql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql);
		return (phpmkr_insert_id());
	} else
		return ($cont[0]["idcontador"]);
}

function generar_campo_flujo($idformato, $idflujo) {
	$buscar_campo = busca_filtro_tabla("", "campos_formato A", "formato_idformato=" . $idformato . " AND nombre='idflujo'", "", $conn);
	
	if($buscar_campo["numcampos"] == 0) {
		$campo = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(" . $idformato . ",'idflujo', 'idflujo', 'VARCHAR', '255', 0, 'a,e,b', '" . $idflujo . "', 'select', 0, 'Select id,title as nombre from diagram order by nombre')";
		// Se deja el comentario para la modificacion de los flujos
		// guardar_traza($campo);
	} else {
		$campo = "UPDATE campos_formato SET formato_idformato=" . $idformato . ", nombre='idflujo', etiqueta='idflujo', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='" . $idflujo . "', etiqueta_html='select', valor='Select id,title as nombre from diagram order by nombre' WHERE idcampos_formato=" . $buscar_campo[0]["idcampos_formato"];
		// Se dejea el comentario para la modificacion de los flujos
		// guardar_traza($campo);
	}
	phpmkr_query($campo, $conn);
}

function vincular_funcion_responsables($idformato) {
	global $conn;
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='asignar_responsables'", "", $conn);
	if($buscar_funcion["numcampos"] == 0) {
		$nueva_funcion = "INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*asignar_responsables*}','asignar_responsables','asignar_responsables','asignar_responsables', 'funciones.php','" . $idformato . "','a')";
		guardar_traza($nueva_funcion, $formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion, $conn);
		$idfuncion = phpmkr_insert_id();
	} else {
		$idfuncion = $buscar_funcion[0]["idfunciones_formato"];
	}
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND nombre_funcion='asignar_responsables' AND B.formato_idformato=" . $idformato, "", $conn);
	if (!$buscar_funcion["numcampos"] && $idfuncion) {
		$sql = "INSERT INTO funciones_formato_enlace (formato_idformato,funciones_formato_fk) VALUES(" . $idformato . "," . $idfuncion . ")";
		guardar_traza($sql, $formato[0]["nombre_tabla"]);
		phpmkr_query($sql, $conn);
		$idfunciones_formato_enlace = phpmkr_insert_id();
	}
	if (@$idfuncion && $idfunciones_formato_enlace) {
		return (true);
	}
	return (false);
}

function vincular_funcion_digitalizacion($idformato) {
	global $conn;
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
	// --Vinculando funcion al adicionar de digitalizar
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='digitalizar_formato'", "", $conn);
	if (!$buscar_funcion["numcampos"]) {
		$nueva_funcion = "INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*digitalizar_formato*}','digitalizar_formato','digitalizar_formato','digitalizar_formato', '../librerias/funciones_formatos_generales.php','" . $idformato . "','a,e')";
		guardar_traza($nueva_funcion, $formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion, $conn);
		$idfuncion = phpmkr_insert_id();
	} else {
		$idfuncion = $buscar_funcion[0]["idfunciones_formato"];
	}
	$buscar_funcion = busca_filtro_tabla("", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND nombre_funcion='digitalizar_formato' AND B.formato_idformato=" . $idformato, "", $conn);
	if (!$buscar_funcion["numcampos"] && $idfuncion) {
		$sql = "INSERT INTO funciones_formato_enlace (formato_idformato,funciones_formato_fk) VALUES(" . $idformato . "," . $idfuncion . ")";
		guardar_traza($sql, $formato[0]["nombre_tabla"]);
		phpmkr_query($sql, $conn);
		$idfunciones_formato_enlace = phpmkr_insert_id();
	} else if ($buscar_funcion["numcampos"]) {
		$idfunciones_formato_enlace = $buscar_funcion[0]["idfunciones_formato_enlace"];
	}
	// ---Vinculando funcion de validacion al digitalizar
	
	if ($idfunciones_formato_enlace) {
		$buscar_funcion = busca_filtro_tabla("", "funciones_formato A", "nombre_funcion='validar_digitalizacion_formato'", "", $conn);
		if (!$buscar_funcion["numcampos"]) {
			$nueva_funcion = "INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*validar_digitalizacion_formato*}','validar_digitalizacion_formato','validar_digitalizacion_formato','validar_digitalizacion_formato', '../librerias/funciones_formatos_generales.php','" . $idformato . "','a,e')";
			guardar_traza($nueva_funcion, $formato[0]["nombre_tabla"]);
			phpmkr_query($nueva_funcion, $conn);
			$idfuncion_validar = phpmkr_insert_id();
		} else {
			$idfuncion_validar = $buscar_funcion[0]["idfunciones_formato"];
		}
		$buscar_funcion = busca_filtro_tabla("", "funciones_formato A, funciones_formato_enlace B", "A.idfunciones_formato=B.funciones_formato_fk AND nombre_funcion='validar_digitalizacion_formato' AND B.formato_idformato=" . $idformato, "", $conn);
		if (!$buscar_funcion["numcampos"] && $idfuncion_validar) {
			$sql = "INSERT INTO funciones_formato_enlace (formato_idformato,funciones_formato_fk) VALUES(" . $idformato . "," . $idfuncion_validar . ")";
			guardar_traza($sql, $formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
			$idfunciones_validar_enlace = phpmkr_insert_id();
		}
	}
	
	// Vinculando la accion de validar la digitalizar posterior a la accion correspondiente.
	if(in_array("e", $x_banderas)) {
		$accion = busca_filtro_tabla("", "accion", "nombre='aprobar'", "", $conn);
	} else {
		$accion = busca_filtro_tabla("", "accion", "nombre='adicionar'", "", $conn);
	}
	$buscar_funcion_accion = busca_filtro_tabla("", "funciones_formato_accion", "idfunciones_formato=" . $idfuncion_validar . " AND formato_idformato=" . $idformato, "", $conn);
	if (!$buscar_funcion_accion["numcampos"]) {
		$accion_digita = "INSERT INTO funciones_formato_accion (idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES(" . $idfuncion_validar . "," . $accion[0]["idaccion"] . ", " . $idformato . ", 'POSTERIOR',1,1)";
	} else {
		$accion_digita = "UPDATE funciones_formato_accion SET idfunciones_formato=" . $idfuncion_validar . ", accion_idaccion=" . $accion[0]["idaccion"] . ", formato_idformato=" . $idformato . ", momento='POSTERIOR', estado=1, orden=1 WHERE idfunciones_formato_accion=" . $buscar_funcion_accion[0]["idfunciones_formato_accion"];
	}
	guardar_traza($accion_digita, $formato[0]["nombre_tabla"]);
	phpmkr_query($accion_digita, $conn);
	return (true);
}

function vincular_campo_anexo($idformato) {
	global $conn;
	$formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
	$buscar_campo = busca_filtro_tabla("", "campos_formato A", "formato_idformato=" . $idformato . " AND nombre='anexo_formato'", "", $conn);
	
	if($buscar_campo["numcampos"] == 0) {
		$campo = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(" . $idformato . ",'anexo_formato', 'Anexos digitales', 'VARCHAR', '255', 0, 'a,e,b', '" . $idflujo . "', 'archivo', 0, '')";
	} else {
		$campo = "UPDATE campos_formato SET formato_idformato=" . $idformato . ", nombre='anexo_formato', etiqueta='Anexos digitales', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='" . $idflujo . "', etiqueta_html='archivo', valor='' WHERE idcampos_formato=" . $buscar_campo[0]["idcampos_formato"];
	}
	guardar_traza($campo, $formato[0]["nombre_tabla"]);
	phpmkr_query($campo);
}

function vincular_funciones_formato($libreria,$funcion){
	global $conn;
	$retorno = array(
			"mensaje" => "Error al tratar de vincular la funcion al formato",
			"exito" => 0
	);
	$libreria_formato=busca_filtro_tabla("","formato_libreria A","A.idformato_libreria=".$libreria,"",$conn);
	if($libreria_formato["numcampos"]){
		$existe=busca_filtro_tabla("","funciones_formato A","A.ruta='".$libreria_formato[0]["ruta"]."' AND A.nombre = '".$funcion."'","",$conn);
		if(!$existe["numcampos"]){
			$nombre=str_replace("{*","",$funcion);
			$nombre=str_replace("*}","",$nombre);
			$sql2="INSERT INTO funciones_formato(nombre,nombre_funcion,etiqueta,descripcion,ruta,acciones,formato) VALUES('".$funcion."','".$nombre
			."','".$nombre."','".$nombre."','".$libreria_formato[0]["ruta"]."','m',' ')";
			phpmkr_query($sql2);
			$idfunciones_formato=phpmkr_insert_id();
			if($idfunciones_formato){
				$sql2="INSERT INTO funciones_formato_enlace(formato_idformato,funciones_formato_fk) VALUES(".$libreria_formato[0]["formato_idformato"].",".$idfunciones_formato.")";
				phpmkr_query($sql2);
				$idfunciones_formato_enlace=phpmkr_insert_id();
				if($idfunciones_formato_enlace){
					$retorno["exito"]=1;
					$retorno["mensaje"]="Funcion vinculada con &eacute;xito";
				}
				else{
					$retorno["mensaje"]="Error al vincular la funcion ".$nombre." al formato error al generar el enlace  idfunciones_formato=".$idfunciones_formato;
				}
			}
			else{
				$retorno["mensaje"]="Error al vincular la funcion ".$nombre." al formato ".$sql2;
				
			}
		}
		else{
			if(strpos($existe[0]["acciones"],"m")!==false){
				$sql3="UPDATE acciones='m,".$existe[0]["acciones"]."' WHERE idfunciones_formato=".$existe[0]["idfunciones_formato"];
				phpmkr_query($sql3);
				/*
				 * TODO: Validar que las acciones queden vinculadas al mostrar 
				 * */
				$retorno["exito"]=1;
				$retorno["mensaje"]="Funcion vinculada con &eacute;xito";
			}
		}
	}
	else{
		$retorno["mensaje"]="La libreria no se encuentra vinculada con el formato, por lo tanto no se puede usar la funcion ".$funcion;
	}
	return($retorno);
}

function adicionar_pantalla_campos_formato($idpantalla,$datos){
  $campo_serie=busca_filtro_tabla("","pantalla_campos","nombre='serie_idserie' AND pantalla_idpantalla=".$idpantalla,"",$conn);
  if(!$campo_serie["numcampos"]){
    $sql2="INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(".$idpantalla.",'".$datos["nombre"]."','serie_idserie','Tipo de documento','int','11',0,'','a,e','Tipo de documento','','','hidden',0,1,'Tipo documental')";  
    phpmkr_query($sql2);
  }
  $campo_documento=busca_filtro_tabla("","pantalla_campos","nombre='documento_iddocumento' AND pantalla_idpantalla=".$idpantalla,"",$conn);
  if(!$campo_documento["numcampos"]){
    $sql2="INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(".$idpantalla.",'".$datos["nombre"]."','documento_iddocumento','Documento asociado','int','11',0,'','a','Documento asociado','','','hidden',0,0,'Documento')";
    phpmkr_query($sql2);
  }
	$campo_dependencia=busca_filtro_tabla("","pantalla_campos","nombre='dependencia' AND pantalla_idpantalla=".$idpantalla,"",$conn);
	if(!$campo_dependencia["numcampos"]){
		$sql2="INSERT INTO pantalla_campos(pantalla_idpantalla, tabla, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(".$idpantalla.",'".$datos["nombre"]."','dependencia','Seleccione rol','varchar','255',1,'select iddependencia_cargo as id, concat(dependencia,concat('' - '',cargo)) as nombre from vfuncionario_dc where idfuncionario={*idfuncionario*} and estado_dc=1','a','Seleccione el rol a utilizar','','','select',0,1,'Seleccionar')";
    phpmkr_query($sql2);
	}
}	
function eliminar_pantalla_campos_formato($idpantalla){
  $campo_serie=busca_filtro_tabla("","pantalla_campos","nombre='serie_idserie' AND pantalla_idpantalla=".$idpantalla,"",$conn);
  if($idpantalla){
    if($campo_serie["numcampos"]){
      $sql2="DELETE FROM pantalla_campos WHERE idpantalla=".$idpantalla." AND nombre='serie_idserie'";
      phpmkr_query($sql2);    
    }
    $campo_documento=busca_filtro_tabla("","pantalla_campos","nombre='documento_iddocumento' AND pantalla_idpantalla=".$idpantalla,"",$conn);
    if($campo_documento["numcampos"]){ 
      $sql2="DELETE FROM pantalla_campos WHERE idpantalla=".$idpantalla." AND nombre='documento_iddocumento'";
      phpmkr_query($sql2);    
    }
  }   
}
?>