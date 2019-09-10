<?php

class Asignacion extends Model
{
    protected $idasignacion;
    protected $tarea_idtarea;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $documento_iddocumento;
    protected $serie_idserie;
    protected $estado;
    protected $entidad_identidad;
    protected $llave_entidad;
    protected $reprograma;
    protected $tipo_reprograma;
    protected $descripcion;

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
                'tarea_idtarea',
                'documento_iddocumento',
                'serie_idserie',
                'estado',
                'entidad_identidad',
                'llave_entidad',
                'reprograma',
                'tipo_reprograma',
                'descripcion'
            ],
            'date' => [
                'fecha_inicial',
                'fecha_final'
            ]
        ];
    }
}
