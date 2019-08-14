<?php

class VersionAnexos extends Model
{
    protected $idversion_anexos;
    protected $documento_iddocumento;
    protected $ruta;
    protected $fk_idversion_documento;
    protected $anexos_idanexos;

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
                'ruta',
                'fk_idversion_documento',
                'anexos_idanexos',
            ],
            'date' => []
        ];
    }
}
