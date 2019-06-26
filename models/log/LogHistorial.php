<?php

class LogHistorial extends Model
{
    protected $idlog_historial;
    protected $fk_log;
    protected $campo;
    protected $anterior;
    protected $nuevo;
    

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
                'campo',
                'anterior',
                'nuevo'
            ],
            'date' => []
        ];
    }

    public static function findHistoryByLog($logId, $Instance)
    {
        $records = self::findAllByAttributes([
            'fk_log' => $logId
        ]);

        $data = [];
        foreach ($records as $LogHistorial) {
            $data[] = [
                'field' => $Instance->getFieldLabel($LogHistorial->campo),
                'old' => $Instance->getValueLabel($LogHistorial->campo, $LogHistorial->anterior),
                'new' => $Instance->getValueLabel($LogHistorial->campo, $LogHistorial->nuevo),
            ];
        }

        return $data;
    }
}
