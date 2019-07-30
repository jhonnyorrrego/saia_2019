<?php

class DocumentoTarea extends Model
{
    protected $iddocumento_tarea;
    protected $fk_tarea;
    protected $fk_documento;
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

    /**
     * evento de base de datos
     * se ejecuta antes de crear un nuevo registro
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-29
     */
    public function beforeCreate()
    {
        if (!$this->fk_funcionario) {
            $this->fk_funcionario = SessionController::getValue('idfuncionario');
        }

        if (!$this->fecha) {
            $this->fecha = date('Y-m-d H:i:s');
        }

        if (!$this->estado) {
            $this->estado = 1;
        }

        return true;
    }

    /**
     * evento de base de datos
     * se ejecuta despues de crear un nuevo registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-20
     */
    protected function afterCreate()
    {
        return
            Documento::setLimitDate($this->fk_documento) &&
            $this->addTraceability();
    }

    /**
     * crea el registro de rastro sobre la vinculacion de una tarea
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    public function addTraceability()
    {
        return DocumentoRastro::newRecord([
            'fk_documento' => $this->fk_documento,
            'accion' => DocumentoRastro::ACCION_VINCULACION_TAREA,
            'titulo' => 'Se le ha vinculado una tarea'
        ]);
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

    /**
     * consulta la fecha inicial y el estado
     * de la ultima tarea de un documento
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-21
     */
    public static function getLastStateByTask($documentId)
    {
        $state = TareaEstado::CANCELADA;
        $sql = <<<SQL
        SELECT 
            tarea.fecha_inicial,tarea_estado.valor
        FROM
            documento_tarea  join 
            tarea  on 
                documento_tarea.fk_tarea = tarea.idtarea
                JOIN
            tarea_estado ON tarea.idtarea = tarea_estado.fk_tarea
        WHERE
            tarea_estado.estado = 1 AND 
            tarea_estado.valor <> {$state} and 
            documento_tarea.fk_documento = {$documentId}
SQL;
        $data = StaticSql::search($sql);

        if ($data) {
            $response = $data[0];
            foreach ($data as $row) {
                if ($row['fecha_inicial'] > $response['fecha_inicial']) {
                    $response = $row;
                }
            }
        } else {
            $response = null;
        }

        return $response;
    }
}
