<?php

class Tarea extends LogModel
{
    protected $idtarea;
    protected $nombre;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $descripcion;
    protected $fk_recurrencia_tarea;

    //relations
    protected $RecurrenciaTarea;

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
                'nombre',
                'fecha_inicial',
                'fecha_final',
                'descripcion',
                'fk_recurrencia_tarea'
            ],
            'date' => ['fecha_inicial', 'fecha_final']
        ];
    }

    /**
     * evento de base de datos
     * se ejecuta despues de crear un nuevo registro
     * @return void
     */
    public function afterCreate()
    {
        return
            parent::afterCreate() &&
            $this->setDefaultState();
    }

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    public function afterUpdate()
    {
        return
            parent::afterUpdate() &&
            $this->refreshDocumentLimitDate();
    }

    /**
     * obtiene una instancia del grupo de recurrencia
     * al que pertenece la tarea
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-23
     */
    public function getRecurrence()
    {
        if (!$this->RecurrenciaTarea) {
            $this->RecurrenciaTarea = $this->getRelationFk('RecurrenciaTarea');
        }

        return $this->RecurrenciaTarea;
    }

    /**
     * retorna el nombre
     *
     * @return string
     */
    public function getName()
    {
        return html_entity_decode($this->nombre);
    }

    /**
     * calcula el color de la tarea
     *
     * @return string
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-08
     */
    public function getColor()
    {
        $TareaEstado = TareaEstado::findByAttributes([
            'fk_tarea' => $this->getPK(),
            'estado' => 1
        ]);

        if ($TareaEstado->valor != TareaEstado::REALIZADA) {
            $Limit = new DateTime($this->fecha_final);
            $Today = new DateTime();

            $diference = DateController::dias_habiles_entre_fechas($Today, $Limit);

            if ($diference < 2) {
                $color = '#dc3545';
            } elseif ($diference >= 2 && $diference <= 8) {
                $color = '#ffc107';
            } else {
                $color = '#17a2b8';
            }
        } else { //tarea realizada
            $color = '#10CFBD';
        }

        return $color;
    }

    /**
     * crea el estado pendiente para la tarea
     * cuando se crea
     *
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-08
     */
    public function setDefaultState()
    {
        return TareaEstado::newRecord([
            'fk_funcionario' => SessionController::getValue('idfuncionario'),
            'fk_tarea' => $this->getPK(),
            'fecha' => date('Y-m-d H:i:s'),
            'estado' => 1,
            'valor' => TareaEstado::PENDIENTE
        ]);
    }

    /**
     * refresca la fecha limite del documento enlazado
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-21
     */
    public function refreshDocumentLimitDate()
    {
        $DocumentoTarea = DocumentoTarea::findByAttributes(['fk_tarea' => $this->getPK()]);

        if ($DocumentoTarea) {
            $response = Documento::setLimitDate($DocumentoTarea->fk_documento);
        } else {
            $response = true;
        }

        return $response;
    }

    /**
     * busca las tareas entre fechas
     * segun el tipo de funcionario
     *
     * @param int $userId idfuncionario
     * @param DateTime $initialDate fecha inicial
     * @param DateTime $finalDate fecha final
     * @param int $type tipo de relacion 1,responsable.2,seguidor.3,creador
     * @return array objetos de la clase tarea
     */
    public static function findBetweenDates($userId, $initialDate, $finalDate, $type)
    {
        $initial = StaticSql::getDateFormat('a.fecha_inicial', 'Y-m-d H:i:s');
        $final =  StaticSql::getDateFormat('a.fecha_final', 'Y-m-d H:i:s');
        $sql = <<<SQL
            SELECT
                a.* 
            FROM
                tarea a 
            JOIN
                tarea_funcionario b
            ON
                a.idtarea = b.fk_tarea
            WHERE
                b.estado=1 AND
                b.fk_funcionario = {$userId} AND
                b.tipo= {$type} AND
                {$initial} >='{$initialDate}' AND
                {$final} <= '{$finalDate}'
SQL;

        return self::findBySql($sql);
    }

    /**
     * busca los anexos activos de la tarea
     *
     * @param object $params
     * *  [task, order, offset, limit ]
     * @return void
     */
    public static function findActiveFiles($params)
    {
        $sql = <<<SQL
            select a.*
            from anexo a 
            join tarea_anexo b 
                on a.idanexo = b.fk_anexo 
            join tarea c
                on b.fk_tarea = c.idtarea
            where 
                c.idtarea = $params->task and
                a.eliminado = 0 and 
                a.estado = 1
            order by $params->order
SQL;
        return Anexo::findBySql($sql, true, $params->offset, $params->limit);
    }

    /**
     * cuenta los anexos activos de la tarea
     *
     * @param int $taskId
     * @return void
     */
    public static function countActiveFiles($taskId)
    {
        $sql = <<<SQL
        select count(*) as total 
        from anexo a 
        join tarea_anexo b 
            on a.idanexo = b.fk_anexo 
        join tarea c
            on b.fk_tarea = c.idtarea
        where 
            c.idtarea = {$taskId} and
            a.eliminado = 0 and 
            a.estado = 1
SQL;
        $record = StaticSql::search($sql);
        return $record[0]['total'];
    }
}
