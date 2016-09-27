<?php
set_time_limit(0);
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_notificaciones.php");

if(!@$_SESSION["LOGIN" . LLAVE_SAIA]) {
	$_SESSION["LOGIN" . LLAVE_SAIA] = @$_REQUEST["LOGIN"];
	$_SESSION["usuario_actual"] = $_REQUEST["usuario_actual"];
	$_SESSION["conexion_remota"] = 1;
	global $usuactual;
	$usuactual = @$_REQUEST["LOGIN"];
}

// ini_set("display_errors",true);
$_REQUEST['nombre_documento'] = str_replace("||", " ", $_REQUEST['nombre_documento']);

$datos_documento = obtener_datos_documento($_REQUEST["iddocumento"]);

if(array_key_exists('version_numero', $_REQUEST)) {
	$datos_documento["version"] = $_REQUEST["version_numero"];
}

if(!$datos_documento) {
	notificaciones("<b>No se creo la versi&oacute;n del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
	volver(1);
	die();
} else {
    
  
    
	switch($_REQUEST['tipo_versionamiento']) {
		/**
		 * Crea la version del documento (Crea el pdf nuevo del documento y toma los anexos y
		 * paginas digitalizadas para comprimirlas en la version del documento)
		 */
		case 1:
			$datos_documento['pdf'] = crear_pdf_documento_tcpdf($datos_documento);
		    chmod($ruta_db_superior.$datos_documento['pdf'],0777);
			if(!$datos_documento['pdf']) {
				notificaciones("<b>No se creo la versi&oacute;n del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
				volver(1);
				die();
			} else {
				
				$destino = crear_destino_version($datos_documento);
				
				if(!$destino) {
					notificaciones("<b>No se creo la versi&oacute;n del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
					volver(1);
					die();
				} else {
					$iddocumento_version = registrar_version_documento($datos_documento);
					
					if(!$iddocumento_version) {
						notificaciones("<b>No Se creo la versi&oacute;n del documento</b>", "success", 8500);
					} else {
						notificaciones("<b>Se creo la versi&oacute;n " . $datos_documento["version"] . " del documento</b>", "success", 8500);
						$documentos = obtener_anexos_paginas_documento($datos_documento);
						$copia_archivos = copiar_anexos_paginas_documento($datos_documento, $documentos, $iddocumento_version);
						
						if(!$copia_archivos) {
							notificaciones("<b>No se versionaron los anexos y/o paginas del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
							volver(1);
							die();
						}
						
						if(!$_REQUEST["no_redirecciona"]) {
							redirecciona($ruta_db_superior . "versionamiento/listar_versiones.php?iddocumento=" . $datos_documento["iddocumento"]);
						}
					}
				}
			}
			break;
		/**
		 * Crea la version del documento y reemplaza el anexo cuando se trata de un documento de calidad
		 * para ello elimina el anexo y crea un nuevo anexo, el cual lo asocia al iddocumento enviado
		 */
		case 2:
			$destino = crear_destino_version($datos_documento);
			$documentos = obtener_anexos_paginas_documento($datos_documento);
			
			if(!$destino) {
				notificaciones("<b>No se creo la versi&oacute;n del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
				die();
			} else {
				
				if(array_key_exists('iddocumento_anexo', $_REQUEST)) {
					$anexo_nuevo = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $_REQUEST["iddocumento_anexo"], "", $conn);
					
					if($anexo_nuevo["numcampos"]) {
						if(sizeof($documentos["anexos"])) {
							$accion = reemplazar_anexo_antiguo($documentos["anexos"], $anexo_nuevo, $datos_documento);
							
							modificar_etiqueta_documento($datos_documento, $_REQUEST["nombre_documento"]);
							if($accion) {
								notificaciones("<b>Los anexos han sido reemplazado con exito.</b>", "success", 11500);
							}
						} else {
							adicionar_registro_nuevo_anexo($datos_documento, $anexo_nuevo);
							modificar_etiqueta_documento($datos_documento, $_REQUEST["nombre_documento"]);
						}
					} else {
						notificaciones("<b>No se encuentra un nuevo anexo para reemplazar. Por lo tanto solo se versionara el documento</b>", "warning", 11500);
					}
				}
				
				$datos_documento['pdf'] = crear_pdf_documento_tcpdf($datos_documento);  
				
				if(!$datos_documento['pdf']) {
					// print_r($datos_documento);print_r('<-------- MUERE AQUI');
					
					notificaciones("<b>No se creo la versi&oacute;n del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
					volver(1);
					die();
				} else {
					$iddocumento_version = registrar_version_documento($datos_documento);
					
					if(!$iddocumento_version) {
						notificaciones("<b>No Se creo la versi&oacute;n del documento</b>", "success", 8500);
					} else {
						notificaciones("<b>Se creo la versi&oacute;n " . $datos_documento["version"] . " del documento</b>", "success", 8500);
						$documentos = obtener_anexos_paginas_documento($datos_documento);
						
						$copia_archivos = copiar_anexos_paginas_documento($datos_documento, $documentos, $iddocumento_version);
						
						if(!$copia_archivos) {
							notificaciones("<b>No se versionaron los anexos y/o paginas del documento<br />comuniquese con el administrador del sistema</b>", "warning", 11500);
							volver(1);
							die();
						}
						if(!$_REQUEST["no_redirecciona"]) {
							redirecciona($ruta_db_superior . "versionamiento/listar_versiones.php?iddocumento=" . $datos_documento["iddocumento"]);
						}
					}
				}
			}
			break;
		/**
		 * Crea la version del documento lo pone en estado eliminado el la tabla de documento
		 */
		case 3:
			poner_documento_estado_eliminado($datos_documento);
			notificaciones("<b>El documento a sido eliminado.</b>", "success", 7500);
			break;
	}
}

function crear_destino_version($datos_documento) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento['iddocumento']);
	$ruta_versiones = ruta_almacenamiento("versiones");
	
	//$ruta = $ruta_db_superior . RUTA_VERSIONES . $datos_documento['iddocumento'] . "/" . $datos_documento['version'];
	$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'];
	if(!is_dir($ruta)) {
		if(!crear_destino($ruta)) {
			notificaciones("<b>Error al crear la carpeta de destino.</b>", "warning", 7500);
			return (false);
		}
	}
	
	return ($ruta);
}

function copiar_anexos_paginas_documento($datos_documento, $documentos, $iddocumento_version) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	
	$raiz=$ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento['iddocumento']);
    $ruta_versiones=ruta_almacenamiento("versiones",0);
    $ruta_db_superior=$raiz;
	if(sizeof($documentos["anexos"])) {

		//$ruta = RUTA_VERSIONES . $datos_documento['iddocumento'] . "/" . $datos_documento['version'] . "/anexos";
		$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'] . "/anexos";
		
		if(!is_dir($ruta_db_superior.$ruta)) {
			if(!crear_destino($ruta_db_superior.$ruta)) {
				notificaciones("<b>Error al crear la carpeta de los anexos.</b>", "warning", 7500);
				return (false);
			}
		}
		
		if(!is_dir($ruta_db_superior.$ruta)) {
			notificaciones("<b>Error al crear la carpeta de los anexos.</b>", "warning", 7500);
			return (false);
		} else {
			
			foreach($documentos["anexos"] as $anexo) {
				$ruta_origen = $ruta_db_superior . $anexo["ruta"];
				$ruta_destino = $ruta_db_superior.$ruta . "/" . rand() . '.' . $anexo["tipo"];
				if(!copy($ruta_origen, $ruta_destino)) {
					notificaciones("<b>Error al pasar el anexo " . $anexo["etiqueta"] . " a la carpeta de los anexos.</b>", "warning", 7500);
					return (false);
				} else {
					$ruta_alm = substr($ruta_destino, strlen($ruta_db_superior));
					$insert_anexo = "INSERT INTO anexos_version(documento_iddocumento,version_numero,ruta,etiqueta,tipo) VALUES(" . $datos_documento["iddocumento"] . "," . $datos_documento["version"] . ",'" . $ruta_alm . "','" . $anexo["etiqueta"] . "','" . $anexo["tipo"] . "')";
					
					phpmkr_query($insert_anexo, "", $datos_documento["funcionario_codigo"]);
					$idanexos_version = phpmkr_insert_id();
					
					$insert_pivote = "INSERT INTO version_pivote_anexo(iddocumento_version, idanexos_version) VALUES(" . $iddocumento_version . "," . $idanexos_version . ")";
					phpmkr_query($insert_pivote, "", $datos_documento["funcionario_codigo"]);
				}
			}
		}
	}
	
	if(sizeof($documentos["paginas"])) {
		
		$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'] . "/paginas";
		
		if(!is_dir($ruta_db_superior.$ruta)) {
			if(!crear_destino($ruta_db_superior.$ruta)) {
				notificaciones("<b>Error al crear la carpeta de las paginas digitalizadas.</b>", "warning", 7500);
				return (false);
			}
		}
		
		if(!is_dir($ruta_db_superior.$ruta)) {
			notificaciones("<b>Error al crear la carpeta de las paginas digitalizadas.</b>", "warning", 7500);
			return (false);
		} else {
			foreach($documentos["paginas"] as $pagina) {
				$ruta_origen = $ruta_db_superior . $pagina["ruta"];
				$ruta_destino = $ruta_db_superior.$ruta . "/" . $pagina["pagina"] . ".jpg";
				
				if(!copy($ruta_origen, $ruta_destino)) {
					notificaciones("<b>Error al pasar la pagina " . $pagina["pagina"] . " a la carpeta de las paginas digitalizadas.</b>", "warning", 7500);
					return (false);
				} else {
					$ruta_alm = substr($ruta_destino, strlen($ruta_db_superior));
					$insert_pagina = "INSERT INTO anexos_version(documento_iddocumento,version_numero,ruta,etiqueta,tipo) VALUES(" . $datos_documento["iddocumento"] . "," . $datos_documento["version"] . ",'" . $ruta_alm . "','" . $pagina["pagina"] . "','jpg')";
					
					phpmkr_query($insert_pagina, "", $datos_documento["funcionario_codigo"]);
					$idanexos_version = phpmkr_insert_id();
					
					$insert_pivote = "INSERT INTO version_pivote_anexo(iddocumento_version, idanexos_version) VALUES(" . $iddocumento_version . "," . $idanexos_version . ")";
					phpmkr_query($insert_pivote, "", $datos_documento["funcionario_codigo"]);
				}
			}
		}
	}
	
	if($datos_documento["pdf"]) {
		
		//$ruta = RUTA_VERSIONES . $datos_documento['iddocumento'] . "/" . $datos_documento['version'] . "/pdf";
		$ruta = $ruta_versiones . $formato_ruta . "/version" . $datos_documento['version'] . "/pdf";
		
		if(!is_dir($ruta_db_superior.$ruta)) {
			if(!crear_destino($ruta_db_superior.$ruta)) {
				notificaciones("<b>Error al crear la carpeta del pdf.</b>", "warning", 7500);
				return (false);
			}
		}
		
		if(!is_dir($ruta_db_superior.$ruta)) {
			//die("no entro ..");
			notificaciones("<b>Error al crear la carpeta del pdf.</b>", "warning", 7500);
			return (false);
		} else {
			
			$nombre_pdf = explode("/", $datos_documento["pdf"]);
			$nombre_pdf = $nombre_pdf[(sizeof($nombre_pdf) - 1)];
			
			$ruta_origen = $datos_documento["pdf"];
			$ruta_destino = $ruta . "/" . $nombre_pdf;
			
			
			chmod($ruta_db_superior.$ruta_origen,0777);
			chmod($ruta_db_superior.$ruta_destino,0777);
			//print_r($ruta_origen); print_r('<------------>'); print_r($ruta_destino); print_r('<------------>'); print_r($ruta_db_superior);
		
			
			if(!copy($ruta_db_superior . $ruta_origen, $ruta_db_superior . $ruta_destino)) {
				notificaciones("<b>Error al pasar el pdf del documento a la carpeta.</b>", "warning", 7500);
				return (false);
			} else {
				$ruta_alm = substr($ruta_destino, strlen($ruta_db_superior));
				$insert_pdf = "INSERT INTO anexos_version(documento_iddocumento,version_numero,ruta,etiqueta,tipo) VALUES(" . $datos_documento["iddocumento"] . "," . $datos_documento["version"] . ",'" . $ruta_alm . "','pdf','pdf')";
				
				phpmkr_query($insert_pdf, "", $datos_documento["funcionario_codigo"]);
				$idanexos_version = phpmkr_insert_id();
				
				$insert_pivote = "INSERT INTO version_pivote_anexo(iddocumento_version, idanexos_version) VALUES(" . $iddocumento_version . "," . $idanexos_version . ")";
				phpmkr_query($insert_pivote, "", $datos_documento["funcionario_codigo"]);
			}
		}
	}
	return (true);
}

function registrar_version_documento($datos_documento) {
	$insert_version = "INSERT INTO documento_version(documento_iddocumento, numero_version, fecha, funcionario)VALUES(" . $datos_documento["iddocumento"] . ", " . $datos_documento['version'] . ", " . fecha_db_almacenar(date("Y-m-d H:i"), "Y-m-d H:i") . ", " . $datos_documento["funcionario_codigo"] . ")";
	
	phpmkr_query($insert_version, "", $datos_documento["funcionario_codigo"]);
	$iddocumento_version = phpmkr_insert_id();
	
	$update_documento = "UPDATE documento SET version=" . $iddocumento_version . " WHERE iddocumento=" . $datos_documento["iddocumento"];
	
	phpmkr_query($update_documento, "", $datos_documento["funcionario_codigo"]);
	
	if($_REQUEST["iddocumento_anexo"]) {
		$update_control_documentos = "UPDATE ft_control_documentos SET iddocumento_creado=" . $iddocumento_version . ", vigencia=" . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . " WHERE documento_iddocumento=" . $_REQUEST["iddocumento_anexo"];
		phpmkr_query($update_control_documentos, "", $datos_documento["funcionario_codigo"]);
	}
	
	if($iddocumento_version) {
		return ($iddocumento_version);
	} else {
		return (false);
	}
}

function reemplazar_anexo_antiguo($anexo_antiguo, $anexos, $datos_documento) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	
	$raiz=$ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento["iddocumento"]);
	$ruta_archivos = ruta_almacenamiento("archivos",0);
	$ruta_db_superior=$raiz;
	//$fecha_ruta = date("Y-m", strtotime($datos_documento["fecha"]));
	//$ruta_anexos = RUTA_ARCHIVOS . $datos_documento["estado"] . "/" . $fecha_ruta . "/" . $datos_documento["iddocumento"] . "/anexos";
	$ruta_anexos = $ruta_archivos . $formato_ruta . "/anexos";
	
	if(!is_dir($ruta_db_superior.$ruta_anexos)) {
		if(!crear_destino($ruta_db_superior.$ruta_anexos)) {
			notificaciones("<b>Error al crear la carpeta del anexo.</b>", "warning", 8500);
			return (false);
		}
	}
	
	foreach($anexo_antiguo as $value) {
		$delete_anexo = "delete FROM anexos where idanexos=" . $value["idanexo"];
		phpmkr_query($delete_anexo, "", $datos_documento["funcionario_codigo"]);
		
		$permiso_anexo = "delete FROM permiso_anexo where anexos_idanexos=" . $value["idanexo"];
		phpmkr_query($permiso_anexo, "", $datos_documento["funcionario_codigo"]);
		
		if(file_exists($ruta_db_superior . $value["ruta"])) {
			unlink($ruta_db_superior . $value["ruta"]);
		}
	}
	
	for($i = 0; $i < $anexos["numcampos"]; $i++) {
		$nombre_anexo = explode("/", $anexos[$i]['ruta']);
		$nombre_anexo = $nombre_anexo[count($nombre_anexo) - 1];
		
		$ruta_origen = $ruta_db_superior . $anexos[$i]["ruta"];
		$ruta_destino = $ruta_anexos . "/" . $nombre_anexo;
		
		if(!copy($ruta_origen, $ruta_db_superior . $ruta_destino)) {
			notificaciones("<b>Error al pasar el anexo " . $anexos[0]["etiqueta"] . " a la carpeta del documento.</b>", "warning", 8500);
		} else {
			$ruta_alm = substr($ruta_destino, strlen($ruta_db_superior));
			$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha_anexo) VALUES(" . $datos_documento["iddocumento"] . ",'" . $ruta_alm . "','" . $anexos[$i]["tipo"] . "','" . $anexos[$i]['etiqueta'] . "'," . $datos_documento['idformato'] . "," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
			
			phpmkr_query($sql_anexo, "", $datos_documento["funcionario_codigo"]);
			
			$idanexo = phpmkr_insert_id();
			
			if(!$idanexo) {
				notificaciones("<b>Error al registrar el anexo " . $anexos[$i]["etiqueta"] . "</b>", "warning", 8500);
			} else {
				
				$permiso_anexo = busca_filtro_tabla("", "permiso_anexo", "anexos_idanexos=" . $anexos[$i]["idanexos"], "", $conn);
				
				$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(" . $idanexo . ",'" . $permiso_anexo[0]['idpropietario'] . "','" . $permiso_anexo[0]['caracteristica_propio'] . "','" . $permiso_anexo[0]['caracteristica_dependencia'] . "','" . $permiso_anexo[0]['caracteristica_cargo'] . "','" . $permiso_anexo[0]["caracteristica_total"] . "')";
				
				phpmkr_query($sql_permiso_anexo, "", $datos_documento["funcionario_codigo"]);
				
				$idpermiso_anexo = phpmkr_insert_id();
				
				if(!$idpermiso_anexo) {
					notificaciones("<b>Error al registrar los permisos del anexo " . $anexos[$i]["etiqueta"] . "</b>", "warning", 8500);
				}
			}
		}
	}
	return (true);
}

function adicionar_registro_nuevo_anexo($datos_documento, $anexo) {
	global $conn, $ruta_db_superior;
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	$raiz=$ruta_db_superior;
	$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento["iddocumento"]);
	$ruta_archivos = ruta_almacenamiento("archivos",0);
	$ruta_db_superior=$raiz;
	//$ruta_anexo = RUTA_ARCHIVOS . $datos_documento["estado"] . "/" . date("Y-m") . "/" . $datos_documento["iddocumento"] . "/anexos";
	$ruta_anexo = $ruta_archivos . $formato_ruta . "/anexos";
	
	if(!is_dir($ruta_db_superior.$ruta_anexo)) {
		if(!crear_destino( $ruta_db_superior.$ruta_anexo)) {
			notificaciones("<b>Error al crear la carpeta del anexo.</b>", "warning", 7500);
			return (false);
		}
	}
	
	$ruta_anexo = $ruta_anexo . "/" . rand() . "." . $anexo[0]['tipo'];
	
	$ruta_origen = $ruta_db_superior . $anexo[0]['ruta'];
	$ruta_destino = $ruta_anexo;
	
	if(!copy($ruta_origen,$ruta_db_superior.$ruta_destino)) {
		notificaciones("<b>Error al pasar el pdf del documento a la carpeta.</b>", "warning", 7500);
		return (false);
	}
	
	$ruta_alm = substr($ruta_anexo, strlen($ruta_db_superior));
	$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha_anexo) VALUES(" . $datos_documento["iddocumento"] . ",'" . $ruta_alm . "','" . $anexo[0]['tipo'] . "','" . $anexo[0]['etiqueta'] . "'," . $datos_documento['idformato'] . "," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ")";
	
	phpmkr_query($sql_anexo, "", $datos_documento["funcionario_codigo"]);
	$idanexo = phpmkr_insert_id();
	
	if($idanexo) {
		$permiso_anexo = busca_filtro_tabla("", "permiso_anexo", "anexos_idanexos=" . $anexo[0]["idanexos"], "", $conn);
		
		$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(" . $idanexo . ",'" . $permiso_anexo[0]['idpropietario'] . "','" . $permiso_anexo[0]['caracteristica_propio'] . "','" . $permiso_anexo[0]['caracteristica_dependencia'] . "','" . $permiso_anexo[0]['caracteristica_cargo'] . "','" . $permiso_anexo[0]["caracteristica_total"] . "')";
		
		phpmkr_query($sql_permiso_anexo, "", $datos_documento["funcionario_codigo"]);
		
		$idpermiso_anexo = phpmkr_insert_id();
		
		if($idpermiso_anexo) {
			notificaciones("<b>El anexo " . $anexo[0]['etiqueta'] . " ha sido incorporado con exito</b>", "success", 8500);
		} else {
			notificaciones("<b>No se adicionaron los permisos al anexo " . $anexo[0]['etiqueta'] . ".<br />Favor comuniquese con el administrador del sistema.</b>", "warning", 8500);
		}
	} else {
		notificaciones("<b>No se adiciono el anexo " . $anexo[0]['etiqueta'] . " al documento.<br />Favor comuniquese con el administrador del sistema.</b>", "warning", 8500);
	}
}

function modificar_etiqueta_documento($datos_documento, $etiqueta) {
	global $conn;
	
	$update_documento = "UPDATE " . $datos_documento['tabla'] . " SET nombre='" . $etiqueta . "' where documento_iddocumento=" . $datos_documento['iddocumento'];
	
	// phpmkr_query($update_documento,"",$datos_documento["funcionario_codigo"]);
	phpmkr_query($update_documento);
}

function poner_documento_estado_eliminado($datos_documento) {
	global $conn;
	
	$sql = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $datos_documento["iddocumento"];
	// print_r($update_documento);die();
	// phpmkr_query($sql,$datos_documento["funcionario_codigo"]);
	phpmkr_query($sql);
}