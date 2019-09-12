<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'formatos/librerias/funciones_acciones.php';
include_once $ruta_db_superior . 'formatos/librerias/funciones_generales.php';

//si es editar
//librerias/modificar_plantilla.php

JwtController::check($_REQUEST['token'], $_REQUEST['key']);

if (empty($_REQUEST['formatId'])) {
    throw new Exception("Se debe indicar el formato", 1);
}

if (empty($_REQUEST["dependencia"])) {
    throw new Exception("Se debe indicar el rol", 1);
}

if (empty($_REQUEST["tipo_radicado"])) {
    throw new Exception("Se debe indicar el contador", 1);
}

$Formato = new Formato($_REQUEST['formatId']);
$plantilla = strtoupper($Formato->nombre);
$idformato = $Formato->getPK();
$valores = [];

if (empty($_POST["ejecutor"])) {
    $_POST["ejecutor"] = SessionController::getValue('usuario_actual');
}

$Documento = new Documento();
foreach ($_POST as $key => $valor) {
    if (
        in_array($key, $Documento->getSafeAttributes()) &&
        !in_array($key, ["estado", "fecha"])
    ) {
        $valores[$key] = $valor;
    }
}

$valores["numero"] = 0;
$valores["plantilla"] = $plantilla;
$valores["responsable"] = $_REQUEST["dependencia"];
$valores["serie"] = !empty($_POST["serie_idserie"]) ? $_POST["serie_idserie"] : 0;

$Contador = Contador::findByAttributes([
    'nombre' => $_POST["tipo_radicado"]
]);

if (!$Contador) {
    $Contador = $Formato->getCounter();

    if (!$Contador) {
        throw new Exception("Se debe definir un contador", 1);
    }
}

$valores["tipo_radicado"] = $Contador->getPK();
$_POST["tipo_radicado"] = $Contador->nombre;

llama_funcion_accion(null, $idformato, "radicar", "ANTERIOR");
$_POST["iddoc"] = saveDocument(trim($_POST["tipo_radicado"]), $valores, null);

if ($_POST["iddoc"]) {
    include_once $ruta_db_superior . "anexosdigitales/funciones_archivo.php";
    $permisos = null;
    cargar_archivo($_POST["iddoc"], $permisos);
}

llama_funcion_accion($_POST["iddoc"], $idformato, "radicar", "POSTERIOR");

if (array_key_exists("anterior", $_REQUEST)) {
    llama_funcion_accion($_REQUEST["anterior"], $idformato, "responder", "ANTERIOR");
    $idbuzon = busca_filtro_tabla("max(A.idtransferencia) as idbuzon", "buzon_entrada A", "A.archivo_idarchivo=" . $_REQUEST["anterior"], "", $conn);

    Respuesta::newRecord([
        'fecha' => date('Y-m-d H:i:s'),
        'destino' => $_POST["iddoc"],
        'origen' => $_REQUEST["anterior"],
        'idbuzon' =>  $idbuzon[0]["idbuzon"],
        'plantilla' =>  $plantilla,
    ]);

    $datos["archivo_idarchivo"] = $_REQUEST["anterior"];
    $datos["nombre"] = "TRAMITE";
    $datos["tipo_destino"] = 1;
    $datos["tipo"] = "";
    $destino_tramite[] = $_SESSION["usuario_actual"];
    transferir_archivo_prueba($datos, $destino_tramite, "", "");
    llama_funcion_accion($_REQUEST["anterior"], $idformato, "responder", "POSTERIOR");
}

if ($_POST["iddoc"]) {
    $idplantilla = saveFormat($_POST["iddoc"]);
}

if (!$idplantilla) {
    if (!isset($_REQUEST["no_redirecciona"])) {
        alerta("<b>ATENCI&Oacute;N</b><br>No se ha podido Crear el documento..", 'error', 5000);
        phpmkr_query("update documento set estado='ELIMINADO' where iddocumento=" . $_POST["iddoc"], $conn);
        redirecciona("responder.php");
    } else {
        $retorno["mensaje"] = "No se ha podido Crear el documento ";
        return json_encode($retorno);
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

    if (!is_array($adicionales)) {
        $adicionales = [];
    }

    $adicionales["activo"] = "1";
    include_once $ruta_db_superior . 'formatos/librerias/funciones_generales.php';

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
            redirecciona('formatos/' . "librerias/rutaadd.php?x_plantilla='$plantilla'&doc=" . $_POST["iddoc"] . "&obligatorio=" . $_POST["obligatorio"] . "&origen=" . $usuario_origen[0][0]);
            return;
        } else {
            $retorno["mensaje"] = "Error al generar la ruta de aprobacion";
            return json_encode($retorno);
        }
    }

    if (in_array("e", $banderas) || $_REQUEST["webservie_aprob_doc"] == 1) {
        aprobar($_POST["iddoc"], 1);
    }

    enrutar_documento("", $_POST["iddoc"]);
    return $_POST["iddoc"];
}


function saveDocument($tipo_contador, $arreglo, $archivos = null, $idflujo = null)
{
    global $conn, $ruta_db_superior;
    if ($tipo_contador != "" && $tipo_contador != null);
    elseif (array_key_exists("serie", $arreglo))
        $tipo_contador = $arreglo["serie"];
    else
        alerta("<b>ATENCI&Oacute;N</b><br>No es posible radicar el Documento. Error No existe clasificaci&oacute;n del documento", 'warning');

    if (!array_key_exists("numero", $arreglo) && $tipo_contador) {
        $arreglo["numero"] = 0;
    }
    if (empty($arreglo["plantilla"])) {
        $arreglo["plantilla"] = "";
    } else {
        $idformato = busca_filtro_tabla("idformato", "formato", "lower(nombre)='" . strtolower($arreglo["plantilla"]) . "'", "", $conn);
        if ($idformato['numcampos']) {
            $arreglo["formato_idformato"] = $idformato[0]['idformato'];
        }
    }
    if (!isset($arreglo["tipo_radicado"]))
        $arreglo["tipo_radicado"] = $contador[0]["idcontador"];
    if ($tipo_contador == "radicacion_salida" && !isset($arreglo["plantilla"]))
        $arreglo["estado"] = "APROBADO";
    elseif (!empty($arreglo["plantilla"]))
        $arreglo["estado"] = "ACTIVO";
    elseif (!isset($arreglo["estado"]))
        $arreglo["estado"] = "ACTIVO";

    // VENTANILLA RADICACION
    $ventanilla_radicacion = usuario_actual('ventanilla_radicacion') ?? 0;
    $arreglo["ventanilla_radicacion"] = $ventanilla_radicacion;

    $doc = Documento::newRecord($arreglo);

    if (empty($doc)) {
        die("No hay ID Documento");
    }

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
    if ($archivos != null && $archivos != "") {
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

    return $doc;
}


function saveFormat($iddoc, $tipo = 0)
{
    global $conn;
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

    if ($idformato) {
        $larchivos = array();
        $where = "formato_idformato=" . $idformato . " AND (banderas NOT LIKE '%pk%' OR banderas IS NULL)";
        $columns = GenerarFormatoController::getFieldsName($tabla);

        if ($columns) {
            $where .= " AND nombre IN('" . implode("','", $columns) . "')";
        }
        $lcampos = busca_filtro_tabla("idcampos_formato,tipo_dato,nombre,etiqueta_html,valor,longitud", "campos_formato", $where, "", $conn);
        for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
            // si el valor es un array
            if (is_array($_REQUEST[$lcampos[$j]["nombre"]]) && $lcampos[$j]["etiqueta_html"] != "archivo") {
                array_push($valores, "'" . implode(',', @$_REQUEST[$lcampos[$j]["nombre"]]) . "'");
                array_push($campos, $lcampos[$j]["nombre"]);
            } else if ($lcampos[$j]["valor"] == "{*form_ejecutor*}") {
                array_push($campos, $lcampos[$j]["nombre"]);
                $valor = ejecutoradd($_REQUEST[$lcampos[$j]["nombre"]]);
                array_push($valores, $valor);
            } else {
                switch ($lcampos[$j]["etiqueta_html"]) {
                    case "detalle":
                        if (@$_REQUEST["anterior"]) {
                            $formato_detalle = busca_filtro_tabla("id" . $lcampos[$j]["nombre"], $lcampos[$j]["nombre"], "documento_iddocumento=" . $_REQUEST["anterior"], "", $conn);
                            if ($formato_detalle["numcampos"])
                                $_REQUEST[$lcampos[$j]["nombre"]] = $formato_detalle[0]["id" . $lcampos[$j]["nombre"]];
                        }
                        break;
                    case "archivo":
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
                        case "TEXT":
                            $_REQUEST[$lcampos[$j]["nombre"]] = str_replace("'", "&#39;", stripslashes($_REQUEST[$lcampos[$j]["nombre"]]));
                            if ($tipo == 1 && $lcampos[$j]["longitud"] >= 4000) {
                                $contenido = $_REQUEST[$lcampos[$j]["nombre"]];
                                guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "texto", $conn);
                            } elseif ($lcampos[$j]["longitud"] < 4000) {
                                $contenido = $_REQUEST[$lcampos[$j]["nombre"]];
                                array_push($valores, "'" . @$_REQUEST[$lcampos[$j]["nombre"]] . "'");
                                array_push($campos, $lcampos[$j]["nombre"]);
                            }

                            break;
                        case "TIME":
                            array_push($valores, "'" . @$_REQUEST[$lcampos[$j]["nombre"]] . "'");
                            array_push($campos, $lcampos[$j]["nombre"]);
                            break;
                        case "DATE":
                            array_push($campos, $lcampos[$j]["nombre"]);
                            if (@$_REQUEST[$lcampos[$j]["nombre"]] && $_REQUEST[$lcampos[$j]["nombre"]] != '0000-00-00') {
                                array_push($valores, "'" . $_REQUEST[$lcampos[$j]["nombre"]] . "'");
                            } else {
                                array_push($valores, "NULL");
                            }
                            break;
                        case "DATETIME":
                            array_push($campos, $lcampos[$j]["nombre"]);
                            if (@$_REQUEST[$lcampos[$j]["nombre"]] && $_REQUEST[$lcampos[$j]["nombre"]] != '0000-00-00 00:00') {
                                array_push($valores,  "'" . $_REQUEST[$lcampos[$j]["nombre"]] . "'");
                            } else {
                                array_push($valores, "NULL");
                            }
                            break;
                        default:
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

    if ($campos && $valores && $tipo == 0) {
        if (!in_array('documento_iddocumento', $campos)) {
            array_push($campos, "documento_iddocumento");
            array_push($valores, $iddoc);
        } else {
            $pos = array_search('documento_iddocumento', $campos);
            $valores[$pos] = $iddoc;
        }

        if (in_array("serie_idserie", $campos)) {
            $pos = array_search('serie_idserie', $campos);
            if ($valores[$pos] == "''") {
                $valores[$pos] = "NULL";
            }
        }
        if (in_array("despachado", $campos)) {
            $pos = array_search('despachado', $campos);
            if ($valores[$pos] == "''") {
                $valores[$pos] = 0;
            }
        }

        llama_funcion_accion($iddoc, $idformato, "adicionar", "ANTERIOR");

        $sql = "INSERT INTO " . $tabla . "(" . implode(",", $campos) . ") VALUES (" . implode(",", $valores) . ")";

        $Connection = Connection::getInstance(true);
        $Connection->query($sql);
        $insertado = $Connection->lastInsertId();

        if ($insertado) {
            if (count($larchivos)) {
                include_once("anexosdigitales/funciones_archivo.php");
                cargar_archivo_formato($larchivos, $idformato, $iddoc, $form_uuid);
            }

            llama_funcion_accion($iddoc, $idformato, "adicionar", "POSTERIOR");
            generar_ruta_documento($idformato, $iddoc);
        } else {
            if (isset($iddoc)) {
                $del = "DELETE FROM documento WHERE iddocumento=" . $iddoc;
                phpmkr_query($del);
            }
        }
    } elseif ($tipo == 1) { // cuando voy a editar
        $update = array();
        for ($i = 0; $i < count($campos); $i++) {
            $update[] = $campos[$i] . "=" . $valores[$i];
        }
        llama_funcion_accion($iddoc, $idformato, "editar", "ANTERIOR");
        $sql = "UPDATE " . $tabla . " SET " . implode(",", $update) . " WHERE documento_iddocumento=" . $iddoc;

        if (!phpmkr_query($sql)) {
            throw new Exception("Error al actualizar el documento", 1);
        }

        DocumentoRastro::newRecord([
            'fk_documento' => $iddoc,
            'accion' => DocumentoRastro::ACCION_EDICION,
            'titulo' => 'Edición del documento'
        ]);

        if (isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"] != "") {
            $valid_ruta = busca_filtro_tabla("idruta,origen,tipo_origen", "ruta", "tipo='ACTIVO' and documento_iddocumento=" . $iddoc, "idruta asc", $conn);
            // TODO: Se valida si cambio la dependencia del creador para actualizar la ruta (Firma SVG)
            if ($valid_ruta["numcampos"] == 1 && $valid_ruta[0]["tipo_origen"] == 5 && $valid_ruta[0]["origen"] != $_REQUEST["dependencia"]) {
                $update_ruta = "UPDATE ruta SET origen=" . $_REQUEST["dependencia"] . " WHERE idruta=" . $valid_ruta[0]["idruta"];
                phpmkr_query($update_ruta) or die("Error al actualizar la ruta del documento");
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
    actualizar_datos_documento($idformato, $iddoc);

    return $insertado;
}
