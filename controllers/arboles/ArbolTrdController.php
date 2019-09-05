<?php
//POR EL MOMENTO NO SE USA ESTE SCRIPT=> BORRAR
class ArbolTrdController
{
    public $id;
    protected $cache;
    protected $objetoJson;

    public function __construct(int $cache = 1, int $id = 0)
    {
        $this->id = $id;
        $this->cache = $cache;

        $this->init();
    }

    public function init()
    {
        if ($file = self::getRouteFile()) {
            if (is_file($file) && $this->cache) {
                $this->objetoJson = json_decode(file_get_contents($file), true);
            } else {
                $idVersion = self::getIdVersion();
                $hijos = self::llena_dependencia($this->id, $idVersion);
                $objetoJson = [
                    'key' => 0,
                    'children' => $hijos
                ];
                if ($this->cache) {
                    file_put_contents($file, json_encode($objetoJson));
                }
                $this->objetoJson = $objetoJson;
            }
        }
        return $this;
    }

    public function getObjetoJson()
    {
        return $this->objetoJson;
    }

    public static function getRouteFile()
    {
        global $ruta_db_superior;

        $dir = $ruta_db_superior . TemporalController::$saiaDir;

        if (!file_exists($dir)) {
            if (!mkdir($dir, PERMISOS_CARPETAS, TRUE)) {
                return false;
            }
        }
        return $dir . '/arbolTrd.txt';
    }

    public static function removeFile()
    {
        if ($file = self::getRouteFile()) {
            return unlink($file);
        }
        return false;
    }

    public static function getIdVersion()
    {
        $Version = SerieVersion::getCurrentVersion();
        return $Version->getPK();
    }

    public static function llena_dependencia(int $id, $idVersion = null)
    {
        if (!$idVersion) {
            $idVersion = self::getIdVersion();
        }

        $objetoJson = [];
        if ($id == 0) {

            $dataDep = Dependencia::getQueryBuilder()
                ->select('iddependencia,codigo,nombre,estado')
                ->from('dependencia')
                ->where('cod_padre=0 or cod_padre is null')
                ->orderBy('nombre', 'ASC')
                ->execute()->fetchAll();
        } else {

            $dataDep = Dependencia::getQueryBuilder()
                ->select('iddependencia,sigla,codigo,nombre,estado')
                ->from('dependencia')
                ->where('cod_padre=:id')
                ->orderBy('nombre', 'ASC')
                ->setParameter(':id', $id, 'integer')
                ->execute()->fetchAll();
        }

        if (!empty($dataDep)) {

            foreach ($dataDep as $data) {

                $info = [
                    'iddependencia' => (int) $data['iddependencia'],
                    'codigo' => $data['codigo'],
                    'sigla' => $data['sigla']
                ];

                $hijosDep = [];
                $cantHijosDep = Dependencia::getQueryBuilder()
                    ->select('count(*) as cant')
                    ->from('dependencia')
                    ->where('cod_padre=:id')
                    ->setParameter(':id', $data['iddependencia'], 'integer')
                    ->execute()->fetch();

                if ($cantHijosDep['cant']) {
                    $hijosDep = self::llena_dependencia($data['iddependencia'], $idVersion);
                }

                $hijosSerie = self::llena_serie(0, $data['iddependencia'], $idVersion);

                $dataHijos = array_merge($hijosDep, $hijosSerie);

                $text = "{$data['nombre']} ({$data['sigla']} {$data['codigo']})";
                if ($data['estado'] == 0) {
                    $text .= " - INACTIVO";
                }

                $item = [
                    'key' => "{$data['iddependencia']}.0",
                    'title' => $text,
                    'extraClasses' => 'style-dep',
                    'data' => $info
                ];

                if (!empty($dataHijos)) {
                    $item['children'] = $dataHijos;
                }
                $objetoJson[] = $item;
            }
        }
        return $objetoJson;
    }

    public static function llena_serie(int $idserie, int $iddep, $idVersion = null)
    {
        if (!$idVersion) {
            $idVersion = self::getIdVersion();
        }

        $objetoJson = [];
        if ($idserie == 0) {

            $QueryBuilder = DependenciaSerie::getQueryBuilder();
            $dataDepSerie = $QueryBuilder
                ->select('ds.fk_serie,ds.fk_dependencia,ds.iddependencia_serie,s.nombre,s.codigo,s.estado')
                ->from('dependencia_serie', 'ds')
                ->innerJoin('ds', 'serie', 's', 's.idserie=ds.fk_serie')
                ->where('ds.estado=1 and ds.fk_dependencia=:iddependencia')
                ->andWhere('s.fk_serie_version=:idversion')
                ->andWhere(
                    $QueryBuilder->expr()->orX(
                        "s.cod_padre is null",
                        "s.cod_padre=0"
                    )
                )
                ->orderBy('s.nombre', 'ASC')
                ->setParameters(
                    [
                        ':iddependencia' => $iddep,
                        ':idversion' =>  $idVersion
                    ],
                    [
                        'integer', 'integer'
                    ]
                )
                ->execute()->fetchAll();
        } else {

            $dataDepSerie = Serie::getQueryBuilder()
                ->select('ds.fk_serie,ds.fk_dependencia,ds.iddependencia_serie,s.nombre,s.codigo,s.estado')
                ->from('dependencia_serie', 'ds')
                ->innerJoin('ds', 'serie', 's', 's.idserie=ds.fk_serie')
                ->where('ds.estado=1 and ds.fk_dependencia=:iddependencia')
                ->andWhere('s.fk_serie_version=:idversion')
                ->andWhere('s.cod_padre=:cod_padre')
                ->setParameters(
                    [
                        ':iddependencia' => $iddep,
                        ':cod_padre' => $idserie,
                        ':idversion' =>  $idVersion
                    ],
                    [
                        'integer', 'integer', 'integer'
                    ]
                )
                ->execute()->fetchAll();
        }

        if (!empty($dataDepSerie)) {

            foreach ($dataDepSerie as $data) {

                $info = [
                    'iddependencia_serie' => (int) $data['iddependencia_serie'],
                    'iddependencia' => (int) $data['fk_dependencia'],
                    'idserie' => (int) $data['fk_serie']
                ];

                $dataHijos = self::llena_serie($data['fk_serie'], $data['fk_dependencia']);

                $text = "{$data['nombre']} ({$data['codigo']})";
                if ($data['estado'] == 0) {
                    $text .= " - INACTIVO";
                }

                $item = [
                    'key' => "{$data['fk_dependencia']}.{$data['fk_serie']}",
                    'title' => $text,
                    'data' => $info
                ];

                if (!empty($dataHijos)) {
                    $item['children'] = $dataHijos;
                }

                $objetoJson[] = $item;
            }
        } else if ($idserie) {
            if ($tipos = self::llena_tipo($idserie, $iddep)) {
                $objetoJson = $tipos;
            }
        }
        return $objetoJson;
    }

    public static function llena_tipo(int $idserie, int $iddep)
    {
        $objetoJson = [];

        $tipoDocumental = Serie::getQueryBuilder()
            ->select('idserie,nombre,estado')
            ->from('serie')
            ->where('tipo=3 AND cod_padre=:id')
            ->setParameter(':id', $idserie, 'integer')
            ->execute()->fetchAll();

        if (!empty($tipoDocumental)) {

            foreach ($tipoDocumental as $data) {
                $info = [
                    'iddependencia_serie' => 0,
                    'iddependencia' => $iddep,
                    'idserie' => (int) $data['idserie']
                ];

                $text = $data['nombre'];
                if ($data['estado'] == 0) {
                    $text .= " - INACTIVO";
                }

                $item = [
                    'key' => "{$iddep}.{$data['idserie']}",
                    'title' => $text,
                    'data' => $info
                ];
                $objetoJson[] = $item;
            }
            return $objetoJson;
        }
        return false;
    }
}
