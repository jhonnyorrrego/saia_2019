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

        registrar_accion_digitalizacion($this->Documento->getPK(), 'CREACION DOCUMENTO');
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
                } else if ($CamposFormato->valor == "{*form_ejecutor*}") {
                    $data[$field] = ejecutoradd($data[$CamposFormato->nombre]);
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
            generar_ruta_documento($this->formatId, $this->Documento->getPK());
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
