<?php

class AnexoLog extends Model
{
    protected $idanexo_log;
    protected $fk_log;
    protected $fk_anexo;
    

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

    /**
     * crea una nueva relacion con log
     *
     * @param integer $logId
     * @param integer $fileId
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-15
     */
    public static function newLogRelation($logId, $fileId)
    {
        return self::newRecord([
            'fk_anexo' => $fileId,
            'fk_log' => $logId
        ]);
    }
}