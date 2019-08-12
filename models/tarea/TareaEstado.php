<?php

class TareaEstado extends Model
{
    const REALIZADA = 1;
    const PENDIENTE = 2;
    const PROCESO = 3;
    const CANCELADA = 4;

    protected $idtarea_estado;
    protected $fk_funcionario;
    protected $fk_tarea;
    protected $fecha;
    protected $descripcion;
    protected $valor;
    protected $estado;
    protected $user;

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
                'fecha',
                'descripcion',
                'estado',
                'valor',
            ],
            'date' => ['fecha'],
            'labels' => [
                'estado' => [
                    'label' => 'valor',
                    'values' => [
                        '1' => 'Realizada',
                        '2' => 'Pendiente',
                        '3' => 'En proceso',
                        '4' => 'Cancelada'
                    ]
                ]
            ]
        ];
    }

    /**
     * funcionalidad ejecutada despues de crear un nuevo registro
     *
     * @return boolean
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-20
     */
    protected function afterCreate()
    {
        $DocumentoTarea = DocumentoTarea::findByAttributes(['fk_tarea' => $this->fk_tarea]);

        if ($DocumentoTarea) {
            $response = Documento::setLimitDate($DocumentoTarea->fk_documento);
        } else {
            $response = true;
        }

        return $response;
    }

    /**
     * retorna una instancia del usuario creador
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-21
     */
    public function getUser()
    {
        if (!$this->user) {
            $this->user = self::getRelationFk('Funcionario');
        }

        return $this->user;
    }

    /**
     * inactiva un estado
     *
     * @param int $taskId id de la tarea
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public static function takeOffByTask($taskId)
    {
        return self::executeUpdate(['estado' => 0], ['fk_tarea' => $taskId]);
    }

    /**
     * retorna la etiqueta del estado
     *
     * @param integer $state
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-03-21
     */
    public static function getState($state)
    {
        switch ($state) {
            case self::REALIZADA:
                $response = 'Realizada';
                break;
            case self::PENDIENTE:
                $response = 'Pendiente';
                break;
            case self::PROCESO:
                $response = 'En proceso';
                break;
            case self::CANCELADA:
                $response = 'Cancelada';
                break;
        }

        return $response;
    }
}
