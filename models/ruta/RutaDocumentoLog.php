<?php

class RutaDocumentoLog extends Model
{
    protected $idruta_documento_log;
    protected $fk_log;
    protected $fk_ruta_documento;
    

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_log',
                'fk_ruta_documento'
            ],
            'date' => []
        ];
    }

    /**
     * crea una nueva relacion con log
     *
     * @param integer $logId
     * @param integer $route
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-15
     */
    public static function newLogRelation($logId, $route)
    {
        return self::newRecord([
            'fk_ruta_documento' => $route,
            'fk_log' => $logId
        ]);
    }
}
