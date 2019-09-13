<?php

class GuardarFtController
{

    /**
     * almacena el idformato
     *
     * @var integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-13
     */
    protected $formatId;

    /**
     * almacena la instancia de Formato
     *
     * @var Formato
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-13
     */
    protected $Formato;

    /**
     * almacena la instancia del documento creado
     *
     * @var Documento
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-13
     */
    protected $Documento;

    public function __construct($formatId)
    {
        $this->formatId = $formatId;
        $this->getFormat();
    }

    /**
     * almacena la instancia de formato 
     * en la propiedad
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-13
     */
    public function getFormat()
    {
        $this->Formato = new Formato($this->formatId);
    }

    /**
     * inicia el proceso de creacion del documento
     *
     * @param array $data
     * @return integer $documentId
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-13
     */
    public function create($data)
    {
        global $ruta_db_superior;

        if (empty($data["dependencia"])) {
            throw new Exception("Se debe indicar el rol", 1);
        }

        $plantilla = strtoupper($this->Formato->nombre);
        $Contador = Contador::findByAttributes([
            'nombre' => $data["tipo_radicado"]
        ]);

        if (!$Contador) {
            $Contador = $this->Formato->getCounter();

            if (!$Contador) {
                throw new Exception("Se debe definir un contador", 1);
            }
        }

        llama_funcion_accion(null, $this->formatId, "radicar", "ANTERIOR");

        $this->Documento = new Documento();
        $this->Documento->setAttributes([
            'ejecutor' => SessionController::getValue('usuario_actual'),
            'numero' => 0,
            'plantilla' => $plantilla,
            'responsable' => $data['dependencia'],
            'tipo_radicado' => $Contador->getPK(),
            'formato_idformato' => $this->formatId,
            'estado' => 'ACTIVO',
            'ventanilla_radicacion' => usuario_actual('ventanilla_radicacion') ?? 0
        ]);

        if (!$this->Documento->save()) {
            throw new Exception("Error al guardar el documento", 1);
        }

        registrar_accion_digitalizacion($this->Documento->getPK(), 'CREACION DOCUMENTO');

        $data["tipo_radicado"] = $Contador->nombre;
        $data["iddoc"] = $this->Documento->getPK();

        llama_funcion_accion($this->Documento->getPK(), $this->formatId, "radicar", "POSTERIOR");

        if (array_key_exists("anterior", $data)) {
            llama_funcion_accion($data["anterior"], $this->formatId, "responder", "ANTERIOR");
            $idbuzon = busca_filtro_tabla("max(A.idtransferencia) as idbuzon", "buzon_entrada A", "A.archivo_idarchivo=" . $data["anterior"], "");

            Respuesta::newRecord([
                'fecha' => date('Y-m-d H:i:s'),
                'destino' => $data["iddoc"],
                'origen' => $data["anterior"],
                'idbuzon' =>  $idbuzon[0]["idbuzon"],
                'plantilla' =>  $plantilla,
            ]);

            $datos["archivo_idarchivo"] = $data["anterior"];
            $datos["nombre"] = "TRAMITE";
            $datos["tipo_destino"] = 1;
            $datos["tipo"] = "";
            $destino_tramite[] = $_SESSION["usuario_actual"];
            transferir_archivo_prueba($datos, $destino_tramite, "", "");
            llama_funcion_accion($data["anterior"], $this->formatId, "responder", "POSTERIOR");
        }

        if ($data["iddoc"]) {
            $idplantilla = $this->saveFormat($data["iddoc"], 0, $data);
        }

        if (!$idplantilla) {
            throw new Exception("Error al guardar el formato", 1);
        }

        $datos["archivo_idarchivo"] = $data["iddoc"];
        $datos["nombre"] = "BORRADOR";
        $datos["tipo_destino"] = 1;
        $datos["tipo"] = "";

        transferir_archivo_prueba($datos, [SessionController::getValue('usuario_actual')], "", "");

        $datos["archivo_idarchivo"] = $data["iddoc"];
        $datos["nombre"] = "POR_APROBAR";
        $datos["tipo"] = "";

        include_once $ruta_db_superior . 'formatos/librerias/funciones_generales.php';

        if (isset($data["firmado"]) && $data["firmado"] == "una") {
            $exist_ruta = busca_filtro_tabla("documento_iddocumento", "ruta", "tipo='ACTIVO' and documento_iddocumento=" . $data["iddoc"], "", $conn);
            if (!$exist_ruta["numcampos"]) {
                $radicador = busca_filtro_tabla("f.funcionario_codigo", "configuracion c,funcionario f", "c.nombre='radicador_salida' and f.login=c.valor", "", $conn);
                if ($radicador["numcampos"]) {
                    $aux_destino[0] = $radicador[0]["funcionario_codigo"];
                    $datos["ruta_creador_documento"] = 1;

                    transferir_archivo_prueba($datos, $aux_destino, ["activo" => 1]);
                }
            }
        } else if (isset($data["firmado"]) && $data["firmado"] == "varias") {
            redirecciona("formatos/librerias/rutaadd.php?x_plantilla='$plantilla'&doc=" . $data["iddoc"] . "&obligatorio=" . $data["obligatorio"] . "&origen=" . $data['dependencia']);
            return;
        }

        $banderas = explode(",", $this->Formato->banderas);

        if (in_array("e", $banderas)) {
            aprobar($data["iddoc"], 1);
        }

        return $data["iddoc"];
    }

    private function saveFormat($iddoc, $tipo = 0, $data)
    {
        global $conn;
        $insertado = 0;
        $data["fecha"] = date("Y-m-d H:i:s");
        $tabla = strtolower($data["tabla"]);
        $valores = [];
        $campos = [];
        $fieldFiles = [];
        $idformato = $this->formatId;

        $fields = $this->Formato->getFields();
        foreach ($fields as $CamposFormato) {
            $flags = explode(',', $CamposFormato->banderas);

            if (in_array('pk', $flags)) {
                continue;
            }

            if (is_array($data[$CamposFormato->nombre]) && $CamposFormato->etiqueta_html != "archivo") {
                array_push($valores, "'" . implode(',', @$data[$CamposFormato->nombre]) . "'");
                array_push($campos, $CamposFormato->nombre);
            } else if ($CamposFormato->valor == "{*form_ejecutor*}") {
                array_push($campos, $CamposFormato->nombre);
                $valor = ejecutoradd($data[$CamposFormato->nombre]);
                array_push($valores, $valor);
            } else {
                switch ($CamposFormato->etiqueta_html) {
                    case "detalle":
                        if (@$data["anterior"]) {
                            $formato_detalle = busca_filtro_tabla("id" . $CamposFormato->nombre, $CamposFormato->nombre, "documento_iddocumento=" . $data["anterior"], "", $conn);
                            if ($formato_detalle["numcampos"])
                                $data[$CamposFormato->nombre] = $formato_detalle[0]["id" . $CamposFormato->nombre];
                        }
                        break;
                    case "archivo":
                        $routes = explode(',', $data[$CamposFormato->nombre]);

                        foreach ($routes as $route) {
                            $fieldFiles[] = [
                                'fieldId' => $CamposFormato->getPK(),
                                'route' => $route
                            ];
                        }

                        break;
                }
                if (isset($data[$CamposFormato->nombre])) {
                    switch (strtoupper($CamposFormato->tipo_dato)) {
                        case "TEXT":
                            $data[$CamposFormato->nombre] = str_replace("'", "&#39;", stripslashes($data[$CamposFormato->nombre]));
                            if ($tipo == 1 && $CamposFormato->longitud >= 4000) {
                                $contenido = $data[$CamposFormato->nombre];
                                guardar_lob($CamposFormato->nombre, $tabla, "documento_iddocumento=" . $iddoc, $contenido, "texto", $conn);
                            } elseif ($CamposFormato->longitud < 4000) {
                                $contenido = $data[$CamposFormato->nombre];
                                array_push($valores, "'" . @$data[$CamposFormato->nombre] . "'");
                                array_push($campos, $CamposFormato->nombre);
                            }

                            break;
                        case "TIME":
                            array_push($valores, "'" . @$data[$CamposFormato->nombre] . "'");
                            array_push($campos, $CamposFormato->nombre);
                            break;
                        case "DATE":
                            array_push($campos, $CamposFormato->nombre);
                            if (@$data[$CamposFormato->nombre] && $data[$CamposFormato->nombre] != '0000-00-00') {
                                array_push($valores, "'" . $data[$CamposFormato->nombre] . "'");
                            } else {
                                array_push($valores, "NULL");
                            }
                            break;
                        case "DATETIME":
                            array_push($campos, $CamposFormato->nombre);
                            if (@$data[$CamposFormato->nombre] && $data[$CamposFormato->nombre] != '0000-00-00 00:00') {
                                array_push($valores,  "'" . $data[$CamposFormato->nombre] . "'");
                            } else {
                                array_push($valores, "NULL");
                            }
                            break;
                        default:
                            $data[$CamposFormato->nombre] = $data[$CamposFormato->nombre];
                            if (is_array($data[$CamposFormato->nombre])) {
                                array_push($valores, "'" . implode(',', $data[$CamposFormato->nombre]) . "'");
                            } else if ($data[$CamposFormato->nombre]) {
                                array_push($valores, "'" . $data[$CamposFormato->nombre] . "'");
                            } else {
                                array_push($valores, "''");
                            }
                            array_push($campos, $CamposFormato->nombre);
                            break;
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

            if (!$insertado) {
                throw new Exception("Error al guardar el formato", 1);
            }

            if ($fieldFiles) {
                $this->saveFiles($fieldFiles);
            }

            llama_funcion_accion($iddoc, $idformato, "adicionar", "POSTERIOR");
            generar_ruta_documento($idformato, $iddoc);
        } elseif ($tipo == 1) { // cuando voy a editar
            $update = [];
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

            if (isset($data["dependencia"]) && $data["dependencia"] != "") {
                $valid_ruta = busca_filtro_tabla("idruta,origen,tipo_origen", "ruta", "tipo='ACTIVO' and documento_iddocumento=" . $iddoc, "idruta asc", $conn);
                // TODO: Se valida si cambio la dependencia del creador para actualizar la ruta (Firma SVG)
                if ($valid_ruta["numcampos"] == 1 && $valid_ruta[0]["tipo_origen"] == 5 && $valid_ruta[0]["origen"] != $data["dependencia"]) {
                    $update_ruta = "UPDATE ruta SET origen=" . $data["dependencia"] . " WHERE idruta=" . $valid_ruta[0]["idruta"];
                    phpmkr_query($update_ruta) or die("Error al actualizar la ruta del documento");
                }
            }
            llama_funcion_accion($iddoc, $idformato, "editar", "POSTERIOR");
            $idft = busca_filtro_tabla("id" . $tabla, $tabla, "documento_iddocumento=" . $iddoc, "", $conn);
            if ($idft["numcampos"]) {
                $insertado = $idft[0]["id" . $tabla];
            } else {
                $insertado = 0;
            }
        }

        if (isset($data["campo_descripcion"])) {
            $campo = busca_filtro_tabla("nombre,etiqueta", "campos_formato", "idcampos_formato IN(" . $data["campo_descripcion"] . ")", "orden", $conn);
            if ($campo["numcampos"]) {
                $descripcion = '';
                for ($i = 0; $i < $campo["numcampos"]; $i++) {
                    $descripcion .= $campo[$i]["etiqueta"] . ": " . mostrar_valor_campo($campo[$i]["nombre"], $idformato, $iddoc, 1) . '<br>';
                }
            }
        }

        $this->Documento->descripcion = $descripcion;
        $this->Documento->save();

        return $insertado;
    }

    /**
     * almacena los archivos de los campos tipo dropzone
     */
    public function saveFiles($data)
    {
        global $ruta_db_superior;

        foreach ($data as $field) {
            Anexos::executeUpdate([
                'estado' => 0
            ], [
                'documento_iddocumento' => $this->Documento->getPK(),
                'campos_formato' => $field['fieldId'],
                'estado' => 1
            ]);
        }

        foreach ($data as $field) {
            $content = file_get_contents($ruta_db_superior . $field['route']);
            $fileName = basename($field['route']);
            $extensionParts = explode('.', $fileName);
            $route = "{$this->Documento->getStorageRoute()}/anexos/{$fileName}";
            $dbRoute = TemporalController::createFileDbRoute($route, 'archivos', $content);

            Anexos::newRecord([
                'documento_iddocumento' => $this->Documento->getPK(),
                'campos_formato' => $field['fieldId'],
                'estado' => 1,
                'ruta' => $dbRoute,
                'etiqueta' => $extensionParts[0],
                'tipo' => end($extensionParts),
                'formato' => $this->formatId,
                'fecha_anexo' => date('Y-m-d H:i:s'),
                'fecha' => date('Y-m-d H:i:s'),
                'estado' => 1,
                'fk_funcionario' => SessionController::getValue('idfuncionario')
            ]);
        }
    }
}
