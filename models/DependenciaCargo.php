<?php

class DependenciaCargo extends LogModel
{
    protected $iddependencia_cargo;
    protected $funcionario_idfuncionario;
    protected $dependencia_iddependencia;
    protected $cargo_idcargo;
    protected $estado;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $fecha_ingreso;
    protected $tipo;
    

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'iddependencia_cargo',
                'funcionario_idfuncionario',
                'dependencia_iddependencia',
                'cargo_idcargo',
                'estado',
                'fecha_inicial',
                'fecha_final',
                'fecha_ingreso',
                'tipo',
            ],
            'date' => [
                'fecha_inicial',
                'fecha_final',
                'fecha_ingreso'
            ]
        ];
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
        return parent::afterCreate() &&
            CargoFuncion::newRole(
                $this->cargo_idcargo,
                $this->funcionario_idfuncionario,
                1
            );
    }

    /**
     * evento de base de datos
     * se ejecuta despues de modificar un registro
     * @return void
     */
    public function afterUpdate()
    {
        return parent::afterUpdate() && $this->checkStateChange();
    }

    /**
     * verifica si el estado cambio a inactivo
     * y si es el ultimo rol con el cargo del rol actual
     * en caso de ser asi se inactivan las funciones
     * vinculadas por cargo
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    private function checkStateChange()
    {
        $diff = array_diff_assoc($this->getAttributes(), $this->clone->getAttributes());

        $lastActiveRole = $this->activeRolesByPosition() == 0 && $diff['estado'] == 0;
        $firstActiveRole = $this->activeRolesByPosition() == 1 && $diff['estado'] == 1;

        if (
            array_key_exists('estado', $diff) && ($lastActiveRole || $firstActiveRole)
        ) {
            return CargoFuncion::newRole(
                $this->cargo_idcargo,
                $this->funcionario_idfuncionario,
                $diff['estado']
            );
        }

        return true;
    }

    /**
     * verifica si el usuario no tiene roles activos
     * con el mismo cargo de la instancia
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-10
     */
    public function activeRolesByPosition()
    {
        return VfuncionarioDc::countRecords([
            'estado' => 1,
            'estado_dc' => 1,
            'idcargo' => $this->cargo_idcargo,
            'idfuncionario' => $this->funcionario_idfuncionario
        ]);
    }
}
