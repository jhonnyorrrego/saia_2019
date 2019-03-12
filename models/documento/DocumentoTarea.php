<?php

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

    public static function findTaskByDocument($documentId){
        $sql = <<<SQL
            select
                a.*
            from
                tarea a join documento_tarea b
            on
                a.idtarea = b.fk_tarea
            where 
                b.fk_documento = {$documentId}
SQL;
        return Tarea::findBySql($sql);
    }
}