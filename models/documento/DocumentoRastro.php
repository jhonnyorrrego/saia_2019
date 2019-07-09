<?php

class DocumentoRastro extends Model
{
    const ACCION_CREACION = 1;
    const ACCION_EDICION = 2;
    const ACCION_ANULACION = 3;
    const ACCION_ASIGNACION_RUTA_RADICACION = 4;
    const ACCION_ASIGNACION_RUTA_APROBACION = 5;
    const ACCION_APROBACION_RUTA_APROBACION = 6;
    const ACCION_APROBACION_VISTO_RUTA_APROBACION = 7;
    const ACCION_RECHAZO_RUTA_APROBACION = 8;
    const ACCION_RECHAZO_VISTO_RUTA_APROBACION = 9;
    const ACCION_CONFIRMACION = 10;
    const ACCION_RADICACION = 11;
    const ACCION_APROBACION = 12;
    const ACCION_DIGITALIZACION = 13;
    const ACCION_VERSIONAMIENTO = 14;
    const ACCION_TRANSFERENCIA = 15;
    const ACCION_VINCULACION_DOCUMENTO = 16;
    const ACCION_VINCULACION_ANEXO = 17;
    const ACCION_CREACION_COMENTARIO = 18;
    const ACCION_VINCULACION_TAREA = 19;

    protected $iddocumento_rastro;
    protected $fk_documento;
    protected $fk_funcionario;
    protected $accion;
    protected $fecha;
    protected $descripcion;
    protected $titulo;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_documento',
                'fk_funcionario',
                'accion',
                'fecha',
                'descripcion',
                'titulo'
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * evento ejecutado previo al insertar
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-08
     */
    public function beforeCreate()
    {
        if (!$this->fecha) {
            $this->fecha = date('Y-m-d H:i:s');
        }

        if (!$this->fk_funcionario) {
            $this->fk_funcionario = SessionController::getValue('idfuncionario');
        }

        return true;
    }
}
