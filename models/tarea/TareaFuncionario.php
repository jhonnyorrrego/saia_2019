<?php

class TareaFuncionario extends Model
{
    protected $idtarea_funcionario;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $tipo;
    protected $estado;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
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
    public function toggleRelation($newState){
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
    public static function assignUser($taskId, $users, $type){
        if($taskId && count($users)){
            $data = [];

            foreach($users as $user){
                $findRelation = self::findByAttributes([
                    'fk_funcionario' => $user,
                    'fk_tarea' => $taskId,
                    'tipo' => $type
                ]);

                if(!$findRelation){
                    $data [] = self::newRecord([
                        'fk_funcionario' => $user,
                        'fk_tarea' => $taskId,
                        'estado' => 1,
                        'tipo' => $type
                    ]);
                }else{
                    $data [] = $findRelation->toggleRelation(1);
                }
            }
        }else{
            $data = NULL;
        }

        return $data;
    }

    public static function findUsersByType($taskId, $type){
        global $conn;

        $tables = self::getTableName() .' a,' . Funcionario::getTableName() .' b';
        $findRecords = busca_filtro_tabla('b.*', $tables, 'a.fk_funcionario = b.idfuncionario and a.estado=1 and a.fk_tarea=' . $taskId . ' and a.tipo = '. $type, '', $conn);

        return Funcionario::convertToObjectCollection($findRecords);
    }

    public static function inactiveRelationsByTask($taskId, $type){
        self::executeUpdate([
            'estado' => 0
        ],[
            'fk_tarea' => $taskId,
            'tipo' => $type
        ]);
    }
}
