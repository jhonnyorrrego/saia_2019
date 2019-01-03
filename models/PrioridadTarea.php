<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class PrioridadTarea extends Model
{
    protected $idprioridad_tarea;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $prioridad;
    protected $estado;
    protected $fecha;
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
                'prioridad',
                'estado',
                'fecha'
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
        $findRecords = busca_filtro_tabla('a.idprioridad_tarea,a.fecha,a.estado,a.prioridad,b.nombres,b.apellidos', $tables, 'a.fk_funcionario = b.idfuncionario and a.fk_tarea =' . $taskId, 'idprioridad_tarea desc', $conn);

        unset($findRecords['numcampos'], $findRecords['tabla'], $findRecords['sql']);
        return $findRecords;
    }

    public static function getPriority($priority){
        switch ($priority) {
            case '1':
                $response = 'Alta';
                break;
            case '2':
                $response = 'Media';
                break;
            case '3':
                $response = 'Baja';
                break;
            case '4':
                $response = 'Ninguna';
                break;
        }

        return $response;
    }
}