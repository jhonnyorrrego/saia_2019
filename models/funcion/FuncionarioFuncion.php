<?php

class FuncionarioFuncion extends LogModel
{
    protected $idfuncionario_funcion;
    protected $fk_funcion;
    protected $fk_funcionario;
    protected $fk_cargo;
    protected $estado;
    protected $fecha;

    //relations
    private $Funcion;
    private $Cargo;


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
                'fk_funcionario',
                'fk_cargo',
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
     * retorna la instancia de la funcion relacionada
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-06
     */
    public function getPosition()
    {
        if (!$this->Cargo) {
            $this->Cargo = new Cargo($this->fk_cargo);
        }

        return $this->Cargo;
    }

    /**
     * verifica si la funcion esta activa
     * para habilitar la relacion con el funcionario
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
            'estado' => 1,
            'fk_cargo' => null
        ]);

        foreach ($relations as $FuncionarioFuncion) {
            $FuncionarioFuncion->estado = 0;
            $FuncionarioFuncion->save();
        }

        return true;
    }

    /**
     * asigno funciones por cargo a los funcionarios
     *
     * @param array $userList
     * @param integer $functionId
     * @param integer $positionId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public static function createRoleRelations($userList, $functionId, $positionId)
    {
        foreach ($userList as $userId) {
            $pk = self::newRecord([
                'fk_funcion' => $functionId,
                'fk_funcionario' => $userId,
                'fk_cargo' => $positionId,
                'estado' => 1,
                'fecha' => date('Y-m-d H:i:s')
            ]);

            if (!$pk) {
                throw new Exception("Error al asignar función al funcionario", 1);
            }
        }

        return true;
    }

    /**
     * inactiva una funcion que fue asignada por rol
     *
     * @param array $userList
     * @param integer $functionId
     * @param integer $positionId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public static function toggleRoleRelations(
        $userList,
        $functionId,
        $positionId,
        $state
    ) {
        foreach ($userList as $userId) {
            $oldState = !$state ? 1 : 0;
            $FuncionarioFuncion = FuncionarioFuncion::findByAttributes([
                'fk_funcionario' => $userId,
                'fk_cargo' => $positionId,
                'fk_funcion' => $functionId
            ]);

            if ($FuncionarioFuncion && $FuncionarioFuncion->estado == $oldState) {
                $FuncionarioFuncion->estado = $state;
                if (!$FuncionarioFuncion->save()) {
                    throw new Exception("Error al modificar el estado", 1);
                }
            } else if (!$FuncionarioFuncion && $state == 1) { //si no esta asignada la funcion por rol
                self::createRoleRelations([$userId], $functionId, $positionId);
            }
        }

        return true;
    }
}
