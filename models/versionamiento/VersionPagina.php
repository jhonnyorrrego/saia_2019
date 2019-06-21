<?php

class VersionPagina extends Model
{
    protected $idversion_pagina;
    protected $documento_iddocumento;
    protected $ruta;
    protected $ruta_miniatura;
    protected $fk_idversion_documento;
    protected $pagina_idpagina;
    

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
                'ruta',
                'ruta_miniatura',
                'fk_idversion_documento',
                'pagina_idpagina',
            ],
            'date' => []
        ];
    }
}
