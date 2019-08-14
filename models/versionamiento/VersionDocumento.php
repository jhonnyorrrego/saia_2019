<?php

class VersionDocumento extends Model
{
    protected $idversion_documento;
    protected $documento_iddocumento;
    protected $fecha;
    protected $funcionario_idfuncionario;
    protected $version;
    protected $pdf;

    //relations
    private $Funcionario;
    private $pages;
    private $attachments;

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
     * obtiene una instancia del funcionario vinculado
     *
     * @return object Funcionario
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-14
     */
    public function getUser()
    {
        if (!$this->Funcionario) {
            $this->Funcionario = $this->getRelationFk('Funcionario', 'funcionario_idfuncionario');
        }

        return $this->Funcionario;
    }

    /**
     * obtiene todas las paginas almacenadas 
     * en la version
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-14
     */
    public function getPages()
    {
        if (!$this->pages) {
            $this->pages = VersionPagina::findAllByAttributes([
                'documento_iddocumento' => $this->documento_iddocumento
            ]);
        }

        return $this->pages;
    }

    /**
     * obtiene todas las paginas almacenadas 
     * en la version
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-14
     */
    public function getAttachments()
    {
        if (!$this->attachments) {
            $this->attachments = VersionAnexos::findAllByAttributes([
                'documento_iddocumento' => $this->documento_iddocumento
            ]);
        }

        return $this->attachments;
    }

    /**
     * crea el pdf del documento en el temporal del usuario
     *
     * @return mixed
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-14
     */
    public function getPdf()
    {
        $prefix = 'pdf-' . $this->getPK();
        $image = TemporalController::createTemporalFile($this->pdf, $prefix);
        return $image->success ? $image->route : false;
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
