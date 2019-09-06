<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . FORMATOS_SAIA . "librerias/funciones_acciones.php";
include_once $ruta_db_superior . "bpmn/librerias_formato.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_cripto.php";

function procesar_estados($idorigen, $iddestino, $nombre_transferencia, $iddocumento = null, $fecha_final = null)
{
    switch ($nombre_transferencia) {
        case "TRANSFERIDO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "COPIA":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "DELEGADO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "REVISADO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;

        case "APROBADO":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;

        case "DEVOLUCION":
            eliminar_asignacion($idorigen, $iddocumento);
            asignar_tarea_buzon($iddocumento, null, 2, $iddestino, 1, null, $fecha_final, "PENDIENTE");
            break;
        case "RESPONDIDO":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        case "TRAMITE":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        case "BORRADOR":
            //asignar_tarea_buzon($iddocumento,NULL,2,$iddestino,1,NULL,$fecha_final,"PENDIENTE");
            break;
        case "TERMINADO":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        case "DISTRIBUCION":
            eliminar_asignacion($idorigen, $iddocumento);
            break;
        default:
            return;
            break;
            //Tener encuenta en el case aprobado que si el destino es el radicador de salida solo se cancela la tarea y yap sino se reasigna.
    }
    return true;
}

function eliminar_asignacion($funcionario, $iddocumento)
{
    global $conn;
    $datos_asignacion = busca_filtro_tabla("idasignacion", "asignacion", "documento_iddocumento=$iddocumento AND entidad_identidad=1 AND llave_entidad=$funcionario and tarea_idtarea=2", "", $conn);
    if ($datos_asignacion["numcampos"]) {
        for ($i = 0; $i < $datos_asignacion["numcampos"]; $i++) {
            //echo "delete from asignacion where idasignacion=".$datos_asignacion[$i]["idasignacion"];
            phpmkr_query("delete from asignacion where idasignacion=" . $datos_asignacion[$i]["idasignacion"], $conn);
        }
    } else {
        //alerta("Problemas al Eliminar la tarea Error # 003");     
        return false;
    }
    return true;
}

function asignar_tarea_buzon($iddocumento, $idserie = null, $idtarea = null, $list_entidad = null, $identidad = null, $fecha_inicial = null, $fecha_final = null, $estado = "PENDIENTE")
{
    global $conn;
    $formato = "Y-m-d H:i:s";
    if (!$fecha_inicial)
        $fecha_inicial = fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
    if (($idserie || $iddocumento) && isset($idtarea)) {
        $sql = "INSERT INTO asignacion (documento_iddocumento,tarea_idtarea,fecha_inicial,estado,entidad_identidad,llave_entidad) VALUES ($iddocumento,$idtarea,$fecha_inicial,'$estado',1,$list_entidad)";
        phpmkr_query($sql);
    } else {
        alerta("Diligencie correctamente los datos e intente nuevamente");
        return false;
    }
    return true;
}

function buscar_funcionarios($dependencia, $arreglo = null)
{
    global $conn;
    $dependencias = dependencias($dependencia);
    array_push($dependencias, $dependencia);
    $dependencias = array_unique($dependencias);
    $funcionarios = busca_filtro_tabla("A.funcionario_codigo", "funcionario A,dependencia_cargo B, cargo C,dependencia D", "B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia=D.iddependencia and B.dependencia_iddependencia IN(" . implode(",", $dependencias) . ") AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1 AND A.sistema=1 AND C.tipo_cargo=1", "", $conn);
    $arreglo = extrae_campo($funcionarios, "funcionario_codigo", "U");
    return $arreglo;
}

function dependencias($padre)
{
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
        $listado4 = array_merge((array) $listado1, (array) $listado3);
    } else
        $listado4 = $padres;

    return $listado4;
}

function radicar_documento_prueba($tipo_contador, $arreglo, $archivos = null, $idflujo = null)
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
    /*$valores = implode(",", array_values($arreglo));
    $campos = implode(",", array_keys($arreglo));

    $sql = "INSERT INTO documento(" . $campos . ")" . " VALUES (" . $valores . ")";
    phpmkr_query($sql, $conn) or die($sql . "    <br> -" . phpmkr_error());
    $doc = phpmkr_insert_id();*/

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
    include_once($ruta_db_superior . "workflow/libreria_paso.php");
    iniciar_flujo($doc, $idflujo);
    return $doc;
}

function busca_cargofuncionario($tipo, $dato, $dependencia)
{
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
        $datorig[0] = array_merge((array) $datorig[0], (array) $temp[0]);
    return $datorig;
}

function transferir_archivo_prueba($datos, $destino, $adicionales, $anexos = null)
{
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
    } else {
        $origen = $_SESSION["usuario_actual"];
    }

    $doc = busca_filtro_tabla("B.idformato", "documento A,formato B", "lower(A.plantilla)=B.nombre AND iddocumento=" . $idarchivo, "", $conn);
    $idformato = $doc[0]["idformato"];
    if (empty($idformato)) {
        print_r($doc);
        die();
    }
    llama_funcion_accion($idarchivo, $idformato, "transferir", "ANTERIOR");

    //Cuando ingresan demasiado texto en las notas
    $texto_notas = "";
    if (in_array("notas", array_keys($adicionales))) {
        $cant_texto = strlen($adicionales["notas"]);
        if ($cant_texto > 3000) {
            $texto_notas = $adicionales["notas"];
            unset($adicionales["notas"]);
        }
    }

    if ($destino != "" && $origen != "") {
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

            $ver_notas = 0;
            if (!empty($datos["ver_notas"])) {
                $ver_notas = $datos["ver_notas"];
            }

            foreach ($destino as $user) {
                if ($user == null) {
                    continue;
                }
                if ($datos["nombre"] != "POR_APROBAR") {                  
                    $buzonSalida = [
                        'archivo_idarchivo' => $idarchivo,
                        'nombre' => $datos["nombre"],
                        'fecha' => date('Y-m-d H:i:s'),
                        'origen' => $origen,
                        'tipo_origen' => '1',
                        'tipo_destino' => '1',
                        'ver_notas' => $ver_notas,
                        'destino' => $user
                    ];

                    if($adicionales){
                        $buzonSalida = array_merge($buzonSalida, $adicionales);
                    }

                    $cadena = BuzonSalida::newRecord($buzonSalida);

                    $idbuzon_s = $cadena;
                    $idtransferencia[] = $idbuzon_s;

                    if ($texto_notas != "") {
                        guardar_lob('notas', 'buzon_salida', "idtransferencia=" . $idbuzon_s, $texto_notas, 'texto', $conn, 0);
                    }

                    $VfuncionarioDc = VfuncionarioDc::getUserFromEntity(1, $user);
                    Acceso::addSeePermission(
                        Acceso::TIPO_DOCUMENTO,
                        $idarchivo,
                        $VfuncionarioDc->getPK()
                    );
                } else if ($datos["nombre"] == "POR_APROBAR") {
                    $fk_ruta_documento = RutaDocumento::newRecord([
                        'tipo' => RutaDocumento::TIPO_RADICACION,
                        'estado' => 1,
                        'fk_documento' => $idarchivo,
                        'tipo_flujo' => RutaDocumento::FLUJO_SERIE
                    ]);

                    $Ruta = new Ruta();

                    if (isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"] != "" && $datos["ruta_creador_documento"] == 1) {
                        $Ruta->setAttributes([
                            'origen' => $_REQUEST["dependencia"],
                            'tipo' => 'ACTIVO',
                            'destino' => $user,
                            'idtipo_documental' => NULL,
                            'condicion_transferencia' => 'POR_APROBAR',
                            'documento_iddocumento' => $idarchivo,
                            'tipo_origen' => '5',
                            'tipo_destino' => '1',
                            'obligatorio' => '1',
                            'fk_ruta_documento' => $fk_ruta_documento
                        ]);
                    } else {
                        $Ruta->setAttributes([
                            'origen' => $origen,
                            'tipo' => 'ACTIVO',
                            'destino' => $user,
                            'idtipo_documental' => NULL,
                            'condicion_transferencia' => 'POR_APROBAR',
                            'documento_iddocumento' => $idarchivo,
                            'tipo_origen' => '1',
                            'tipo_destino' => '1',
                            'obligatorio' => '1',
                            'fk_ruta_documento' => $fk_ruta_documento
                        ]);
                    }

                    $idruta = $Ruta->save();
                    $datos["ruta_idruta"] = $idruta;
                }
                $ver_notas = 0;
                if (!empty($datos["ver_notas"])) {
                    $ver_notas = $datos["ver_notas"];
                }
                
                $buzonEntrada = [
                    'archivo_idarchivo' => $idarchivo,
                    'nombre' => $datos["nombre"],
                    'fecha' => date('Y-m-d H:i:s'),
                    'destino' => $origen,
                    'tipo_origen' => '1',
                    'ruta_idruta' => $datos["ruta_idruta"],
                    'tipo_destino' => $tipo_destino,
                    'ver_notas' => $$ver_notas,
                    'origen' => $user
                ];

                if($adicionales){
                    $buzonEntrada = array_merge($buzonEntrada, $adicionales);
                }               

                $idInsertadoEntrada1 = BuzonEntrada::newRecord($buzonEntrada);

                if ($texto_notas != "") {
                    $idbuzon_e = $idInsertadoEntrada1;
                    guardar_lob('notas', 'buzon_entrada', "idtransferencia=" . $idbuzon_e, $texto_notas, 'texto', $conn, 0);
                }
                procesar_estados($origen, $user, $datos["nombre"], $idarchivo);
            }
        } else {
            $ver_notas = 0;
            if (!empty($datos["ver_notas"])) {
                $ver_notas = $datos["ver_notas"];
            }
            $buzonEntrada = [
                'archivo_idarchivo' => $idarchivo,
                'nombre' => $datos["nombre"],
                'fecha' => date("Y-m-d H:i:s"),
                'destino' => $origen,
                'origen' => $destino,
                'tipo_origen' => '1',
                'tipo_destino' => $tipo_destino,
                'ver_notas' => $ver_notas
            ];

            if($adicionales){
                $buzonEntrada = array_merge($buzonEntrada, $adicionales);
            }

            $idInsertadoEntrada2 = BuzonEntrada::newRecord($buzonEntrada);

            if ($texto_notas != "") {
                $idbuzon_e = $idInsertadoEntrada2;
                guardar_lob('notas', 'buzon_entrada', "idtransferencia=" . $idbuzon_e, $texto_notas, 'texto', $conn, 0);
            }
        }
    }

    DocumentoRastro::newRecord([
        'fk_documento' => $idarchivo,
        'accion' => DocumentoRastro::ACCION_TRANSFERENCIA,
        'titulo' => 'Documento transferido.'
    ]);
    llama_funcion_accion($idarchivo, $idformato, "transferir", "POSTERIOR");
    if ($anexos == 1) {
        return $idtransferencia;
    } else {
        return true;
    }
}

function aprobar($iddoc = 0, $opcion = 0)
{
    global $conn;
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

                if ($registro_actual[$i]["ruta_idruta"] != "") {
                    $rutaIddoc = $registro_actual[$i]["ruta_idruta"];
                } else {
                    $rutaIddoc = "";
                }

                BuzonSalida::newRecord([
                    "archivo_idarchivo" => $iddoc,
                    "nombre" => $estado,
                    "origen" => $registro_actual[$i]["destino"],
                    "fecha" => date('Y-m-d H:i:s'),
                    "destino" => $registro_actual[$i]["origen"],
                    "tipo" => 'DOCUMENTO',
                    "tipo_origen" => 1,
                    "tipo_destino" => 1,
                    "ruta_idruta" => $rutaIddoc
                ]);

                $BuzonEntrada = new BuzonEntrada($registro_actual[$i]["idtransferencia"]);
                $BuzonEntrada->setAttributes([
                    "activo" => 0,
                ]);
                $BuzonEntrada->save();
 
                DocumentoRastro::newRecord([
                    'fk_documento' => $iddoc,
                    'accion' => DocumentoRastro::ACCION_CONFIRMACION,
                    'titulo' => 'Confirmación del documento'
                ]);
            }
            if ($registro_actual[0]["ruta_idruta"] != "") {
                $rutaIddoc = $registro_actual[0]["ruta_idruta"];
            } else {
                $rutaIddoc = "";
            }

            for ($i = 0; $i < $registro_actual["numcampos"]; $i++) {
                $registro_intermedio = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<" . $registro_actual[$i]["idtransferencia"], "A.idtransferencia", $conn);
                if ($registro_intermedio["numcampos"])
                    break;
                if ($registro_actual[$i]["ruta_idruta"] != "") {
                    $rutaIddoc = $registro_actual[$i]["ruta_idruta"];
                } else {
                    $rutaIddoc = "''";
                }

                BuzonEntrada::newRecord([
                    "archivo_idarchivo" => $iddoc,
                    "nombre" => $estado,
                    "origen" => $registro_actual[$i]["origen"],
                    "fecha" => date('Y-m-d H:i:s'),
                    "destino" => $registro_actual[$i]["destino"],
                    "tipo" => 'DOCUMENTO',
                    "tipo_origen" => 1,
                    "tipo_destino" => 1,
                    "ruta_idruta" => $rutaIddoc
                ]);
                procesar_estados($registro_actual[$i]["destino"], $registro_actual[$i]["origen"], $estado, $iddoc);
            }

            if ($aprobar_posterior == 1) {
                $Documento = new Documento($iddoc);
                $dias_entrega = busca_filtro_tabla("dias_entrega", "serie", "idserie=" . $tipo_radicado[0]["serie"], "", $conn);
                if ($tipo_radicado[0]["numero"] == 0) {
                    $numero = contador($iddoc, $tipo_radicado[0]["nombre"]);
                    $Documento->setAttributes([
                        "estado" => 'APROBADO',
                        "fecha" => date('Y-m-d H:i:s'),
                        "dias" =>  $dias_entrega[0]["dias_entrega"]
                    ]);
                } else {
                    $Documento->setAttributes([
                        "estado" => 'APROBADO',
                        "activa_admin" => 0,
                        "fecha" => date('Y-m-d H:i:s'),
                        "dias" =>  $dias_entrega[0]["dias_entrega"]
                    ]);
                }

                RutaDocumento::executeUpdate([
                    'finalizado' => 1
                ], [
                    'estado' => 1,
                    'fk_documento' => $iddoc,
                    'tipo' => RutaDocumento::TIPO_RADICACION
                ]);
                DocumentoRastro::newRecord([
                    'fk_documento' => $iddoc,
                    'accion' => DocumentoRastro::ACCION_RADICACION,
                    'titulo' => 'Radicación del documento'
                ]);

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
    actualizar_datos_documento($tipo_radicado[0]["idformato"], $iddoc);
    if ($opcion == 0) {
        if ($_REQUEST["anterior"] == $iddoc) {
            return $iddoc;
        } else {
            $formato_ant = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $datos_formato[0]["cod_padre"], "", $conn);
            if ($formato_ant["numcampos"]) {
                $iddoc_anterior = busca_filtro_tabla("a.documento_iddocumento", $formato_ant[0]["nombre_tabla"] . " a," . $datos_formato[0]["nombre_tabla"] . " b", "a.id" . $formato_ant[0]["nombre_tabla"] . "=b." . $formato_ant[0]["nombre_tabla"] . " and b.documento_iddocumento=" . $iddoc, "", $con);
                if ($iddoc_anterior["numcampos"]) {
                    $_REQUEST["anterior"] = $iddoc_anterior[0]["documento_iddocumento"];
                }
            }
        }
    }
    return $iddoc;
}

function mostrar_estado_proceso($idformato, $iddoc)
{
    global $conn, $idfactura;
    $campos_formato = ""; // La variable no estaba definida, la he definido provisionalmente como string vacio.
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
                $ancho_firma[0]["valor"] = "20%";
            }

            $alto_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='alto_firma'", "", $conn);
            if (!$alto_firma["numcampos"]) {
                $alto_firma[0]["valor"] = "20%";
            }

            if ($_REQUEST['tipo'] == 1) {

                $ancho_firma[0]["valor"] = "35%";
                $alto_firma[0]["valor"] = "50%";
            }

            $tamano_fuente = busca_filtro_tabla("valor", "configuracion A", "A.nombre='tamano_letra'", "", $conn);
            if (!$tamano_fuente["numcampos"]) {
                $tamano_fuente[0]["valor"] = '10pt';
            }

            echo "<table class='table table-condensed' border=\"0\" cellpadding='0' cellspacing='0' align='left' width=\"100%\">";

            for ($k = $resultado["numcampos"] - 1; $k >= 0; $k--) {
                if (!$resultado[$k])
                    continue;
                $fila = $resultado[$k];
                if ($fila["tipo_origen"] == 5) { // rol
                    $cargos = busca_filtro_tabla("distinct cargo.nombre", "cargo,dependencia_cargo", "cargo_idcargo=idcargo AND tipo_cargo=1 and iddependencia_cargo=" . $fila["origen"], "", $conn);
                } elseif ($fila["tipo_origen"] == 1) { // funcionario_codigo
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
                        echo '<td style="border:none;" align="left"><img src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/assets/images/firmas/faltante.jpg" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '">&nbsp;&nbsp;&nbsp;<br /></td>';
                        if ($iniciales == ($fila["funcionario_codigo"]))
                            $firma_actual = true;
                    } else if ($mostrar_firmas == 1) {
                        $firma = busca_filtro_tabla("firma", "funcionario", "funcionario_codigo='" . $fila["funcionario_codigo"] . "'", "", $conn);
                        echo '<td style="border:none;" align="left">';
                        if ($firma[0]["firma"] != "") {
                            $pagina_actual = $_SERVER["PHP_SELF"];
                            echo '<img class="d-none d-lg-block" src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/' . FORMATOS_SAIA . 'librerias/mostrar_foto.php?codigo=' . $fila["funcionario_codigo"];
                            echo '" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '"/><br />';
                        } else
                            echo '<img class="d-none d-lg-block" src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/assets/images/firmas/blanco.jpg" width="100" height="' . $alto_firma[0]["valor"] . '" ><br />';

                        echo "<p class='my-0'><strong>" . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "</strong><br /></p>";
                        if ($cargos["numcampos"]) {
                            for ($h = 0; $h < $cargos["numcampos"]; $h++) {
                                echo "<p><b>" . formato_cargo($cargos[$h]["nombre"]) . "</b></p><br/>";
                            }
                        } else {
                            echo "</p>";
                        }
                        if ($iniciales == ($fila["funcionario_codigo"]))
                            $firma_actual = true;
                        echo "</td>";
                    } else {
                        echo "<td style='border:none;' align='left'><img src='" . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/assets/images/firmas/blanco.jpg' width='" . $ancho_firma[0]["valor"] . "' height='" . $alto_firma[0]["valor"] . "'>
							<br /><p class='my-0'><b>" . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "</b></p><br />";
                        if ($cargos["numcampos"]) {
                            for ($h = 0; $h < $cargos["numcampos"]; $h++)
                                echo "<p><b>" . formato_cargo($cargos[$h]["nombre"]) . "</b></p></br>";
                        } else {
                            echo "</p>";
                        }
                        if ($iniciales == ($fila["funcionario_codigo"]))
                            $firma_actual = true;
                        echo "</td>";
                    }
                    $firmas++;
                } elseif ($fila["obligatorio"] == 2) { // Revisado
                    if ($fila["nombre"] == "POR_APROBAR")
                        $revisados .= "<tr><td style='width:100%;border:none;'><br/><span class='phpmaker'>Revis&oacute; : " . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "-" . formato_cargo($cargos[0]["nombre"]) . " (Pendiente)</span></td></tr>";
                    elseif ($fila["nombre"] == "APROBADO" || $fila["nombre"] == "REVISADO")
                        $revisados .= "<tr><td style='width:100%;border:none;'><br/><span class='phpmaker'>Revis&oacute; : " . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "-" . formato_cargo($cargos[0]["nombre"]) . "</span> </td></tr>";
                } elseif ($fila["obligatorio"] == 5) { // Firma externa
                    if ($firmas == 0) {
                        echo "<tr>";
                        $fila_abierta = 1;
                    }
                    if ($fila["nombre"] == "POR_APROBAR" && $fila["firma_externa"] == '') {
                        $firmar = "";
                        if ($_SESSION['usuario_actual'] == $fila["funcionario_codigo"]) {
                            $firmar = firma_externa_funcion($idformato, $iddoc, "ruta", "firma_externa", "idruta", $fila["idruta"], "&confirmar=1", 1);
                            $ocultar_confirmar++;
                        }
                        echo "<td style='border:none;'><br/><br/>" . $firmar . "<br/><br/><br/>_______________________________<br/><br/><br/></td>";
                    } else if ($fila["firma_externa"] != '') {
                        $_REQUEST["campo_seleccion"] = "firma_externa";
                        $_REQUEST["campo_tabla"] = "idruta";
                        $_REQUEST["llave_seleccion"] = firma_externa_funcion($idformato, $iddoc, "ruta", "firma_externa", "idruta", $fila["idruta"], "", 1);
                        $_REQUEST["tabla"] = "ruta";
                        $_REQUEST["firma"] = "1";
                        require_once($ruta_db_superior . FORMATOS_SAIA . "librerias/mostrar_foto_manual.php");
                        $parte = '<td style="border:none;"><img class="d-none d-lg-block" src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/carpeta_temporal_firma/imagen_temporal' . $_REQUEST["llave_seleccion"] . '.jpg" width="200" height="100">';

                        $parte .= "<br /><strong>" . mayusculas($fila["nombres"] . " " . $fila["apellidos"]) . "</strong><br />";
                        if ($cargos["numcampos"]) {
                            for ($h = 0; $h < $cargos["numcampos"]; $h++)
                                $parte .= formato_cargo($cargos[$h]["nombre"]) . "<br/>";
                        }
                        echo $parte . "</td>";
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
                    echo "<td style='border:none;'></td>";
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

    return $firma_actual;
}

function cargo_rol($iddoc)
{
    global $conn;
    $resultado = array();
    $origenes = array();
    $tipo = busca_filtro_tabla("distinct activo,nombre,obligatorio,ruta.origen,ruta.tipo_origen,orden,ruta.idruta,ruta.firma_externa", "buzon_entrada,ruta", 
    "ruta_idruta=idruta and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and (obligatorio in(1,2,5)) and ruta.tipo='ACTIVO'  and archivo_idarchivo=" . $iddoc, "ruta.idruta asc,buzon_entrada.nombre asc", $conn);
    
    $query =Model::getQueryBuilder();

    $tipo = $query
    ->select("a.activo,a.nombre,b.obligatorio,b.origen,b.tipo_origen,b.orden,b.idruta,a.fecha,b.firma_externa")
    ->from("buzon_entrada",'a')
    ->join('a','ruta','b','a.ruta_idruta=b.idruta')
    ->where(
        $query->expr()->andX(
        $query->expr()->orX(
            $query->expr()->in("a.nombre",":estado"),
            $query->expr()->andX(
                "a.nombre='POR_APROBAR'",
                "a.activo = 1",
            )
        ),      
        $query->expr()->in("b.obligatorio",[1, 2, 5]),
        "b.tipo = 'ACTIVO'",
        "a.archivo_idarchivo = :iddoc",
        )
    )->setParameter(":estado",['APROBADO','REVISADO'],\Doctrine\DBAL\Connection::PARAM_STR_ARRAY)
    ->setParameter(":iddoc", $iddoc)
    ->execute()->fetchAll();
    
    for ($i = 0; $i < $tipo["numcampos"]; $i++) {
        if (in_array($tipo[$i]["origen"], $origenes)) {
            unset($tipo[$i]);
            continue;
        }
        $origenes[] = $tipo[$i]["origen"];
        switch ($tipo[$i]["tipo_origen"]) {
            case 1:
                $fun = busca_filtro_tabla("nombres,apellidos,idfuncionario,funcionario_codigo", "funcionario", "funcionario_codigo=" . $tipo[$i]["origen"], "", $conn);
                break;
            case 5:
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
function radicar_plantilla()
{
    global $conn, $ruta_db_superior;

    $valores = array();
    $plantilla = "";
    $idformato = 0;

    if (empty($_POST["ejecutor"])) {
        $_POST["ejecutor"] = SessionController::getValue('usuario_actual');
    }

    if (!empty($_POST["formato"])) {
        $plantilla = strtoupper($_POST["formato"]);
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
                            return json_encode($retorno);
                        }
                    }
                }
            }
        }
    }

    $Documento = new Documento();
    foreach ($_POST as $key => $valor) {
        if (
            in_array($key, $Documento->getSafeAttributes()) &&
            !in_array($key, ["estado", "descripcion", "fecha"])
        ) {
            $valores[$key] = $valor;
        }
    }
    $valores["descripcion"] = str_replace("'", "", $_POST["descripcion"]);
    if (isset($_POST["serie_idserie"]) && $_POST["serie_idserie"]) {
        $valores["serie"] = $_POST["serie_idserie"];
    } else {
        $valores["serie"] = 0;
    }
    $valores["plantilla"] = $plantilla;
    if (!empty($_REQUEST["dependencia"])) {
        $valores["responsable"] = $_REQUEST["dependencia"];
    }

    if (!empty($_POST["tipo_radicado"])) {
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
            return json_encode($retorno);
        }
    }
    $valores["numero"] = 0;
    if (isset($_POST["municipio"])) {
        $valores["municipio_idmunicipio"] = $_POST["municipio"];
    } else if (isset($_POST["municipio_idmunicipio"])) {
        $valores["municipio_idmunicipio"] = $_POST["municipio_idmunicipio"];
    } else {
        $mun = busca_filtro_tabla("valor", "configuracion", "nombre='ciudad'", "", $conn);
        if ($mun["numcampos"] && !empty($mun[0][0])) {
            $valores["municipio_idmunicipio"] = $mun[0][0];
        } else {
            $valores["municipio_idmunicipio"] = 633;
        }
    }

    llama_funcion_accion(null, $idformato, "radicar", "ANTERIOR");
    $_POST["iddoc"] = radicar_documento_prueba(trim($_POST["tipo_radicado"]), $valores, null);
    if (empty($plantilla)) {
        include_once("anexosdigitales/funciones_archivo.php");
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
        $idplantilla = guardar_documento($_POST["iddoc"]);
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
        include_once($ruta_db_superior . FORMATOS_SAIA . "librerias/funciones_generales.php");

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
                redirecciona(FORMATOS_SAIA . "librerias/rutaadd.php?x_plantilla='$plantilla'&doc=" . $_POST["iddoc"] . "&obligatorio=" . $_POST["obligatorio"] . "&origen=" . $usuario_origen[0][0]);
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
}

/**
 * redirect document to a new window
 * default: views/documento/index_acordeon.php
 * @param string $url
 * @return void
 */
function enrutar_documento($url = "", $documentId)
{
    global $ruta_db_superior;

    // webservice utilitie
    if (isset($_REQUEST["no_redirecciona"])) {
        return $_REQUEST['iddoc'] ? $_REQUEST['iddoc'] : $documentId;
    }

    if (!$url && $documentId) {
        $params = http_build_query([
            'documentId' => $documentId
        ]);
        $url = $ruta_db_superior . "views/documento/index_acordeon.php?" . $params;
    }

    redirecciona($url);
}

function crear_pretexto($asunto, $contenido)
{
    global $conn;
    $campos = "asunto";
    $valores = "'" . $asunto . "'";
    $sql = "INSERT INTO pretexto(" . $campos . ") VALUES (" . $valores . ")";
    phpmkr_query($sql);
    $idpretexto = phpmkr_insert_id();
    guardar_lob("contenido", "pretexto", "idpretexto=$idpretexto", $contenido, "texto", $conn);
    // Guardo la relacion de la plantilla con el suaurio
    $idfuncionario = $_SESSION["idfuncionario"];
    $campos = "pretexto_idpretexto,entidad_identidad,llave_entidad";
    $valores = "'" . $idpretexto . "','1'," . "'" . $idfuncionario . "'";
    $sql = "INSERT INTO entidad_pretexto(" . $campos . ") VALUES (" . $valores . ") ";
    phpmkr_query($sql);
}

function ejecutoradd($sKey)
{
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
            return $sKey;
        else { // comprobar si existe la nacionalidad -----
            $pais = busca_filtro_tabla("idpais", "pais", "idpais='" . $x_nacionalidad . "'", "", $conn);

            if (!$pais["numcampos"]) {
                phpmkr_query("insert into pais(nombre) values('" . (($x_nacionalidad)) . "')", $conn);
                $x_nacionalidad = phpmkr_insert_id();
            }
            // --------------------------------------------
            phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,celular,direccion,titulo,email,pais_idpais) VALUES(" . $campo[0]["idejecutor"] . ",'" . (($x_telefono)) . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . (($x_celular)) . "','" . (($x_direccion)) . "','" . (($x_titulo)) . "','" . (($x_email)) . "','$x_nacionalidad')", $conn) or error("NO SE INSERTO REMITENTE");
            return phpmkr_insert_id();
        }
    } else { // comprobar si existe la nacionalidad -----
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
            return phpmkr_insert_id();
        }
    }

    return true;
}

function guardar_documento($iddoc, $tipo = 0)
{
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

        for ($j = 0; $j < $lcampos["numcampos"]; $j++) { // si el valor es un array
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
                        case "BLOB":
                            if ($tipo == 1) {
                                $apuntador = fopen($_FILES[$lcampos[$j]["nombre"]]["tmp_name"], "rb");
                                $contenido = fread($apuntador, $_FILES[$lcampos[$j]["nombre"]]["size"]);
                                fclose($apuntador);
                                guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "archivo", $conn);
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

    if (count($campos) && count($valores) && $tipo == 0) {
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
            $sql1 = "insert into permiso_documento(funcionario,documento_iddocumento,permisos) values('" . $_SESSION["usuario_actual"] . "','" . $iddoc . "','e,m,r')";
            phpmkr_query($sql1, $conn);

            if (count($larchivos)) {
                include_once("anexosdigitales/funciones_archivo.php");
                cargar_archivo_formato($larchivos, $idformato, $iddoc, $form_uuid);
            }

            llama_funcion_accion($iddoc, $idformato, "adicionar", "POSTERIOR");
            generar_ruta_documento($idformato, $iddoc);

            for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
                if (isset($_REQUEST[$lcampos[$j]["nombre"]])) {
                    switch (strtoupper($lcampos[$j]["tipo_dato"])) {
                        case "TEXT":
                            if ($lcampos[$j]["longitud"] >= 4000) {
                                $contenido = $_REQUEST[$lcampos[$j]["nombre"]];
                                guardar_lob($lcampos[$j]["nombre"], $tabla, "documento_iddocumento=" . $iddoc, $contenido, "texto", $conn);
                            }
                            break;
                        case "BLOB":
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
            $ag = busca_filtro_tabla("idautoguardado", "autoguardado", "usuario='" . $_SESSION["usuario_actual"] . "' and formato='" . $nomformato[0]["nombre"] . "'", "", $conn);
            if ($ag["numcampos"]) {
                $sql = "delete from autoguardado where idautoguardado=" . $ag[0]["idautoguardado"];
                phpmkr_query($sql);
            }
        } else {
            if (isset($iddoc)) {
                $del = "DELETE FROM documento WHERE iddocumento=" . $iddoc;
                phpmkr_query($del);
            }
            alerta("<b>ATENCI&Oacute;N</b><br>No se ha podido Crear el formato..", 'error', 5000);
            redirecciona($ruta_db_superior . "vacio.php");
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

function actualizar_datos_documento($idformato, $iddoc)
{
    include_once FORMATOS_SAIA . "librerias/funciones_generales.php";

    if (isset($_REQUEST["campo_descripcion"])) {
        $campo = busca_filtro_tabla("nombre,etiqueta", "campos_formato", "idcampos_formato IN(" . $_REQUEST["campo_descripcion"] . ")", "orden", $conn);
    } else if ($idformato) {
        $campo = busca_filtro_tabla("idcampos_formato,nombre,etiqueta,formato_idformato", "campos_formato cf", "cf.formato_idformato='" . $idformato . "' AND (acciones like 'p' or acciones like '%,p' or acciones like 'p,%' or acciones like '%,p,%')", "orden", $conn);
    }
    if ($campo["numcampos"]) {
        $descripcion = '';
        for ($i = 0; $i < $campo["numcampos"]; $i++) {
            $descripcion .= $campo[$i]["etiqueta"] . ": " . mostrar_valor_campo($campo[$i]["nombre"], $idformato, $iddoc, 1) . '<br>';
        }
    }
    $idserie = 0;
    if ($idformato) {
        $info_formato = busca_filtro_tabla("nombre_tabla,serie_idserie", "formato", "idformato=" . $idformato, "", $conn);
        if ($info_formato["numcampos"]) {
            if ($info_formato[0]["serie_idserie"]) {
                $idserie = $info_formato[0]["serie_idserie"];
            }
            $doc_serie = busca_filtro_tabla("serie_idserie", $info_formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);
            if ($doc_serie["numcampos"] && $doc_serie[0]["serie_idserie"]) {
                $idserie = $doc_serie[0]["serie_idserie"];
            }
        }
    }

    $descripcion = str_replace("'", "", $descripcion);
    $sql = "UPDATE documento SET descripcion='" . $descripcion . "',serie=" . $idserie . " WHERE iddocumento=" . $iddoc;
    phpmkr_query($sql);
    return;
}

if (!empty($_REQUEST["funcion"])) {
    $funcion = str_replace(["'", "\\"], "", strtolower($_REQUEST["funcion"]));
    if (!empty($_REQUEST["parametros"])) {
        $params = preg_split("/;/", $_REQUEST["parametros"]);
        call_user_func_array($funcion, $params);
    } else {
        $funcion();
    }
}
