<?php

class CargoFuncion extends LogModel
{
    protected $idcargo_funcion;
    protected $fk_funcion;
    protected $fk_cargo;
    protected $estado;
    protected $fecha;
    protected $dbAttributes;

    //relations
    private $Funcion;

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
                'fk_funcion',
                'fk_cargo',
                'estado',
                'fecha'
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * evento anterior al modificar
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function beforeUpdate()
    {
        return $this->activateRelation() && parent::beforeUpdate();
    }

    /**
     * evento anterior al modificar
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function afterUpdate()
    {
        return parent::afterUpdate() && $this->checkStateChange();
    }

    /**
     * evento posterior al crear
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public function afterCreate()
    {
        return parent::afterCreate() && $this->createUserRelations();
    }

    /**
     * retorna la instancia de la funcion relacionada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-06
     */
    public function getFunction()
    {
        if (!$this->Funcion) {
            $this->Funcion = new Funcion($this->fk_funcion);
        }

        return $this->Funcion;
    }

    /**
     * verifica si la funcion esta activa
     * para habilitar la relacion con el cargo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public function activateRelation()
    {
        if ($this->estado == 1 && $this->getFunction()->estado == 0) {
            throw new Exception("La función no se encuentra activa", 1);
        }

        return true;
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

        if (array_key_exists('estado', $diff)) {
            return $this->toggleUsersRelation($diff['estado']);
        }

        return true;
    }

    /**
     * inactiva la funcion a los funcionarios que tienen el cargo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function toggleUsersRelation($state)
    {
        $list = VfuncionarioDc::findColumn('idfuncionario', [
            'idcargo' => $this->fk_cargo
        ]);

        return FuncionarioFuncion::toggleRoleRelations(
            $list,
            $this->fk_funcion,
            $this->fk_cargo,
            $state
        );
    }

    /**
     * asigna la funcion a los funcionario que tienen el cargo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public function createUserRelations()
    {
        $list = VfuncionarioDc::findColumn('idfuncionario', [
            'idcargo' => $this->fk_cargo
        ]);

        return FuncionarioFuncion::createRoleRelations($list, $this->fk_funcion, $this->fk_cargo);
    }

    /**
     * inactiva las relaciones con una funcion
     *
     * @param integer $functionId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public static function inactiveByFunction($functionId)
    {
        //no se debe usar executeUpdate ya que implementa LogModel
        $relations = self::findAllByAttributes([
            'fk_funcion' => $functionId,
            'estado' => 1
        ]);

        foreach ($relations as $CargoFuncion) {
            $CargoFuncion->estado = 0;
            $CargoFuncion->save();
        }

        return true;
    }

    /**
     * asigna las funciones activas del cargo
     * a un funcionario
     *
     * @param integer $positionId
     * @param integer $userId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public static function newRole($positionId, $userId, $state)
    {
        $functions = self::findAllByAttributes([
            'fk_cargo' => $positionId,
            'estado' => 1
        ]);

        foreach ($functions as $CargoFuncion) {
            FuncionarioFuncion::toggleRoleRelations(
                [$userId],
                $CargoFuncion->fk_funcion,
                $positionId,
                $state
            );
        }

        return true;
    }
}
