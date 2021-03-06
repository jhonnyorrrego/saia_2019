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
        $this->dbAttributes = (object) [
            'safe' => [
                'nombre',
                'estado',
                'fecha'
            ],
            'date' => ['fecha'],
            'labels' => [
                'estado' => [
                    'label' => 'Estado',
                    'values' => [
                        0 => 'Inactivo',
                        1 => 'Activo'
                    ]
                ]
            ]
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
        $diff = array_diff_assoc($this->getAttributes(), $this->clone->getAttributes());

        if (array_key_exists('estado', $diff) && (int) $diff['estado'] == 0) {
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
        $QueryBuilder = self::getQueryBuilder()
            ->select('*')
            ->from('funcion')
            ->where('nombre like :like')
            ->andWhere('estado = 1')
            ->setParameter(':like', "%{$term}%");

        return self::findByQueryBuilder($QueryBuilder);
    }
}
