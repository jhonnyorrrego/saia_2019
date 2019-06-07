<?php

class Funcion extends LogModel
{
    protected $idfuncion;
    protected $nombre;
    protected $estado;
    protected $fecha;
    protected $dbAttributes;

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
                'nombre',
                'estado',
                'fecha'
            ],
            'date' => ['fecha']
        ];
    }

    public static function findAllByTerm($term)
    {
        $sql = <<<SQL
            SELECT * 
            FROM funcion
            WHERE
                nombre like '%{$term}%'
SQL;
        return self::findBySql($sql);
    }
}
