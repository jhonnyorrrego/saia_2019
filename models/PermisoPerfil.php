<?php

class PermisoPerfil extends Model
{
    protected $idpermiso_perfil;
    protected $modulo_idmodulo;
    protected $perfil_idperfil;
    protected $caracteristica_propio;
    protected $caracteristica_grupo;
    protected $caracteristica_total;
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
        $safeDbAttributes = [
            'modulo_idmodulo',
            'perfil_idperfil',
            'caracteristica_propio',
            'caracteristica_grupo',
            'caracteristica_total'
        ];
        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}