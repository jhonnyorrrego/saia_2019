<?php

class LogAccion extends Model
{
    protected $idlog_accion;
    protected $nombre;
    protected $descripcion;
    

    const CREAR = 1;
    const EDITAR = 2;
    const BORRAR = 3;
    const VERSIONAR = 4;
    const NAMES = [
        self::CREAR => 'Creación',
        self::EDITAR => 'Edición',
        self::BORRAR => 'Eliminación',
        self::VERSIONAR => 'Versionamiento',
    ];

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
                'descripcion',
            ],
            'date' => []
        ];
    }

    /**
     * retorna la etiqueta de una accion
     *
     * @param integer $id
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-11
     */
    public static function getActionName($id)
    {
        return self::NAMES[$id];
    }
}
