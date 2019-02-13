<?php

class Log extends Model
{
    protected $idlog;
    protected $fk_log_accion;
    protected $fk_funcionario;
    protected $fecha;
    protected $user;
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
                'fk_log_accion',
                'fk_funcionario',
                'fecha'
            ],
            'date' => ['fecha']
        ];
    }

    public function getUser()
    {
        if (!$this->user) {
            $this->user = new Funcionario($this->fk_funcionario);
        }

        return $this->user;
    }
}