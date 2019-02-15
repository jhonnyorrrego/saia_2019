<?php

class AnexoLog extends Model
{
    protected $idanexo_log;
    protected $fk_log;
    protected $fk_anexo;
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
                'fk_anexo'
            ],
            'date' => []
        ];
    }

    public static function newLogRelation($logId, $fileId)
    {
        return self::newRecord([
            'fk_anexo' => $fileId,
            'fk_log' => $logId
        ]);
    }
}