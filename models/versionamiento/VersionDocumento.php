<?php

class VersionDocumento extends Model
{
    protected $idversion_documento;
    protected $documento_iddocumento;
    protected $fecha;
    protected $funcionario_idfuncionario;
    protected $version;
    protected $pdf;


    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'documento_iddocumento',
                'fecha',
                'funcionario_idfuncionario',
                'version',
                'pdf'
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * funcionalidad a ejecutar posterior a crear un registro
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    protected function afterCreate()
    {
        return $this->addTraceability();
    }

    /**
     * crea el registro de rastro sobre el versionamiento
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    public function addTraceability()
    {
        return DocumentoRastro::newRecord([
            'fk_documento' => $this->documento_iddocumento,
            'accion' => DocumentoRastro::ACCION_VERSIONAMIENTO,
            'titulo' => 'Docuemento versionado'
        ]);
    }
}
