<?php

use \Doctrine\DBAL\Types\Type;

class HelperSerie
{

    public static function getAllSerie(string $table)
    {
        $query = Model::getQueryBuilder()
            ->select('idserie,codigo,nombre');
        switch ($table) {

            case 'serie_temp':
                $SerieVersion = SerieVersion::getTempVersion();
                $query->from('serie_temp', 's')
                    ->where('fk_serie_version=:idSerieVersion');
                break;

            default:
                $SerieVersion = SerieVersion::getCurrentVersion();
                $query->from('serie', 's')
                    ->where('fk_serie_version=:idSerieVersion');
                break;
        }

        $query->andWhere('estado=1 and cod_padre=0')
            ->setParameter(':idSerieVersion', $SerieVersion->getPK(), Type::INTEGER)
            ->orderBy('nombre', 'ASC');

        return $query->execute()->fetchAll();
    }

    public static function getAllSerieDependencia(string $table, int $idserie)
    {


        $query = Model::getQueryBuilder()
            ->select('s.idserie,s.codigo,s.nombre,d.iddependencia,
        d.nombre as nombre_dep,d.codigo as codigo_dep,
        idserie_dependencia as id,sd.estado');

        switch ($table) {

            case 'serie_temp':
                $SerieVersion = SerieVersion::getTempVersion();
                $query->from('serie_temp', 's')
                    ->innerJoin('s', 'serie_dependencia_temp', 'sd', 's.idserie=sd.fk_serie');
                break;

            default:
                $SerieVersion = SerieVersion::getCurrentVersion();
                $query->from('serie', 's')
                    ->innerJoin('s', 'serie_dependencia', 'sd', 's.idserie=sd.fk_serie');
                break;
        }

        $query->innerJoin('sd', 'dependencia', 'd', 'sd.fk_dependencia=d.iddependencia')
            ->where('s.estado=1 and s.cod_padre=:cod_padre')
            ->andWhere('fk_serie_version=:idSerieVersion')
            ->orderBy('s.nombre', 'ASC')
            ->setParameters(
                [
                    ':cod_padre' => $idserie,
                    ':idSerieVersion' => $SerieVersion->getPK()
                ],
                [
                    ':cod_padre', Type::INTEGER,
                    ':idSerieVersion', Type::INTEGER
                ]
            );

        return $query->execute()->fetchAll();
    }

    public static function SQLCodSerie(
        string $table,
        string $codigo,
        int $type = 0,
        int $idExclude = 0
    ) {
        $query = Model::getQueryBuilder()
            ->select('idserie,nombre')
            ->from($table)
            ->where('codigo=:codigo')
            ->setParameter(':codigo', $codigo, Type::STRING);

        if ($type) {
            $query->andWhere('tipo=:tipo')
                ->setParameter(':tipo', $type, Type::INTEGER);
        }

        if ($idExclude) {
            $query->andWhere('idserie<>:idserie')
                ->setParameter(':idserie', $idExclude, Type::INTEGER);
        }
        return $query->execute()->fetch();
    }

    /**
     * valida si el codigo de una serie existe
     *
     * @param string $table
     * @param string $codigo
     * @param integer $type
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function existCodSerie(
        string $table,
        string $codigo,
        int $type = 0,
        int $idExclude = 0
    ): bool {
        $query = self::SQLCodSerie($table, $codigo, $type, $idExclude);
        return $query ? true : false;
    }

    public static function querySerieDep(string $table, int $idserie, int $iddependencia)
    {
        $query = Model::getQueryBuilder()
            ->select('d.idserie_dependencia');

        switch ($table) {

            case 'serie_temp':
                $query->from('serie_temp', 's')
                    ->innerJoin('s', 'serie_dependencia_temp', 'd', 's.idserie=d.fk_serie');
                break;

            default:
                $query->from('serie', 's')
                    ->innerJoin('s', 'serie_dependencia', 'd', 's.idserie=d.fk_serie');
                break;
        }

        $query->where('d.fk_dependencia=:iddependencia')
            ->andWhere('d.fk_serie=:idserie')
            ->setParameters(
                [
                    ':iddependencia' => $iddependencia,
                    ':idserie' => $idserie
                ],
                [
                    ':iddependencia', Type::INTEGER,
                    ':idserie', Type::INTEGER
                ]
            );

        return $query->execute()->fetch();
    }


    /**
     * Valida si una serie/subserie ya esta vinculada a la dependencia
     *
     * @param string $table
     * @param integer $idserie
     * @param integer $iddependencia
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function existSerieDep(
        string $table,
        int $idserie,
        int $iddependencia
    ): bool {
        return self::querySerieDep($table, $idserie, $iddependencia) ? true : false;
    }
    /**
     * Valida que el codigo de la serie no este vinculada
     * a la dependencia
     *
     * @param integer $tipo
     * @param string $codSerie
     * @param integer $iddep
     * @param integer $codPadre
     * @return array|false
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function validateSerieDependencia(
        string $table,
        int $tipo,
        string $codSerie,
        int $iddep,
        int $codPadre = 0,
        int $idExclude = 0
    ) {
        $query = Model::getQueryBuilder()
            ->select('idserie,nombre');

        switch ($table) {

            case 'serie_temp':
                $query->from('serie_temp', 's')
                    ->innerJoin('s', 'serie_dependencia_temp', 'd', 's.idserie=d.fk_serie');
                break;

            default:
                $query->from('serie', 's')
                    ->innerJoin('s', 'serie_dependencia', 'd', 's.idserie=d.fk_serie');
                break;
        }

        $query->where('d.fk_dependencia=:iddependencia')
            ->andWhere('s.codigo like :cod_serie')
            ->andWhere('s.tipo=:tipo')
            ->setParameters(
                [
                    ':iddependencia' => $iddep,
                    ':cod_serie' => $codSerie,
                    ':tipo' => $tipo
                ],
                [
                    ':iddependencia', Type::INTEGER,
                    ':cod_serie', Type::STRING,
                    ':tipo', Type::INTEGER
                ]
            );

        if ($idExclude) {
            $query->andWhere('s.idserie<>:idserie')
                ->setParameter(':idserie', $idExclude, Type::INTEGER);
        }

        if ($tipo == 2) {
            $query->andWhere('s.cod_padre=:cod_padre')
                ->setParameter(':cod_padre', $codPadre, Type::INTEGER);
        }
        $response = $query->execute()->fetch();

        if (!$response && $tipo == 1) {
            return self::SQLCodSerie($table, $codSerie, 1, $idExclude);
        }

        return $response;
    }
}
