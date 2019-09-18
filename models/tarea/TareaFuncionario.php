<?php

class TareaFuncionario extends Model
{
    const TIPO_RESPONSABLE = 1;
    const TIPO_SEGUIDOR = 1;
    const TIPO_CREADOR = 3;

    protected $idtarea_funcionario;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $tipo;
    protected $estado;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_funcionario',
                'fk_tarea',
                'tipo',
                'estado'
            ],
            'date' => []
        ];
    }

    /**
     * activa la ralacion entre
     * el funcionario y la tarea
     *
     * @return int idtarea_funcionario
     */
    public function toggleRelation($newState)
    {
        $this->estado = $newState;

        return $this->save();
    }

    /**
     * asigna funcionario a la tarea
     *
     * @param int $taskId
     * @param array $user listado de funcionarios
     * @param int $type tipo de asignacion 1:responsable , 2: seguidor, 3:creador
     * @return void
     */
    public static function assignUser($taskId, $users, $type)
    {
        if ($taskId && count($users)) {
            $data = [];

            foreach ($users as $user) {
                $findRelation = self::findByAttributes([
                    'fk_funcionario' => $user,
                    'fk_tarea' => $taskId,
                    'tipo' => $type
                ]);

                if (!$findRelation) {
                    $data[] = self::newRecord([
                        'fk_funcionario' => $user,
                        'fk_tarea' => $taskId,
                        'estado' => 1,
                        'tipo' => $type
                    ]);
                } else {
                    $data[] = $findRelation->toggleRelation(1);
                }
            }
        } else {
            $data = null;
        }

        return $data;
    }

    /**
     * busca los funcionarios de una tarea
     * por el tipo de relacion.
     *
     * @param intenger $taskId
     * @param integer $type
     * @return void
     */
    public static function findUsersByType($taskId, $type)
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('b.*')
            ->from('tarea_funcionario', 'a')
            ->join('a', 'funcionario', 'b', 'a.fk_funcionario = b.idfuncionario')
            ->where('a.estado =1')
            ->andWhere('a.fk_tarea = :taskId')
            ->andWhere('a.tipo = :type')
            ->setParameter(':taskId', $taskId, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':type', $type, \Doctrine\DBAL\Types\Type::INTEGER);

        return Funcionario::findByQueryBuilder($QueryBuilder);
    }

    /**
     * inactiva todas las relaciones de la tarea
     * segun el tipo de relacion indicada
     *
     * @param integer $taskId
     * @param integer $type
     * @return void
     */
    public static function inactiveRelationsByTask($taskId, $type)
    {
        self::executeUpdate([
            'estado' => 0
        ], [
            'fk_tarea' => $taskId,
            'tipo' => $type
        ]);
    }
}
