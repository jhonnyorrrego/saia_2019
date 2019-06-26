<?php

class Funcion extends LogModel
{
    protected $idfuncion;
    protected $nombre;
    protected $estado;
    protected $fecha;
    

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

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    public function afterUpdate()
    {
        return $this->checkStateChange() && parent::afterUpdate();
    }

    /**
     * verifica si el estado cambio a inactivo
     * para inactivar las relaciones
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    private function checkStateChange()
    {
        $diff = array_diff($this->getAttributes(), $this->clone->getAttributes());

        if (array_key_exists('estado', $diff) && $diff['estado'] == 0) {
            return $this->inactiveRelations();
        }

        return true;
    }

    /**
     * inactiva las relaciones con cargo funcion
     * y funucionario funcion llamando el metodo inactiveByFunction
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public function inactiveRelations()
    {
        return CargoFuncion::inactiveByFunction($this->getPK()) &&
            FuncionarioFuncion::inactiveByFunction($this->getPK());
    }

    /**
     * busca las funciones que concuerden con un string
     *
     * @param string $term
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
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
