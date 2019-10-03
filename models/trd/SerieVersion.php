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
    protected $estado;
    protected $vigente;

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
                'json_trd',
                'estado',
                'vigente'
            ]
        ];
    }

    /**
     * SQL que obtiene el registro de la version actual
     *
     * @return Doctrine\DBAL\Query\QueryBuilder
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    private static function getSQLCurrentVersion(): Doctrine\DBAL\Query\QueryBuilder
    {
        return self::getQueryBuilder()
            ->select('*')
            ->from('serie_version')
            ->where("vigente=1");
    }

    /**
     * obtiene una instancia de la version actual
     *
     * @return SerieVersion|false
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function getCurrentVersion()
    {
        $data = self::findByQueryBuilder(
            self::getSQLCurrentVersion()
        );

        return !empty($data) ? $data[0] : false;
    }


    /**
     * obtiene una instancia de la version temporal
     *
     * @return SerieVersion|false
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function getTempVersion()
    {
        $sql = self::getQueryBuilder()
            ->select('*')
            ->from('serie_version')
            ->where("estado=2");

        $data = self::findByQueryBuilder($sql);

        return !empty($data) ? $data[0] : false;
    }

    /**
     * Verifica si existe una version actual
     *
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function existCurrentVersion(): bool
    {
        return self::getSQLCurrentVersion()->execute()->fetch()
            ? true : false;
    }

    /**
     * Verifica si existe una version temporal/borrador
     *
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function existTemporalVersion(): bool
    {
        $data = self::getQueryBuilder()
            ->select('idserie_version')
            ->from('serie_version')
            ->where("estado=2")
            ->execute()->fetch();

        return $data ? true : false;
    }
}
