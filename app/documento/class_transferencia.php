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
include_once $ruta_db_superior . "formatos/librerias/funciones_acciones.php";
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

    $datos_asignacion = busca_filtro_tabla("idasignacion", "asignacion", "documento_iddocumento=$iddocumento AND entidad_identidad=1 AND llave_entidad=$funcionario and tarea_idtarea=2", "");
    if ($datos_asignacion["numcampos"]) {
        for ($i = 0; $i < $datos_asignacion["numcampos"]; $i++) {
            //echo "delete from asignacion where idasignacion=".$datos_asignacion[$i]["idasignacion"];
            phpmkr_query("delete from asignacion where idasignacion=" . $datos_asignacion[$i]["idasignacion"]);
        }
    } else {
        //alerta("Problemas al Eliminar la tarea Error # 003");     
        return false;
    }
    return true;
}

function asignar_tarea_buzon($iddocumento, $idserie = null, $idtarea = null, $list_entidad = null, $identidad = null, $fecha_inicial = null, $fecha_final = null, $estado = "PENDIENTE")
{
    if (!$fecha_inicial)
        $fecha_inicial = date('Y-m-d H:i:s');

    if (($idserie || $iddocumento) && isset($idtarea)) {
        Model::getQueryBuilder()
            ->insert("asignacion")
            ->values([
                "documento_iddocumento" => "?",
                "tarea_idtarea" => "?",
                "fecha_inicial" => "?",
                "estado" => "?",
                "entidad_identidad" => "1",
                "llave_entidad" => "?"

            ])
            ->setParameter(1, $iddocumento, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(2, $idtarea, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(3, DateTime::createFromFormat("Y-m-d H:i:s", date($fecha_inicial)), \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter(4, $estado)
            ->setParameter(5, $idtarea, \Doctrine\DBAL\Types\Type::INTEGER)->execute();
    } else {
        alerta("Diligencie correctamente los datos e intente nuevamente");
        return false;
    }
    return true;
}

function buscar_funcionarios($dependencia, $arreglo = null)
{

    $dependencias = dependencias($dependencia);
    array_push($dependencias, $dependencia);
    $dependencias = array_unique($dependencias);
    $funcionarios = busca_filtro_tabla("A.funcionario_codigo", "funcionario A,dependencia_cargo B, cargo C,dependencia D", "B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia=D.iddependencia and B.dependencia_iddependencia IN(" . implode(",", $dependencias) . ") AND A.estado=1 AND B.estado=1 AND C.estado=1 AND D.estado=1 AND A.sistema=1 AND C.tipo_cargo=1", "");
    $arreglo = extrae_campo($funcionarios, "funcionario_codigo", "U");
    return $arreglo;
}

function dependencias($padre)
{

    $listado1 = array();
    $listado2 = array();
    $listado3 = array();
    $ldependencias = busca_filtro_tabla("iddependencia", "dependencia A", "A.cod_padre IN(" . $padre . ")", "");
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

function busca_cargofuncionario($tipo, $dato, $dependencia)
{

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
        $temp = busca_filtro_tabla("", "funcionario A", $filtro, "");
        if ($temp == "")
            error_("Datos del Funcionario Origen de Dependencia no Existe");
        else {
            $dorig = $temp[0]['idfuncionario'];
            $datorig = busca_filtro_tabla("f.*,c.*,f.estado as estado_f,d.estado as estado_d", "dependencia_cargo d, cargo c, funcionario f", "d.funcionario_idfuncionario=f.idfuncionario AND c.idcargo=d.cargo_idcargo AND f.idfuncionario='" . $dorig . "'", "f.estado ASC");
        }
    } else if ($tipo == "cargo" || $tipo == 4) {
        $datorig = busca_filtro_tabla("A.iddependencia_cargo", "dependencia_cargo A", "A.cargo_idcargo=$dato AND A.dependencia_iddependencia=$dependencia", "");
        if ($datorig["numcampos"] > 0)
            $datorig = busca_cargofuncionario(5, $datorig[0]["iddependencia_cargo"], "");
        else {
            $cargo = busca_filtro_tabla("nombre", "cargo", "idcargo=" . $dato, "");
            error_(codifica_encabezado("No existe nadie en esta dependencia con el cargo " . $cargo[0]["nombre"]));
        }
    } else if ($tipo == 'iddependencia_cargo' || $tipo == 5) {
        $datorig = busca_filtro_tabla("f.*,c.*,f.estado as estado_f,d.estado as estado_d", "dependencia_cargo d,funcionario f,cargo c", "c.idcargo=d.cargo_idcargo AND f.idfuncionario=d.funcionario_idfuncionario AND d.iddependencia_cargo=" . $dato, "");
    } else
        $datorig[0]['iddependencia_cargo'] = $dato;
    if ($temp != "" && $temp["numcampos"] > 0)
        $datorig[0] = array_merge((array) $datorig[0], (array) $temp[0]);
    return $datorig;
}

function transferir_archivo($datos, $destino, $adicionales, $anexos = null)
{
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

    $Documento = new Documento($idarchivo);
    $Formato = $Documento->getFormat();
    $idformato = $Formato->getPK();

    llama_funcion_accion($idarchivo, $idformato, "transferir", "ANTERIOR");

    if ($destino && $origen) {
        if ($datos["tipo_destino"] == "1" || $datos["tipo_destino"] == "5") {
            $tipo_destino = 1;

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
                if (!$user) {
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

                    if ($adicionales) {
                        $buzonSalida = array_merge($buzonSalida, $adicionales);
                    }

                    $cadena = BuzonSalida::newRecord($buzonSalida);

                    $idbuzon_s = $cadena;
                    $idtransferencia[] = $idbuzon_s;

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
                    'ver_notas' => $ver_notas,
                    'activo' => $datos['activo'],
                    'origen' => $user
                ];

                if ($adicionales) {
                    $buzonEntrada = array_merge($buzonEntrada, $adicionales);
                }

                BuzonEntrada::newRecord($buzonEntrada);

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
                'origen' => $destino[0],
                'tipo_origen' => 1,
                'tipo_destino' => 1,
                'activo' => $datos['activo'],
                'ver_notas' => $ver_notas
            ];

            if ($adicionales) {
                $buzonEntrada = array_merge($buzonEntrada, $adicionales);
            }

            BuzonEntrada::newRecord($buzonEntrada);
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
    $aprobar_posterior = 0;
    if (isset($_REQUEST["iddoc"]) && $_REQUEST["iddoc"]) {
        $iddoc = $_REQUEST["iddoc"];
    }

    $tipo_radicado = busca_filtro_tabla("documento.*,contador.nombre,plantilla,idformato", "documento,contador,formato C", "idcontador=tipo_radicado and iddocumento=$iddoc AND lower(plantilla)=lower(C.nombre)", "");
    $datos_formato = busca_filtro_tabla("banderas,mostrar_pdf,nombre,nombre_tabla,cod_padre,idformato", "formato", "idformato='" . $tipo_radicado[0]["idformato"] . "'", "");
    $formato = strtolower($tipo_radicado[0]["plantilla"]);

    llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "confirmar", "ANTERIOR");

    $registro_actual = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and A.destino=" . $_SESSION["usuario_actual"], "A.idtransferencia");

    if ($registro_actual["numcampos"] > 0) {
        $registro_anterior = busca_filtro_tabla("A.*", "buzon_entrada A", "A.nombre='POR_APROBAR' and A.activo=1 and A.idtransferencia<" . $registro_actual[0]["idtransferencia"] . " and A.archivo_idarchivo=" . $iddoc . " and origen=" . $_SESSION["usuario_actual"], "A.idtransferencia desc");
        $terminado = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.nombre='POR_APROBAR' and A.activo=1", "A.idtransferencia");
        if ($registro_actual["numcampos"] > 0 && $registro_anterior["numcampos"] == 0) {
            if (($terminado["numcampos"] == $registro_actual["numcampos"]) || ($terminado["numcampos"] == 1 && $terminado[0]["destino"] == $_SESSION["usuario_actual"])) {
                $aprobar_posterior = 1;
                $estado = "APROBADO";
                llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "aprobar", "ANTERIOR");
            } else {
                $estado = "REVISADO";
            }

            for ($i = 0; $i < $registro_actual["numcampos"]; $i++) {
                $registro_intermedio = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<" . $registro_actual[$i]["idtransferencia"], "A.idtransferencia");
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
                $registro_intermedio = busca_filtro_tabla("A.*", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc . " and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<" . $registro_actual[$i]["idtransferencia"], "A.idtransferencia");
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
                $Serie = new Serie($tipo_radicado[0]["serie"]);

                contador($tipo_radicado[0]["nombre"], $iddoc);
                $Documento = new Documento($iddoc);
                $Documento->setAttributes([
                    "estado" => 'APROBADO',
                    "fecha" => date('Y-m-d H:i:s'),
                    "dias" =>  $Serie->dias_respuesta
                ]);
                $Documento->save();

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

                $respuestas = busca_filtro_tabla("origen,estado", "respuesta,documento", "iddocumento=origen and destino='" . $iddoc . "' and estado in('TRAMITE','ACTIVO','APROBADO')", "");

                if ($respuestas["numcampos"] > 0) {
                    $origen_respuesta = busca_filtro_tabla("origen", "buzon_salida", "archivo_idarchivo=$iddoc and nombre='BORRADOR'", "");
                    $datos["origen"] = $origen_respuesta[0]["origen"];
                    $datos["nombre"] = "RESPONDIDO";
                    $datos["tipo"] = "";
                    $datos["tipo_origen"] = "1";
                    $datos["tipo_destino"] = "1";
                    for ($i = 0; $i < $respuestas["numcampos"]; $i++) {
                        if ($respuestas[$i]["estado"] == "TRAMITE" || $respuestas[$i]["estado"] == "ACTIVO") {
                            $DocumentoRespuestas = new Documento($respuestas[$i]["origen"]);
                            $DocumentoRespuestas->estado = 'APROBADO';
                            $DocumentoRespuestas->save();
                        }
                        $datos["archivo_idarchivo"] = $respuestas[$i]["origen"];
                        $destino_respuesta[0] = $origen_respuesta[0]["origen"];
                        $destino_respuesta[0] = $_SESSION["usuario_actual"];
                        transferir_archivo($datos, $destino_respuesta, "", "");
                    }
                }

                if ($datos_formato[0]["mostrar_pdf"] == 1) {
                    $Documento->pdf = null;
                    $Documento->save();
                }
            }
        }
    }

    if ($datos_formato[0]["mostrar_pdf"] == 1) {
        $Documento->pdf = null;
        $Documento->save();
    }

    llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "confirmar", "POSTERIOR");
    if ($aprobar_posterior == 1) {
        llama_funcion_accion($iddoc, $tipo_radicado[0]["idformato"], "aprobar", "POSTERIOR");
    }

    $Documento = new Documento($iddoc);
    $Documento->refreshDescription();

    if ($opcion == 0) {
        if ($_REQUEST["anterior"] == $iddoc) {
            return $iddoc;
        } else {
            $formato_ant = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $datos_formato[0]["cod_padre"], "");
            if ($formato_ant["numcampos"]) {
                $iddoc_anterior = busca_filtro_tabla("a.documento_iddocumento", $formato_ant[0]["nombre_tabla"] . " a," . $datos_formato[0]["nombre_tabla"] . " b", "a.id" . $formato_ant[0]["nombre_tabla"] . "=b." . $formato_ant[0]["nombre_tabla"] . " and b.documento_iddocumento=" . $iddoc, "");
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
    $revisados = "";
    $campos_formato = ""; // La variable no estaba definida, la he definido provisionalmente como string vacio.

    if (!isset($_REQUEST["ocultar_firmas"]) || $_REQUEST["ocultar_firmas"] == 0) {
        $firma_actual = false;
        $estado_doc = busca_filtro_tabla("A.estado,A.serie,A.ejecutor,A.documento_antiguo", "documento A", "A.iddocumento=" . $iddoc, "");
        $iniciales = $estado_doc[0]["ejecutor"];
        $ultimo_ruta = busca_filtro_tabla("max(A.idtransferencia) as idbuzon", "buzon_entrada A", "A.archivo_idarchivo=" . $iddoc, "");

        $tabla = busca_filtro_tabla("nombre_tabla", "formato A", "A.idformato=" . $idformato, "");
        $mostrar_firmas_doc = busca_filtro_tabla("A.firma,dependencia" . $campos_formato, "" . $tabla[0]["nombre_tabla"] . " A,documento B", "A.documento_iddocumento=B.iddocumento and B.iddocumento=" . $iddoc, "");
        if ($mostrar_firmas_doc["numcampos"] > 0) {
            $mostrar_firmas = $mostrar_firmas_doc[0]["firma"];
        }


        if (!array_key_exists("tipo", $_REQUEST)) {
            $_REQUEST["tipo"] = 1;
        }
        $resultado = cargo_rol($_REQUEST["iddoc"]);
        if (!$resultado["numcampos"]) {
            if (!$estado_doc[0]["documento_antiguo"]) {
                $resultado = busca_filtro_tabla("distinct iddependencia_cargo as origen,idfuncionario,funcionario_codigo,nombres,apellidos,1 as activo,1 as obligatorio,nombre", "funcionario,dependencia_cargo,buzon_entrada", "archivo_idarchivo=" . $_REQUEST["iddoc"] . " and destino=funcionario_codigo and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and idfuncionario=funcionario_idfuncionario and iddependencia_cargo=" . $mostrar_firmas_doc[0]["dependencia"], "");
                $resultado[0]["tipo_origen"] = 5;
            } else {
                $resultado = busca_filtro_tabla("distinct iddependencia_cargo as origen,idfuncionario,funcionario_codigo,nombres,apellidos,1 as activo,1 as obligatorio,nombre", "funcionario,dependencia_cargo,buzon_entrada", "archivo_idarchivo=" . $_REQUEST["iddoc"] . " and destino=funcionario_codigo and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and idfuncionario=funcionario_idfuncionario and dependencia_iddependencia=" . $mostrar_firmas_doc[0]["dependencia"], "");
                if (!$resultado["numcampos"])
                    $resultado = busca_filtro_tabla("distinct iddependencia_cargo as origen,idfuncionario,funcionario_codigo,nombres,apellidos,1 as activo,1 as obligatorio,nombre", "funcionario,dependencia_cargo,buzon_entrada", "archivo_idarchivo=" . $_REQUEST["iddoc"] . " and destino=funcionario_codigo and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and idfuncionario=funcionario_idfuncionario", "");
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
            $ancho_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='ancho_firma'", "");
            if (!$ancho_firma["numcampos"]) {
                $ancho_firma[0]["valor"] = "20%";
            }

            $alto_firma = busca_filtro_tabla("valor", "configuracion A", "A.nombre='alto_firma'", "");
            if (!$alto_firma["numcampos"]) {
                $alto_firma[0]["valor"] = "20%";
            }

            if ($_REQUEST['tipo'] == 1) {

                $ancho_firma[0]["valor"] = "35%";
                $alto_firma[0]["valor"] = "50%";
            }

            $tamano_fuente = busca_filtro_tabla("valor", "configuracion A", "A.nombre='tamano_letra'", "");
            if (!$tamano_fuente["numcampos"]) {
                $tamano_fuente[0]["valor"] = '10pt';
            }

            echo "<table class='table table-condensed' border=\"0\" cellpadding='0' cellspacing='0' align='left' width=\"100%\">";

            for ($k = $resultado["numcampos"] - 1; $k >= 0; $k--) {
                if (!$resultado[$k])
                    continue;
                $fila = $resultado[$k];
                if ($fila["tipo_origen"] == 5) { // rol
                    $cargos = busca_filtro_tabla("distinct cargo.nombre", "cargo,dependencia_cargo", "cargo_idcargo=idcargo AND tipo_cargo=1 and iddependencia_cargo=" . $fila["origen"], "");
                } elseif ($fila["tipo_origen"] == 1) { // funcionario_codigo
                    $cargos = busca_filtro_tabla("distinct funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND tipo_cargo=1 AND idfuncionario=funcionario_idfuncionario and fecha_inicial<='" . $fila["fecha"] . "' and fecha_final>='" . $fila["fecha"] . "' and funcionario_codigo='" . $fila["origen"] . "' AND dependencia_cargo.estado=1", "");
                    if (!$cargos["numcampos"])
                        $cargos = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,cargo.nombre", "cargo,dependencia_cargo,funcionario,dependencia", "dependencia.iddependencia=dependencia_cargo.dependencia_iddependencia and cargo_idcargo=idcargo AND tipo_cargo=1 AND idfuncionario=funcionario_idfuncionario and funcionario_codigo='" . $fila["origen"] . "'", "fecha desc");
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
                        $firma = busca_filtro_tabla("firma", "funcionario", "funcionario_codigo='" . $fila["funcionario_codigo"] . "'", "");
                        echo '<td style="border:none;" align="left">';
                        if ($firma[0]["firma"] != "") {
                            $pagina_actual = $_SERVER["PHP_SELF"];
                            echo '<img class="d-none d-lg-block" src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/' . 'formatos/' . 'librerias/mostrar_foto.php?codigo=' . $fila["funcionario_codigo"];
                            echo '" width="' . $ancho_firma[0]["valor"] . '" height="' . $alto_firma[0]["valor"] . '"/><br />';
                        } else
                            echo '<img class="d-none d-lg-block" src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/assets/images/firmas/blanco.jpg" width="100" height="' . $alto_firma[0]["valor"] . '" ><br />';

                        echo "<p class='my-0'><strong>" . strtoupper($fila["nombres"] . " " . $fila["apellidos"]) . "</strong><br /></p>";
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
							<br /><p class='my-0'><b>" . strtoupper($fila["nombres"] . " " . $fila["apellidos"]) . "</b></p><br />";
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
                        $revisados .= "<tr><td style='width:100%;border:none;'><br/><span class='phpmaker'>Revis&oacute; : " . strtoupper($fila["nombres"] . " " . $fila["apellidos"]) . "-" . formato_cargo($cargos[0]["nombre"]) . " (Pendiente)</span></td></tr>";
                    elseif ($fila["nombre"] == "APROBADO" || $fila["nombre"] == "REVISADO")
                        $revisados .= "<tr><td style='width:100%;border:none;'><br/><span class='phpmaker'>Revis&oacute; : " . strtoupper($fila["nombres"] . " " . $fila["apellidos"]) . "-" . formato_cargo($cargos[0]["nombre"]) . "</span> </td></tr>";
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
                        require_once($ruta_db_superior . 'formatos/' . "librerias/mostrar_foto_manual.php");
                        $parte = '<td style="border:none;"><img class="d-none d-lg-block" src="' . PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . '/carpeta_temporal_firma/imagen_temporal' . $_REQUEST["llave_seleccion"] . '.jpg" width="200" height="100">';

                        $parte .= "<br /><strong>" . strtoupper($fila["nombres"] . " " . $fila["apellidos"]) . "</strong><br />";
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

    $resultado = array();
    $origenes = array();
    $tipo = busca_filtro_tabla(
        "distinct activo,nombre,obligatorio,ruta.origen,ruta.tipo_origen,orden,ruta.idruta,ruta.firma_externa",
        "buzon_entrada,ruta",
        "ruta_idruta=idruta and (nombre in ('APROBADO','REVISADO') or(nombre='POR_APROBAR' AND activo=1)) and (obligatorio in(1,2,5)) and ruta.tipo='ACTIVO'  and archivo_idarchivo=" . $iddoc,
        "ruta.idruta asc,buzon_entrada.nombre asc"
    );

    $query = Model::getQueryBuilder();

    $tipo = $query
        ->select("a.activo,a.nombre,b.obligatorio,b.origen,b.tipo_origen,b.orden,b.idruta,a.fecha,b.firma_externa")
        ->from("buzon_entrada", 'a')
        ->join('a', 'ruta', 'b', 'a.ruta_idruta=b.idruta')
        ->where(
            $query->expr()->andX(
                $query->expr()->orX(
                    $query->expr()->in("a.nombre", ":estado"),
                    $query->expr()->andX(
                        "a.nombre='POR_APROBAR'",
                        "a.activo = 1"
                    )
                ),
                $query->expr()->in("b.obligatorio", [1, 2, 5])
            )
        )->andWhere("b.tipo = 'ACTIVO'")
        ->andWhere("a.archivo_idarchivo = :iddoc")
        ->setParameter(":estado", ['APROBADO', 'REVISADO'], \Doctrine\DBAL\Connection::PARAM_STR_ARRAY)
        ->setParameter(":iddoc", $iddoc)
        ->execute()->fetchAll();

    for ($i = 0, $total = count($tipo); $i < $total; $i++) {

        if (in_array($tipo[$i]["origen"], $origenes)) {
            unset($tipo[$i]);
            continue;
        }
        $origenes[] = $tipo[$i]["origen"];
        switch ($tipo[$i]["tipo_origen"]) {
            case 1:
                $fun = busca_filtro_tabla("nombres,apellidos,idfuncionario,funcionario_codigo", "funcionario", "funcionario_codigo=" . $tipo[$i]["origen"], "");
                break;
            case 5:
                $fun = busca_filtro_tabla("nombres,apellidos,idfuncionario,funcionario_codigo", "funcionario,dependencia_cargo", "idfuncionario=funcionario_idfuncionario and iddependencia_cargo=" . $tipo[$i]["origen"], "");
                break;
        }
        $tipo[$i]["nombres"] = $fun[0]["nombres"];
        $tipo[$i]["apellidos"] = $fun[0]["apellidos"];
        $tipo[$i]["idfuncionario"] = $fun[0]["idfuncionario"];
        $tipo[$i]["funcionario_codigo"] = $fun[0]["funcionario_codigo"];
    }
    return $tipo;
}

function ejecutoradd($sKey)
{

    $x_identificacion = $_REQUEST["x_nitejecutor2"];
    $x_nombre = $_REQUEST["cliente0"];
    $x_direccion = $_REQUEST["x_direccionejecutor"];
    $x_telefono = $_REQUEST["x_telefonoejecutor"];
    $x_email = $_REQUEST["x_emailejecutor"];
    $x_celular = $_REQUEST["x_celularejecutor"];
    $x_nacionalidad = $_REQUEST["x_nacionalidadejecutor"];

    $x_identificacion = ($x_identificacion != "") ? $x_identificacion : 'NULL';

    $condicion = ($x_identificacion != "") ? "identificacion='" . $x_identificacion . "'" : 'identificacion is NULL';

    $campo = busca_filtro_tabla("iddatos_ejecutor,idejecutor", "ejecutor,datos_ejecutor", "ejecutor_idejecutor=idejecutor and iddatos_ejecutor='$sKey' and nombre ='" . (($x_nombre)) . "' and $condicion", "iddatos_ejecutor desc");

    if ($campo["numcampos"] > 0) {
        $repetido = busca_filtro_tabla("iddatos_ejecutor", "ejecutor,datos_ejecutor", "idejecutor=ejecutor_idejecutor and iddatos_ejecutor=" . $campo[0]["iddatos_ejecutor"] . " and direccion='" . (($x_direccion)) . "' and telefono='" . (($x_telefono)) . "' and pais_idpais='$x_nacionalidad'   and email='" . (($x_email)) . "' and celular='" . (($x_celular)) . "'", "");

        if ($repetido["numcampos"] > 0)
            return $sKey;
        else { // comprobar si existe la nacionalidad -----
            $pais = busca_filtro_tabla("idpais", "pais", "idpais='" . $x_nacionalidad . "'", "");

            if (!$pais["numcampos"]) {
                phpmkr_query("insert into pais(nombre) values('" . (($x_nacionalidad)) . "')");
                $x_nacionalidad = phpmkr_insert_id();
            }
            // --------------------------------------------
            phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,celular,direccion,titulo,email,pais_idpais) VALUES(" . $campo[0]["idejecutor"] . ",'" . (($x_telefono)) . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . (($x_celular)) . "','" . (($x_direccion)) . "','','" . (($x_email)) . "','$x_nacionalidad')") or error("NO SE INSERTO REMITENTE");
            return phpmkr_insert_id();
        }
    } else { // comprobar si existe la nacionalidad -----
        $pais = busca_filtro_tabla("idpais", "pais", "idpais='" . $x_nacionalidad . "'", "");
        if (!$pais["numcampos"]) {
            phpmkr_query("insert into pais(nombre) values('" . (($x_nacionalidad)) . "')");
            $x_nacionalidad = phpmkr_insert_id();
        }
        // --------------------------------------------
        phpmkr_query("INSERT INTO ejecutor(nombre,identificacion,fecha_ingreso) VALUES('" . (($x_nombre)) . "','" . $x_identificacion . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ")") or error("NO SE INSERTO REMITENTE");
        $idejecutor = phpmkr_insert_id();

        if ($idejecutor) {
            phpmkr_query("INSERT INTO datos_ejecutor(ejecutor_idejecutor,telefono,fecha,celular,direccion,titulo,email,pais_idpais) VALUES(" . $idejecutor . ",'" . (($x_telefono)) . "'," . fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s') . ",'" . (($x_celular)) . "','" . (($x_direccion)) . "','','" . (($x_email)) . "','$x_nacionalidad')") or error("NO SE INSERTO REMITENTE");
            return phpmkr_insert_id();
        }
    }

    return true;
}
