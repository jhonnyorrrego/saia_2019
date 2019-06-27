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
        $this->dbAttributes = (object)[
            'safe' => [
                'version',
                'nombre',
                'tipo',
                'descripcion',
                'archivo_trd',
                'anexos',
                'json_clasificacion',
                'json_trd'
            ]
        ];
    }

    public static function VersionActual()
    {
        $id = SerieVersion::search("SELECT MAX(idserie_version) AS id FROM serie_version");
        if (!empty($id)) {
            return new SerieVersion($id[0]);
        } else {
            throw new Exception("No existe una version actual de la TRD");
        }
    }
}
