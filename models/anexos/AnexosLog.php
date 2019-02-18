<?php

class AnexosLog extends Model
{
    protected $idanexos_log;
    protected $fk_log;
    protected $fk_anexos;
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
                'fk_log',
                'fk_anexos'
            ],
            'date' => []
        ];
    }

    public static function newLogRelation($logId, $fileId)
    {
        return self::newRecord([
            'fk_anexos' => $fileId,
            'fk_log' => $logId
        ]);
    }
}