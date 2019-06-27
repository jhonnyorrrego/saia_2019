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
        $this->dbAttributes = (object)[
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
}
