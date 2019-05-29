<?php

class Perfil extends Model
{
    const ADMINISTRADOR = 1; 
    const GENERAL = 6; 
    const ADMIN_INTERNO = 8; 

    protected $idperfil;
    protected $nombre;
    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = ['nombre'];

        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
        
    }
}