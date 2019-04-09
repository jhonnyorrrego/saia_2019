<?php

class LogAcceso extends Model
{
    protected $idlog_acceso;
    protected $login;
    protected $iplocal;
    protected $ipremota;
    protected $exito;
    protected $fecha;
    protected $fecha_cierre;
    protected $funcionario_idfuncionario;
    protected $idsesion_php;
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
        $this->dbAttributes = (object)[
            'safe' => [
                'login',
                'iplocal',
                'ipremota',
                'exito',
                'fecha',
                'fecha_cierre',
                'funcionario_idfuncionario',
                'idsesion_php'
            ],
            'date' => ['fecha', 'fecha_cierre']
        ];
    }

    
}