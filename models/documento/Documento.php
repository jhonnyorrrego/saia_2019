<?php

class Documento extends Model
{
    const APROBADO = 'Aprobado';
    const RECHAZADO = 'Rechazado';

    protected $iddocumento;
    protected $numero;
    protected $serie;
    protected $fecha;
    protected $ejecutor;
    protected $descripcion;
    protected $tipo_radicado;
    protected $estado;
    protected $dias;
    protected $plantilla;
    protected $activa_admin;
    protected $fecha_creacion;
    protected $tipo_ejecutor;
    protected $pantalla_idpantalla;
    protected $paginas;
    protected $municipio_idmunicipio;
    protected $pdf;
    protected $pdf_hash;
    protected $fecha_oficio;
    protected $oficio;
    protected $anexo;
    protected $descripcion_anexo;
    protected $almacenado;
    protected $responsable;
    protected $guia;
    protected $guia_empresa;
    protected $tipo_despacho;
    protected $formato_idformato;
    protected $documento_antiguo;
    protected $version;
    protected $fecha_limite;
    protected $ventanilla_radicacion;
    protected $prioridad;
    protected $estado_aprobacion;

    //relations
    protected $Funcionario; //ejecutor
    protected $Serie;
    protected $Formato;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'iddocumento',
            'numero',
            'serie',
            'fecha',
            'ejecutor',
            'descripcion',
            'tipo_radicado',
            'estado',
            'dias',
            'plantilla',
            'activa_admin',
            'fecha_creacion',
            'tipo_ejecutor',
            'pantalla_idpantalla',
            'paginas',
            'municipio_idmunicipio',
            'pdf',
            'pdf_hash',
            'fecha_oficio',
            'oficio',
            'anexo',
            'descripcion_anexo',
            'almacenado',
            'responsable',
            'guia',
            'guia_empresa',
            'tipo_despacho',
            'formato_idformato',
            'documento_antiguo',
            'version',
            'fecha_limite',
            'ventanilla_radicacion',
            'prioridad',
            'estado_aprobacion'
        ];
        // set the date attributes on the schema
        $dateAttributes = [
            'fecha',
            'fecha_creacion',
            'fecha_oficio',
            'fecha_limite'
        ];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /* funcionalidad a ejecutar antes de crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-19
     */
    protected function beforeCreate()
    {
        if (!$this->fecha_creacion) {
            $this->fecha_creacion = date('Y-m-d H:i:s');
        }

        if (!$this->fecha) {
            $this->fecha = date('Y-m-d H:i:s');
        }

        return true;
    }

    /* funcionalidad a ejecutar posterior a crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-19
     */
    protected function afterCreate()
    {
        return
            AccesoController::setFullAccess(Acceso::TIPO_DOCUMENTO, $this->getPK()) &&
            $this->addTraceability(DocumentoRastro::ACCION_CREACION);
    }

    /**
     * obtiene una instancia del funcionario del campo ejeuctor
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public function getUser()
    {
        if (!$this->Funcionario) {
            $this->Funcionario = $this->getRelationFk('Funcionario', 'ejecutor');
        }

        return $this->Funcionario;
    }

    /**
     * obtiene una instancia de la serie asociada
     * en caso de no tener genera una con el nombre 
     * sin asignar
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public function getSerie()
    {
        if ($this->serie) {
            if (!$this->Serie) {
                $this->Serie = $this->getRelationFk('Serie', 'serie');
            }
        } else {
            $this->Serie = new Serie();
            $this->Serie->nombre = 'Sin asignar';
        }

        return $this->Serie;
    }

    /**
     * obtiene una instancia del formato correspondiente
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-09
     */
    public function getFormat()
    {
        if (!$this->Formato) {
            $this->Formato = self::getRelationFk('Formato', 'formato_idformato');
        }

        return $this->Formato;
    }

    /**
     * retorna la decripcion lista para mostrar al cliente
     * sin tags html y decodificada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getDescription()
    {
        return strip_tags(html_entity_decode($this->descripcion));
    }

    /**
     * crea los registros para el rastro
     * sobre los cambios del documento
     *
     * @param integer $action ej. DocumentoRastro::ACCION_CREACION
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-08
     */
    public function addTraceability($action)
    {
        switch ($action) {
            case DocumentoRastro::ACCION_CREACION:
                $pk = DocumentoRastro::newRecord([
                    'fk_documento' => $this->getPK(),
                    'accion' => $action,
                    'titulo' => 'Creación del documento'
                ]);
                break;
            case DocumentoRastro::ACCION_ANULACION:
                $pk = DocumentoRastro::newRecord([
                    'fk_documento' => $this->getPK(),
                    'accion' => $action,
                    'titulo' => 'Anulación del documento'
                ]);
                break;

            default:
                $pk = 0;
                break;
        }

        return $pk;
    }

    /**
     * asigna la fecha limite en base a la ultima tarea activa
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-20
     */
    public static function setLimitDate($documentId)
    {
        $data = DocumentoTarea::getLastStateByTask($documentId);

        return self::executeUpdate(['fecha_limite' => $data['fecha_inicial']], [
            self::getPrimaryLabel() => $documentId
        ]);
    }

    /**
     * determina si un usuario tiene acceso 
     * a ver un documento
     *
     * @param integer $userId
     * @param integer $documentId
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-20
     */
    public static function canSee($userId, $documentId)
    {
        $access = Acceso::countRecords([
            'tipo_relacion' => Acceso::TIPO_DOCUMENTO,
            'id_relacion' => $documentId,
            'estado' => 1,
            'accion' => Acceso::ACCION_VER_PUBLICO
        ]);

        if (!$access) {
            $access = Acceso::countRecords([
                'tipo_relacion' => Acceso::TIPO_DOCUMENTO,
                'id_relacion' => $documentId,
                'estado' => 1,
                'accion' => Acceso::ACCION_VER,
                'fk_funcionario' => $userId
            ]);
        }

        return $access > 0;
    }

    /**
     * determina si un usuario tiene acceso 
     * a editar un documento por acceso y por edicion continua
     *
     * @param integer $userId
     * @param integer $documentId
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-02
     */
    public static function canEdit($userId, $documentId)
    {
        $Documento = new self($documentId);
        $access = $Documento->estado == 'ACTIVO' &&
            Acceso::isManager(Acceso::TIPO_DOCUMENTO, $documentId, $userId);

        if (!$access) {
            $access = $Documento->getFormat()->tipo_edicion;
        }

        if (!$access && $Documento->activa_admin == 1) {
            $VersionDocumento = VersionDocumento::findByAttributes([
                'documento_iddocumento' => $documentId,
            ], null, 'idversion_documento desc');

            $access = $VersionDocumento->funcionario_idfuncionario == $userId;
        }

        return $access > 0;
    }

    /**
     * asigna el estado de aprobacion del documento
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-16
     */
    public static function setApprobationState($documentId)
    {
        $finished = RutaDocumento::countRecords([
            'fk_documento' => $documentId,
            'estado' => 1,
            'finalizado' => 1
        ]);

        if ($finished) {
            $state = self::APROBADO;
            $routes = RutaAprobacion::findActivesByDocument($documentId);

            foreach ($routes as $RutaAprobacion) {
                if (
                    $RutaAprobacion->tipo_accion == RutaAprobacion::TIPO_APROBAR &&
                    $RutaAprobacion->ejecucion == RutaAprobacion::EJECUCION_RECHAZAR
                ) {
                    $state = self::RECHAZADO;
                    break;
                }
            }

            self::executeUpdate([
                'estado_aprobacion' => $state
            ], [
                'iddocumento' => $documentId
            ]);

            DocumentoRastro::newRecord([
                'fk_documento' => $documentId,
                'accion' => DocumentoRastro::ACCION_APROBACION,
                'titulo' => $state == self::APROBADO ? 'Documento aprobado' : 'Documento rechazado'
            ]);
        }
    }
}
