<?php

class Flujo extends Model implements IAnexos
{

    use TFlujo;

    protected $idflujo;
    protected $nombre;
    protected $descripcion;
    protected $codigo;
    protected $version;
    protected $expediente;
    protected $diagrama;
    protected $duracion;
    protected $fecha_creacion;
    protected $fecha_modificacion;
    protected $version_actual;
    protected $mostrar_codigo;
    protected $info;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                "nombre",
                "descripcion",
                "codigo",
                "version",
                "expediente",
                "diagrama",
                "duracion",
                "version_actual",
                "fecha_creacion",
                "fecha_modificacion",
                "info",
                "mostrar_codigo"
            ],
            'date' => [
                "fecha_creacion",
                "fecha_modificacion",
            ],
            "table" => "wf_flujo",
            "primary" => "idflujo"
        ];
    }

    public function findActiveFiles($params)
    {
        $sql = <<<SQL
            select a.*
            from anexo a 
            join wf_anexo_flujo af
                on a.idanexo = af.fk_anexo 
            join wf_flujo f
                on af.fk_flujo = f.idflujo
            where 
                f.idflujo = $this->idflujo and a.eliminado = 0
            order by $params->order
SQL;
        //$records = //ejecuta el select

        return self::convertToArray($records);
    }
}
