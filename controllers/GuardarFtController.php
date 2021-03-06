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
        if (empty($data["dependencia"])) {
            throw new Exception("Se debe indicar el rol", 1);
        }

        $Contador = Contador::findByAttributes([
            'nombre' => $data["tipo_radicado"]
        ]);

        if (!$Contador) {
            $Contador = $this->Formato->getCounter();

            if (!$Contador) {
                throw new Exception("Se debe definir un contador", 1);
            }
        }

        $data["tipo_radicado"] = $Contador->nombre;
        $plantilla = strtoupper($this->Formato->nombre);

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

        llama_funcion_accion($this->Documento->getPK(), $this->formatId, "radicar", "POSTERIOR");

        if (array_key_exists("anterior", $data)) {
            llama_funcion_accion($data["anterior"], $this->formatId, "responder", "ANTERIOR");
            $idbuzon = busca_filtro_tabla("max(A.idtransferencia) as idbuzon", "buzon_entrada A", "A.archivo_idarchivo=" . $data["anterior"], "");

            Respuesta::newRecord([
                'fecha' => date('Y-m-d H:i:s'),
                'destino' => $this->Documento->getPK(),
                'origen' => $data["anterior"],
                'idbuzon' =>  $idbuzon[0]["idbuzon"],
                'plantilla' =>  $plantilla,
            ]);

            $datos = [
                "archivo_idarchivo" => $data["anterior"],
                "nombre" => "TRAMITE",
                "tipo_destino" => 1,
                "tipo" => ""
            ];

            $destination[] = SessionController::getValue('usuario_actual');
            transferir_archivo($datos, $destination, "", "");
            llama_funcion_accion($data["anterior"], $this->formatId, "responder", "POSTERIOR");
        }

        $this->saveFormat($data);

        $datos = [
            "archivo_idarchivo" => $this->Documento->getPK(),
            "nombre" => "BORRADOR",
            "tipo_destino" => 1,
            "tipo" => ""
        ];

        transferir_archivo($datos, [SessionController::getValue('usuario_actual')], "", "");

        $datos = [
            "archivo_idarchivo" => $this->Documento->getPK(),
            "nombre" => "POR_APROBAR",
            "tipo_destino" => 1,
            "activo" => "1",
            "tipo" => ""
        ];

        transferir_archivo($datos, [SessionController::getValue('usuario_actual')], "", "");

        $banderas = explode(",", $this->Formato->banderas);
        if (in_array("e", $banderas)) {
            aprobar($this->Documento->getPK(), 1);
        }
        return $this->Documento->getPK();
    }

    /**
     * ejecuta el editar del documento
     *
     * @param array $data
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-24
     */
    public function edit($data)
    {
        $this->Documento = new Documento($data['iddoc']);
        $this->saveFormat($data, true);
        return $this->Documento->getPK();
    }

    /**
     * guarda la informacion en la ft
     *
     * @param integer $tipo
     * @param array $data
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-16
     */
    private function saveFormat($data, $edit = false)
    {
        $Connection = Connection::getInstance();
        $QueryBuilder = $Connection->createQueryBuilder();

        $fieldFiles = [];
        $data = array_merge($data, [
            'fecha' => date("Y-m-d H:i:s"),
            'documento_iddocumento' => $this->Documento->getPK()
        ]);

        $fields = $this->Formato->getFields();
        foreach ($fields as $CamposFormato) {
            $field = $CamposFormato->nombre;

            if (in_array($CamposFormato->etiqueta_html, [
                'radio',
                'checkbox',
                'select'
            ])) {
                $data[$field] = $this->saveRadioSelected($data[$field], $CamposFormato->getPK());
            }

            if ($data[$field]) {
                $flags = explode(',', $CamposFormato->banderas);

                if (in_array('pk', $flags)) {
                    continue;
                }

                if (is_array($data[$field])) {
                    $data[$field] = implode(',', $data[$CamposFormato->nombre]);
                } else if ($CamposFormato->etiqueta_html == 'archivo') {
                    $routes = explode(',', $data[$CamposFormato->nombre]);

                    foreach ($routes as $route) {
                        $fieldFiles[] = [
                            'fieldId' => $CamposFormato->getPK(),
                            'route' => $route
                        ];
                    }
                }

                if ($edit) {
                    $QueryBuilder->set($field, ":{$field}");
                } else {
                    $QueryBuilder->setValue($field, ":{$field}");
                }

                if (in_array($CamposFormato->tipo_dato, [
                    \Doctrine\DBAL\Types\Type::DATETIME,
                    \Doctrine\DBAL\Types\Type::DATE
                ])) {
                    $data[$field] = new DateTime($data[$field]);
                }

                $QueryBuilder->setParameter(":{$field}", $data[$field], $CamposFormato->tipo_dato);
            }
        }

        if (!$edit) { //adicionar
            llama_funcion_accion($this->Documento->getPK(), $this->formatId, "adicionar", "ANTERIOR");

            $QueryBuilder->insert($this->Formato->nombre_tabla);
            $QueryBuilder->execute();

            if (!$Connection->lastInsertId()) {
                throw new Exception("Error al guardar el formato", 1);
            }

            if ($fieldFiles) {
                $this->saveFiles($fieldFiles);
            }
            llama_funcion_accion($this->Documento->getPK(), $this->formatId, "adicionar", "POSTERIOR");

            $diagram_instance = busca_filtro_tabla('', 'paso_documento A, diagram_instance B', 'A.diagram_iddiagram_instance=B.iddiagram_instance AND A.documento_iddocumento=' . $this->Documento->getPK(), '');
            if ($diagram_instance["numcampos"]) {
                $listado_pasos = busca_filtro_tabla("", "paso A, paso_actividad B, accion C", "B.estado=1 AND A.idpaso=B.paso_idpaso AND B.accion_idaccion=C.idaccion AND (C.nombre LIKE 'confirmar%' OR C.nombre LIKE 'aprobar%') AND A.diagram_iddiagram=" . $diagram_instance[0]["diagram_iddiagram"] . " AND B.paso_anterior=" . $diagram_instance[0]["paso_idpaso"], "");
                $ruta = array();
                // pasos_ruta se debe almacenar por medio de acciones si se va a confirmar, confirmar y firmar, aprobar o aprobar y firmar, confirmar y responsable, aprobar y responsable o confirmar y firma manual o confirmar y firma manual validar si se hace por medio del paso_actividad o por medio de la accion intencionalidad por medio del paso_actividad
                for ($i = 0; $i < $listado_pasos["numcampos"]; $i++) {
                    array_push($ruta, array(
                        "funcionario" => -1,
                        "tipo_firma" => 1,
                        "paso_actividad" => $listado_pasos[$i]["idpaso_actividad"]
                    ));
                }
                if (count($ruta)) {
                    insertar_ruta($ruta, $this->Documento->getPK(), 0);
                }
            } else {
                $dato = busca_filtro_tabla("", "formato_ruta", "formato_idformato=" . $this->formatId, "orden");
                $rut = array();
                for ($i = 0; $i < $dato["numcampos"]; $i++) {
                    $funcionario = "";
                    if ($dato[$i]["entidad"] == 1 && $dato[$i]["tipo_campo"] == 1) {
                        $funcionario = $dato[$i]["llave"];
                    } else if ($dato[$i]["entidad"] == 2 && $dato[$i]["tipo_campo"] == 1) {
                        $cargo = busca_filtro_tabla("", "cargo a, dependencia_cargo b, funcionario c", "idcargo=" . $dato[$i]["llave"] . " and cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and b.estado=1", "");
                        $funcionario = $cargo[0]["funcionario_codigo"];
                    } else if ($dato[$i]["entidad"] == 5 && $dato[$i]["tipo_campo"] == 1) {
                        $funcionario_temp = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo=" . $dato[$i]["llave"], "");
                        if ($funcionario_temp["numcampos"]) {
                            if ($funcionario_temp[0]["estado_dc"] && $funcionario_temp[0]["estado"]) {
                                $funcionario = $funcionario_temp[0]["funcionario_codigo"];
                            } else {
                                $funcionario_temp2 = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia=" . $funcionario_temp[0]["iddependencia"] . " AND idcargo=" . $funcionario_temp[0]["idcargo"] . " AND estado_dc=1 AND estado=1", "");
                                if ($funcionario_temp2["numcampos"]) {
                                    $funcionario = $funcionario_temp2[0]["funcionario_codigo"];
                                }
                            }
                        }
                    } else if ($dato[$i]["entidad"] == 1 && $dato[$i]["tipo_campo"] == 2) {
                        $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre as nom_campo", "formato a, campos_formato b", "formato_idformato=idformato and idcampos_formato=" . $dato[$i]["llave"], "");
                        $datos = busca_filtro_tabla($formato[0]["nom_campo"], $formato[0]["nombre_tabla"] . " a", "documento_iddocumento=" . $this->Documento->getPK(), "");
                        $funcionario = $datos[0][$formato[0]["nom_campo"]];
                    } else if ($dato[$i]["entidad"] == 5 && $dato[$i]["tipo_campo"] == 2) {
                        $formato = busca_filtro_tabla("a.nombre_tabla, b.nombre as nom_campo", "formato a, campos_formato b", "formato_idformato=idformato and idcampos_formato=" . $dato[$i]["llave"], "");
                        $datos = busca_filtro_tabla($formato[0]["nom_campo"], $formato[0]["nombre_tabla"] . " a", "documento_iddocumento=" . $this->Documento->getPK(), "");
                        $funcionario_codigo = busca_filtro_tabla("B.funcionario_codigo", "dependencia_cargo A, funcionario B", "A.iddependencia_cargo=" . $datos[0][$formato[0]["nom_campo"]] . " AND A.funcionario_idfuncionario=B.idfuncionario", "");
                        $funcionario = $funcionario_codigo[0]["funcionario_codigo"];
                    } else if ($dato[$i]["tipo_campo"] == 3) {
                        include_once($ruta_db_superior . $dato[$i]["ruta"]);
                        $funcionario = call_user_func_array($dato[$i]["funcion"], array(
                            $this->formatId,
                            $this->Documento->getPK()
                        ));
                    }
                    if ($i == 0 && $funcionario == SessionController::getValue('usuario_actual'))
                        continue;
                    if ($funcionario != '') {
                        array_push($rut, array(
                            "funcionario" => $funcionario,
                            "tipo_firma" => $dato[$i]["firma"]
                        ));
                    }
                }
                if ($dato["numcampos"])
                    insertar_ruta($rut, $this->Documento->getPK());
            }
        } else { // editar
            llama_funcion_accion($this->Documento->getPK(), $this->formatId, "editar", "ANTERIOR");

            $QueryBuilder
                ->update($this->Formato->nombre_tabla)
                ->where('documento_iddocumento = :documentId')
                ->setParameter(':documentId', $this->Documento->getPK())
                ->execute();

            DocumentoRastro::newRecord([
                'fk_documento' => $this->Documento->getPK(),
                'accion' => DocumentoRastro::ACCION_EDICION,
                'titulo' => 'Edición del documento'
            ]);

            $Ruta = Ruta::findByAttributes([
                'tipo' => 'ACTIVO',
                'documento_iddocumento' => $this->Documento->getPK()
            ]);

            if ($Ruta && $Ruta->tipo_origen == 5 && $Ruta->origen != $data["dependencia"]) {
                $Ruta->origen = $data['dependencia'];
                $Ruta->save();
            }

            if ($fieldFiles) {
                $this->saveFiles($fieldFiles);
            }

            llama_funcion_accion($this->Documento->getPK(), $this->formatId, "editar", "POSTERIOR");
        }

        $this->Documento->refreshDescription();
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

    /**
     * almacena las opciones seleccionadas
     * de los campos radio, select y checkbox
     *
     * @param array $data
     * @param integer $fieldId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-09-24
     */
    public function saveRadioSelected($data, $fieldId)
    {
        $data = is_string($data) ? [$data] : $data;

        CampoSeleccionados::executeDelete([
            'fk_documento' => $this->Documento->getPk(),
            'fk_campos_formato' => $fieldId,
        ]);

        foreach ($data as $optionId) {
            $CampoOpciones = new CampoOpciones($optionId);

            CampoSeleccionados::newRecord([
                'fk_documento' => $this->Documento->getPK(),
                'fk_campos_formato' => $fieldId,
                'fk_campo_opciones' => $CampoOpciones->getPK(),
                'llave' => $CampoOpciones->llave,
                'valor' => $CampoOpciones->valor,
            ]);
        }
    }
}
