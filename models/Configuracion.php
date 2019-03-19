<?php

class Configuracion extends Model
{
    protected $idconfiguracion;
    protected $nombre;
    protected $valor;
    protected $tipo;
    protected $fecha;
    protected $encrypt;
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
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'nombre',
            'valor',
            'tipo',
            'fecha',
            'encrypt'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * Recibe una lista de nombres y devuelve un arreglo de objetos
     * @param array $nombres
     * @return Configuracion[]
     */
    public static function findByNames($names)
    {
        $names = implode("','", $names);
        $sql = "select nombre,valor from configuracion where nombre IN('{$names}')";
        return self::findBySql($sql);
    }
}
