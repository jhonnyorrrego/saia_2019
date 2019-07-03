<?php

class TareaLog extends Model
{
    protected $idtarea_log;
    protected $fk_log;
    protected $fk_tarea;
    

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
                'fk_log',
                'fk_tarea'
            ],
            'date' => []
        ];
    }

    public static function newLogRelation($logId, $taskId)
    {
        return self::newRecord([
            'fk_log' => $logId,
            'fk_tarea' => $taskId
        ]);
    }
}