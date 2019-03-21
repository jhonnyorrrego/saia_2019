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
                'fk_tarea',
                'fk_documento',
                'fk_funcionario',
                'fecha',
                'estado'
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * funcionalidad ejecutada despues de crear un nuevo registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-20
     */
    protected function afterCreate()
    {
        return Documento::setLimitDate($this->fk_documento);
    }

    /**
     * busca las tareas de un documento
     * ordenadas por fecha_inicial
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-21
     */
    public static function findTaskByDocument($documentId)
    {
        $sql = <<<SQL
            select
                a.*
            from
                tarea a join documento_tarea b
            on
                a.idtarea = b.fk_tarea
            where 
                b.fk_documento = {$documentId}
            order by 
                a.fecha_inicial asc
SQL;
        return Tarea::findBySql($sql);
    }

    public static function getLastTaskByDocument($documentId){
        return '';
    }
}

