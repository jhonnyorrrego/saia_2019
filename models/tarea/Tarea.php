<?php

class Tarea extends Model
{
    protected $idtarea;
    protected $nombre;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $descripcion;
    protected $dbAttributes;
    public $clone;

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
            'nombre',
            'fecha_inicial',
            'fecha_final',
            'descripcion',
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha_inicial', 'fecha_final'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * evento de base de datos
     * se ejecuta despues de crear un nuevo registro
     * @return void
     */
    protected function afterCreate()
    {
        return LogController::create(LogAccion::CREAR, 'TareaLog', $this);
    }

    /**
     * evento de base de datos
     * se ejecuta antes de modificar un registro
     * @return void
     */
    protected function beforeUpdate()
    {
        $this->clone = new self($this->getPK());
        return $this->clone->getPK();
    }

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    protected function afterUpdate()
    {
        return LogController::create(LogAccion::EDITAR, 'TareaLog', $this);
    }

    /**
     * retorna el nombre
     *
     * @return string
     */
    public function getName()
    {
        return ucfirst(trim(strtolower($this->nombre)));
    }

    /**
     * calcular el color de la tarea
     *
     * @return string
     */
    public function getColor()
    {
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

        return $color;
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
        global $conn;

        $tables = self::getTableName() . ' a,' . TareaFuncionario::getTableName() . ' b';
        $findRecords = busca_filtro_tabla('a.*', $tables, "a.idtarea = b.fk_tarea and b.estado=1 and b.fk_funcionario =" . $userId . " and b.tipo= " . $type . " and " . fecha_db_obtener('a.fecha_inicial', 'Y-m-d H:i:s') . ">='" . $initialDate . "' and " . fecha_db_obtener('a.fecha_final', 'Y-m-d H:i:s') . "<='" . $finalDate . "'", '', $conn);

        return self::convertToObjectCollection($findRecords);
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
        $records = StaticSql::search($sql, $params->offset, $params->limit);
        return Anexo::convertToObjectCollection($records);
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