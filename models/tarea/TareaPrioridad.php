<?php

class TareaPrioridad extends Model
{
    protected $idtarea_prioridad;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $prioridad;
    protected $estado;
    protected $fecha;

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
                'prioridad',
                'estado',
                'fecha'
            ],
            'date' => ['fecha']
        ];
    }

    public static function takeOffByTask($taskId)
    {
        return self::executeUpdate(['estado' => 0], ['fk_tarea' => $taskId]);
    }

    /**
     * busca el historial de una tarea
     *
     * @param integer $taskId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function findHistoryByTask($taskId)
    {
        return self::getQueryBuilder()
            ->select([
                'a.idtarea_prioridad',
                'a.fecha',
                'a.estado',
                'a.prioridad',
                'b.nombres',
                'b.apellidos'
            ])
            ->from('tarea_prioridad', 'a')
            ->join('a', 'funcionario', 'b', 'a.fk_funcionario = b.idfuncionario')
            ->andWhere('a.fk_tarea = :taskId')
            ->setParameter(':taskId', $taskId, \Doctrine\DBAL\Types\Type::INTEGER)
            ->execute()->fetchAll();
    }

    public static function getPriority($priority)
    {
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
