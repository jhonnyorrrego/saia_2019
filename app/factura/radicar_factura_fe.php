<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
    if(is_file($ruta . "db.php")) {
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

if(!isset($_REQUEST["saia_key"])) {
    $resp["message"] = "No se envió identificación del funcionario";
    echo json_encode($resp);
    die();
}

$saia_key = $_REQUEST["saia_key"];

$resp["data"] = $_REQUEST["datos_correo"];
if(isset($_REQUEST["datos_correo"])) {
    $datos = json_decode($_REQUEST["datos_correo"], true);
    if(json_last_error() !== JSON_ERROR_NONE) {
        $resp["message"] = "error en la cadena json";
        echo json_encode($resp);
        die();
    }
}

logear_funcionario_webservice("radicador_web");
$datos_funcionario = busca_filtro_tabla("idfuncionario, funcionario_codigo, login", "funcionario", "idfuncionario=$saia_key", "");
$formato = busca_filtro_tabla("idformato", "formato", "nombre='factura_electronica'", "");
$idformato = $formato[0]["idformato"];

if($datos_funcionario["numcampos"]) {
    logear_funcionario_webservice($datos_funcionario[0]["login"]);
} else {
    $resp["message"] = "No se encontró el funcionario";
    echo json_encode($resp);
    die();
}

//echo json_encode($resp); die();

$radicados = 0;
foreach($datos as $datos_correo) {
    $id_correo = registar_correo($datos_correo);

    $datos_factura = procesar_factura($datos_correo["adjuntos"]);
    if(!empty($datos_factura)) {
        $datos_factura["fk_datos_correo"] = $id_correo;
        $datos_factura["idgrupo"] = "'" . $datos_correo["idgrupo"] . "'";
        $nombres_anexos = array();
        /* foreach ($datos_correo["adjuntos"] as $archivo) {
          $nombres = preg_split('/___/', $archivo);
          if (!empty($nombres) && count($nombres) > 1) {
          $nombres_anexos = $nombres[1];
          }
          } */

        $datos_factura["anexos"] = "'" . implode(",", $datos_correo["adjuntos"]) . "'";

        $iddatos_factura = registar_factura($datos_factura);
        $datos_factura["iddt_datos_factura"] = $iddatos_factura;
        $datos_factura["fk_datos_factura"] = $iddatos_factura;
        $iddoc = radicar_factura($datos_factura);
        if(!empty($iddoc)) {
            guardar_anexos($datos_correo["adjuntos"], $idformato, $iddoc);
        } else {
            $resp["message"] = "No es posible adjuntar los anexos al documento";
            break;
        }
        $radicados++;
    }
    mover_correo_buzon($datos_correo);
}

$resp["radicados"] = $radicados;
if($radicados) {
    $resp["status"] = 1;
    $resp["message"] = "Radicación existosa";
}

//abrir_url($ruta_db_superior . "index_correo.php", "_self");
//die("HECHO");

echo json_encode($resp);
die();

function procesar_factura($adjuntos) {
    $archivo_face = null;
    foreach($adjuntos as $archivo) {
        $es = file_exists($archivo);
        $ext_arch = pathinfo($archivo, PATHINFO_EXTENSION);

        if(preg_match("/xml/i", $ext_arch) && $es) {
            $archivo_face = $archivo;
            break;
        }
    }

    $datos_factura = array();

    if(!empty($archivo_face)) {
        $factura = new FacturaXML(array(
            "archivo" => $archivo_face
        ));

        $datos_factura["num_factura"] = "'" . $factura->numeroFactura() . "'";
        $datos_factura["fecha_factura"] = fecha_db_almacenar($factura->fechaExpedicion(), "Y-m-d H:i:s");

        $proveedor = $factura->datosProveedor();
        if(is_array($proveedor)) {
            $info = array();
            foreach($proveedor as $key => $value) {
                switch($key) {
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
            if(!empty($info)) {
                $datos_factura["info_proveedor"] = "'" . implode(",", $info) . "'";
            }
        } else {
            $datos_factura["info_proveedor"] = "'$proveedor'";
        }

        $datos_factura["total_factura"] = $factura->totalFactura();
    }
    return $datos_factura;
}

function registar_correo($info_correo) {
    
    $search = array(
        "<",
        ">",
        "&",
        '"'
    );
    $replace = array(
        "",
        "",
        "",
        ""
    );

    $valores = array(
        "idgrupo" => "'" . $info_correo["idgrupo"] . "'",
        "uid" => $info_correo["uid"],
        "asunto" => "'" . htmlentities($info_correo["asunto"]) . "'",
        "fecha_oficio_entrada" => fecha_db_almacenar($info_correo["fecha_oficio_entrada"], "Y-m-d H:i:s"),
        "de" => "'" . htmlentities(str_replace($search, $replace, $info_correo["from"])) . "'",
        "buzon_email" => "'" . $info_correo["buzon"] . "'",
        "para" => "'" . $info_correo["to"] . "'",
        "anexos" => "'" . implode(",", $info_correo["adjuntos"]) . "'"
    );
    $insert = "INSERT INTO dt_datos_correo (" . implode(", ", array_keys($valores)) . ") VALUES (" . implode(", ", array_values($valores)) . ")";
    // print_r(array_keys($valores));

    phpmkr_query($insert) or die("Error al ingresar el registro del correo: " . $insert);

    return phpmkr_insert_id();
}

function registar_factura($info_factura) {
    
    $insert = "INSERT INTO dt_datos_factura (" . implode(", ", array_keys($info_factura)) . ") VALUES (" . implode(", ", array_values($info_factura)) . ")";
    // print_r(array_keys($valores));

    phpmkr_query($insert) or die("Error al ingresar el registro de la factura: " . $insert);
    return phpmkr_insert_id();
}

function radicar_correo($idgrupo) {
    global $ruta_db_superior, $conn;
    include_once ($ruta_db_superior . "app/documento/class_transferencia.php");
    $datos = busca_filtro_tabla("TOP 1 " . fecha_db_obtener("fecha_oficio_entrada", "Y-m-d H:i") . " as fecha,*", "dt_datos_correo", "idgrupo='" . $idgrupo . "' and iddoc_rad=0", "");
    if($datos["numcampos"]) {
        $tabla = "ft_correo_saia";
        $dependencia = busca_filtro_tabla("funcionario_codigo,iddependencia_cargo,login", "vfuncionario_dc", "idfuncionario=" . $_SESSION["idfuncionario"] . " AND estado_dc=1", "");
        $serie = busca_filtro_tabla("predeterminado", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND B.nombre='serie_idserie'", "");
        $campos_formato = busca_filtro_tabla("", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "");
        $campos = extrae_campo($campos_formato, "idcampos_formato");

        $_REQUEST["asunto"] = limpiarContenido($datos[0]["asunto"]);
        $_REQUEST["fecha_oficio_entrada"] = $datos[0]["fecha"];
        $_REQUEST["de"] = limpiarContenido($datos[0]["de"]);
        $_REQUEST["para"] = limpiarContenido($datos[0]["para"]);
        $_REQUEST["transferencia_correo"] = $datos[0]["transferir"];
        $_REQUEST["copia_correo"] = $datos[0]["copia"];
        $_REQUEST["comentario"] = $datos[0]["comentario"];

        $_REQUEST["uid_correo"] = $datos[0]["uid"];
        $_REQUEST["buzon_correo"] = $datos[0]["buzon_email"];
        $_REQUEST["anexos"] = str_replace("\\", "/", $datos[0]["anexos"]);

        $_REQUEST["tipo_radicado"] = "radicacion_entrada";
        $_REQUEST["encabezado"] = "1";
        $_REQUEST["estado_documento"] = "1";
        $_REQUEST["firma"] = "1";
        $_REQUEST["dependencia"] = $dependencia[0]["iddependencia_cargo"];
        $_REQUEST["serie_idserie"] = $serie[0]["predeterminado"];
        $_REQUEST["ejecutor"] = $dependencia[0]["funcionario_codigo"];

        $_REQUEST["campo_descripcion"] = implode(",", $campos);
        $_REQUEST["formato"] = "correo_saia";
        $_REQUEST["idformato"] = $campos_formato[0]["idformato"];
        $_REQUEST["tabla"] = $tabla;
        $_REQUEST["no_redirecciona"] = 1;

        $_POST = $_REQUEST;
        $iddoc = radicar_plantilla();
        if($iddoc) {
            $ok = busca_filtro_tabla("d.iddocumento,d.numero", "$tabla ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "");
            if($ok["numcampos"]) {
                $update_ok = "UPDATE dt_datos_correo SET iddoc_rad=" . $ok[0]["iddocumento"] . ",numero_rad=" . $ok[0]["numero"] . " WHERE iddt_datos_correo=" . $datos[0]["iddt_datos_correo"];
                phpmkr_query($update_ok) or die("Error al actualizar la DT");
            } else {
                $update = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $iddoc;
                phpmkr_query($update) or die("Error al Eliminar el documento");

                $update_dt = "UPDATE dt_datos_correo SET iddoc_rad=-1 WHERE iddt_datos_correo=" . $datos[0]["iddt_datos_correo"];
                phpmkr_query($update_dt) or die("Error al actualizar la DT");
            }
        } else {
            $update_dt = "UPDATE dt_datos_correo SET iddoc_rad=-1 WHERE iddt_datos_correo=" . $datos[0]["iddt_datos_correo"];
            phpmkr_query($update_dt) or die("Error al actualizar la DT");
        }
        //redirecciona("radicar_correo_masivo.php?idgrupo=" . $idgrupo);
        //die();
    }
}

function mover_correo_buzon($info_correo) {
    $email = busca_filtro_tabla("email,email_contrasena", "funcionario", "funcionario_codigo=" . $_SESSION["usuario_actual"], "");
    //$cstr = "{" . SERVIDOR_CORREO_IMAP . ":" . PUERTO_SERVIDOR_CORREO . "/imap/ssl}";
    $cstr = "{" . ltrim(SERVIDOR_CORREO_IMAP, "ssl://") . ":" . PUERTO_SERVIDOR_CORREO . "/ssl/novalidate-cert}";
    $imapStream = imap_open($cstr, $email[0]['email'], $email[0]['email_contrasena']) or die("No es posible conectar al servidor de correo: " . imap_last_error());

    $carpetas = imap_listmailbox($imapStream, "{imap.example.org:143}", "Facturas SAIA");

    if($carpetas === false) {
        imap_createmailbox($imapStream, imap_utf8($cstr . "Facturas SAIA"));
        imap_subscribe($imapStream, $cstr . "Facturas SAIA");
        //imap_close($imapStream);
    }

    //echo $move = imap_mail_move($imapStream, $info_correo["uid"], 'Facturas SAIA', CP_UID);
    $move = imap_mail_move($imapStream, $info_correo["uid"], 'Facturas SAIA', CP_UID);
    imap_close($imapStream, CL_EXPUNGE);
}

function radicar_factura($datos) {
    global $ruta_db_superior, $conn;
    include_once ($ruta_db_superior . "app/documento/class_transferencia.php");
    if(!empty($datos)) {
        $tabla = "ft_factura_electronica";
        $dependencia = busca_filtro_tabla("funcionario_codigo,iddependencia_cargo,login", "vfuncionario_dc", "idfuncionario=" . $_SESSION["idfuncionario"] . " AND estado_dc=1", "");
        $serie = busca_filtro_tabla("predeterminado", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND B.nombre='serie_idserie'", "");
        $campos_formato = busca_filtro_tabla("", "formato A,campos_formato B", "A.nombre_tabla='" . $tabla . "' AND A.idformato=B.formato_idformato AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "");
        $campos = extrae_campo($campos_formato, "idcampos_formato");

        $_REQUEST["num_factura"] = $datos["num_factura"];
        $_REQUEST["nit_proveedor"] = $datos["nit_proveedor"];
        $_REQUEST["fecha_factura"] = $datos["fecha_factura"];
        $_REQUEST["nombre_proveedor"] = limpiarContenido($datos["nombre_proveedor"]);
        $_REQUEST["direccion_proveedor"] = limpiarContenido($datos["direccion_proveedor"]);
        $_REQUEST["ciudad_proveedor"] = limpiarContenido($datos["ciudad_proveedor"]);
        $_REQUEST["estado_proveedor"] = limpiarContenido($datos["estado_proveedor"]);
        $_REQUEST["pais_proveedor"] = limpiarContenido($datos["pais_proveedor"]);
        $_REQUEST["info_proveedor"] = limpiarContenido($datos["info_proveedor"]);
        $_REQUEST["anexos"] = str_replace("\\", "/", $datos["anexos"]);
        $_REQUEST["total_factura"] = $datos["total_factura"];

        //TODO: Revisar lo del remitente

        $_REQUEST["tipo_radicado"] = "radicacion_entrada";
        $_REQUEST["encabezado"] = "1";
        $_REQUEST["estado_documento"] = "1";
        $_REQUEST["firma"] = "1";
        $_REQUEST["dependencia"] = $dependencia[0]["iddependencia_cargo"];
        $_REQUEST["serie_idserie"] = $serie[0]["predeterminado"];
        $_REQUEST["ejecutor"] = $dependencia[0]["funcionario_codigo"];

        $_REQUEST["campo_descripcion"] = implode(",", $campos);
        $_REQUEST["formato"] = "factura_electronica";
        $_REQUEST["idformato"] = $campos_formato[0]["idformato"];
        $_REQUEST["tabla"] = $tabla;
        $_REQUEST["no_redirecciona"] = 1;

        $_POST = $_REQUEST;
        $iddoc = radicar_plantilla();
        if($iddoc) {
            $ok = busca_filtro_tabla("d.iddocumento,d.numero", "$tabla ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=" . $iddoc, "");
            if($ok["numcampos"]) {
                $update_ok = "UPDATE dt_datos_factura SET iddoc_rad=" . $ok[0]["iddocumento"] . ",numero_rad=" . $ok[0]["numero"] . " WHERE iddt_datos_factura=" . $datos["iddt_datos_factura"];
                phpmkr_query($update_ok) or die("Error al actualizar la DT: $update_ok");
            } else {
                $update = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $iddoc;
                phpmkr_query($update) or die("Error al Eliminar el documento: $update");

                $update_dt = "UPDATE dt_datos_factura SET iddoc_rad=-1 WHERE iddt_datos_factura=" . $datos["iddt_datos_factura"];
                phpmkr_query($update_dt) or die("Error al actualizar la DT: $update_dt");
            }
        } else {
            $update_dt = "UPDATE dt_datos_factura SET iddoc_rad=-1 WHERE iddt_datos_factura=" . $datos["iddt_datos_factura"];
            phpmkr_query($update_dt) or die("Error al actualizar la DT: $update_dt");
        }
        //redirecciona("radicar_correo_masivo.php?idgrupo=" . $idgrupo);
        return $iddoc;
    }
    return null;
}

function guardar_anexos($datos, $idformato, $iddoc) {
    global $conn, $ruta_db_superior;
    require_once($ruta_db_superior . "anexosdigitales/funciones_archivo.php");
    //$datos = busca_filtro_tabla("anexos,numero", "ft_factura_electronica,documento", "documento_iddocumento=iddocumento and documento_iddocumento=" . $iddoc, "");
    $vector = $datos;
    $total = count($vector);
    for($i = 0; $i < $total; $i++) {
        //$ruta_real = $ruta_db_superior . "roundcubemail/" . $vector[$i];
        $ruta_real = $vector[$i];
        //print_r($ruta_real);
        if(file_exists($ruta_real)) {
            $dir_anexos = selecciona_ruta_anexos2($iddoc, "archivos");

            $nombres = preg_split('/___/', basename($ruta_real));
            if(!empty($nombres) && count($nombres) > 1) {
                $nombre_anexo = $nombres[1];
            } else {
                $nombre_anexo = basename($ruta_real);
            }

            $archivo = uniqid() . "_" . $nombre_anexo;

            $almacenamiento = new SaiaStorage("archivos");
            $resultado = $almacenamiento->copiar_contenido_externo($ruta_real, $dir_anexos . $archivo);
            if($resultado) {
                $dir_anexos_1 = array(
                    "servidor" => $almacenamiento->get_ruta_servidor(),
                    "ruta" => $dir_anexos . $archivo
                );
                $datos_anexo = pathinfo($ruta_real);
                $consulta_campos_formato = busca_filtro_tabla("idcampos_formato", "campos_formato", "nombre='anexos' and formato_idformato=" . $idformato, "");
                $sql = "INSERT INTO anexos(documento_iddocumento,ruta,tipo,etiqueta,fecha_anexo,formato,campos_formato) values(" . $iddoc . ",'" . json_encode($dir_anexos_1) . "','" . $datos_anexo["extension"] . "','" . $archivo . "'" . "," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . $idformato . "','" . $consulta_campos_formato[0]['idcampos_formato'] . "')";
                phpmkr_query($sql) or die("Error al registrar el anexo: $sql");
                $idanexo = phpmkr_insert_id();
                if($idanexo) {
                    $sql1 = "insert into permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_total)values('" . $idanexo . "', '" . $_SESSION["idfuncionario"] . "', 'lem', 'l')";
                    phpmkr_query($sql1) or die("Error al registrar los permisos del anexo: $sql1");
                }
            }
        }
    }
    return;
}

function limpiarContenido($texto) {
    $textoLimpio = preg_replace('([^ A-Za-z0-9_-ñÑ,&;@\.\-])', '', utf8_decode($texto));
    return $textoLimpio;
}

?>