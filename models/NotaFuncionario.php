<?php

class NotaFuncionario extends Model
{
    protected $idnota_funcionario;
    protected $contenido;
    protected $fk_funcionario;
    protected $fecha;
    protected $estado;


    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'contenido',
            'fk_funcionario',
            'fecha',
            'estado'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }
}
