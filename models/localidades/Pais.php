<?php

class Pais extends Model
{
    protected $idpais;
    protected $nombre;
    protected $estado;
    protected $sortname;
    protected $phonecode;
    

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
                'nombre',
                'estado',
                'sortname',
                'phonecode'
            ],
            'date' => []
        ];
    }

    /**
     * buscador para autocompletar por nombre
     *
     * @param string $term palabra a buscar
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-18
     */
    public static function findAllByTerm($term)
    {
        $sql = <<<SQL
        SELECT 
            idpais,nombre,estado
        FROM 
            pais
        WHERE
            nombre LIKE '%{$term}%' AND
            estado = 1
SQL;

        return self::findBySql($sql);
    }
}
