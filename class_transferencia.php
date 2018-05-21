<?php
if (!isset($_SESSION))
	session_start();
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
include_once ($ruta_db_superior . "sql.php");
include_once ($ruta_db_superior . "asignacion.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_acciones.php");
include_once ($ruta_db_superior . "bpmn/librerias_formato.php");

/*
 * <Clase>
 * <Nombre>buscar_funcionarios</Nombre>
 * <Parametros>$dependencia:id de las dependencias a revisar;$arreglo:variable donde se va a guardar el resultado</Parametros>
 * <Responsabilidades>Busca los funcionarios de las dependencias especificadas<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function buscar_funcionarios($dependencia, $arreglo = NULL) {
	global $conn;
	$dependencias = dependencias($dependencia);
	array_push($dependencias, $dependencia);
	$dependencias = array_unique($dependencias);
	$funcionarios = busca_filtro_tabla("A.funcionario_codigo", "funcionario A,dependencia_cargo B, cargo C,dependencia D", "B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia=D.iddependencia and B.dependencia_iddependencia IN(" . implode(",", $dependencias) . ") AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1 AND A.sistema=1 AND C.tipo_cargo=1", "", $conn);
	$arreglo = extrae_campo($funcionarios, "funcionario_codigo", "U");
	return ($arreglo);
}

/*
 * <Clase>
 * <Nombre>dependencias</Nombre>
 * <Parametros>$padre:id de la dependencia</Parametros>
 * <Responsabilidades>Busca las dependencias hijas de la dependencia especificada<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function dependencias($padre) {
	global $conn;
	$listado1 = array();
	$listado2 = array();
	$listado3 = array();
	$ldependencias = busca_filtro_tabla("iddependencia", "dependencia A", "A.cod_padre IN(" . $padre . ")", "", $conn);
	$listado1 = extrae_campo($ldependencias, "iddependencia", "U");
	$padres = explode(",", $padre);

	if (count($listado1) > 0)
		$listado2 = array_diff($listado1, $padres);

	$cont = count($listado1);
	if ($cont) {
		$listado3 = dependencias(implode(",", $listado2));
		$listado4 = array_merge((array)$listado1, (array)$listado3);
	} else
		$listado4 = $padres;

	return ($listado4);
}

/*
 * <Clase>
 * <Nombre>minusculas</Nombre>
 * <Parametros>$texto:texto que se desea pasar a minusculas</Parametros>
 * <Responsabilidades>Pasa un texto a minúsculas<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function minusculas($texto) {
	$vocales = array('&AACUTE', '&EACUTE', '&IACUTE', '&OACUTE', '&UACUTE', '&NTILDE;');
	$reemplazo = array('&aacute', '&eacute', '&iacute', '&oacute', '&uacute', '&ntilde;');
	$texto_nuevo = strtolower($texto);
	for ($i = 0; $i < count($vocales); $i++) {
		$texto_nuevo = str_replace($vocales[$i], $reemplazo[$i], $texto_nuevo);
	}
	return ($texto_nuevo);
}

/*
 * <Clase>
 * <Nombre>usuarioactual
 * <Parametros>$campo-campo de la tabla funcionario que desea consultar
 * <Responsabilidades>consulta todos los datos del funcionario logueado
 * y devuelve el campo con nombre igual a $campo
 * <Notas>
 * <Excepciones>que el contenido de $campo no sea un campo de la tabla funcionario
 * <Salida>valor del campo con nombre $campo
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function usuarioactual($campo) {
	global $conn;
	$usuactual = $_SESSION["usuario_actual"];
	if ($usuactual != "") {
		$dato = busca_filtro_tabla("A.*,A.idfuncionario AS id", "funcionario A", "A.funcionario_codigo='" . $usuactual . "'", "", $conn);
		if ($dato != "")
			return ($dato[0][$campo]);
	}
	alerta("<b>ATENCI&Oacute;N</b><br>No se encuentra el funcionario en el sistema, por favor comuniquese con el administrador", 'error');
	redirecciona("logout.php");
}

/*
 * <Clase>
 * <Nombre>prepara_sql
 * <Parametros>$arreglo-matriz con los valores a formatear; $separador-caracter
 * con el cual quiero separar los campos
 * <Responsabilidades>Saca los valores de la matriz y los pone en una cadena entre
 * comillas simples y separados por $separador
 * <Notas>
 * <Excepciones>
 * <Salida>una cadena con los valores formateados
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function preparasql($arreglo, $separador) {
	if (is_array($arreglo)) {
		$aux_arreglo = array_values($arreglo);
		$values = "'" . ($aux_arreglo[0]) . "'";
		for ($i = 1; $i < count($arreglo); $i++)
			$values .= $separador . " '" . ($aux_arreglo[$i]) . "'";
		return ($values);
	}
	return (FALSE);
}

/*
 * <Clase>
 * <Nombre>radicar_documento_prueba
 * <Parametros>tipo_contador-nombre del tipo de contador a usar; arreglo-matriz con los valores del formulario
 * necesarios en la radicacion; $archivos-cadena con la lista de los anexos del documento
 * <Responsabilidades>guarda en la bd los datos del nuevo documento
 * <Notas>
 * <Excepciones>
 * <Salida>retorna el id del nuevo documento
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function radicar_documento_prueba($tipo_contador, $arreglo, $archivos = NULL, $idflujo = Null) {
	global $conn, $ruta_db_superior;
	if ($tipo_contador != "" && $tipo_contador != NULL)
		;
	elseif (array_key_exists("serie", $arreglo))
		$tipo_contador = $arreglo["serie"];
	else
		alerta("<b>ATENCI&Oacute;N</b><br>No es posible radicar el Documento. Error No existe clasificaci&oacute;n del documento", 'warning');

	if (!array_key_exists("numero", $arreglo) && $tipo_contador) {
		$arreglo["numero"] = 0;
	}
	if (!@$arreglo["plantilla"]) {
		$arreglo["plantilla"] = "''";
	} else {
		$idformato = busca_filtro_tabla("idformato", "formato", "lower(nombre)=" . strtolower($arreglo["plantilla"]) . "", "", $conn);
		if ($idformato['numcampos']) {
			$arreglo["formato_idformato"] = $idformato[0]['idformato'];
		}
	}
	if (!isset($arreglo["tipo_radicado"]))
		$arreglo["tipo_radicado"] = $contador[0]["idcontador"];
	if ($tipo_contador == "radicacion_salida" && !isset($arreglo["plantilla"]))
		$arreglo["estado"] = "'APROBADO'";
	elseif (@$arreglo["plantilla"] != "")
		$arreglo["estado"] = "'ACTIVO'";
	elseif (!isset($arreglo["estado"]))
		$arreglo["estado"] = "'ACTIVO'";
	$arreglo["fecha_creacion"] = fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s");

	// VENTANILLA RADICACION
	$ventanilla_radicacion = usuario_actual('ventanilla_radicacion');
	if (!$ventanilla_radicacion) {
		$ventanilla_radicacion = 0;
	}
	$arreglo["ventanilla_radicacion"] = $ventanilla_radicacion;

	$valores = implode(",", array_values($arreglo));
	$campos = implode(",", array_keys($arreglo));

	$sql = "INSERT INTO documento(" . $campos . ")" . " VALUES (" . $valores . ")";
	phpmkr_query($sql, $conn) or die($sql . "    <br> -" . phpmkr_error());
	$doc = phpmkr_insert_id();

	if ($doc && $arreglo["estado"] == "'APROBADO'") {
		$nombre_contador = busca_filtro_tabla("nombre", "contador", "idcontador=" . $arreglo["tipo_radicado"], "", $conn);
		contador($doc, $nombre_contador[0]["nombre"]);
	}
	if (@$arreglo[0]["tipo_radicado"] == 1) {
		$usuario = busca_filtro_tabla("valor", "configuracion", "nombre='envio_radicacion_entrada'", "", $conn);
		if ($usuario[0]["valor"] != 0 || $usuario[0]["valor"] != "") {
			$fun = $usuario[0]["valor"];
			$datos["tipo_destino"] = "1";
			$datos["archivo_idarchivo"] = $doc;
			$datos["origen"] = $_SESSION["usuario_actual"];
			$datos["nombre"] = "TRANSFERIDO";
			$datos["tipo"] = "";
			$datos["tipo_origen"] = "1";
			transferir_archivo_prueba($datos, array($fun), "");
		}
	}

	registrar_accion_digitalizacion($doc, 'CREACION DOCUMENTO');
	if ($archivos != NULL && $archivos != "") {
		$config = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_almacenamiento'", "", $conn);
		if ($config["numcampos"]) {
			$tipo_almacenamiento = $config[0]["valor"];
		} else
			$tipo_almacenamiento = "archivo";
		// Si no encuentra el registro en configuracion almacena en archivo
		if ($tipo_almacenamiento == "archivo") {
			$archivos = explode(",", $archivos);
			foreach ($archivos as $nombre) {
				$datos_anexo = explode(";", $nombre);
				if (!is_dir("../anexos/$doc")) {
					mkdir("../anexos/$doc/", PERMISOS_CARPETAS);
					chmod("../anexos/$doc/", PERMISOS_CARPETAS);
				}
				if (rename('../anexos/temporal/' . $datos_anexo[0], "../anexos/$doc/" . $datos_anexo[0]))
					$ruta = "../anexos/$doc/" . $datos_anexo[0];
				else
					$ruta = '../anexos/temporal/' . $datos_anexo[0];
				phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta) VALUES ('$ruta'," . $doc . ",'" . $datos_anexo[2] . "','" . $datos_anexo[1] . "')", $conn);
			}
		} elseif ($tipo_almacenamiento == "db") {
			$archivos = explode(",", $archivos);
			foreach ($archivos as $nombre) {
				$datos_anexo = explode(";", $nombre);
				phpmkr_query("INSERT INTO binario(nombre_original) VALUES ('$datos_anexo[1]')", $conn);
				$idbin = phpmkr_insert_id();
				$fcont = fopen('../anexos/temporal/' . $datos_anexo[0], "rb");
				$cont = fread($fcont, filesize('../anexos/temporal/' . $datos_anexo[0]));
				if (guardar_lob("datos", "binario", "idbinario=$idbin", $cont, "archivo", $conn)) {
					unlink('../anexos/temporal/' . $datos_anexo[0]);
					phpmkr_query("INSERT INTO anexos(ruta,documento_iddocumento,tipo,etiqueta) VALUES ('$idbin'," . $doc . ",'" . $datos_anexo[2] . "','" . $datos_anexo[1] . "')", $conn);
				} else {
					alerta("<b>ATENCI&Oacute;N</b><br>No se Pudo Almacenar el Anexo en la Base de Datos", 'error');
				}
				fclose($fcont);
			}
		}
	}
	if (!$idflujo && @$_REQUEST["idflujo"]) {
		$idflujo = $_REQUEST["idflujo"];
	}
	include_once ($ruta_db_superior . "workflow/libreria_paso.php");
	iniciar_flujo($doc, $idflujo);
	return ($doc);
}

/*
 * <Clase>
 * <Nombre>busca_cargofuncionario
 * <Parametros>tipo-tipo de dato enviado(nit,codigo de funcionario,login...);
 * dato-valor que identifica al usuario que deseo buscar; dependencia-dependencia a la cual pertenece el usuario
 * <Responsabilidades>buscar todos los datos de cargo,dependencia y funcionario del funcionario
 * identificado con los parametros recibidos
 * <Notas>
 * <Excepciones>si el funcionario no tiene un cargo asignado devuelve un vector con el valor recibido
 * en $dato
 * <Salida>vector con los datos de las tablas cargo,funcionario,dependencia
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function busca_cargofuncionario($tipo, $dato, $dependencia) {
	global $conn;
	$filtro = "";
	$datorig[0]["iddependencia_cargo"] = $dato;
	$temp = "";
	if ($tipo == 'nit' || $tipo == 1) {
		$filtro = "A.nit='" . $dato . "'";
	} else if ($tipo == 'id' || $tipo == 2) {
		$filtro = "A.funcionario_codigo=" . $dato;
	} else if ($tipo == 'login' || $tipo == 3) {
		$filtro = "A.login='" . $dato . "'";
	}
	if ($tipo == 'nit' || $tipo == 'id' || $tipo == 'login' || $tipo == 1 || $tipo == 2 || $tipo == 3) {
		$temp = busca_filtro_tabla("", "funcionario A", $filtro, "", $conn);
		if ($temp == "")
			error_("Datos del Funcionario Origen de Dependencia no Existe");
		else {
			$dorig = $temp[0]['idfuncionario'];
			$datorig = busca_filtro_tabla("f.*,c.*,f.estado as estado_f,d.estado as estado_d", "dependencia_cargo d, cargo c, funcionario f", "d.funcionario_idfuncionario=f.idfuncionario AND c.idcargo=d.cargo_idcargo AND f.idfuncionario='" . $dorig . "'", "f.estado ASC", $conn);
		}
	} else if ($tipo == "cargo" || $tipo == 4) {
		$datorig = busca_filtro_tabla("A.iddependencia_cargo", "dependencia_cargo A", "A.cargo_idcargo=$dato AND A.dependencia_iddependencia=$dependencia", "", $conn);
		if ($datorig["numcampos"] > 0)
			$datorig = busca_cargofuncionario(5, $datorig[0]["iddependencia_cargo"], "");
		else {
			$cargo = busca_filtro_tabla("nombre", "cargo", "idcargo=" . $dato, "", $conn);
			error_(codifica_encabezado("No existe nadie en esta dependencia con el cargo " . $cargo[0]["nombre"]));
		}
	} else if ($tipo == 'iddependencia_cargo' || $tipo == 5) {
		$datorig = busca_filtro_tabla("f.*,c.*,f.estado as estado_f,d.estado as estado_d", "dependencia_cargo d,funcionario f,cargo c", "c.idcargo=d.cargo_idcargo AND f.idfuncionario=d.funcionario_idfuncionario AND d.iddependencia_cargo=" . $dato, "", $conn);
	} else
		$datorig[0]['iddependencia_cargo'] = $dato;
	if ($temp != "" && $temp["numcampos"] > 0)
		$datorig[0] = array_merge((array)$datorig[0], (array)$temp[0]);
	return ($datorig);
}

/*
 * <Clase>
 * <Nombre>transferir_archivo_prueba
 * <Parametros>$datos-vector con los datos del formulario necesarios para hacer la transferencia;
 * $tipo-; $destino-lista de usuarios a quienes se enviar� el documento;
 * $adicionales-otros datos referentes a la transferencia;
 * $anexos indica si la transferencia tiene anexos relacionados
 * <Responsabilidades>enviar el documento a los funcionarios destino
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function transferir_archivo_prueba($datos, $destino, $adicionales, $anexos = NULL) {
	global $conn;
	$idtransferencia = array();
	sort($destino);

	/* REEMPLAZOS NUEVOS */
	$funcionarios = $destino;
	foreach ($funcionarios as $key => $valor) {
		$retorno = obtener_reemplazo($valor, 1);
		if ($retorno['exito']) {
			$destino[$key] = $retorno['funcionario_codigo'][0];
		}
	}
	// TERMINA REEMPLAZOS

	$idarchivo = $datos["archivo_idarchivo"];
	if (!isset($datos["ruta_idruta"])) {
		$datos["ruta_idruta"] = "";
	}
	if (array_key_exists("origen", $datos)) {
		$origen = $datos["origen"];
	} else if (@$_SESSION["usuario_actual"]) {
		$origen = $_SESSION["usuario_actual"];
	} else {
		$origen = usuario_actual("funcionario_codigo");
	}

	$doc = busca_filtro_tabla("B.idformato", "documento A,formato B", "A.plantilla=B.nombre AND iddocumento=" . $idarchivo, "", $conn);
	$idformato = @$doc[0]["idformato"];
	llama_funcion_accion($idarchivo, $idformato, "transferir", "ANTERIOR");
	if ($adicionales != Null && $adicionales != "" && is_array($adicionales)) {
		$otras_llaves = "," . implode(",", array_keys($adicionales));
		$otros_valores = "," . implode(",", array_values($adicionales));
		if ($otros_valores == ",") {
			$otros_valores = ",";
		}
	} else {
		$otras_llaves = "";
		$otros_valores = "";
	}
	if ($destino != "" && $origen != "") {
		$values_out = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",";
		if ($datos["tipo_destino"] == "1" || $datos["tipo_destino"] == "5") {
			$tipo_destino = 1;
			$datos_origen = "";
			if ($datos["tipo_destino"] == "5" && count($destino) == 1) {
				$datos_destino = busca_cargofuncionario(5, $destino[0], "");
				if ($datos_destino != "") {
					$destino[0] = $datos_destino[0]["funcionario_codigo"];
				}
			}
			if ($datos["ruta_idruta"] == "") {
				$datos["ruta_idruta"] = 0;
			}

			$values_out .= "'" . $origen . "',1,1" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";

			foreach ($destino as $user) {
				if ($datos["nombre"] != "POR_APROBAR") {
					$sql = "INSERT INTO buzon_salida (archivo_idarchivo,nombre,fecha,origen,tipo_origen,tipo_destino" . $otras_llaves . ",ver_notas,destino) values (" . $values_out . "," . $user . ")";
					phpmkr_query($sql, $conn);
					$idtransferencia[] = phpmkr_insert_id();
				} else if ($datos["nombre"] == "POR_APROBAR") {
					if (isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"] != "" && $datos["ruta_creador_documento"] == 1) {
						$sql = "INSERT INTO ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES(" . $_REQUEST["dependencia"] . ",'ACTIVO'," . $user . ",NULL,'POR_APROBAR'," . $idarchivo . ",5,1,1)";
					} else {
						$sql = "INSERT INTO ruta(origen,tipo,destino,idtipo_documental,condicion_transferencia,documento_iddocumento,tipo_origen,tipo_destino,obligatorio) VALUES(" . $origen . ",'ACTIVO'," . $user . ",NULL,'POR_APROBAR'," . $idarchivo . ",1,1,1)";
					}
					phpmkr_query($sql, $conn) or error("No se puede Generar una Ruta");
					$idruta = phpmkr_insert_id();
					$datos["ruta_idruta"] = $idruta;
				}
				$values_in = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'$origen',1," . $datos["ruta_idruta"] . ",$tipo_destino" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";
				$sql = "INSERT INTO buzon_entrada(archivo_idarchivo,nombre,fecha,destino,tipo_origen,ruta_idruta,tipo_destino" . $otras_llaves . ",ver_notas,origen) values(" . $values_in . "," . $user . ")";

				phpmkr_query($sql, $conn);
				procesar_estados($origen, $user, $datos["nombre"], $idarchivo);
			}
		} else {
			$values = "$idarchivo,'" . $datos["nombre"] . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$origen,$destino,$tipo_origen,$tipo_destino" . $otros_valores . ",'" . @$datos["ver_notas"] . "'";
			$sql = "insert into buzon_entrada(archivo_idarchivo,nombre,fecha,destino,origen,tipo_origen,tipo_destino" . $otras_llaves . ",ver_notas) values (" . $values . ")";
			phpmkr_query($sql, $conn);
		}
	}

	llama_funcion_accion($idarchivo, $idformato, "transferir", "POSTERIOR");
	if ($anexos == 1) {
		return $idtransferencia;
	} else {
		return (TRUE);
	}
}

/*
 * <Clase>
 * <Nombre>aprobar
 * <Parametros>$iddoc-id del documento en proceso
 * <Responsabilidades>para el proceso de recoleccion de firmas (aprobacion de la plantilla)
 * <Notas>Dependiendo del formato que pertenece el documento se valida si al momento de aprobar el documento se deben enviar transferencia a otros destinos, por ejemplo el memorando que se envia a destinos y copias.
 * <Excepciones>si el usuario no es el siguiente por aprobar muestra un mensaje de error
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>cambia el estado del nodo de POR_APROBAR a APROBADO, si es el ultimo por aprobar
 * cambia el estado del documento a APROBADO
 */
function aprobar($iddoc = 0, $opcion = 0) {
	global $ruta_db_superior, $conn;
	$aprobar_posterior = 0;
	if (isset($_REQUEST["iddoc"]) && $_REQUEST["iddoc"]) {
		$iddoc = $_REQUEST["iddoc"];
	}

	$tipo_radicado = busca_filtro_tabla("documento.*,contador.nombre,plantilla,idformato", "documento,contador,formato C", "idcontador=tipo_radicado and iddocumento=$iddoc AND lower(plantilla)=lower(C.nombre)", "", $conn);
	$datos_formato = busca_filtro_tabla("banderas,mostrar_pdf,nombre,nombre_tabla,cod_padre,idformato", "formato", "idformato='" . $tipo_radicado[0]["idformato"] . "'", "", $conn);
	$formato = strtolower($tipo_radicado[0]["plantilla"]);

	llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "confirmar", "ANTERIOR");

	$registro_actual = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and A.destino=" . $_SESSION["usuario_actual"], "A.idtransferencia", $conn);

	if ($registro_actual["numcampos"] > 0) {
		$registro_anterior = busca_filtro_tabla("A.*", "buzon_entrada A", "A.nombre='POR_APROBAR' and A.activo=1 and A.idtransferencia<" . $registro_actual[0]["idtransferencia"] . " and A.archivo_idarchivo=" . $iddoc . " and origen=" . $_SESSION["usuario_actual"], "A.idtransferencia desc", $conn);
		$terminado = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.nombre='POR_APROBAR' and A.activo=1", "A.idtransferencia", $conn);
		if ($registro_actual["numcampos"] > 0 && $registro_anterior["numcampos"] == 0) {
			$destino = $registro_actual[0]["destino"];
			$origen = $registro_actual[0]["origen"];

			if (($terminado["numcampos"] == $registro_actual["numcampos"]) || ($terminado["numcampos"] == 1 && $terminado[0]["destino"] == $_SESSION["usuario_actual"])) {
				$aprobar_posterior = 1;
				$estado = "APROBADO";
				llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "aprobar", "ANTERIOR");
			} else {
				$estado = "REVISADO";
			}
			$campos = "archivo_idarchivo,nombre,origen,fecha,destino,tipo,tipo_origen,tipo_destino,ruta_idruta";

			for ($i = 0; $i < $registro_actual["numcampos"]; $i++) {
				$registro_intermedio = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<" . $registro_actual[$i]["idtransferencia"], "A.idtransferencia", $conn);
				if ($registro_intermedio["numcampos"]) {
					break;
				}
				$valores = $iddoc . ",'$estado'," . $registro_actual[$i]["destino"] . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . "," . $registro_actual[$i]["origen"] . ",'DOCUMENTO',1,1";
				if ($registro_actual[$i]["ruta_idruta"] != "") {
					$valores .= "," . $registro_actual[$i]["ruta_idruta"];
				} else {
					$valores .= ",''";
				}
				phpmkr_query("INSERT INTO buzon_salida (" . $campos . ") VALUES (" . $valores . ")", $conn);

				phpmkr_query("UPDATE buzon_entrada SET activo=0 WHERE idtransferencia=" . $registro_actual[$i]["idtransferencia"], $conn);
				$valores = $iddoc . ",'$estado',$origen," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",$destino,'DOCUMENTO',1,1,";
			}
			if ($registro_actual[0]["ruta_idruta"] != "") {
				$valores .= $registro_actual[0]["ruta_idruta"];
			} else {
				$valores .= "''";
			}

			for ($i = 0; $i < $registro_actual["numcampos"]; $i++) {
				$registro_intermedio = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<" . $registro_actual[$i]["idtransferencia"], "A.idtransferencia", $conn);
				if ($registro_intermedio["numcampos"])
					break;
				$valores = $iddoc . ",'$estado'," . $registro_actual[$i]["origen"] . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . "," . $registro_actual[$i]["destino"] . ",'DOCUMENTO',1,1,";
				if ($registro_actual[$i]["ruta_idruta"] != "") {
					$valores .= $registro_actual[$i]["ruta_idruta"];
				} else {
					$valores .= "''";
				}
				phpmkr_query("INSERT INTO buzon_entrada(" . $campos . ") VALUES (" . $valores . ")", $conn);
				procesar_estados($registro_actual[$i]["destino"], $registro_actual[$i]["origen"], $estado, $iddoc);
			}

			if ($aprobar_posterior == 1) {
				$dias_entrega = busca_filtro_tabla("dias_entrega", "serie", "idserie=" . $tipo_radicado[0]["serie"], "", $conn);
				if ($tipo_radicado[0]["numero"] == 0) {
					$numero = contador($iddoc, $tipo_radicado[0]["nombre"]);
					$update = "UPDATE documento SET estado='APROBADO', fecha=" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ", dias='" . $dias_entrega[0]["dias_entrega"] . "' WHERE iddocumento=" . $iddoc;
					phpmkr_query($update, $conn);
				} else {
					phpmkr_query("UPDATE documento SET estado='APROBADO',activa_admin=0, fecha=" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ", dias='" . $dias_entrega[0]["dias_entrega"] . "' WHERE iddocumento=" . $iddoc, $conn);
				}

				$nombre_tabla = busca_filtro_tabla("nombre_tabla,banderas", "formato", "nombre like '$formato'", "", $conn);
				$tabla = $nombre_tabla[0]["nombre_tabla"];
				$campos_formato = listar_campos_tabla($tabla);

				if (in_array('fecha_' . $formato, $campos_formato)) {
					$sql = "update " . $tabla . " set fecha_" . $formato . "=" . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . " where documento_iddocumento=" . $iddoc;
					phpmkr_query($sql, $conn);
				}
				$respuestas = busca_filtro_tabla("origen,estado", "respuesta,documento", "iddocumento=origen and destino='" . $iddoc . "' and estado in('TRAMITE','ACTIVO','APROBADO')", "", $conn);
				if ($respuestas["numcampos"] > 0) {
					$origen_respuesta = busca_filtro_tabla("origen", "buzon_salida", "archivo_idarchivo=$iddoc and nombre='BORRADOR'", "", $conn);
					$datos["origen"] = $origen_respuesta[0]["origen"];
					$datos["nombre"] = "RESPONDIDO";
					$datos["tipo"] = "";
					$datos["tipo_origen"] = "1";
					$datos["tipo_destino"] = "1";
					for ($i = 0; $i < $respuestas["numcampos"]; $i++) {
						if ($respuestas[$i]["estado"] == "TRAMITE" || $respuestas[$i]["estado"] == "ACTIVO") {
							$sql = "UPDATE documento set estado='APROBADO' where iddocumento='" . $respuestas[$i]["origen"] . "'";
							phpmkr_query($sql, $conn);
						}
						$datos["archivo_idarchivo"] = $respuestas[$i]["origen"];
						$destino_respuesta[0] = $origen_respuesta[0]["origen"];
						$destino_respuesta[0] = $_SESSION["usuario_actual"];
						transferir_archivo_prueba($datos, $destino_respuesta, "", "");
					}
				}

				if ($datos_formato[0]["mostrar_pdf"] == 1) {
					$sql1 = "UPDATE documento SET pdf=null WHERE iddocumento=" . $iddoc;
					phpmkr_query($sql1);
				}
			}
			$array_banderas = explode(",", $nombre_tabla[0]["banderas"]);
		}
	}

	if ($datos_formato[0]["mostrar_pdf"] == 1) {
		$sql1 = "UPDATE documento SET pdf=null WHERE iddocumento=" . $iddoc;
		phpmkr_query($sql1);
	}

	llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "confirmar", "POSTERIOR");
	if ($aprobar_posterior == 1) {
		llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "aprobar", "POSTERIOR");
	}
	actualizar_datos_documento($tipo_radicado[0]["idformato"],$iddoc);
	if ($opcion == 0) {
		if ($_REQUEST["anterior"] == $iddoc) {
			enrutar_documento($ruta_db_superior . 'pantallas/documento/informacion_resumen_documento.php?iddoc=' . $iddoc, 'arbol_formato');
			return ($iddoc);
		} else {
			$formato_ant = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $datos_formato[0]["cod_padre"], "", $conn);
			if ($formato_ant["numcampos"]) {
				$iddoc_anterior = busca_filtro_tabla("a.documento_iddocumento", $formato_ant[0]["nombre_tabla"] . " a," . $datos_formato[0]["nombre_tabla"] . " b", "a.id" . $formato_ant[0]["nombre_tabla"] . "=b." . $formato_ant[0]["nombre_tabla"] . " and b.documento_iddocumento=" . $iddoc, "", $con);
				if ($iddoc_anterior["numcampos"]) {
					$_REQUEST["anterior"] = $iddoc_anterior[0]["documento_iddocumento"];
				}
			}
			enrutar_documento();
		}
	}
	return $iddoc;
}

/*
 * <Clase>
 * <Nombre>crear_pdf</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc:id del documento</Parametros>
 * <Responsabilidades>Genera el pdf del formato<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function crear_pdf($idformato, $iddoc) {
	global $conn;
	$url = "pantallas/documento/visor_documento.php?iddoc=" . $iddoc . "&actualizar_pdf=1&rand=" . rand(0, 1000);
	abrir_url($url, "_self");
}

/*
 * <Clase>
 * <Nombre>mostrar_formato</Nombre>
 * <Parametros>$idformato:id del formato;$iddoc: id del documento</Parametros>
 * <Responsabilidades><Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excepciones>
 * <Salida></Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function mostrar_formato($idformato, $iddoc) {
	global $conn;
	if (!isset($_REQUEST["no_redirecciona"])) {
		$datos_formato = busca_filtro_tabla("ruta_mostrar,nombre,mostrar_pdf", "formato", "idformato=$idformato", "", $conn);
		if ($datos_formato[0]["mostrar_pdf"] == 1) {
			$url = $ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $iddoc . "&idformato=$idformato&actualizar_pdf=1";
		} else if ($datos_formato[0]["mostrar_pdf"] == 2) {
			$url = $ruta_db_superior . "pantallas/documento/visor_documento.php?iddoc=" . $iddoc . "&pdf_word=1";
		} else {
			$url = "formatos/" . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?iddoc=" . $iddoc . "&idformato=$idformato";
		}
		if (!@$_REQUEST['aprobacion_externa']) {
			redirecciona($url);
		}
	}
}

function mostrar_estado_proceso($idformato, $iddoc) {
	global $conn, $idfactura;
	$rol = false;
	if (!isset($_REQUEST["ocultar_firmas"]) || $_REQUEST["ocultar_firmas"] == 0) {
		$firma_actual = false;
		$estado_doc = busca_filtro_tabla("A.estado,A.serie,A.ejecutor,A.documento_antiguo", "documento A", "A.iddocumento=" . $iddoc, "", $conn);
		$iniciales = $estado_doc[0]["ejecutor"];
		$ultimo_ruta = busca_filtro_tabla("max(A.idtransferencia) as idbuzon", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc, "", $conn);
		if ($pagina != "mostrar_calidad") {
			$tabla = busca_filtro_tabla("nombre_tabla", "formato A", "A.idformato=" . $idformato, "", $conn);
			$mostrar_firmas_doc = busca_filtro_tabla("A.firma,dependencia" . $campos_formato, "" . $tabla[0]["nombre_tabla"] . " A,documento B", "A.documento_iddocumento=B.iddocumento and B.iddocumento=" . $iddoc, "", $conn);
			if ($mostrar_firmas_doc["numcampos"] > 0) {
				$mostrar_firmas = $mostrar_firmas_doc[0]["firma"];
			}
		} else {
			$mostrar_firmas = 1;
		}

		if (!array_key_exists("tipo", $_REQUEST)) {
			$_REQUEST["tipo"] = 1;
		}
		$resultado = cargo_rol($_REQUEST["iddoc"]);
		if (!$resultado["numcampos"]) {
			if (!$estado_doc[0]["documento_antiguo"]) {
				$resultado = busca_filtro_tabla("distinct iddependencia_cargo as origen,idfuncionario,funcionario_codigo,nombres,apellidos,1 as activo,1 as obligatorio,nombre", "funcionario,dependencia_cargo,buzon_entrada", "archivo_idarchivo=" . $_REQUEST["iddoc"] . " and destino=funcionario_codigo and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and idfuncionario=funcionario_idfuncionario and iddependencia_cargo=" . $mostrar_firmas_doc[0]["dependencia"], "", $conn);
				$resultado[0]["tipo_origen"] = 5;
			} else {
				$resultado = busca_filtro_tabla("distinct iddependencia_cargo as origen,idfuncionario,funcionario_codigo,nombres,apellidos,1 as activo,1 as obligatorio,nombre", "funcionario,dependencia_cargo,buzon_entrada", "archivo_idarchivo=" . $_REQUEST["iddoc"] . " and destino=funcionario_codigo and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and idfuncionario=funcionario_idfuncionario and dependencia_iddependencia=" . $mostrar_firmas_doc[0]["dependencia"], "", $conn);
				if (!$resultado["numcampos"])
					$resultado = busca_filtro_tabla("distinct iddependencia_cargo as origen,idfuncionario,funcionario_codigo,nombres,apellidos,1 as activo,1 as obligatorio,nombre", "funcionario,dependencia_cargo,buzon_entrada", "archivo_idarchivo=" . $_REQUEST["iddoc"] . " and destino=funcionario_codigo and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and idfuncionario=funcionario_idfuncionario", "", $conn);
				$resultado[0]["tipo_origen"] = 5;
			}
			if (!$resultado["numcampos"]) {
				echo '<font color="red">El documento no tiene responsable(s) asignado(s).</font>';
				return;
			}
		}

		$num_cols = 2;
		$i = 0;
		$firmas = 0;
		$fila_abierta = 0;
		$ocultar_confirmar = 0;
		if ($resultado["numcampos"]) {
			array_unique($resultado);
			$ancho_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='ancho_firma'", "", $conn);
			if (!$ancho_firma["numcampos"]) {
				$ancho_firma[0]["valor"] = 200;
			}

			$alto_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='alto_firma'", "", $conn);
			if (!$alto_firma["numcampos"]) {
				$alto_firma[0]["valor"] = 100;
			}
			$tamano_fuente = busca_filtro_tabla("valor", "configuracion A", "A.nombre='tamano_letra'", "", $conn);
			if (!$tamano_fuente["numcampos"]) {
				$tamano_fuente[0]["valor"] = '10pt';
			}

			echo "<table border=\"0\" cellpadding='0' cellspacing='0' align='left' width=\"100%\">";

			for ($k = $resultado["numcampos"] - 1; $k >= 0; $k--) {
				if (!$resultado[$k])
					continue;
				$fila = $resultado[$k];
				if ($fila["tipo_origen"] == 5) {// rol
					$cargos = busca_filtro_tabla("distinct cargo.nombre", "cargo,dependencia_cargo", "cargo_idcargo=idcargo AND tipo_cargo=1 and iddependencia_cargo=" . $fila["origen"], "", $conn);
				} elseif ($fila["tipo_origen"] == 1) {// funcionario_codigo
					$cargos = busca_filtro_tabla("distinct funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND tipo_cargo=1 AND idfuncionario=funcionario_idfuncionario and fecha_inicial<='" . $fila["fecha"] . "' and fecha_final>='" . $fila["fecha"] . "' and funcionario_codigo='" . $fila["origen"] . "' AND dependencia_cargo.estado=1", "", $conn);
					if (!$cargos["numcampos"])
						$cargos = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND tipo_cargo=1 AND idfuncionario=funcionario_idfuncionario and funcionario_codigo='" . $fila["origen"] . "'", "fecha desc", $conn);
				}
				if (!isset($fila["obligatorio"]))
					$fila["obligatorio"] = 1;

				if ($fila["obligatorio"] == 1) {
					if ($firmas == 0) {
						echo "<tr>";
						$fila_abierta = 1;
					}

					if ($fila["nombre"] == "POR_APROBAR") {
						echo '<td align="left"><img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/firmas/faltante.jpg" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '">&nbsp;&nbsp;&nbsp;<br /></td>';
						if ($iniciales == ($fila["funcionario_codigo"]))
							$firma_actual = true;
					} else if ($mostrar_firmas == 1) {
						$firma = busca_filtro_tabla("firma", "funcionario", "funcionario_codigo='" . $fila["funcionario_codigo"] . "'", "", $conn);
						echo '<td align="left">';
						if ($firma[0]["firma"] != "") {
							$pagina_actual = $_SERVER["PHP_SELF"];
							echo '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/formatos/librerias/mostrar_foto.php?codigo=' . $fila["funcionario_codigo"];
							echo '" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '"/><br />';
						} else
							echo '<img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/firmas/blanco.jpg" width="100" height="' . $alto_firma[0]["valor"] . '" ><br />';

						echo "<strong>" . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "</strong>&nbsp;&nbsp;&nbsp;<br />";
						if ($cargos["numcampos"]) {
							for ($h = 0; $h < $cargos["numcampos"]; $h++)
								echo formato_cargo($cargos[$h]["nombre"]) . "<br/>";
						}
						if ($iniciales == ($fila["funcionario_codigo"]))
							$firma_actual = true;
						echo "</td>";
					} else {
						echo "<td align='left'><img src='" . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/firmas/blanco.jpg' width='" . $ancho_firma[0]["valor"] . "' height='" . $alto_firma[0]["valor"] . "'>
							<br /><b>" . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "</b>&nbsp;&nbsp;&nbsp;<br />";
						if ($cargos["numcampos"]) {
							for ($h = 0; $h < $cargos["numcampos"]; $h++)
								echo formato_cargo($cargos[$h]["nombre"]) . "<br/>";
						}
						if ($iniciales == ($fila["funcionario_codigo"]))
							$firma_actual = true;
						echo "</td>";
					}
					$firmas++;
				} elseif ($fila["obligatorio"] == 2) {// Revisado
					if ($fila["nombre"] == "POR_APROBAR")
						$revisados .= "<tr><td style='width:100%;'><br/><span class='phpmaker'>Revis&oacute; : " . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "-" . formato_cargo($cargos[0]["nombre"]) . " (Pendiente)</span></td></tr>";
					elseif ($fila["nombre"] == "APROBADO" || $fila["nombre"] == "REVISADO")
						$revisados .= "<tr><td style='width:100%;'><br/><span class='phpmaker'>Revis&oacute; : " . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "-" . formato_cargo($cargos[0]["nombre"]) . "</span> </td></tr>";
				} elseif ($fila["obligatorio"] == 5) {// Firma externa
					if ($firmas == 0) {
						echo "<tr>";
						$fila_abierta = 1;
					}
					if ($fila["nombre"] == "POR_APROBAR" && $fila["firma_externa"] == '') {
						$firmar = "&nbsp;&nbsp;";
						if ($_SESSION['usuario_actual'] == $fila["funcionario_codigo"]) {
							$firmar = firma_externa_funcion($idformato, $iddoc, "ruta", "firma_externa", "idruta", $fila["idruta"], "&confirmar=1", 1);
							$ocultar_confirmar++;
						}
						echo "<td><br/><br/>" . $firmar . "<br/><br/><br/>_______________________________<br/><br/><br/></td>";
					} else if ($fila["firma_externa"] != '') {
						$_REQUEST["campo_seleccion"] = "firma_externa";
						$_REQUEST["campo_tabla"] = "idruta";
						$_REQUEST["llave_seleccion"] = firma_externa_funcion($idformato, $iddoc, "ruta", "firma_externa", "idruta", $fila["idruta"], "", 1);
						$_REQUEST["tabla"] = "ruta";
						$_REQUEST["firma"] = "1";
						require_once ($ruta_db_superior . "formatos/librerias/mostrar_foto_manual.php");
						$parte = '<td><img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/carpeta_temporal_firma/imagen_temporal' . $_REQUEST["llave_seleccion"] . '.jpg" width="200" height="100">';

						$parte .= "<br /><strong>" . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "</strong><br />";
						if ($cargos["numcampos"]) {
							for ($h = 0; $h < $cargos["numcampos"]; $h++)
								$parte .= formato_cargo($cargos[$h]["nombre"]) . "<br/>";
						}
						echo($parte . "</td>");
					}
					$firmas++;
				}
				if ($firmas == $num_cols) {
					$firmas = 0;
					echo "</tr>";
					$fila_abierta = 0;
				}
			}
		
	

			if ($firmas < $num_cols && $fila_abierta == 1) {
				while ($firmas < $num_cols) {
					echo "<td>&nbsp;</td>";
					$firmas++;
				}
				echo "</tr>";
			}
		}
		if ($revisados != "") {
			echo "<tr>";
			echo "<td colspan=\"$num_cols\">";
			echo "<table border=\"0\" width=\"100%\">";
			echo $revisados;
			echo "</table>";
			echo "</td></tr>";
		}
		echo "</table><br/>";

	}

	if ($_REQUEST["tipo"] == 1 && $ocultar_confirmar) {
		echo "<script>
		$(document).ready(function(){
			$('#boton_confirmar').attr('disabled','true');
		});
		</script>";
	}
	if (!$firma_actual)
		return (true);
	else
		return (false);
}


/*
 * <Clase>
 * <Nombre>cargo_rol
 * <Parametros>iddoc-id del documento;
 * <Responsabilidades>busca si el documento tiene ruta y el estado de la ruta, para buscar la informacion del funcionario de dicha ruta dependiendo de la entidad
 * <Notas>Esta funcion es para las firmas es llamada por mostrar_estado_proceso
 * <Excepciones>
 * <Salida> array con nombres, apellidos, idfuncionario y codigo del funcionario de la ruta del documento
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function cargo_rol($iddoc) {
	global $conn;
	$resultado = array();
	$tipo = busca_filtro_tabla("distinct activo,nombre,obligatorio,ruta.origen,ruta.tipo_origen,orden,ruta.idruta," . fecha_db_obtener('buzon_entrada.fecha', 'Y-m-d H:i') . " as fecha,ruta.firma_externa", "buzon_entrada,ruta", "ruta_idruta=idruta and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and (obligatorio in(1,2,5)) and ruta.tipo='ACTIVO'  and archivo_idarchivo=" . $iddoc, "ruta.idruta asc,buzon_entrada.nombre asc", $conn);
	for ($i = 0; $i < $tipo["numcampos"]; $i++) {
		if (in_array($tipo[$i]["origen"], $origenes)) {
			unset($tipo[$i]);
			continue;
		}
		$origenes[] = $tipo[$i]["origen"];
		switch ($tipo[$i]["tipo_origen"]) {
			case 1 :
				$fun = busca_filtro_tabla("nombres,apellidos,idfuncionario,funcionario_codigo", "funcionario", "funcionario_codigo=" . $tipo[$i]["origen"], "", $conn);
				break;
			case 5 :
				$fun = busca_filtro_tabla("nombres,apellidos,idfuncionario,funcionario_codigo", "funcionario,dependencia_cargo", "idfuncionario=funcionario_idfuncionario and iddependencia_cargo=" . $tipo[$i]["origen"], "", $conn);
				break;
		}
		$tipo[$i]["nombres"] = $fun[0]["nombres"];
		$tipo[$i]["apellidos"] = $fun[0]["apellidos"];
		$tipo[$i]["idfuncionario"] = $fun[0]["idfuncionario"];
		$tipo[$i]["funcionario_codigo"] = $fun[0]["funcionario_codigo"];
	}
	return $tipo;
}

/*
 * <Clase>
 * <Nombre>radicar_plantilla
 * <Parametros>
 * <Responsabilidades>se encarga de radicar los documentos de tipo plantilla
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function radicar_plantilla() {
	global $conn, $sql, $ruta_db_superior;
	$valores = array();
	$plantilla = "";
	$idformato = 0;
	if (!@$_POST["ejecutor"]) {
		$_POST["ejecutor"] = $_SESSION["usuario_actual"];
	}
	if (@$_POST["formato"]) {
		$plantilla = "'" . strtoupper($_POST["formato"]) . "'";
		$formato = busca_filtro_tabla("idformato,nombre_tabla", "formato A", "A.nombre LIKE '" . strtolower($_POST["formato"]) . "'", "", $conn);
		if ($formato["numcampos"]) {
			$idformato = $formato[0]["idformato"];
			$campos = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $formato[0]["idformato"] . " AND banderas LIKE '%u%'", "", $conn);
			for ($l = 0; $l < $campos["numcampos"]; $l++) {
				if ($_REQUEST[$campos[$l]["nombre"]]) {
					$dato = busca_filtro_tabla("", $formato[0]["nombre_tabla"], $campos[$l]["nombre"] . "=" . $_REQUEST[$campo[$l]["nombre"]], "", $conn);
					if ($dato["numcampos"]) {
						if (!isset($_REQUEST["no_redirecciona"])) {
							alerta("<b>ATENCI&Oacute;N</b><br>El campo " . $campos[$l]["nombre"] . " Debe ser Unico por Favor Vuelva a Insertar la informacion", 'warning', 5000);
							volver(1);
						} else {
							$retorno["mensaje"] = "El campo " . $campos[$l]["nombre"] . " Debe ser Unico por Favor Vuelva a Insertar la informacion";
							return (json_encode($retorno));
						}
					}
				}
			}
		}
	}

	$buscar = phpmkr_query("SELECT A.* FROM documento A WHERE 1=0", $conn);
	$lista_campos = array();
	for ($i = 0; $i < phpmkr_num_fields($buscar); $i++) {
		array_push($lista_campos, strtolower(phpmkr_field_name($buscar, $i)));
	}

	$valores = array("fecha" => fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s'));
	foreach ($_POST as $key => $valor) {
		if (in_array($key, $lista_campos) && $key != "estado" && $key != "descripcion" && $key != "fecha") {
			if ($valor[0] != "'") {
				$valor = "'" . $valor . "'";
			}
			$valores[$key] = $valor;
		}
	}
	$valores["descripcion"] = "'" . str_replace("'", "", $_POST["descripcion"]) . "'";
	if (isset($_POST["serie_idserie"]) && $_POST["serie_idserie"]) {
		$valores["serie"] = $_POST["serie_idserie"];
	} else {
		$valores["serie"] = 0;
	}
	$valores["plantilla"] = $plantilla;
	if (isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"] != "") {
		$valores["responsable"] = $_REQUEST["dependencia"];
	}
	if (@$_POST["tipo_radicado"]) {
		$tipo_radicado = busca_filtro_tabla("idcontador", "contador", "nombre='" . $_POST["tipo_radicado"] . "'", "", $conn);
		if ($tipo_radicado["numcampos"]) {
			$valores["tipo_radicado"] = $tipo_radicado[0]["idcontador"];
		} else if (isset($formato) && $formato["numcampos"]) {
			$valores["tipo_radicado"] = $formato[0]["contador_idcontador"];
		} else {
			$valores["tipo_radicado"] = 0;
		}
	}
	if (isset($formato) && $formato["numcampos"] && $valores["tipo_radicado"]) {
		$tipo_rad = busca_filtro_tabla("nombre", "contador", "idcontador=" . $valores["tipo_radicado"], "", $conn);
		if ($tipo_rad["numcampos"]) {
			$_POST["tipo_radicado"] = $tipo_rad[0]["nombre"];
		}
	} else {
		if (!isset($_REQUEST["no_redirecciona"])) {
			alerta("<b>ATENCI&Oacute;N</b><br>El Documento que intenta Radicar no posee Secuencia", 'error', 5000);
			volver(1);
		} else {
			$retorno["mensaje"] = "El Documento que intenta Radicar no posee Secuencia";
			return (json_encode($retorno));
		}
	}
	$valores["numero"] = 0;
	if (isset($_POST["municipio"])) {
		$valores["municipio_idmunicipio"] = $_POST["municipio"];
	} else if (isset($_POST["municipio_idmunicipio"])) {
		$valores["municipio_idmunicipio"] = $_POST["municipio_idmunicipio"];
	} else {
		$mun = busca_filtro_tabla("valor", "configuracion", "nombre='ciudad'", "", $conn);
		if ($mun["numcampos"]) {
			$valores["municipio_idmunicipio"] = $mun[0][0];
		} else {
			$valores["municipio_idmunicipio"] = 633;
		}
	}

	llama_funcion_accion(NULL, $idformato, "radicar", "ANTERIOR");
	$_POST["iddoc"] = radicar_documento_prueba(trim($_POST["tipo_radicado"]), $valores, Null);
	if ($plantilla == "") {
		include_once ("anexosdigitales/funciones_archivo.php");
		$permisos = NULL;
		cargar_archivo($_POST["iddoc"], $permisos);
	}

	llama_funcion_accion($_POST["iddoc"], $idformato, "radicar", "POSTERIOR");

	if (array_key_exists("anterior", $_REQUEST)) {
		llama_funcion_accion($_REQUEST["anterior"], $idformato, "responder", "ANTERIOR");
		$idbuzon = busca_filtro_tabla("max(A.idtransferencia) as idbuzon", "buzon_entrada A", "A.archivo_idarchivo=" . $_REQUEST["anterior"], "", $conn);
		phpmkr_query("INSERT INTO respuesta(fecha,destino,origen,idbuzon,plantilla) VALUES (" . fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s') . "," . $_POST["iddoc"] . "," . $_REQUEST["anterior"] . "," . $idbuzon[0]["idbuzon"] . "," . $plantilla . ")", $conn);

		$datos["archivo_idarchivo"] = $_REQUEST["anterior"];
		$datos["nombre"] = "TRAMITE";
		$datos["tipo_destino"] = 1;
		$datos["tipo"] = "";
		$destino_tramite[] = $_SESSION["usuario_actual"];
		transferir_archivo_prueba($datos, $destino_tramite, "", "");
		llama_funcion_accion($_REQUEST["anterior"], $idformato, "responder", "POSTERIOR");
	}

	if ($_POST["iddoc"]) {
		$idplantilla = guardar_documento($_POST["iddoc"]);
	}

	if (!$idplantilla) {
		if (!isset($_REQUEST["no_redirecciona"])) {
			alerta("<b>ATENCI&Oacute;N</b><br>No se ha podido Crear el documento..", 'error', 5000);
			phpmkr_query("update documento set estado='ELIMINADO' where iddocumento=" . $_POST["iddoc"], $conn);
			redirecciona("responder.php");
		} else {
			$retorno["mensaje"] = "No se ha podido Crear el documento ";
			return (json_encode($retorno));
		}
	} else {
		$formato = busca_filtro_tabla("", "formato", "nombre_tabla LIKE '" . @$_POST["tabla"] . "'", "", $conn);
		$banderas = array();
		if ($formato["numcampos"]) {
			$banderas = explode(",", $formato[0]["banderas"]);
		}

		$datos["archivo_idarchivo"] = $_POST["iddoc"];
		$datos["nombre"] = "BORRADOR";
		$datos["tipo_destino"] = 1;
		$datos["tipo"] = "";
		$aux_destino[0] = $_SESSION["usuario_actual"];
		if (!isset($adicionales)) {
			$adicionales = "";
		}
		transferir_archivo_prueba($datos, $aux_destino, $adicionales, "");

		$datos["archivo_idarchivo"] = $_POST["iddoc"];
		$datos["nombre"] = "POR_APROBAR";
		$datos["tipo"] = "";
		$adicionales["activo"] = "1";
		include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");

		if ((!isset($_POST["firmado"]) || (isset($_POST["firmado"]) && $_POST["firmado"] == "una"))) {
			$exist_ruta = busca_filtro_tabla("documento_iddocumento", "ruta", "tipo='ACTIVO' and documento_iddocumento=" . $_POST["iddoc"], "", $conn);
			if (!$exist_ruta["numcampos"]) {
				$radicador = busca_filtro_tabla("f.funcionario_codigo", "configuracion c,funcionario f", "c.nombre='radicador_salida' and f.login=c.valor", "", $conn);
				if ($radicador["numcampos"]) {
					$aux_destino[0] = $radicador[0]["funcionario_codigo"];
					$datos["ruta_creador_documento"] = 1;
					// TODO: Utilizado para las firmas tipo SVG (Para el funcionario creador)
					transferir_archivo_prueba($datos, $aux_destino, $adicionales);
				}
			}
		} else if (isset($_POST["firmado"]) && $_POST["firmado"] == "varias") {
			$usuario_origen = busca_filtro_tabla("dependencia", $_POST["tabla"], "id" . $_POST["tabla"] . "=" . $idplantilla, "", $conn);
			if (!isset($_REQUEST["no_redirecciona"])) {
				redirecciona("formatos/librerias/rutaadd.php?x_plantilla=$plantilla&doc=" . $_POST["iddoc"] . "&obligatorio=" . $_POST["obligatorio"] . "&origen=" . $usuario_origen[0][0]);
				return;
			} else {
				$retorno["mensaje"] = "Error al generar la ruta de aprobacion";
				return (json_encode($retorno));
			}
		}

		if (in_array("e", $banderas) || $_REQUEST["webservie_aprob_doc"] == 1) {
			aprobar($_POST["iddoc"], 1);
		}
		enrutar_documento();
		return $_POST["iddoc"];
	}
}

/*
 * <Clase>
 * <Nombre> enrutar_documento
 * <Parametros> pagina_siguiente si se desea una redireccion directa
 * <Responsabilidades> Enrutar los documentos a sus respectivos proceso post aprobacion, radicacion etc.
 * <Notas>
 * <Excepciones>
 * <Salida> alerta si el formato no coincide con un formato valido
 * <Pre-condiciones> El documento debio haber sido creado de lo contrario envia a pendientelist.php
 * <Post-condiciones> Pantalla que el usuario debe ver luego de haber realizado accion sobre el documento
 */
function enrutar_documento($url = "", $target = "centro") {
	global $conn;
	// Utilizada para que enlos webservice no redireccione
	if (!isset($_REQUEST["no_redirecciona"])) {
		$iddoc = ($_POST["iddoc"]) ? $_POST["iddoc"] : $_REQUEST["iddoc"];
		if ($iddoc && $url == "") {
			// $_REQUEST["omitir_formato_papa"] => utilizado para cuando un formato que es hijo (detalle) lo colocan en formatos (como si fuera un formato padre)
			if (isset($_REQUEST["anterior"]) && $_REQUEST["anterior"] && !isset($_REQUEST["omitir_formato_papa"])) {
				$formato_doc = busca_filtro_tabla("A.nombre,A.idformato,ruta_mostrar,nombre_tabla", "formato A, documento B", "B.iddocumento=" . $_REQUEST["anterior"] . " AND lower(A.nombre)=lower(B.plantilla)", "", $conn);
				$formato_hijo = busca_filtro_tabla("A.*", "formato A, documento B", "B.iddocumento=" . $iddoc . " AND lower(A.nombre)=lower(B.plantilla)", "", $conn);

				if ($formato_hijo[0]["cod_padre"] > 0 && is_file("formatos/" . $formato_hijo[0]["nombre"] . "/" . $formato_hijo[0]["ruta_mostrar"])) {
					echo "<script>
             direccion=new String(window.parent.frames[0].location);
             vector=direccion.split('&');
             window.parent.frames[0].location=vector[0]+'&'+vector[1]+'&seleccionar=" . $formato_hijo[0]["idformato"] . "-" . $formato_doc[0]["nombre_tabla"] . "-" . $formato_hijo[0]["nombre_tabla"] . "-" . $iddoc . "';
            </script>";
					return $iddoc;
				} else {
					$formato_doc = $formato_hijo;
					if ($formato_doc["numcampos"]) {
						$nom_formato = $formato_doc[0]["nombre"];
					}
					abrir_url("formatos/$nom_formato/detalles_mostrar_$nom_formato.php?idformato=" . $formato_doc[0]["idformato"] . "&iddoc=" . $iddoc, "_self");
					return $iddoc;
				}
			} else {
				$formato_doc = busca_filtro_tabla("A.nombre,A.idformato", "formato A, documento B", "B.iddocumento=" . $iddoc . " AND lower(A.nombre)=lower(B.plantilla)", "", $conn);
				if ($formato_doc["numcampos"]) {
					$nom_formato = $formato_doc[0]["nombre"];
					if (@$_SESSION["tipo_dispositivo"] == 'movil') {
						abrir_url("ordenar.php?key=" . $iddoc . "&accion=mostrar&mostrar_formato=1", "_self");
					} else {
						abrir_url("formatos/$nom_formato/detalles_mostrar_$nom_formato.php?idformato=" . $formato_doc[0]["idformato"] . "&iddoc=" . $iddoc, "_self");
					}
					return $iddoc;
				}
			}
		}
		if ($url != "") {
			$ruta_def = $url;
		} else {
			$ruta_def = "pantallas/buscador_principal.php?idbusqueda=3";
		}
		if (strpos($ruta_def, "iddoc") === false) {
			if (strpos($ruta_def, "?") === false) {
				if (isset($_REQUEST["iddoc"])) {
					$ruta_def .= "?iddoc=" . $iddoc;
				}
			} else {
				if (isset($_REQUEST["iddoc"])) {
					$ruta_def .= "&idddoc=" . $iddoc;
				}
			}
		}
		abrir_url($ruta_def, $target);
	}
	return ($iddoc);
}

/*
 * <Clase>
 * <Nombre>crear_pretexto
 * <Parametros>$asunto : asunto de la pantilla;contenido : contenido de la plantilla)
 * <Responsabilidades>guarda los datos de la plantilla en las tablas pretexto y entidad_pretexto
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function crear_pretexto($asunto, $contenido) {
	global $conn;
	$campos = "asunto";
	$valores = "'" . $asunto . "'";
	$sql = "INSERT INTO " . "pretexto" . "(" . $campos . ") VALUES (" . $valores . ")";
	phpmkr_query($sql);
	$idpretexto = phpmkr_insert_id();
	guardar_lob("contenido", "pretexto", "idpretexto=$idpretexto", $contenido, "texto", $conn);
	// Guardo la relacion de la plantilla con el suaurio
	$idfuncionario = usuarioactual("idfuncionario");
	$campos = "pretexto_idpretexto,entidad_identidad,llave_entidad";
	$valores = "'" . $idpretexto . "','1'," . "'" . $idfuncionario . "'";
	$sql = "INSERT INTO " . "entidad_pretexto" . "(" . $campos . ") VALUES (" . $valores . ") ";
	phpmkr_query($sql);
}

/*
 * <Clase>
 * <Nombre>ejecutoradd</Nombre>
 * <Parametros>$skey: identificador de datos ejecutor</Parametros>
 * <Responsabilidades>Revisa si existe un ejecutor y si no es asi lo almacena en ejecutor y datos_ejecutor<Responsabilidades>
 * <Notas>Esta funcion no se utiliza</Notas>
 * <Excepciones></Excpciones>
 * <Salida>Ejecutor actualizado</Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function ejecutoradd($sKey) {
	global $conn;
	$x_identificacion = $_REQUEST["x_nitejecutor2"];
	$x_nombre = $_REQUEST["cliente0"];
	$x_direccion = $_REQUEST["x_direccionejecutor"];
	$x_telefono = $_REQUEST["x_telefonoejecutor"];
	$x_email = $_REQUEST["x_emailejecutor"];
	$x_celular = $_REQUEST["x_celularejecutor"];
	$x_nacionalidad = $_REQUEST["x_nacionalidadejecutor"];

	$x_identificacion = ($x_identificacion != "") ? $x_identificacion : 'NULL';

	$condicion = ($x_identificacion != "") ? "identificacion='" . $x_identificacion . "'" : 'identificacion is NULL';

	$campo = busca_filtro_tabla("iddatos_ejecutor,idejecutor", "ejecutor,datos_ejecutor", "ejecutor_idejecutor=idejecutor and iddatos_ejecutor='$sKey' and nombre ='" . (($x_nombre)) . "' and $condicion", "iddatos_ejecutor desc", $conn);

	if ($campo["numcampos"] > 0) {
		$repetido = busca_filtro_tabla("iddatos_ejecutor", "ejecutor,datos_ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $campo[0]["iddatos_ejecutor"] . " and direccion='" . (($x_direccion)) . "' and telefono='" . (($x_telefono)) . "' and pais_idpais='$x_nacionalidad'   and email='" . (($x_email)) . "' and celular='" . (($x_celular)) . "'", "", $conn);

		if ($repetido["numcampos"] > 0)
			return ($sKey);
		else {// comprobar si existe la nacionalidad -----
			$pais = busca_filtro_tabla("idpais", "pais", "idpais='" . $x_nacionalidad . "'", "", $conn);

			if (!$pais["numcampos"]) {
				phpmkr_query("insert into pais(nombre) values('" . (($x_nacionalidad)) . "')", $conn);
				$x_nacionalidad = phpmkr_insert_id();
			}
			// --------------------------------------------
			phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,celular,direccion,titulo,email,pais_idpais) VALUES(" . $campo[0]["idejecutor"] . ",'" . (($x_telefono)) . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . (($x_celular)) . "','" . (($x_direccion)) . "','" . (($x_titulo)) . "','" . (($x_email)) . "','$x_nacionalidad')", $conn) or error("NO SE INSERTO REMITENTE");
			return (phpmkr_insert_id());
		}
	} else {// comprobar si existe la nacionalidad -----
		$pais = busca_filtro_tabla("idpais", "pais", "idpais='" . $x_nacionalidad . "'", "", $conn);
		if (!$pais["numcampos"]) {
			phpmkr_query("insert into pais(nombre) values('" . (($x_nacionalidad)) . "')", $conn);
			$x_nacionalidad = phpmkr_insert_id();
		}
		// --------------------------------------------
		phpmkr_query("INSERT INTO ejecutor(nombre,identificacion,fecha_ingreso) VALUES('" . (($x_nombre)) . "','" . $x_identificacion . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")", $conn) or error("NO SE INSERTO REMITENTE");
		$idejecutor = phpmkr_insert_id();

		if ($idejecutor) {
			phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,celular,direccion,titulo,email,pais_idpais) VALUES(" . $idejecutor . ",'" . (($x_telefono)) . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . (($x_celular)) . "','" . (($x_direccion)) . "','" . (($x_titulo)) . "','" . (($x_email)) . "','$x_nacionalidad')", $conn) or error("NO SE INSERTO REMITENTE");
			return (phpmkr_insert_id());
		}
	}
	// die();
	return (true);
}

/*
 * <Clase>
 * <Nombre>guardar_documento
 * <Parametros>iddoc-id del documento actual;tipo:indica si se está adicionando(0) o editando(1)
 * <Responsabilidades>guarda los datos de la plantilla en la tabla correspondiente (carta,certificado,memorando)
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function guardar_documento($iddoc, $tipo = 0) {
	global $conn, $ruta_db_superior;
	$insertado = 0;
	$_POST["fecha"] = date("Y-m-d H:i:s");
	$tabla = strtolower($_REQUEST["tabla"]);

	if (isset($_REQUEST["origen"])) {
		$pos = strpos($_REQUEST["origen"], "_");
		if ($pos !== false) {
			$_REQUEST["origen"] = substr($_REQUEST["origen"], 0, $pos);
		}
	}
	$valores = array();
	$campos = array();
	$lista_campos = array();

	$buscar = phpmkr_query("SELECT A.* FROM " . $tabla . " A WHERE 1=0", $conn);

	$idformato = null;
	$form_uuid = null;
	if (@$_REQUEST["form_uuid"]) {
		$form_uuid = $_REQUEST["form_uuid"];
	}
	if (@$_REQUEST["idformato"]) {
		$idformato = $_REQUEST["idformato"];
	} else if (@$_REQUEST["tabla"]) {
		$formato = busca_filtro_tabla("idformato", "formato", "nombre_tabla LIKE '" . $tabla . "'", "", $conn);
		if ($formato["numcampos"]) {
			$idformato = $formato[0]["idformato"];
		}
	}
	for ($i = 0; $i < phpmkr_num_fields($buscar); $i++) {
		$nombre_campo = phpmkr_field_name($buscar, $i);
		array_push($lista_campos, $nombre_campo);
	}

	if ($idformato) {
		$ltareas = array();
		$larchivos = array();
		$where = "formato_idformato=" . $idformato . " AND (banderas NOT LIKE '%pk%' OR banderas IS NULL)";
		if ($i) {
			$where .= " AND nombre IN('" . implode("','", $lista_campos) . "')";
		}
		$lcampos = busca_filtro_tabla("idcampos_formato,tipo_dato,nombre,etiqueta_html,valor,longitud", "campos_formato", $where, "", $conn);

		for ($j = 0; $j < $lcampos["numcampos"]; $j++) {// si el valor es un array
			if (is_array($_REQUEST[$lcampos[$j]["nombre"]]) && $lcampos[$j]["etiqueta_html"] != "archivo") {
				array_push($valores, "'" . implode(',', @$_REQUEST[$lcampos[$j]["nombre"]]) . "'");
				array_push($campos, $lcampos[$j]["nombre"]);
			} else if ($lcampos[$j]["valor"] == "{*form_ejecutor*}") {
				array_push($campos, $lcampos[$j]["nombre"]);
				$valor = ejecutoradd($_REQUEST[$lcampos[$j]["nombre"]]);
				array_push($valores, $valor);
			} else {
				switch ($lcampos[$j]["etiqueta_html"]) {
					case "detalle" :
						if (@$_REQUEST["anterior"]) {
							$formato_detalle = busca_filtro_tabla("id" . $lcampos[$j]["nombre"], $lcampos[$j]["nombre"], "documento_iddocumento=" . $_REQUEST["anterior"], "", $conn);
							if ($formato_detalle["numcampos"])
								$_REQUEST[$lcampos[$j]["nombre"]] = $formato_detalle[0]["id" . $lcampos[$j]["nombre"]];
						}
						break;
					case "archivo" :
						array_push($larchivos, $lcampos[$j]["idcampos_formato"]);
						if (@$_REQUEST["form_uuid"]) {
							array_push($campos, $lcampos[$j]["nombre"]);
							array_push($valores, "'$form_uuid'");
							unset($_REQUEST[$lcampos[$j]["nombre"]]);
						}
						// $_REQUEST[$lcampos[$j]["nombre"]] = 0;
						break;
				}
				if (isset($_REQUEST[$lcampos[$j]["nombre"]])) {
					switch (strtoupper($lcampos[$j]["tipo_dato"])) {
						case "TEXT" :
							$_REQUEST[$lcampos[$j]["nombre"]] = str_replace("'", "&#39;", stripslashes($_REQUEST[$lcampos[$j]["nombre"]]));
							if ($tipo == 1 && $lcampos[$j]["longitud"] >= 4000) {
								$contenido = limpia_tabla(@$_REQUEST[$lcampos[$j]["nombre"]]);
								guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "texto", $conn);
							} elseif ($lcampos[$j]["longitud"] < 4000) {
								$contenido = limpia_tabla(@$_REQUEST[$lcampos[$j]["nombre"]]);
								array_push($valores, "'" . @$_REQUEST[$lcampos[$j]["nombre"]] . "'");
								array_push($campos, $lcampos[$j]["nombre"]);
							}

							break;
						case "BLOB" :
							if ($tipo == 1) {
								$apuntador = fopen($_FILES[$lcampos[$j]["nombre"]]["tmp_name"], "rb");
								$contenido = fread($apuntador, $_FILES[$lcampos[$j]["nombre"]]["size"]);
								fclose($apuntador);
								guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "archivo", $conn);
							}
							break;
						case "TIME" :
							array_push($valores, "'" . @$_REQUEST[$lcampos[$j]["nombre"]] . "'");
							array_push($campos, $lcampos[$j]["nombre"]);
							break;
						case "DATE" :
							array_push($campos, $lcampos[$j]["nombre"]);
							if (@$_REQUEST[$lcampos[$j]["nombre"]] && $_REQUEST[$lcampos[$j]["nombre"]] != '0000-00-00') {
								array_push($valores, fecha_db_almacenar(@$_REQUEST[$lcampos[$j]["nombre"]], 'Y-m-d'));
							} else {
								array_push($valores, "NULL");
							}
							break;
						case "DATETIME" :
							array_push($campos, $lcampos[$j]["nombre"]);
							if (@$_REQUEST[$lcampos[$j]["nombre"]] && $_REQUEST[$lcampos[$j]["nombre"]] != '0000-00-00 00:00') {
								array_push($valores, fecha_db_almacenar(@$_REQUEST[$lcampos[$j]["nombre"]], 'Y-m-d H:i:s'));
							} else {
								array_push($valores, "NULL");
							}
							break;
						default :
							$_REQUEST[$lcampos[$j]["nombre"]] = str_replace("'", "&#39;", stripslashes($_REQUEST[$lcampos[$j]["nombre"]]));
							if (is_array($_REQUEST[$lcampos[$j]["nombre"]])) {
								array_push($valores, "'" . implode(',', @$_REQUEST[$lcampos[$j]["nombre"]]) . "'");
							} else if (@$_REQUEST[$lcampos[$j]["nombre"]] != '') {
								array_push($valores, "'" . ((@$_REQUEST[$lcampos[$j]["nombre"]])) . "'");
							} else {
								array_push($valores, "''");
							}
							array_push($campos, $lcampos[$j]["nombre"]);
							break;
					}
				}
			}
		}
	}

	if (count($campos) && count($valores) && $tipo == 0) {
		if (!in_array('documento_iddocumento', $campos)) {
			array_push($campos, "documento_iddocumento");
			array_push($valores, $iddoc);
		} else {
			$pos = array_search('documento_iddocumento', $campos);
			$valores[$pos] = $iddoc;
		}

		if (in_array("estado_documento", $campos)) {
			$idestado = obtener_estado_documento($iddoc);
			if ($idestado) {
				if (!in_array("estado_documento", $campos)) {
					array_push($campos, "estado_documento");
					array_push($valores, $idestado);
				} else {
					$pos_e = array_search('estado_documento', $campos);
					$valores[$pos_e] = $idestado;
				}
			}
		}

		llama_funcion_accion($iddoc, $idformato, "adicionar", "ANTERIOR");
		$sql = "INSERT INTO " . $tabla . "(" . implode(",", $campos) . ") VALUES (" . implode(",", $valores) . ")";
		phpmkr_query($sql, $conn);
		$insertado = phpmkr_insert_id();

		if ($insertado) {
			$sql1 = "insert into permiso_documento(funcionario,documento_iddocumento,permisos) values('" . $_SESSION["usuario_actual"] . "','" . $iddoc . "','e,m,r')";
			phpmkr_query($sql1, $conn);

			if (count($larchivos)) {
				include_once ("anexosdigitales/funciones_archivo.php");
				cargar_archivo_formato($larchivos, $idformato, $iddoc, $form_uuid);
			}

			llama_funcion_accion($iddoc, $idformato, "adicionar", "POSTERIOR");
			generar_ruta_documento($idformato, $iddoc);

			for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
				if (isset($_REQUEST[$lcampos[$j]["nombre"]])) {
					switch (strtoupper($lcampos[$j]["tipo_dato"])) {
						case "TEXT" :
							if ($lcampos[$j]["longitud"] >= 4000) {
								$contenido = limpia_tabla(@$_REQUEST[$lcampos[$j]["nombre"]]);
								guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "texto", $conn);
							}
							break;
						case "BLOB" :
							$apuntador = fopen($_FILES[$lcampos[$j]["nombre"]]["tmp_name"], "rb");
							$contenido = fread($apuntador, $_FILES[$lcampos[$j]["nombre"]]["size"]);
							fclose($apuntador);
							guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "archivo", $conn);
							break;
					}
				}
			}
			if (isset($_REQUEST["plantilla"]) && $_REQUEST["plantilla"] == 1) {
				crear_pretexto($_REQUEST["asplantilla"], $_REQUEST["contenido"]);
			}
			$nomformato = busca_filtro_tabla("nombre", "formato", "idformato=" . $idformato, "", $conn);
			$sql = "delete from autoguardado where usuario='" . $_SESSION["usuario_actual"] . "' and formato='" . $nomformato[0]["nombre"] . "'";
			phpmkr_query($sql, $conn);
		} else {
			if (isset($iddoc)) {
				$del = "DELETE FROM documento WHERE iddocumento=" . $iddoc;
				phpmkr_query($del);
			}
			alerta("<b>ATENCI&Oacute;N</b><br>No se ha podido Crear el formato..", 'error', 5000);
			die($sql);
		}
	} elseif ($tipo == 1) {// cuando voy a editar
		$update = array();
		for ($i = 0; $i < count($campos); $i++) {
			$update[] = $campos[$i] . "=" . $valores[$i];
		}
		llama_funcion_accion($iddoc, $idformato, "editar", "ANTERIOR");
		$sql = "UPDATE " . $tabla . " SET " . implode(",", $update) . " WHERE documento_iddocumento=" . $iddoc;
		phpmkr_query($sql, $conn);

		if (isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"] != "") {
			$valid_ruta = busca_filtro_tabla("idruta,origen,tipo_origen", "ruta", "tipo='ACTIVO' and documento_iddocumento=" . $iddoc, "idruta asc", $conn);
			// TODO: Se valida si cambio la dependencia del creador para actualizar la ruta (Firma SVG)
			if ($valid_ruta["numcampos"] == 1 && $valid_ruta[0]["tipo_origen"] == 5 && $valid_ruta[0]["origen"] != $_REQUEST["dependencia"]) {
				$update_ruta = "UPDATE ruta SET origen=" . $_REQUEST["dependencia"] . " WHERE idruta=" . $valid_ruta[0]["idruta"];
				phpmkr_query($update_ruta);
			}
		}
		llama_funcion_accion($iddoc, $idformato, "editar", "POSTERIOR");
		$idft = busca_filtro_tabla("id" . $tabla, $tabla, "documento_iddocumento=" . $iddoc, "", $conn);
		if ($idft["numcampos"]) {
			$insertado = $idft[0][0];
		} else {
			$insertado = 0;
		}
	}
	actualizar_datos_documento($idformato,$iddoc);
	
	if (count($ltareas)) {
		include_once ("asignaciones/funciones.php");
		asignar_tarea_a_documento($iddoc, $ltareas);
	}
	return ($insertado);
}

function actualizar_datos_documento($idformato, $iddoc) {
	include_once ("formatos/librerias/funciones_generales.php");
	if (isset($_REQUEST["campo_descripcion"])) {
		$campo = busca_filtro_tabla("nombre,etiqueta", "campos_formato", "idcampos_formato IN(" . $_REQUEST["campo_descripcion"] . ")", "orden", $conn);
	} else if ($idformato) {
		$campo = busca_filtro_tabla("idcampos_formato,nombre,etiqueta,formato_idformato", "campos_formato cf", "cf.formato_idformato='" . $idformato . "' AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "orden", $conn);
	}
	if ($campo["numcampos"]) {
		for ($i = 0; $i < $campo["numcampos"]; $i++) {
			if ($i == 0) {
				$descripcion = "<strong>" . $campo[$i]["etiqueta"] . ": </strong>" . mostrar_valor_campo($campo[$i]["nombre"], $idformato, $iddoc, 1);
			} else {
				$descripcion .= "<br/><strong>" . $campo[$i]["etiqueta"] . ": </strong>" . mostrar_valor_campo($campo[$i]["nombre"], $idformato, $iddoc, 1);
			}
		}
	}
	$idserie=0;
	if($idformato){
		$info_formato=busca_filtro_tabla("nombre_tabla,serie_idserie","formato","idformato=".$idformato,"",$conn);
		if($info_formato["numcampos"]){
			if($info_formato[0]["serie_idserie"]){
				$idserie=$info_formato[0]["serie_idserie"];
			}
			$doc_serie=busca_filtro_tabla("serie_idserie",$info_formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
			if($doc_serie["numcampos"] && $doc_serie[0]["serie_idserie"]){
				$idserie=$doc_serie[0]["serie_idserie"];
			}
		}
	}
	
	$descripcion = str_replace("'", "", $descripcion);
	$sql = "UPDATE documento SET descripcion='" . $descripcion . "',serie=".$idserie." WHERE iddocumento=" . $iddoc;
	phpmkr_query($sql);
	return;
}


/*
 * <Clase>
 * <Nombre>llamar_buscar_ruta
 * <Parametros>
 * <Responsabilidades>tomar del post los parametros para poder llamar la funcion buscar_ruta
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function llamar_buscar_ruta() {
	buscar_ruta($_POST["serie"], $_POST["$ejecutor"], $_POST["$destino"]);
}

/*
 * <Clase>
 * <Nombre>buscar_funcionario_ruta
 * <Parametros>tipo_ruta-si la ruta es para un documento o para una serie;
 * dato-dependiento del tipo de ruta contiene la serie o el id del documento;
 * usuario-funcionario al cual quiero buscar dentro de la ruta
 * <Responsabilidades>busca un funcionario dentro de una ruta
 * <Notas>
 * <Excepciones>si no lo encuentra devuelve -1
 * <Salida> retorna el orden del funcionario dentro de la ruta
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function buscar_funcionario_ruta($tipo_ruta, $dato, $usuario) {
	global $conn;
	// busco la informacion de cargo,funcionario y dependencia del usuario actual
	$inf_funcionario = busca_cargofuncionario(2, $usuario, '');
	// miro que tipo de ruta es
	if ($tipo_ruta == "serie")
		$filtro = "tipo_documental_idtipo_documental=" . $dato;
	if ($tipo_ruta == "documento")
		$filtro = "documento_iddocumento=" . $dato;
	if ($inf_funcionario["numcampos"] == 0) {
		return (-1);
	} else {
		$encontrado = 0;
		foreach ($inf_funcionario as $fila) {
			$idnodo = busca_filtro_tabla("orden", "ruta", "origen=" . $fila["iddependencia_cargo"] . " and tipo_origen=5 and $filtro", "orden", $conn);
			if ($idnodo["numcampos"] == 0) {
				$idnodo = busca_filtro_tabla("orden", "ruta", "origen=" . $fila["cargo_idcargo"] . " and tipo_origen=4 and $filtro", "orden", $conn);
				if ($idnodo["numcampos"] == 0) {
					$idnodo = busca_filtro_tabla("orden", "ruta", "origen=" . $fila["dependencia_iddependencia"] . " and tipo_origen=2 and $filtro", "orden", $conn);
					if ($idnodo["numcampos"] == 0) {
						$idnodo = busca_filtro_tabla("orden", "ruta", "origen=" . $_SESSION["usuario_actual"] . " and tipo_origen=1 and $filtro", "orden", $conn);
					} else {
						$encontrado = 1;
						break;
					}
				} else {
					$encontrado = 1;
					break;
				}
			} else {
				$encontrado = 1;
				break;
			}
		}
		if ($encontrado == 0)
			return (-1);
		else
			return ($idnodo[0]["orden"]);
	}
}

/*
 * <Clase>
 * <Nombre>buscar_ruta
 * <Parametros>serie-id de la serie(entero); ejecutor-quien hizo el documento(entero);
 * destino-persona a quien va dirigido el documento(entero); iddoc-id del documento(entero)
 * <Responsabilidades>busca la ruta para un documento por serie y si no la encuentra por iddocumento
 * <Notas>crea la ruta en un vector con los codigos de los funcionarios,nombres,estado de transferencia,etc.
 * si no encuentra la ruta ni por serie ni por iddocumento llama a rutaadd.php
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>llama a verificar_rutas
 */
function buscar_ruta($serie, $ejecutor, $destino, $iddoc) {
	global $conn;
	$ruta = "";
	// busco en la ruta el id del nodo con los ceros en origen y destino (para la factura)
	$idnodo = busca_filtro_tabla("A.orden", "ruta A", "A.origen=0 and A.destino<>0 and A.tipo_documental_idtipo_documental=" . $serie, "A.orden", $conn);
	if ($idnodo["numcampos"] > 0) {// busco los nodos siguientes en la ruta
		$campos = "distinct A.idruta,A.origen,A.destino,A.condicion_transferencia,A.tipo_origen,A.tipo_destino,A.orden,A.obligatorio";
		$where = "A.tipo_documental_idtipo_documental=" . $serie;
		$where .= " and A.orden>=" . $idnodo[0]["orden"];
		$ruta = busca_filtro_tabla($campos, "ruta A", $where, "A.orden", $conn);
		for ($i = 0; $i < count($ruta); $i++) {
			if ($ruta[$i]["origen"] == 0) {
				$ruta[$i]["origen"] = $destino;
				$ruta[$i]["tipo_origen"] = 1;
			}
		}
	} else {// busco el usuario en la ruta por serie
		$encontrado = buscar_funcionario_ruta("serie", $serie, $destino);
		if ($encontrado == "-1") {// busco el usuario en la ruta por iddocumento
			$encontrado = buscar_funcionario_ruta("documento", $iddoc, $destino);
			if ($encontrado == "-1") {
				$enlace = '<div align=center>
                <iframe src="formatos/librerias/rutaadd.php';
				if (isset($iddoc))
					$enlace .= '?doc=' . $iddoc . "&origen=" . $_SESSION["usuario_actual"];
				$enlace .= '" width="100%" height="100%" frameborder=0 scrolling="si" marginwidth=0>
                 </iframe>
                 <input name="serie" value="' . $serie . '" type="hidden">
                 <input name="ejecutor" value="' . $ejecutor . '" type="hidden">
                 <input name="destino" value="' . $destino . '" type="hidden">
                 <input name="funcion" value="llamar_buscar_ruta();" type="hidden">
                 <input type=button value="Actualizar" onclick="window.location.reload();">
                 </div> ';
				echo($enlace);
			} else {// busco el resto de la ruta por iddocumento
				$campos = "distinct idruta,origen,destino,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio";
				$where = "documento_iddocumenot=" . $iddoc;
				$where .= " and orden>=" . $encontrado;
				$ruta = busca_filtro_tabla($campos, "ruta", $where, "orden", $conn);
			}
		} else {// busco el resto de la ruta por serie
			$campos = "distinct idruta,origen,destino,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio";
			$where = "tipo_documental_idtipo_documental=" . $serie;
			$where .= " and orden>=" . $encontrado;
			$ruta = busca_filtro_tabla($campos, "ruta", $where, "orden", $conn);
		}
	}
	$i = 0;
	// busco la informaci�n de los funcionarios que van en la ruta usando el destino,origen,tipo destino,tipo origen
	if ($ruta["numcampos"] > 0) {
		for ($i = 0; $i < $ruta["numcampos"]; $i++) {
			$nombre_origen = "";
			switch ($ruta[$i]["tipo_origen"]) {
				case "1" :
					$datos_origen = busca_cargofuncionario(2, $ruta[$i]["origen"], "");
					if ($datos_origen[0]["estado_f"] == 1)
						$estado = 1;
					else
						$estado = 0;
					break;
				case "5" :
					$datos_origen = busca_cargofuncionario(5, $ruta[$i]["origen"], "");
					$nombre_origen = $datos_origen[0]["nombre"] . " - ";
					if ($datos_origen[0]["estado_f"] == 1 && $datos_origen[0]["estado_d"] == 1 && date("Y-m-d") <= $datos_origen[0]["fecha_final"] && date("Y-m-d") >= $datos_origen[0]["fecha_inicial"])
						$estado = 1;
					else
						$estado = 0;
					break;
				case "4" :
					$dependencia = busca_filtro_tabla("d.dependencia_iddependencia as dep", "dependencia_cargo d,funcionario f", "d.funcionario_idfuncionario=f.idfuncionario and f.funcionario_codigo=" . $_SESSION["usuario_factura"], "", $conn);
					$datos_origen = busca_cargofuncionario(4, $ruta[$i]["origen"], $dependencia[0]["dep"]);
					$nombre_origen = $datos_origen[0]["nombre"] . " - ";
					if ($datos_origen[0]["estado_f"] == 1 && $datos_origen[0]["estado_d"] == 1 && date("Y-m-d") <= $datos_origen[0]["fecha_final"] && date("Y-m-d") >= $datos_origen[0]["fecha_inicial"])
						$estado = 1;
					else
						$estado = 0;
					break;
			}

			$nombre_origen .= $datos_origen[0]["nombres"] . " " . $datos_origen[0]["apellidos"];
			if ($estado)
				$nombre_origen .= " (activo)";
			else
				$nombre_origen .= " (inactivo)";
			$nombre_destino = "";
			switch ($ruta[$i]["tipo_destino"]) {
				case "1" :
					$datos_destino = busca_cargofuncionario(2, $ruta[$i]["destino"], "");
					if ($datos_destino[0]["estado_f"] == 1)
						$estado = 1;
					else
						$estado = 0;
					break;
				case "5" :
					$datos_destino = busca_cargofuncionario(5, $ruta[$i]["destino"], "");
					$nombre_destino = $datos_destino[0]["nombre"] . " - ";
					if ($datos_destino[0]["estado_f"] == 1 && $datos_destino[0]["estado_d"] == 1 && date("Y-m-d") <= $datos_destino[0]["fecha_final"] && date("Y-m-d") >= $datos_destino[0]["fecha_inicial"])
						$estado = 1;
					else
						$estado = 0;
					break;
				case "4" :
					$dependencia = busca_filtro_tabla("d.dependencia_iddependencia as dep", "dependencia_cargo d,funcionario f", "d.funcionario_idfuncionario=f.idfuncionario and f.funcionario_codigo=" . $_SESSION["usuario_factura"], "", $conn);
					$datos_destino = busca_cargofuncionario(4, $ruta[$i]["origen"], $dependencia[0]["dep"]);
					$nombre_destino = $datos_destino[0]["nombre"] . " - ";
					if ($datos_destino[0]["estado_f"] == 1 && $datos_destino[0]["estado_d"] == 1 && date("Y-m-d") <= $datos_destino[0]["fecha_final"] && date("Y-m-d") >= $datos_destino[0]["fecha_inicial"])
						$estado = 1;
					else
						$estado = 0;
					break;
				case "2" :
					$dependencia = busca_filtro_tabla("A.nombre", "dependencia A", "A.iddependencia=" . $ruta[$i]["destino"], "", $conn);
					$nombre_destino = $dependencia[0]["nombre"];
					$datos_destino[0]["funcionario_codigo"] = $ruta[$i]["destino"];
					$datos_destino[0]["nombres"] = "";
					$estado = 1;
					break;
			}
			if ($datos_destino[0]["nombres"] != "")
				$nombre_destino .= $datos_destino[0]["nombres"] . " " . $datos_destino[0]["apellidos"];
			if ($estado)
				$nombre_destino .= " (activo)";
			else
				$nombre_destino .= " (inactivo)";
			// vector con la ruta
			$enrutados[$i]["origen"] = $datos_origen[0]["funcionario_codigo"];
			$enrutados[$i]["tipo_origen"] = $ruta[$i]["tipo_origen"];
			$enrutados[$i]["destino"] = $datos_destino[0]["funcionario_codigo"];
			$enrutados[$i]["tipo_destino"] = $ruta[$i]["tipo_destino"];
			$enrutados[$i]["idruta"] = $ruta[$i]["idruta"];
			$enrutados[$i]["orden"] = $ruta[$i]["orden"];
			$enrutados[$i]["nombre_origen"] = $nombre_origen;
			$enrutados[$i]["nombre_destino"] = $nombre_destino;
			$enrutados[$i]["accion"] = $ruta[$i]["condicion_transferencia"];
			$i++;
		}
	}
	verificar_ruta($enrutados, $iddoc);
}

/*
 * <Clase>
 * <Nombre>verificar_ruta
 * <Parametros>fila-vector con la ruta creada por buscar_ruta;id_documento-id del documento actual
 * <Responsabilidades>verifica que la ruta est� bien formada
 * <Notas>
 * <Excepciones>si hay errores muestra una pantalla con la ruta y los mesajes de error
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>si todo est� bien llama a transferir_archivo_prueba
 */
function verificar_ruta($fila, $id_documento) {// verifico que est�n bien los nodos
	$error = 0;
	$mensaje = "";

	for ($i = 0; $i < count($fila); $i++) {
		if ($i < count($fila) - 1 && $fila[$i]["origen"] == $fila[$i + 1]["origen"] && $fila[$i]["destino"] == $fila[$i + 1]["destino"]) {
			$error = 1;
			$mensaje .= "No debe haber dos nodos consecutivos con el mismo origen y destino (nodo $i)<br/>";
		}
		if ($fila[$i]["origen"] == "" || $fila[$i]["destino"] == "") {
			$error = 1;
			$mensaje .= "El origen y el destino deben ser diferentes de vacio (nodo $i)<br/>";
		}
		if ($i < count($fila) - 1 && $fila[$i]["orden"] != $fila[$i + 1]["orden"] && $fila[$i]["destino"] != $fila[$i + 1]["origen"]) {
			$error = 1;
			$mensaje .= "El destino del nodo $i debe ser igual al origen del nodo " . ($i + 1) . "<br/>";
		}
		if ($fila[$i]["origen"] == $fila[$i]["destino"]) {
			$error = 1;
			$mensaje .= "El origen y el destino deben ser diferentes (nodo $i)<br/>";
		}
	}
	// si hubo alg�n error muestro la ruta en pantalla y espero verificaci�n
	if ($error == 1) {
		echo $mensaje;
		echo "<form name='form1' action='class_transferencia.php' method='post' >";
		echo "<table border='0' cellspacing='1' cellpadding='4' bgcolor='#CCCCCC'>
             <tr class='encabezado_list' align='center'>
             <td><b><span class='phpmaker'>Nodo</b></span></td>
             <td><b><span class='phpmaker'>Orden</b></span></td>
             <td><span class='phpmaker'><b>Origen</b></span></td>";
		echo "<td><span class='phpmaker'><b>" . codifica_encabezado("Acción") . "</b></span></td>
             <td><span class='phpmaker'><b>Destino</b></span></td><td><span class='phpmaker'><b>Obligatorio</b></span></td></tr>
             <td></td>";
		$i = 0;
		foreach ($fila as $fila2) {
			echo "<tr  bgcolor='#F5F5F5' id='fila$i'>
                 <td>$i</td>
                <td><span class='phpmaker'>
                <input type=hidden id='idruta$i' name='idruta$i' value='" . $fila2["idruta"] . "'>
                <input type=text readonly=true style='width:50px;' id='orden$i' name='orden$i' value='" . $fila2["orden"] . "'>
                </span></td>
                <td><span class='phpmaker'>
                <input type=hidden id='tipo_origen$i' name='tipo_origen$i' value='" . $fila2["tipo_origen"] . "'>
                <input type=hidden name='origen$i' id='origen$i' value='" . $fila2["origen"] . "'>
                <input type=text style='width:450px;' readonly=true  value='" . $fila2["nombre_origen"] . "'>
                </span></td>
                <td><span class='phpmaker'>
                <input type=text style='width:100px;' readonly=true  id='accion$i' name='accion$i' value='" . $fila2["accion"] . "'>
                </span></td>
                <td><span class='phpmaker'>
                <input type=hidden id='tipo_destino$i' name='tipo_destino$i' value='" . $fila2["tipo_destino"] . "'>
                <input type=hidden name='destino$i' id='destino$i' value='" . $fila2["destino"] . "'>
                <input type=text style='width:450px;' readonly=true  value='" . $fila2["nombre_destino"] . "'>
                </span></td>
                <td><span class='phpmaker'><input type=text name='obligatorio$i' value='" . $fila2["tipo_origen"] . "' >
                </span></td>
                ";
			if ($fila2["idruta"] != "") {
				echo "<td id='editar$i'><span class='phpmaker'>
                          <input type='button' value='Editar' name='editar$i'
                          onclick='window.location=\"DibujaPantalla.php?codigo=2&tipo=editar&id=" . $fila2["idruta"] . "\"' >
                          <input type='button' value='Eliminar' name='eliminar$i'
                          onclick='window.location=\"DibujaPantalla.php?codigo=2&tipo=eliminar&id=" . $fila2["idruta"] . "\"' >
                          </span></td>
                          </tr>";
			} else
				echo "</tr>";
			$i++;
		}
		echo "</table><input type=button value='Continuar' onclick='location=\"class_transferencia.php?funcion=llamar_buscar_ruta&iddoc=" . $_POST["iddoc"] . "\";'>";
	}// si todo est� bien hago la transferencia
	else {
		if (isset($_POST["iddoc"]))
			$datos["archivo_idarchivo"] = $_POST["iddoc"];
		else
			$datos["archivo_idarchivo"] = $id_documento;
		$datos["nombre"] = "POR_APROBAR";
		$datos["tipo"] = "";
		foreach ($fila as $fila2) {
			$datos["ruta_idruta"] = $fila2["idruta"];
			$adicionales["activo"] = 1;
			$datos["tipo_destino"] = $fila2["tipo_destino"];
			$destino[0] = $fila2["destino"];
			$datos["origen"] = $fila2["origen"];
			transferir_archivo_prueba($datos, $destino, $adicionales);
		}
		echo "<script>window.location='/saia/saia1.0/documentoview.php?key=" . $_SESSION["iddoc"] . "';</script>";
	}
}

/*
 * <Clase>
 * <Nombre>formato_devolucion
 * <Parametros>iddoc-id del documento actual
 * <Responsabilidades>muestra en pantalla el formato donde se llenan los datos para la devolucion
 * <Notas>
 * <Excepciones>si no hay a quien devolver el documento muestra una alerta y se devuelve a la pagina anterior
 * <Salida>
 * <Pre-condiciones>que el documento haya sido transferido por otra persona al usuario actual
 * <Post-condiciones>
 */
function formato_devolucion($iddoc = 0) {
	global $conn, $ruta_db_superior;
	if (@$_REQUEST["iddoc"] || @$_REQUEST["key"]) {
		if (!@$_REQUEST["iddoc"])
			$_REQUEST["iddoc"] = @$_REQUEST["key"];
		include_once ("pantallas/documento/menu_principal_documento.php");
		menu_principal_documento($_REQUEST["iddoc"]);
	}
	$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
	if ($config[0]["valor"]) {
		$style = "<style type=\"text/css\"><!--INPUT, TEXTAREA, SELECT {font-family: Tahoma; font-size: 10px;} .phpmaker {font-family: Verdana; font-size: 9px;} .encabezado { background-color:" . $config[0]["valor"] . "; color:white ; padding:10px; text-align: left;  } .encabezado_list { background-color:" . $config[0]["valor"] . "; color:white ; vertical-align:middle; text-align: center; } --></style>";
		echo $style;
	}
	if (!$iddoc) {
		$iddoc = $_REQUEST["iddoc"];
	} else {
		$_REQUEST["iddoc"] = $iddoc;
	}

	$x_recibido = $_SESSION["usuario_actual"];
	$reemplazo = 0;
	$transferencias = busca_filtro_tabla("destino", "buzon_entrada", "archivo_idarchivo=" . $iddoc . " AND origen='" . $x_recibido . "' AND destino<>'" . $x_recibido . "' and nombre in('REVISADO','TRANSFERIDO','APROBADO','DEVOLUCION')", "fecha DESC", $conn);

	if ($transferencias["numcampos"]) {
		$retorno = obtener_reemplazo($transferencias[0]['destino'], 1);
		if ($retorno['exito']) {
			$reemplazo = $retorno['funcionario_codigo'][0];
		}
	} else {
		alerta('<b>ATENCI&Oacute;N</b><br>No es posible devolver el documento, por favor transfieralo o terminelo.', 'warning', 4000);
		$mostar_formato_devolver = busca_filtro_tabla('b.nombre,b.idformato', 'documento a, formato b', 'b.nombre=lower(a.plantilla) AND a.iddocumento=' . $iddoc, '', $conn);
		redirecciona($ruta_db_superior . "formatos/" . $mostar_formato_devolver[0]['nombre'] . "/mostrar_" . $mostar_formato_devolver[0]['nombre'] . ".php?iddoc=" . $iddoc . "&idformato=" . $mostar_formato_devolver[0]['idformato']);
		return;
	}
	echo '<p><span style="font-family: Verdana; font-size: 9px; font-weight: bold;">&nbsp;&nbsp;DEVOLVER DOCUMENTOS&nbsp;&nbsp;&nbsp;&nbsp;</span><br/><br/></p>
<form name="transferenciadev" id="transferenciadev" action="' . PROTOCOLO_CONEXION . RUTA_PDF . '/class_transferencia.php" method="post">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
<tr>
			  <td class="encabezado">
			  	<span class="phpmaker" style="color: #FFFFFF;">CAMBIANDO ESTADO AL DOCUMENTO:</span>
  </td>
			  <td bgcolor="#F5F5F5">
				  <span class="phpmaker">';
	$arch = busca_filtro_tabla("numero,descripcion", "documento", "iddocumento=" . $iddoc, "", $conn);
	echo($arch[0]["numero"] . "-" . $arch[0]['descripcion']);
	echo '<input type="hidden" name="iddoc" value="' . $iddoc . '">
					</span>
  </td>
</tr>

<tr>
  <td class="encabezado">
    <span class="phpmaker" style="color: #FFFFFF;">FECHA</span>
  </td>
  <td bgcolor="#F5F5F5"><span class="phpmaker">';
	$x_fecha = date("Y-m-d H:i:s");
	echo '<input type="hidden" name="x_fecha" id="x_fecha" value="' . $x_fecha . '">' . $x_fecha . '</span>
  </td>
</tr>

<tr>
				<td class="encabezado">
					<span class="phpmaker" style="color: #FFFFFF;"> DEVUELTO A:</span>
</td>
<td bgcolor="#F5F5F5"><span class="phpmaker">';
	$transferencias = busca_filtro_tabla("buzon_entrada.destino,fecha,ruta_idruta", "buzon_entrada", " archivo_idarchivo='" . $_REQUEST["iddoc"] . "' AND origen='" . $x_recibido . "' AND nombre in('TRANSFERIDO','REVISADO') and destino<>'" . $x_recibido . "'", "fecha DESC", $conn);
	if ($transferencias["numcampos"]) {
		$info_adicional = "";
		if ($reemplazo) {
			$transferencias[0]["destino"] = $reemplazo;
			$info_adicional = " - Reemplazo";
			echo "<input type='hidden' value='" . $retorno['idreemplazo'][0] . "' name='campo_reemplazo' id='campo_reemplazo'>";
			echo "<input type='hidden' value='" . $transferencias[0]['ruta_idruta'] . "' name='campo_idruta' id='campo_idruta'>";
		}
		$funcionario_destino = busca_filtro_tabla("", "funcionario", "funcionario_codigo=" . $transferencias[0]["destino"] . " and estado=1", "", $conn);
		if ($funcionario_destino['numcampos']) {
			echo ucwords($funcionario_destino[0]["nombres"] . " " . $funcionario_destino[0]["apellidos"]) . $info_adicional . "<br><br />";
		} else {
			alerta("<b>ATENCI&Oacute;N</b><br>El funcionario NO esta Activo, por favor transfieralo o terminelo.", 'warning', 4000);
			redirecciona($ruta_db_superior . "vacio.php");
		}
	} else {
		alerta("<b>ATENCI&Oacute;N</b><br>No existe funcionarios para devolver el documento", 'warning', 4000);
		redirecciona($ruta_db_superior . "vacio.php");
	}
	echo '<input type="hidden" name="x_funcionario_destino" id="x_funcionario_destino" value="' . $funcionario_destino[0]["funcionario_codigo"] . '"></span>
</td>
</tr>

<tr>
<td class="encabezado">
  <span class="phpmaker" style="color: #FFFFFF;">ESTADO DE LA TRANSFERENCIA</span>
</td>
<td bgcolor="#F5F5F5">
  <span class="phpmaker"><input type="hidden" name="x_nombre" value="DEVOLUCION">DEVOLUCI&Oacute;N</span>
</td>
</tr>

<tr>
<td class="encabezado">
  <span class="phpmaker" style="color: #FFFFFF;">MOTIVOS DEVOLUCION</span>
</td>
<td bgcolor="#F5F5F5">
  <span class="phpmaker">
					<input type="radio" name="motivo" value="Mal direccionamiento de Ventanilla Unica" onclick="document.getElementById(\'x_notas\').value=this.value">
					Mal direccionamiento de Ventanilla Unica
					<br/>
					<input type="radio" name="motivo" value="Cambio de Funciones del Usuario" onclick="document.getElementById(\'x_notas\').value=this.value">
					Cambio de Funciones del Usuario
					<br/>
					<input type="radio" name="motivo" value="Se Necesitan Cambios en el Documento" onclick="document.getElementById(\'x_notas\').value=this.value">
					Se Necesitan Cambios en el Documento
					<br/>
					<input type="radio" name="motivo" value="Otras" onclick="document.getElementById(\'x_notas\').value=this.value">
					Otras
  </span>
</td>
</tr>

<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;"> OBSERVACIONES DE LA DEVOLUCI&Oacute;N</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker"><textarea cols="55" rows="5" id="x_notas" name="x_notas">' . @$x_notas . '</textarea></span></td>
</tr>
</table>
<input type="hidden" name="funcion" value="devolucion">
		<input type="hidden" name="ruta_idruta" id="ruta_idruta" value="0">
		<input type="button" name="Action" value="DEVOLVER" onclick="if(form.x_notas.value==' . "''" . ') alert(' . "'Debe llenar las notas.'" . '); else form.submit(); ">
</form>';
}

function devolucion() {
	global $conn, $ruta_db_superior;
	$theValue = ($_REQUEST["iddoc"] != "") ? intval($_REQUEST["iddoc"]) : "NULL";
	$datos["archivo_idarchivo"] = $theValue;

	if (isset($_REQUEST['campo_reemplazo']) && $_REQUEST['campo_reemplazo'] != 0 && isset($_REQUEST['campo_idruta']) && $_REQUEST['campo_idruta'] != 0) {
		include_once ($ruta_db_superior . "pantallas/reemplazos/procesar_reemplazo.php");
		actualiza_ruta_devolucion($_REQUEST['campo_reemplazo'], $datos["archivo_idarchivo"], $_REQUEST['campo_idruta']);
	}
	$idformato = busca_filtro_tabla("idformato", "formato f,documento d", "lower(f.nombre)=lower(d.plantilla) and iddocumento=" . $datos["archivo_idarchivo"], "", $conn);
	llama_funcion_accion($datos["archivo_idarchivo"], $idformato[0]["idformato"], "devolver", "ANTERIOR");

	$documento = busca_filtro_tabla("", "documento", "iddocumento=" . $datos["archivo_idarchivo"], "", $conn);

	// NUEVO DESARROLLO DEVOLVER

	$sql2 = " UPDATE buzon_entrada SET nombre='ELIMINA_REVISADO' WHERE archivo_idarchivo=" . $datos["archivo_idarchivo"] . " AND destino=" . $_REQUEST["x_funcionario_destino"] . " AND origen=" . $_SESSION["usuario_actual"] . "  AND nombre='REVISADO';";
	phpmkr_query($sql2);

	$sql3 = " UPDATE buzon_entrada SET activo=1 WHERE archivo_idarchivo=" . $datos["archivo_idarchivo"] . " AND destino=" . $_REQUEST["x_funcionario_destino"] . " AND origen=" . $_SESSION["usuario_actual"] . "  AND nombre='POR_APROBAR'; ";
	phpmkr_query($sql3);

	$sql4 = " UPDATE asignacion SET tarea_idtarea=-1 WHERE documento_iddocumento=" . $datos["archivo_idarchivo"] . " AND llave_entidad='" . $_SESSION["usuario_actual"] . "'; ";
	phpmkr_query($sql4);

	$strsql = "INSERT INTO asignacion (tarea_idtarea,fecha_inicial,documento_iddocumento,serie_idserie,estado,entidad_identidad,llave_entidad)";
	$strsql .= "VALUES (2,'" . date('Y-m-d H:i:s') . "'," . $datos["archivo_idarchivo"] . ",0,'PENDIENTE',1,'" . $_REQUEST["x_funcionario_destino"] . "')";
	$sql5 = $strsql;
	phpmkr_query($sql5);

	$strsql = "INSERT INTO buzon_entrada (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,notas,tipo,activo,ruta_idruta,ver_notas)";
	$strsql .= "VALUES (" . $datos["archivo_idarchivo"] . ",'DEVOLUCION','" . $_SESSION["usuario_actual"] . "',1,'" . date('Y-m-d H:i:s') . "','" . $_REQUEST["x_funcionario_destino"] . "',1,'" . $_REQUEST["x_notas"] . "','ARCHIVO',0,0,1)";
	$sql6 = $strsql;
	phpmkr_query($sql6);

	$strsql = "INSERT INTO buzon_salida (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,notas,tipo,ruta_idruta,ver_notas)";
	$strsql .= "VALUES (" . $datos["archivo_idarchivo"] . ",'DEVOLUCION','" . $_REQUEST["x_funcionario_destino"] . "',1,'" . date('Y-m-d H:i:s') . "','" . $_SESSION["usuario_actual"] . "',1,'" . $_REQUEST["x_notas"] . "','ARCHIVO',0,1)";
	$sql7 = $strsql;
	phpmkr_query($sql7);

	llama_funcion_accion($datos["archivo_idarchivo"], $idformato[0]["idformato"], "devolver", "POSTERIOR");
	// FIN NUEVO DESARROLLO DEVOLVER

	if ($_REQUEST["retornar"] == 1) {
		return true;
	} else {
		enrutar_documento("pantallas/buscador_principal.php?idbusqueda=3");
	}
}

/*
 * <Clase>
 * <Nombre>revisar_fechas
 * <Parametros>estado-estado que quiero revisar para ver si hay documentos que deban pasar a el
 * <Responsabilidades>dependiendo del parametro pasado en la variable estado revisa si hay documentos que cumplan
 * las condiciones necesarias para pasar a dicho estado
 * <Notas>
 * <Excepciones>
 * <Salida>
 * <Pre-condiciones>
 * <Post-condiciones>
 */
function revisar_fechas($estado) {
	global $conn;
	// convierto el estado a mayusculas
	$estado = strtoupper($estado);
	if ($estado == "GESTION") {
		$from = "(select iddocumento,fecha+decode(dias,'',dias_entrega,dias)-sysdate as faltantes from documento A,serie B where A.estado='APROBADO' and A.serie=idserie)";
	} else if ($estado == "CENTRAL") {
		$from = "(select iddocumento,ADD_MONTHS(fecha+decode(dias,'',dias_entrega,dias),retencion_gestion*12)-sysdate as faltantes from documento A,serie B where A.estado='GESTION' and A.serie=idserie)";
	} else if ($estado == "HISTORICO") {
		$from = "(select iddocumento,ADD_MONTHS(fecha+decode(dias,'',dias_entrega,dias),(retencion_gestion+retencion_central)*12)-sysdate as faltantes from documento A,serie B where A.estado='CENTRAL' and A.serie=idserie)";
	}
	$resultado = busca_filtro_tabla("iddocumento", $from, "faltantes<=0", "", $conn);
	if ($resultado["numcampos"]) {
		for ($i = 0; $i < $resultado["numcampos"]; $i++) {
			phpmkr_query("UPDATE documento SET estado='$estado' WHERE iddocumento=" . $resultado[$i]["iddocumento"], $conn);
		}
	}
}

function dependencias_asistentes($padre) {
	global $conn;
	$listado1 = array();
	$listado2 = array();
	$listado3 = array();
	$ldependencias = busca_filtro_tabla("iddependencia", "dependencia A", "A.cod_padre IN(" . $padre . ")", "", $conn);
	$listado1 = extrae_campo($ldependencias, "iddependencia", "U");
	$padres = explode(",", $padre);

	if (count($listado1) > 0)
		$listado2 = array_diff($listado1, $padres);

	$cont = count($listado1);
	if ($cont) {
		$listado3 = dependencias(implode(",", $listado2));
		$listado4 = array_merge((array)$listado1, (array)$listado3);
	} else
		$listado4 = $padres;

	return ($listado4);
}

/*
 * <Clase>
 * <Nombre>arbol_serie()</Nombre>
 * <Parametros></Parametros>
 * <Responsabilidades>Desplegar el arbol de las series documentales que están asignadas a un funcionario<Responsabilidades>
 * <Notas></Notas>
 * <Excepciones></Excpciones>
 * <Salida>Arbol desplegado</Salida>
 * <Pre-condiciones><Pre-condiciones>
 * <Post-condiciones><Post-condiciones>
 * </Clase>
 */
function arbol_serie($condicion_adicional = '') {
	include_once ("formatos/librerias/header_formato.php");
	echo '<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
	<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
	<input type="hidden" name="serie" id="serie" obligatorio="obligatorio"  value="" >
    <br />  Buscar: <input type="text" id="stext_serie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById(\'stext_serie\').value),1)"><img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a><a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById(\'stext_serie\').value),0,1)"><img src="botones/general/buscar.png" alt="Buscar" border="0px"></a><a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById(\'stext_serie\').value))"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
    <div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2"></div>
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
			tree2.enableCheckBoxes(1);
			tree2.enableRadioButtons(true);
			tree2.setOnLoadingStart(cargando_serie);
      tree2.setOnLoadingEnd(fin_cargando_serie);
			tree2.enableThreeStateCheckboxes(true);
			tree2.enableThreeStateCheckboxes(true);
			tree2.setXMLAutoLoading("test_serie_funcionario.php' . $condicion_adicional . '");
			tree2.loadXML("test_serie_funcionario.php' . $condicion_adicional . '");
			function fin_cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval(\'document.getElementById("esperando_serie")\');
        else if (browserType == "ie")
           document.poppedLayer =
              eval(\'document.getElementById("esperando_serie")\');
        else
           document.poppedLayer =
              eval(\'document.layers["esperando_serie"]\');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval(\'document.getElementById("esperando_serie")\');
        else if (browserType == "ie")
           document.poppedLayer =
              eval(\'document.getElementById("esperando_serie")\');
        else
           document.poppedLayer =
               eval(\'document.layers["esperando_serie"]\');
        document.poppedLayer.style.visibility = "visible";
      }
	-->
	</script>';
}

if (isset($_REQUEST["funcion"]) && trim($_REQUEST["funcion"]) != "") {
	$funcion = str_replace("'", "", str_replace("\\", "", strtolower($_REQUEST["funcion"])));
	$funcion();
}
?>