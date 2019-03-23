<?php

class Documento extends Model
{
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
    protected $fk_idversion_documento;
    protected $version;
    protected $fecha_limite;
    protected $ventanilla_radicacion;
    protected $prioridad;
    protected $dbAttributes;

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
            'fk_idversion_documento',
            'version',
            'fecha_limite',
            'ventanilla_radicacion',
            'prioridad'
        ];
        // set the date attributes on the schema
        $dateAttributes = [
            'fecha',
            'fecha_creacion',
            'fecha_oficio',
            'fecha_limite'
        ];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
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

    /* funcionalidad a ejecutar posterior a crear un registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-19
     */
    protected function afterCreate()
    {
        return self::setPermissions($this->getPK());
    }

    /**
     * asigna los permisos sobre el documento
     *
     * @param integer $documentId id del documento
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-20
     */
    public static function setPermissions($documentId)
    {
        return AccesoController::setFullAccess(Acceso::TIPO_DOCUMENTO, $documentId);
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

        return $access;
    }
}
