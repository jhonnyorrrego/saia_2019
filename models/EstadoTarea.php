<?php

class EstadoTarea extends Model
{
    protected $idestado_tarea;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $fecha;
    protected $descripcion;
    protected $valor;
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
                'fecha',
                'descripcion',
                'estado',
                'valor',
            ],
            'date' => ['fecha']
        ];
    }

    public static function takeOffByTask($taskId){
        return self::executeUpdate(['estado' => 0], ['fk_tarea' => $taskId]);
    }

    public static function findHistoryByTask($taskId){
        global $conn;

        $tables = self::getTableName() . ' a,' . Funcionario::getTableName() . ' b';
        $findRecords = busca_filtro_tabla('a.idestado_tarea,a.fecha,a.estado,a.valor,a.descripcion,b.nombres,b.apellidos', $tables, 'a.fk_funcionario = b.idfuncionario and a.fk_tarea =' . $taskId, 'idestado_tarea desc', $conn);

        unset($findRecords['numcampos'], $findRecords['tabla'], $findRecords['sql']);
        return $findRecords;
    }

    public static function getState($state){
        switch ($state) {
            case '1':
                $response = 'Realizada';
                break;
            case '2':
                $response = 'En espera';
                break;
            case '3':
                $response = 'En proceso';
                break;
            case '4':
                $response = 'Cancelada';
                break;
        }

        return $response;
    }
}