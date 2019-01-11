<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class DocumentoTarea extends Model
{
    protected $iddocumento_tarea;
    protected $fk_tarea;
    protected $fk_documento;
    protected $fk_funcionario;
    protected $fecha;
    protected $estado;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_tarea',
                'fk_documento',
                'fk_funcionario',
                'fecha',
                'estado'
            ],
            'date' => ['fecha']
        ];
    }
   
}