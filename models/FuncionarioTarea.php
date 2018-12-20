<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class FuncionarioTarea extends Model
{
    protected $idfuncionario_tarea;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $tipo;
    protected $estado;

    function __construct($id){
        return parent::__construct($id);
    }

    /**
     * define the values for dbAttributes
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
     * asigna funcionario a la tarea
     *
     * @param int $tasksId
     * @param array $user listado de funcionarios
     * @param int $type tipo de asignacion 1:responsable , 2: seguidor
     * @return void
     */
    public static function assignUser($tasksId, $users, $type){
        if($tasksId && count($users)){
            $data = [];
            foreach($users as $user){
                $data [] = self::newRecord([
                    'fk_funcionario' => $user,
                    'fk_tarea' => $tasksId,
                    'estado' => 1,
                    'tipo' => $type
                ]);
            }
        }else{
            $data = NULL;
        }

        return $data;
    }
}
