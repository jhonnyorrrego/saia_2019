<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

function crear_contador($contador) {
    global $conn;

    $cont = busca_filtro_tabla("*", "contador", "nombre LIKE '" . $contador . "'", "", $conn);
    if (!$cont["numcampos"]) {
        $sql = "INSERT INTO contador(consecutivo, nombre) VALUES(1,'" . $contador . "')";
        guardar_traza($strsql, "ft_" . $contador);
        phpmkr_query($sql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql);
        return (phpmkr_insert_id());
    } else
        return ($cont[0]["idcontador"]);
}

function generar_campo_flujo($idformato, $idflujo) {
    $buscar_campo = busca_filtro_tabla("", "campos_formato A", "formato_idformato=" . $idformato . " AND nombre='idflujo'", "", $conn);

    if ($buscar_campo["numcampos"] == 0) {
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
    if ($buscar_funcion["numcampos"] == 0) {
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
    if (in_array("e", $x_banderas)) {
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

    if ($buscar_campo["numcampos"] == 0) {
        $campo = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(" . $idformato . ",'anexo_formato', 'Anexos digitales', 'VARCHAR', '255', 0, 'a,e,b', '" . $idflujo . "', 'archivo', 0, '')";
    } else {
        $campo = "UPDATE campos_formato SET formato_idformato=" . $idformato . ", nombre='anexo_formato', etiqueta='Anexos digitales', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='" . $idflujo . "', etiqueta_html='archivo', valor='' WHERE idcampos_formato=" . $buscar_campo[0]["idcampos_formato"];
    }
    guardar_traza($campo, $formato[0]["nombre_tabla"]);
    phpmkr_query($campo);
}

function vincular_funciones_formato($libreria, $funcion) {
    global $conn;
    $retorno = array(
        "mensaje" => "Error al tratar de vincular la funcion al formato",
        "exito" => 0
    );
    $libreria_formato = busca_filtro_tabla("", "formato_libreria A", "A.idformato_libreria=" . $libreria, "", $conn);
    if ($libreria_formato["numcampos"]) {
        $existe = busca_filtro_tabla("", "funciones_formato A", "A.ruta='" . $libreria_formato[0]["ruta"] . "' AND A.nombre = '" . $funcion . "'", "", $conn);
        if (!$existe["numcampos"]) {
            $nombre = str_replace("{*", "", $funcion);
            $nombre = str_replace("*}", "", $nombre);
            $sql2 = "INSERT INTO funciones_formato(nombre,nombre_funcion,etiqueta,descripcion,ruta,acciones,formato) VALUES('" . $funcion . "','" . $nombre . "','" . $nombre . "','" . $nombre . "','" . $libreria_formato[0]["ruta"] . "','m',' ')";
            phpmkr_query($sql2);
            $idfunciones_formato = phpmkr_insert_id();
            if ($idfunciones_formato) {
                $sql2 = "INSERT INTO funciones_formato_enlace(formato_idformato,funciones_formato_fk) VALUES(" . $libreria_formato[0]["formato_idformato"] . "," . $idfunciones_formato . ")";
                phpmkr_query($sql2);
                $idfunciones_formato_enlace = phpmkr_insert_id();
                if ($idfunciones_formato_enlace) {
                    $retorno["exito"] = 1;
                    $retorno["mensaje"] = "Funcion vinculada con &eacute;xito";
                } else {
                    $retorno["mensaje"] = "Error al vincular la funcion " . $nombre . " al formato error al generar el enlace  idfunciones_formato=" . $idfunciones_formato;
                }
            } else {
                $retorno["mensaje"] = "Error al vincular la funcion " . $nombre . " al formato " . $sql2;
            }
        } else {
            if (strpos($existe[0]["acciones"], "m") !== false) {
                $sql3 = "UPDATE acciones='m," . $existe[0]["acciones"] . "' WHERE idfunciones_formato=" . $existe[0]["idfunciones_formato"];
                phpmkr_query($sql3);
                /*
                 * TODO: Validar que las acciones queden vinculadas al mostrar
                 */
                $retorno["exito"] = 1;
                $retorno["mensaje"] = "Funcion vinculada con &eacute;xito";
            }
        }
    } else {
        $retorno["mensaje"] = "La libreria no se encuentra vinculada con el formato, por lo tanto no se puede usar la funcion " . $funcion;
    }
    return ($retorno);
}

function vincular_funciones_formatos($libreria, $funcion) {
    global $conn;
    $idformato=$_REQUEST['idformato'];
    $retorno = array(
        "mensaje" => "Error al tratar de vincular la funcion al formato",
        "exito" => 0
    );
    $funciones_nucleo = busca_filtro_tabla("", "funciones_nucleo A", "A.idfunciones_nucleo=" . $libreria, "", $conn);
 
    if ($funciones_nucleo["numcampos"]) {
        $datos_funcion = busca_filtro_tabla("", "funciones_formato A", "A.nombre = '" . $funcion . "'", "", $conn);
	
        if ($datos_funcion["numcampos"]) {
            $nombre = str_replace("{*", "", $funcion);
            $nombre = str_replace("*}", "", $nombre);
			$consulta_existe_func=busca_filtro_tabla("","funciones_formato_enlace","formato_idformato=".$idformato." and funciones_formato_fk=".$datos_funcion[0]['idfunciones_formato']." ","",$conn);
			
				if(!$consulta_existe_func['numcampos']){
	                $sql2 = "INSERT INTO funciones_formato_enlace(formato_idformato,funciones_formato_fk) VALUES(" . $idformato . "," . $datos_funcion[0]['idfunciones_formato'] . ")";
	                phpmkr_query($sql2);
	                $idfunciones_formato_enlace = phpmkr_insert_id();
	                if ($idfunciones_formato_enlace) {
	                    $retorno["exito"] = 1;
	                    $retorno["mensaje"] = "Funcion vinculada con &eacute;xito";
	                } else {
	                    $retorno["mensaje"] = "Error al vincular la funcion " . $nombre . " al formato error al generar el enlace  idfunciones_formato=" . $idfunciones_formato;
	                }
                }else{
                	//$retorno["mensaje"] = "Error al vincular la funcion " . $nombre . " al formato la funcion ya se encuentra vinculada";
					return false;
				}	
        } else {
            if (strpos($datos_funcion[0]["acciones"], "m") !== false) {
            	
                $sql3 = "UPDATE acciones='m," . $datos_funcion[0]["acciones"] . "' WHERE idfunciones_formato=" . $datos_funcion[0]["idfunciones_formato"];
                return $sql3;
                phpmkr_query($sql3);
                /*
                 * TODO: Validar que las acciones queden vinculadas al mostrar
                 */
                $retorno["exito"] = 1;
                $retorno["mensaje"] = "Funcion vinculada con &eacute;xito";
            }
        }
    } else {
        $retorno["mensaje"] = "La libreria no se encuentra vinculada con el formato, por lo tanto no se puede usar la funcion " . $funcion;
    }
    return ($retorno);
}


function adicionar_pantalla_campos_formato($idpantalla, $datos) {
    $retorno = array();
    $campo_serie = busca_filtro_tabla("", "campos_formato", "nombre='serie_idserie' AND formato_idformato=" . $idpantalla, "", $conn);
    /*
     * Se garantiza que la serie ya existe y que siempre llega un valor para serie_idserie en datos
     */
    if (!$campo_serie["numcampos"]) {
        $sql2 = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(" . $idpantalla . ",'serie_idserie','Tipo de documento','int','11',0,'../../test/test_serie_funcionario.php?estado_serie=1;2;0;1;1;0;1','a,e','Tipo de documento','" . $datos["serie_idserie"] . "','','hidden',0,1,'Tipo documental')";
        phpmkr_query($sql2);
        $retorno["serie_idserie"] = phpmkr_insert_id();
        $retorno["serie_idserie_sql"] = $sql2;
    }
    $campo_documento = busca_filtro_tabla("", "campos_formato", "nombre='documento_iddocumento' AND formato_idformato=" . $idpantalla, "", $conn);
    if (!$campo_documento["numcampos"]) {
        $sql2 = "INSERT INTO campos_formato(formato_idformato,  nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(" . $idpantalla . ",'documento_iddocumento','Documento asociado','int','11',0,'','a','Documento asociado','','','hidden',0,0,'Documento')";
        phpmkr_query($sql2);
        $retorno["documento"] = phpmkr_insert_id();
        $retorno["documento_sql"] = $sql2;
    }
    $campo_formato = busca_filtro_tabla("", "campos_formato", "nombre='idft_" . $datos["nombre_tabla"] . "' AND formato_idformato=" . $idpantalla, "", $conn);
    if (!$campo_formato["numcampos"]) {
        $sql2 = "INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, predeterminado, banderas, etiqueta_html, orden, fila_visible,placeholder) VALUE(" . $idpantalla . ",'id" . $datos["nombre_tabla"] . "','Identificador de formato','int','11',0,'','a','Identificador unico del formato (llave primaria)','','ai,pk','hidden',0,0,'id" . $datos["nombre_tabla"] . "')";
        phpmkr_query($sql2);
        $retorno["idformato"] = phpmkr_insert_id();
        $retorno["idformato_sql"] = $sql2;
    }
    return ($retorno);
}

function eliminar_pantalla_campos_formato($idpantalla) {
    $campo_serie = busca_filtro_tabla("", "pantalla_campos", "nombre='serie_idserie' AND pantalla_idpantalla=" . $idpantalla, "", $conn);
    if ($idpantalla) {
        if ($campo_serie["numcampos"]) {
            $sql2 = "DELETE FROM pantalla_campos WHERE idpantalla=" . $idpantalla . " AND nombre='serie_idserie'";
            phpmkr_query($sql2);
        }
        $campo_documento = busca_filtro_tabla("", "pantalla_campos", "nombre='documento_iddocumento' AND pantalla_idpantalla=" . $idpantalla, "", $conn);
        if ($campo_documento["numcampos"]) {
            $sql2 = "DELETE FROM pantalla_campos WHERE idpantalla=" . $idpantalla . " AND nombre='documento_iddocumento'";
            phpmkr_query($sql2);
        }
    }
}

function actualizar_encabezado_pie($idformato, $tipo, $valor) {
    $retorno = array(
        "exito" => 0
    );
	$buscar_formato= busca_filtro_tabla("encabezado, pie_pagina", "formato", "idformato=" . $idformato, "", $conn);
	 if ($buscar_formato["numcampos"]) {
        	$encabezado_anterior = $buscar_formato[0]["encabezado"];
        	$pie_pagina_anterior = $buscar_formato[0]["pie_pagina"];
     }
    if ($tipo == "encabezado") {        
        $sql = "UPDATE formato set encabezado=" . $valor . " WHERE idformato=" . $idformato;
        phpmkr_query($sql);
        $retorno["exito"] = 1;
		//se ingresan las funciones del encabezado en la tabla funciones_formato y funciones_formato_enlace
		$retorno["funciones"] = registrar_funciones_encabezado_formato($valor,$idformato,$encabezado_anterior);
    } else if ($tipo == "pie") {
        $sql = "UPDATE formato set pie_pagina=" . $valor . " WHERE idformato=" . $idformato;
        phpmkr_query($sql);
        $retorno["exito"] = 1;
		$retorno["funciones"] = registrar_funciones_pie_formato($valor,$idformato,$pie_pagina_anterior);
    }
    $retorno["sql"] = $sql;
    return ($retorno);
}

function actualizar_cuerpo_formato($idformato, $tipo_retorno) {
    $retorno = array(
        "exito" => 0
    );
    $retorno["mensaje"] = "Existe un error al actualizar el cuerpo del formato";
    if (@$_REQUEST["contenido"]) {
        $sql = "UPDATE formato set cuerpo='" . $_REQUEST["contenido"] . "' WHERE idformato=" . $idformato;
        phpmkr_query($sql);
        $retorno["exito"] = 1;
        $retorno["sql"] = $sql;
        $retorno["mensaje"] = "El contenido para generar el dise&ntilde;o del formato se almacena de forma correcta";
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function consultar_campos_formato($idformato, $tipo_retorno) {
    global $conn, $ruta_db_superior;
    $retorno = array(
        "exito" => 0,
        "mensaje" =>  "Recuerde que se deben crear campos del formato"
    );
    if (@$_REQUEST["idformato"]) {
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $idformato, "", $conn);
        $consulta_campos_lectura = busca_filtro_tabla("valor", "configuracion", "nombre='campos_solo_lectura'", "", $conn);
        
        if ($consulta_campos_lectura['numcampos']) {
            $campos_lectura = json_decode($consulta_campos_lectura[0]['valor'], true);
            $campos_lectura = implode(",", $campos_lectura);
            $campos_lectura = str_replace(",", "','", $campos_lectura);
            $busca_idft = strpos($campos_lectura, "idft_");
            if ($busca_idft !== false) {
                $consulta_ft = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
                $campos_lectura = str_replace("idft_", "id" . $formato[0]['nombre_tabla'], $campos_lectura);
                $campos_excluir[] = $campos_lectura;
            }
        }

        $condicion_adicional = " and A.nombre not in('" . implode("', '", $campos_excluir) . "')";
        $campos = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $idformato . " and etiqueta_html<>'campo_heredado' " . $condicion_adicional . "", "A.orden", $conn);
        if($campos['numcampos']){
            $retorno["exito"] = 1;
        }
        if ($tipo_retorno == 1)
            echo (json_encode($retorno));
        else {
            return ($retorno);
        }
    }
}

function verificar_nombre_formato($nombre, $tipo_retorno) {
    $retorno = array(
        "exito" => 0,
        "mensaje" => "El nombre del formato no es v&aacute;lido"
    );
    $formato = busca_filtro_tabla("", "formato", "nombre='" . $nombre . "'", "", $conn);
    $max_long_nombre = 26;
    $min_long_nombre = 3;
    /* Validacion que tenga entre 3 y 20 caracteres y que solo tenga numeros letras y _ */
    if (ereg("^[a-zA-Z0-9\_]{" . $min_long_nombre . "," . $max_long_nombre . "}$", $nombre)) {
        $retorno["exito"] = 1;
        $retorno["mensaje"] = "El nombre del formato es correcto";
    } else {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "En el nombre del formato solo son permitidos n&uacute;meros, letras y el gui&oacute;n bajo";
    }
    if ($formato["numcampos"]) {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "El nombre del formato ya existe";
    } else if (strlen($nombre) > $max_long_nombre || strlen($nombre) < $min_long_nombre) {
        $retorno["exito"] = 0;
        $retorno["mensaje"] = "El nombre del formato debe tener m&aacute;s de " . $min_long_nombre . " y menos de " . $max_long_nombre . " caracteres.";
    }

    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function actualizar_contenido_encabezado($idencabezado, $etiqueta, $contenido, $tipo_retorno = 1) {
    global $conn;
    $retorno = array(
        "exito" => 0
    );
    $sql = "";
    $contenido = addslashes(stripslashes($contenido));
    if (empty($idencabezado)) {
        $sql = "INSERT INTO encabezado_formato(etiqueta, contenido) VALUES ('$etiqueta', '$contenido')";
        phpmkr_query($sql);
        $retorno["idInsertado"] = phpmkr_insert_id();
        $retorno["exito"] = 1;
    } else {
        $sql = "UPDATE encabezado_formato set etiqueta='$etiqueta', contenido='$contenido' WHERE idencabezado_formato=" . $idencabezado;
        phpmkr_query($sql);
        $retorno["exito"] = 1;
    }
    $retorno["sql"] = $sql;

    $encabezados = busca_filtro_tabla("", "encabezado_formato", "1=1", "etiqueta", $conn);
    $datos = array();
    for ($i = 0; $i < $encabezados["numcampos"]; $i++) {
        $fila = array(
            "idencabezado" => $encabezados[$i]["idencabezado_formato"],
            "etiqueta" => $encabezados[$i]["etiqueta"],
            "contenido" => $encabezados[$i]["contenido"]
        );
        $datos[] = $fila;
    }

    if (!empty($datos)) {
        $retorno["datos"] = $datos;
    }

    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function consultar_contenido_encabezado(){
	
    global $conn;
    $retorno = array(
        "exito" => 0
    );
    $encabezados = busca_filtro_tabla("","encabezado_formato","1=1","etiqueta ASC",$conn);
	$tipo_retorno=$_REQUEST['tipo_retorno'];
    $datos = array();
    if($encabezados['numcampos']){
    	$retorno["exito"] = 1;
	    for ($i = 0; $i < $encabezados["numcampos"]; $i++) {
	        $fila = array(
	            "idencabezado" => $encabezados[$i]["idencabezado_formato"],
	            "etiqueta" => $encabezados[$i]["etiqueta"],
	            "contenido" => $encabezados[$i]["contenido"]
	        );
	        $datos[] = $fila;
	    }
    }
    if (!empty($datos)) {
        $retorno["datos"] = $datos;
    }
	
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }

}
function eliminar_contenido_encabezado($idencabezado, $etiqueta, $contenido, $tipo_retorno = 1) {
    global $conn;
    $retorno = array(
        "exito" => 0
    );
    $sql = "";
    if (!empty($idencabezado)) {
        $consulta_plantilla = busca_filtro_tabla("f.nombre","formato f,documento d","d.estado not in ('ELIMINADO') and  lower(d.plantilla) = f.nombre and f.idformato=".$_REQUEST['idFormato'],"","");
        if($consulta_plantilla['numcampos']){
            if(isset($_REQUEST['tipo']) && $_REQUEST['tipo']=="encabezado"){
                $retorno["mensaje"] = "No es posible elimiar el encabezado, ya existen documentos asociados";
            }else if(isset($_REQUEST['tipo']) && $_REQUEST['tipo']=="piePagina"){
                $retorno["mensaje"] = "No es posible elimiar el pie de pagina, ya existen documentos asociados";
            }
            $retorno["exito"] = 0;          
        }else{
            $sql = "DELETE FROM encabezado_formato WHERE idencabezado_formato=" . $idencabezado;
            phpmkr_query($sql);

            if(isset($_REQUEST['tipo']) && $_REQUEST['tipo']=="encabezado"){
                $updateFormato = "UPDATE formato set encabezado = 0 where idformato=".$_REQUEST['idFormato'];
            }else if(isset($_REQUEST['tipo']) && $_REQUEST['tipo']=="piePagina"){
                $updateFormato = "UPDATE formato set piePagina = 0 where idformato=".$_REQUEST['idFormato'];
            } 
            phpmkr_query($updateFormato);
            $retorno["exito"] = 1;
            $retorno["sql"] = $sql;
        }
        
    }

    $encabezados = busca_filtro_tabla("", "encabezado_formato", "1=1", "etiqueta", $conn);
    $datos = array();
    for ($i = 0; $i < $encabezados["numcampos"]; $i++) {
        $fila = array(
            "idencabezado" => $encabezados[$i]["idencabezado_formato"],
            "etiqueta" => $encabezados[$i]["etiqueta"],
            "contenido" => $encabezados[$i]["contenido"]
        );
        $datos[] = $fila;
    }

    if (!empty($datos)) {
        $retorno["datos"] = $datos;
    }

    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}


if (@$_REQUEST["ejecutar_libreria_formato"]) {
    if (!@$_REQUEST["tipo_retorno"]) {
        $_REQUEST["tipo_retorno"] = 1;
    }
    $_REQUEST["ejecutar_libreria_formato"]($_REQUEST["idformato"], $_REQUEST["tipo_retorno"]);
}
if (@$_REQUEST["ejecutar_libreria_encabezado"]) {
    $_REQUEST["ejecutar_libreria_encabezado"]($_REQUEST["idencabezado"], $_REQUEST["etiqueta"], $_REQUEST["contenido"], $_REQUEST["tipo_retorno"]);
}
function registrar_funciones_encabezado_formato($idencabezado,$idformato,$id_encabezado_anterior){
	global $conn;
	$funciones_encabezado_anterior=array();
	$funciones_encabezado_nuevo=array();
	$buscar_encabezado_anterior = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=".$id_encabezado_anterior, "", $conn);
	if($buscar_encabezado_anterior["numcampos"]){
	 	preg_match_all("/{\*([^*}]+)\*}/", $buscar_encabezado_anterior[0]["contenido"], $funciones_encabezado_anterior);
	}
	//print_r($buscar_encabezado_anterior["sql"]);
	
	$buscar_encabezado_nuevo = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=".$idencabezado, "", $conn);
	if($buscar_encabezado_nuevo["numcampos"]){
	 	preg_match_all("/{\*([^*}]+)\*}/", $buscar_encabezado_nuevo[0]["contenido"], $funciones_encabezado_nuevo);
	}
	//return ($buscar_encabezado_anterior["sql"]." - ".$buscar_encabezado_nuevo["sql"]);
	//return (var_dump($buscar_encabezado_nuevo)." - ".var_dump($funciones_encabezado_nuevo));
	/*print_r($funciones_encabezado_anterior[1]);
	print_r("<br><br>");
	print_r($funciones_encabezado_nuevo[1]);*/
	//$resultado = array_intersect($funciones_encabezado_anterior[1],$funciones_encabezado_nuevo[1]);
	$funciones_borrar = array_diff($funciones_encabezado_anterior[1],$funciones_encabezado_nuevo[1]);
	//print_r($funciones_borrar);
	
	for($i=1;$i<=count($funciones_borrar);$i++)
	{
		$buscar_funciones_formato = busca_filtro_tabla("", "funciones_formato ff, funciones_formato_enlace ffe", "ff.nombre_funcion='".$funciones_borrar[$i]."' and ff.idfunciones_formato = ffe.funciones_formato_fk and ffe.formato_idformato=".$idformato, "", $conn);		
		//print_r($buscar_funciones_formato["sql"]);
		if($buscar_funciones_formato["numcampos"]){
			//delete funciones_formato_enlace			
			$delete = "DELETE FROM funciones_formato_enlace WHERE idfunciones_formato_enlace=".$buscar_funciones_formato[0]["idfunciones_formato_enlace"];
			phpmkr_query($delete);
		}
		$buscar_funciones_formato_enlace = busca_filtro_tabla("", "funciones_formato ff, funciones_formato_enlace ffe", "ff.nombre_funcion='".$funciones_borrar[$i]."' and ff.idfunciones_formato = ffe.funciones_formato_fk", "", $conn);
		if(!$buscar_funciones_formato_enlace["numcampos"]){
			//eliminar de funciones_formato la funcion
			$delete = "DELETE FROM funciones_formato WHERE idfunciones_formato=".$buscar_funciones_formato_enlace[0]["idfunciones_formato"];
			phpmkr_query($delete);
		}
	}
	for($i=0;$i<count($funciones_encabezado_nuevo[1]);$i++)//funciones nuevas
	 {
		 $buscar_funciones_formato = busca_filtro_tabla("", "funciones_formato", "nombre_funcion='".$funciones_encabezado_nuevo[1][$i]."'", "", $conn);
			//return $buscar_funciones_formato["sql"];
			if($buscar_funciones_formato["numcampos"]){
				$id_funciones_formato = $buscar_funciones_formato[0]["idfunciones_formato"];
				//return $buscar_funciones_formato["sql"];
				$buscar_funciones_formato_enlace = busca_filtro_tabla("", "funciones_formato_enlace", "funciones_formato_fk=".$id_funciones_formato." and formato_idformato=".$idformato, "", $conn);
				if(!$buscar_funciones_formato_enlace["numcampos"]){
					$insert_ffe = "INSERT INTO funciones_formato_enlace (funciones_formato_fk, formato_idformato) VALUES ($id_funciones_formato,$idformato)";
					//print_r($insert_ffe);
				 	 phpmkr_query($insert_ffe);
					 $ok= phpmkr_insert_id();
				}
			}
		else{ //se ingresa funciones en funciones_formato
			$insert_ff = "INSERT INTO funciones_formato (nombre, nombre_funcion,etiqueta,ruta,acciones) VALUES ('{*".$funciones_encabezado_nuevo[1][$i]."*}', '".$funciones_encabezado_nuevo[1][$i]."', '".$funciones_encabezado_nuevo[1][$i]."','../librerias/encabezado_pie_pagina.php','m')";
			 phpmkr_query($insert_ff);
			 $id = phpmkr_insert_id();
			 $insert_ffe = "INSERT INTO funciones_formato_enlace (funciones_formato_fk, formato_idformato) VALUES ($id,$idformato)";
			  phpmkr_query($insert_ffe);
			  $ok= phpmkr_insert_id();
		}
	}		
	//}
return $ok;
}
function registrar_funciones_pie_formato($idencabezado,$idformato,$id_pie_anterior){
	global $conn;
	$funciones_pie_anterior=array();
	$funciones_pie_nuevo=array();
	$buscar_pie_anterior = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=".$id_pie_anterior, "", $conn);
	if($buscar_pie_anterior["numcampos"]){
	 	preg_match_all("/{\*([^*}]+)\*}/", $buscar_pie_anterior[0]["contenido"], $funciones_pie_anterior);
	}
	
	$buscar_pie_nuevo = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=".$idencabezado, "", $conn);
	if($buscar_pie_nuevo["numcampos"]){
	 	preg_match_all("/{\*([^*}]+)\*}/", $buscar_pie_nuevo[0]["contenido"], $funciones_pie_nuevo);
	}
	
	$funciones_borrar = array_diff($funciones_pie_anterior[1],$buscar_pie_nuevo[1]);
		
	for($i=1;$i<=count($funciones_borrar);$i++)
	{
		$buscar_funciones_formato = busca_filtro_tabla("", "funciones_formato ff, funciones_formato_enlace ffe", "ff.nombre_funcion='".$funciones_borrar[$i]."' and ff.idfunciones_formato = ffe.funciones_formato_fk and ffe.formato_idformato=".$idformato, "", $conn);		
		//print_r($buscar_funciones_formato["sql"]);
		if($buscar_funciones_formato["numcampos"]){
			//delete funciones_formato_enlace			
			$delete = "DELETE FROM funciones_formato_enlace WHERE idfunciones_formato_enlace=".$buscar_funciones_formato[0]["idfunciones_formato_enlace"];
			phpmkr_query($delete);
		}
		$buscar_funciones_formato_enlace = busca_filtro_tabla("", "funciones_formato ff, funciones_formato_enlace ffe", "ff.nombre_funcion='".$funciones_borrar[$i]."' and ff.idfunciones_formato = ffe.funciones_formato_fk", "", $conn);
		if(!$buscar_funciones_formato_enlace["numcampos"]){
			//eliminar de funciones_formato la funcion
			$delete = "DELETE FROM funciones_formato WHERE idfunciones_formato=".$buscar_funciones_formato_enlace[0]["idfunciones_formato"];
			phpmkr_query($delete);
		}
	}
	for($i=0;$i<count($funciones_pie_nuevo[1]);$i++)//funciones nuevas
	 {
		 $buscar_funciones_formato = busca_filtro_tabla("", "funciones_formato", "nombre_funcion='".$funciones_pie_nuevo[1][$i]."'", "", $conn);
			//return $buscar_funciones_formato["sql"];
			if($buscar_funciones_formato["numcampos"]){
				$id_funciones_formato = $buscar_funciones_formato[0]["idfunciones_formato"];
				//return $buscar_funciones_formato["sql"];
				$buscar_funciones_formato_enlace = busca_filtro_tabla("", "funciones_formato_enlace", "funciones_formato_fk=".$id_funciones_formato." and formato_idformato=".$idformato, "", $conn);
				if(!$buscar_funciones_formato_enlace["numcampos"]){
					$insert_ffe = "INSERT INTO funciones_formato_enlace (funciones_formato_fk, formato_idformato) VALUES ($id_funciones_formato,$idformato)";
					//print_r($insert_ffe);
				 	 phpmkr_query($insert_ffe);
					 $ok= phpmkr_insert_id();
				}
			}
		else{ //se ingresa funciones en funciones_formato
			$insert_ff = "INSERT INTO funciones_formato (nombre, nombre_funcion,etiqueta,ruta,acciones) VALUES ('{*".$funciones_pie_nuevo[1][$i]."*}', '".$funciones_pie_nuevo[1][$i]."', '".$funciones_pie_nuevo[1][$i]."','../librerias/encabezado_pie_pagina.php','m')";
			 phpmkr_query($insert_ff);
			 $id = phpmkr_insert_id();
			 $insert_ffe = "INSERT INTO funciones_formato_enlace (funciones_formato_fk, formato_idformato) VALUES ($id,$idformato)";
			  phpmkr_query($insert_ffe);
			  $ok= phpmkr_insert_id();
		}
	}
return $ok;
}

function consultarPermisos(){
    global $conn;
    $nombreFormato = $_REQUEST['nombreFormato'];
    $retorno = ["exito" => 0, "permisos" => []];
    $consultaModulo = busca_filtro_tabla("idmodulo", "modulo", "nombre='{$nombreFormato}' and enlace='formatos/mostrar_{$nombreFormato}.php' ", "", $conn);
    
    if ($consultaModulo['numcampos']) {
        $consultarPermiso = busca_filtro_tabla("perfil_idperfil", "permiso_perfil", "modulo_idmodulo={$consultaModulo[0]['idmodulo']}", "", $conn);
        if($consultarPermiso['numcampos']){
            for ($i=0; $i < $consultarPermiso['numcampos'] ; $i++) { 
               $permisos[]= $consultarPermiso[$i][perfil_idperfil];
            }
            $retorno["permisos"] = $permisos;
        }
    }
    echo json_encode($retorno);

}
?>