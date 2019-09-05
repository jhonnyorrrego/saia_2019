<?php

class SerieVersion extends Model
{
    protected $idserie_version;
    protected $version;
    protected $nombre;
    protected $tipo;
    protected $descripcion;
    protected $archivo_trd;
    protected $anexos;
    protected $json_clasificacion;
    protected $json_trd;

    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'nombre',
                'version',
                'tipo',
                'descripcion',
                'archivo_trd',
                'anexos',
                'json_clasificacion',
                'json_trd'
            ]
        ];
    }

    public static function getCurrentVersion()
    {
        $subConsulta = "(SELECT MAX(version) FROM serie_version)";
        $sql = self::getQueryBuilder()
            ->select('*')
            ->from('serie_version')
            ->where("version={$subConsulta}");

        $data = self::findByQueryBuilder($sql);

        return !empty($data) ? $data[0] : false;
    }
}
