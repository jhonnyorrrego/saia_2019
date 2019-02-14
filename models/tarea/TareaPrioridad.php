<?php

class TareaPrioridad extends Model
{
    protected $idtarea_prioridad;
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

        $sql = <<<SQL
            select 
                a.idtarea_prioridad,
                a.fecha,
                a.estado,
                a.prioridad,
                b.nombres,
                b.apellidos
            from 
                tarea_prioridad a join
                funcionario b on
                a.fk_funcionario = b.idfuncionario
            where 
                a.fk_tarea = {$taskId}
            order by idtarea_prioridad desc
SQL;

        return StaticSql::search($sql);
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