<?php

class PermisoPerfil extends Model
{
    protected $idpermiso_perfil;
    protected $modulo_idmodulo;
    protected $perfil_idperfil;
    

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'modulo_idmodulo',
                'perfil_idperfil'
            ],
            'date' => []
        ];
    }
}