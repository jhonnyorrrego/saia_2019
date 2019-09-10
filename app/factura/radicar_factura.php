<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";

require_once 'FacturaXML.php';

header('Content-Type: application/json');

$datos = array();

$resp = array(
    "status" => 0
);

if (!isset($_REQUEST["saia_key"])) {
    $resp["message"] = "No se envió identificación del funcionario";
    echo json_encode($resp);
    die();
}

$saia_key = $_REQUEST["saia_key"];

$resp["data"] = $_REQUEST["datos_correo"];
if (isset($_REQUEST["datos_correo"])) {
    $datos = json_decode($_REQUEST["datos_correo"], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $resp["message"] = "error en la cadena json";
        echo json_encode($resp);
        die();
    }
}

// $nombre_formato = 'factura_electronica';
$nombre_formato = 'factura_electronica';
// logear_funcionario_webservice("radicador_web");
$datos_funcionario = busca_filtro_tabla("idfuncionario, funcionario_codigo, login", "funcionario", "idfuncionario=$saia_key", "", $conn);
$formato = busca_filtro_tabla("idformato", "formato", "nombre='{$nombre_formato}'", "", $conn);
$idformato = $formato[0]["idformato"];

if ($datos_funcionario["numcampos"]) {
    logear_funcionario_webservice($datos_funcionario[0]["login"]);
} else {
    $resp["message"] = "No se encontró el funcionario";
    echo json_encode($resp);
    die();
}

// Preprocesar la lista de archivos

$archivosXml = [];
$archivosPdf = [];
$archivoEml = [];

$noExiste = [];
// Separar por nombre los xml de los pdf
// Tener en cuenta que se le asigna un identificador unico separado por "___" del nombre
foreach ($datos as $datos_correo) {
    $uidCorreo = $datos_correo["uid"];
    $esteEml = [];
    foreach ($datos_correo["adjuntos"] as $archivo) {
        $es = file_exists($archivo);
        $partes_ruta = pathinfo($archivo);

        $ext_arch = $partes_ruta['extension'];
        $sNomArch = new Stringy\Stringy($partes_ruta['filename']);
        $prefijo = strstr((string)$sNomArch, '___', true);
        if(!empty($prefijo)) {
            $prefijo = $prefijo . '___';
            $sNomArch = $sNomArch->removeLeft($prefijo);
        }

        $nom_arch = (string)$sNomArch;
        if ($es) {
            if (preg_match("/xml/i", $ext_arch)) {
                $archivosXml[$uidCorreo][$nom_arch] = $archivo;
            } else if (preg_match("/pdf/i", $ext_arch)) {
                $archivosPdf[$uidCorreo][$nom_arch] = $archivo;
            } else if (preg_match("/eml/i", $ext_arch)) {
                $esteEml[] = $archivo;
            }
        } else {
            $noExiste[] = $archivo;
        }
    }
    $esteEml = array_unique($esteEml);
    $archivoEml[$uidCorreo][] = $esteEml;
}

$procesados = [];
$procesadosXml = [];
$procesadosPdf = [];
//var_dump($archivosXml);
//var_dump($archivosPdf);
//var_dump($archivoEml);
//die();

$mensajes = [];
$radicados = [];

foreach ($datos as $datos_correo) {

    $radicados[$uidCorreo] = 0;
    $uidCorreo = $datos_correo["uid"];
    foreach ($archivosXml[$uidCorreo] as $nombre => $ruta) {
        $datos_factura = procesar_factura($ruta);
        if (!empty($datos_factura)) {
            $notas = $datos_factura["notas"];
            $tipo_persona = $datos_factura["tipo_persona"];
            unset($datos_factura["notas"]);
            unset($datos_factura["tipo_persona"]);
            // $datos_factura["idgrupo"] = "'" . $datos_correo["idgrupo"] . "'";

            $anexLst = implode(",", $datos_correo["adjuntos"]);
            $anexLst = trim($anexLst, "'");
            $datos_factura["anexos"] = "'" . $anexLst . "'";

            $iddatos_factura = registar_factura($datos_factura);
            // $datos_factura["num_folios"] = count($datos_correo["adjuntos"]);
            // $datos_factura["iddt_datos_factura"] = $iddatos_factura;
            $datos_factura["fk_datos_factura"] = $iddatos_factura;
            $datos_factura["anexos"] = $anexLst;
            $iddoc = radicar_factura($datos_factura, $nombre_formato);
            if (!empty($iddoc)) {
                $anexos = [];
                $anexos[] = $archivosXml[$uidCorreo][$nombre];
                $anexos[] = $archivosPdf[$uidCorreo][$nombre];
                $anexos[] = $archivoEml[$uidCorreo][0];
                guardar_anexos($anexos, $idformato, $iddoc);
                guardarDetalleFactura($iddoc, $datos_factura["items"]);
                $procesadosXml[$uidCorreo][$nombre] = $archivosXml[$uidCorreo][$nombre];
                $procesadosPdf[$uidCorreo][$nombre] = $archivosPdf[$uidCorreo][$nombre];
                $procesados[] = $nombre;
                $radicados[$uidCorreo]++;
            } else {
                $mensajes[$datos_correo["asunto"]] = "No fue posible radicar el documento para la factura: $nombre";
                break;
            }
        } else {
            $mensajes[$datos_correo["asunto"]] = "No se pudo procesar la factura: $nombre";
        }
    }
    $mensajes[$datos_correo["asunto"]] = mensajeTerminacion($archivosXml[$uidCorreo], $procesadosXml[$uidCorreo], $procesadosPdf[$uidCorreo]);

    mover_correo_buzon($datos_correo);
}

// echo json_encode($procesados);die();

$resp["radicados"] = count($procesados);

if ($radicados) {
    $resp["status"] = 1;
} else {
    $resp["status"] = 0;
}

//TODO revisar los mensajes

$resp["message"] = http_build_query($mensajes);

echo json_encode($resp);
die();

function mensajeTerminacion($archivosXml, $procesadosXml, $procesadosPdf) {
    $mensaje = "";

    $procesadosXml = array_filter($procesadosXml);
    $procesadosPdf = array_filter($procesadosPdf);

    $aDiffIni = array_diff_key($archivosXml, $procesadosXml);
    $aDiffFin = array_diff_key($procesadosXml, $procesadosPdf);

    if (empty($aDiffIni)) {
        if(empty($aDiffFin)) {
            $mensaje = '"Registro Exitoso". Todas las facturas con su respectiva versión en PDF';
        } else {
            $mensaje = '"Registro Exitoso". Algunas facturas sin su respectiva versión en PDF';
        }
    } else {
        $mensaje = "Por favor revise los documentos generados en busca de inconsistencias";
    }

    return $mensaje;
}

function procesar_factura($archivo_face) {
    $es = file_exists($archivo_face);
    $ext_arch = pathinfo($archivo_face, PATHINFO_EXTENSION);

    $datos_factura = array();

    if (preg_match("/xml/i", $ext_arch) && $es) {
        $factura = new FacturaXML(array(
            "archivo" => $archivo_face
        ));

        $datos_factura["num_factura"] = "'" . $factura->numeroFactura() . "'";
        $datos_factura["fecha_factura"] = fecha_db_almacenar($factura->fechaExpedicion(), "Y-m-d H:i:s");
        $datos_factura["items"] = $factura->items();

        $proveedor = $factura->datosProveedor();
        if (is_array($proveedor)) {
            $info = array();
            foreach ($proveedor as $key => $value) {
                switch ($key) {
                    case "identificacion":
                        $datos_factura["nit_proveedor"] = "'$value'";
                        break;
                    case "nombre":
                        $datos_factura["nombre_proveedor"] = "'$value'";
                        break;
                    case "direccion":
                        $datos_factura["direccion_proveedor"] = "'$value'";
                        break;
                    case "ciudad":
                        $datos_factura["ciudad_proveedor"] = "'$value'";
                        break;
                    case "departamento":
                        $datos_factura["estado_proveedor"] = "'$value'";
                        break;
                    case "pais":
                        $datos_factura["pais_proveedor"] = "'$value'";
                        break;
                    case "tipo_persona":
                        $datos_factura["tipo_persona"] = $value;
                        break;
                    default:
                        $info[] = "$key : $value";
                        break;
                }
            }
            if (!empty($info)) {
                $datos_factura["info_proveedor"] = "'" . implode(",", $info) . "'";
            }
        } else {
            $datos_factura["info_proveedor"] = "'$proveedor'";
        }

        $datos_factura["total_factura"] = $factura->totalFactura();
        $datos_factura["notas"] = "'" . $factura->notas() . "'";
    }
    return $datos_factura;
}

function registar_factura($info_factura) {
    global $conn;
    unset($info_factura["items"]);
    $insert = "INSERT INTO dt_datos_factura (" . implode(", ", array_keys($info_factura)) . ") VALUES (" . implode(", ", array_values($info_factura)) . ")";
    // print_r(array_keys($valores));

    phpmkr_query($insert) or die("Error al ingresar el registro de la factura: " . $insert);
    return phpmkr_insert_id();
}

function mover_correo_buzon($info_correo) {
    $email = busca_filtro_tabla("email,email_contrasena", "funcionario", "funcionario_codigo=" . $_SESSION["usuario_actual"], "", $conn);
    // $cstr = "{" . SERVIDOR_CORREO_IMAP . ":" . PUERTO_SERVIDOR_CORREO . "/imap/ssl}";
    
    $cstr = "{" . ltrim(SERVIDOR_CORREO_IMAP, "ssl://") . ":" . PUERTO_SERVIDOR_CORREO . "/ssl/novalidate-cert}";
    $imapStream = imap_open($cstr, $email[0]['email'], $email[0]['email_contrasena']) or die("No es posible conectar al servidor de correo: " . imap_last_error());

    $carpetas = imap_listmailbox($imapStream, "{imap.example.org:143}", "Facturas SAIA");

    if ($carpetas === false) {
        imap_createmailbox($imapStream, imap_utf8($cstr . "Facturas SAIA"));
        imap_subscribe($imapStream, $cstr . "Facturas SAIA");
        // imap_close($imapStream);
    }

    // echo $move = imap_mail_move($imapStream, $info_correo["uid"], 'Facturas SAIA', CP_UID);
    $move = imap_mail_move($imapStream, $info_correo["uid"], 'Facturas SAIA', CP_UID);
    imap_close($imapStream, CL_EXPUNGE);
}

function radicar_factura($datos, $nombre_formato) {
    global $ruta_db_superior, $conn;
    include_once ($ruta_db_superior . "app/documento/class_transferencia.php");
    if (!empty($datos)) {
        $tabla = "ft_{$nombre_formato}";
        $dependencia = busca_filtro_tabla("funcionario_codigo,iddependencia_cargo,login", "vfuncionario_dc", "idfuncionario=" . $_SESSION["idfuncionario"] . " AND estado_dc=1", "", $conn);
        $serie = busca_filtro_tabla("predeterminado", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND B.nombre='serie_idserie'", "", $conn);
        $campos_formato = busca_filtro_tabla("", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "", $conn);
        $campos = extrae_campo($campos_formato, "idcampos_formato");

        $_REQUEST["num_factura"] = $datos["num_factura"];
        $_REQUEST["fecha_factura"] = $datos["fecha_factura"];

        $_REQUEST["anexos"] = $datos["anexos"];
        $_REQUEST["total_factura"] = $datos["total_factura"];
        $_REQUEST["info_proveedor"] = implode("\n", $datos["notas"]);

        // TODO: Revisar lo del remitente
        $idDatosEjecutor = obtener_ejecutor($datos);

        $_REQUEST["proveedor"] = $idDatosEjecutor;

        $_REQUEST["tipo_radicado"] = "radicacion_entrada";
        $_REQUEST["encabezado"] = "1";
        $_REQUEST["estado_documento"] = "1";
        $_REQUEST["firma"] = "1";
        $_REQUEST["dependencia"] = $dependencia[0]["iddependencia_cargo"];
        $_REQUEST["serie_idserie"] = $serie[0]["predeterminado"];
        $_REQUEST["ejecutor"] = $dependencia[0]["funcionario_codigo"];

        $_REQUEST["campo_descripcion"] = implode(",", $campos);
        $_REQUEST["formato"] = "{$nombre_formato}";
        $_REQUEST["idformato"] = $campos_formato[0]["idformato"];
        $_REQUEST["tabla"] = $tabla;
        $_REQUEST["no_redirecciona"] = 1;
        $_REQUEST["webservie_aprob_doc"] = 1;

        $_POST = $_REQUEST;
        $iddoc = radicar_plantilla();
        if ($iddoc) {
            $ok = busca_filtro_tabla("d.iddocumento,d.numero", "$tabla ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "", $conn);
            if ($ok["numcampos"]) {
                $update_ok = "UPDATE dt_datos_factura SET iddoc_rad=" . $ok[0]["iddocumento"] . ",numero_rad=" . $ok[0]["numero"] . " WHERE iddt_datos_factura=" . $datos["fk_datos_factura"];
                phpmkr_query($update_ok) or die("Error al actualizar la DT: $update_ok");
            } else {
                $update = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $iddoc;
                phpmkr_query($update) or die("Error al Eliminar el documento: $update");

                $update_dt = "UPDATE dt_datos_factura SET iddoc_rad=-1 WHERE iddt_datos_factura=" . $datos["fk_datos_factura"];
                phpmkr_query($update_dt) or die("Error al actualizar la DT: $update_dt");
            }
        } else {
            $update_dt = "UPDATE dt_datos_factura SET iddoc_rad=-1 WHERE iddt_datos_factura=" . $datos["fk_datos_factura"];
            phpmkr_query($update_dt) or die("Error al actualizar la DT: $update_dt");
        }
        // redirecciona("radicar_correo_masivo.php?idgrupo=" . $idgrupo);
        return $iddoc;
    }
    return null;
}

function guardar_anexos($datos, $idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    require_once ($ruta_db_superior . "anexosdigitales/funciones_archivo.php");
    // $datos = busca_filtro_tabla("anexos,numero", "ft_{$nombre_formato},documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "", $conn);
    $total = count($datos);
    for ($i = 0; $i < $total; $i++) {
        // $ruta_real = $ruta_db_superior . "roundcubemail/" . $vector[$i];
        $ruta_real = $datos[$i];
        // print_r($ruta_real);
        if (file_exists($ruta_real)) {
            $dir_anexos = selecciona_ruta_anexos2($iddoc, "archivos");

            $nombres = preg_split('/___/', basename($ruta_real));
            if (!empty($nombres) && count($nombres) > 1) {
                $nombre_anexo = $nombres[1];
            } else {
                $nombre_anexo = basename($ruta_real);
            }

            $archivo = uniqid() . "_" . $nombre_anexo;

            $almacenamiento = new SaiaStorage("archivos");
            $resultado = $almacenamiento->copiar_contenido_externo($ruta_real, $dir_anexos . $archivo);
            if ($resultado) {
                $dir_anexos_1 = array(
                    "servidor" => $almacenamiento->get_ruta_servidor(),
                    "ruta" => $dir_anexos . $archivo
                );
                $datos_anexo = pathinfo($ruta_real);
                $consulta_campos_formato = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre='anexos' and formato_idformato=" . $idformato, "", $conn);
                $sql = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo,formato,campos_formato) values(" . $iddoc . ",'" . json_encode($dir_anexos_1) . "','" . $datos_anexo["extension"] . "','" . $nombre_anexo . "'" . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . $idformato . "','" . $consulta_campos_formato[0]['idcampos_formato'] . "')";
                phpmkr_query($sql) or die("Error al registrar el anexo: $sql");
                $idanexo = phpmkr_insert_id();
                if ($idanexo) {
                    $sql1 = "insert into permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_total)values('" . $idanexo . "', '" . $_SESSION["idfuncionario"] . "', 'lem', 'l')";
                    phpmkr_query($sql1) or die("Error al registrar los permisos del anexo: $sql1");
                }
            }
        }
    }
    return;
}

function guardarDetalleFactura($iddoc, $items) {
    global $conn;
    $tabla = "ft_ite_factur_electronica";
    $datos_padre = busca_filtro_tabla("idft_factura_electronica", "ft_factura_electronica", "documento_iddocumento = $iddoc", "", $conn);
    $idft = null;
    if ($datos_padre["numcampos"]) {
        $idft = $datos_padre[0]["idft_factura_electronica"];
    }
    foreach ($items as $item) {
        $datos = [];
        $datos["cantidad"] = $item["cantidad"];
        $datos["descripcion"] = "'" . $item["descripcion"] . "'";
        $datos["ft_factura_electronica"] = $idft;
        // $datos["impuesto_1"]=$item["cantidad"];
        // $datos["impuesto_2"]=$item["cantidad"];
        // $datos["serie_idserie"]=$item["cantidad"];
        $datos["valor_iva"] = $item["impuestos"] ?? 0;
        $datos["valor_total"] = $item["precio"] ?? 0;
        $datos["valor_unitario"] = $item["valor"] ?? 0;

        $sql = "INSERT INTO $tabla (" . implode(", ", array_keys($datos)) . ") VALUES (" . implode(", ", array_values($datos)) . ")";
        phpmkr_query($sql) or die($sql);
        $iditem = phpmkr_insert_id();
    }
}

function limpiarContenido($texto) {
    $textoLimpio = preg_replace('([^ A-Za-z0-9_-ñÑ,&;@\.\-])', '', utf8_decode($texto));
    return $textoLimpio;
}

function obtener_ejecutor($datos) {
    global $conn;
    $datos_persona = array();

    if (!empty($datos)) {
        $datos = array_map(function ($val) {
            return trim(trim($val, "'"));
        }, $datos);

        $nombre = trim(trim($datos["nombre_proveedor"], "'"));
        $identificacion = trim(trim($datos["nit_proveedor"], "'"));
        $datos_persona["departamento"] = 0;
        $valida_dep = busca_filtro_tabla("iddepartamento", "departamento", "lower(nombre) like lower('" . htmlentities($datos["estado_proveedor"]) . "')", "", $conn);
        if ($valida_dep["numcampos"]) {
            $datos_persona["departamento"] = $valida_dep[0]["iddepartamento"];
        }
        if (!empty($datos_persona["departamento"])) {
            $valida_ciudad = busca_filtro_tabla("m.idmunicipio", "departamento d, municipio m", "d.iddepartamento=m.departamento_iddepartamento and d.iddepartamento=" . $datos_persona["departamento"] . " and lower(m.nombre) like lower('" . htmlentities($datos["ciudad_proveedor"]) . "')", "", $conn);
            if ($valida_ciudad["numcampos"]) {
                $datos_persona["ciudad"] = $valida_ciudad[0]["idmunicipio"];
            }
        } else {
            $valor = busca_filtro_tabla("", "municipio A", "lower(A.nombre) like lower('" . htmlentities($datos["ciudad_proveedor"]) . "')", "", $conn);
            if ($valor) {
                $datos_persona["ciudad"] = $valor[0]["idmunicipio"];
            }
        }

        $datos_persona["direccion"] = limpiarContenido($datos["direccion_proveedor"]);
        // $datos_persona["telefono"] =
        // $datos_persona["email"] =

        if (!isset($datos_persona["ciudad"]) || empty($datos_persona["ciudad"])) {
            $config = busca_filtro_tabla("valor", "configuracion", "lower(nombre) like 'ciudad'", "", $conn);
            if ($config["numcampos"]) {
                $datos_persona["ciudad"] = $config[0][0];
            } else {
                $datos_persona["ciudad"] = 658;
            }
        }

        $ejecutor = array(
            "numcampos" => 0
        );
        if (!empty($identificacion)) {
            $ejecutor = busca_filtro_tabla("", "ejecutor", "identificacion LIKE '$identificacion'", "", $conn);

            if (!$ejecutor["numcampos"]) {
                $ejecutor = busca_filtro_tabla("", "ejecutor", "lower(nombre) LIKE lower('$nombre') and (identificacion is null or identificacion='')", "", $conn);
            }
        } elseif (trim($nombre) != "") {
            $ejecutor = busca_filtro_tabla("", "ejecutor", "lower(nombre) LIKE lower('$nombre ')", "", $conn);
        }
        if ($ejecutor["numcampos"]) {
            $otros = "";
            if (!empty($identificacion)) {
                $otros .= ",identificacion='" . $identificacion . "'";
            }
            $sql = "UPDATE ejecutor SET nombre ='$nombre'" . $otros . " WHERE idejecutor=" . $ejecutor[0]["idejecutor"];
            phpmkr_query($sql) or die($sql);
            $idejecutor = $ejecutor[0]["idejecutor"];
        } else {
            $sql = "INSERT INTO ejecutor(nombre,identificacion)VALUES('$nombre','$identificacion')";
            phpmkr_query($sql) or die($sql);
            $idejecutor = phpmkr_insert_id();
            $insertado = 1;
        }

        $campos_excluidos = array(
            "nombre",
            "identificacion"
        );
        $campos_ejecutor = array_diff(array_keys($datos_persona), $campos_excluidos);
        sort($campos_ejecutor);
        $campos_todos = array(
            "direccion",
            "telefono",
            "email",
            "cargo",
            "empresa",
            "ciudad",
            "titulo",
            "codigo"
        );

        $condicion_actualiza = "";
        for ($i = 0; $i < count($campos_ejecutor); $i++) {
            if (isset($datos_persona[$campos_ejecutor[$i]])) {
                if (in_array($campos_ejecutor[$i], $campos_todos) && $datos_persona[$campos_ejecutor[$i]]) {
                    $condicion_actualiza .= " AND {$campos_ejecutor[$i]} = '{$datos_persona[$campos_ejecutor[$i]]}'";
                } else if (in_array($campos_ejecutor[$i], $campos_todos)) {
                    $condicion_actualiza .= " AND {$campos_ejecutor[$i]} IS NULL or {$campos_ejecutor[$i] } = '')";
                }
            }
        }
        $datos_ejecutor = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor . $condicion_actualiza, "", $conn);
        if ((!$datos_ejecutor["numcampos"] || $insertado) && $condicion_actualiza != "") {
            $datos_ejecutor = busca_filtro_tabla("", "datos_ejecutor", "ejecutor_idejecutor=" . $idejecutor, "iddatos_ejecutor desc", $conn);
            $campos = array();
            $valores = array();

            for ($i = 0; $i <= count($campos_todos); $i++) {
                if ($campos_todos[$i] != "fecha_nacimiento") {
                    if (isset($datos_persona[$campos_todos[$i]]) && in_array($campos_todos[$i], $campos_ejecutor)) {
                        array_push($valores, $datos_persona[$campos_todos[$i]]);
                        array_push($campos, $campos_todos[$i]);
                        $actualizado = 1;
                    } else if ($datos_ejecutor["numcampos"] && $datos_ejecutor[0][$campos_todos[$i]] != "") {
                        array_push($valores, $datos_ejecutor[0][$campos_todos[$i]]);
                        array_push($campos, $campos_todos[$i]);
                    }
                }
            }
            if ($actualizado) {
                $valor_insertar = "'" . implode("','", str_replace("'", "''", $valores)) . "',";
                $campos_insertar = implode(",", $campos) . ",";
            }
            $sql = 'INSERT INTO datos_ejecutor(' . $campos_insertar . "ejecutor_idejecutor,fecha) VALUES(" . $valor_insertar . $idejecutor . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
            phpmkr_query($sql);

            $iddatos_ejecutor = phpmkr_insert_id();
        } else if ($datos_ejecutor["numcampos"]) {
            $iddatos_ejecutor = $datos_ejecutor[0]["iddatos_ejecutor"];
        }
        return ($iddatos_ejecutor);
    }
    return null;
}
