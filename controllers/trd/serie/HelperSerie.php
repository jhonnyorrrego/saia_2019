<?php

use \Doctrine\DBAL\Types\Type;

class HelperSerie
{

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
    public function existCodSerie(string $table, string $codigo, int $type = null): bool
    {
        $query = Model::getQueryBuilder()
            ->select('idserie')
            ->from($table)
            ->where('codigo=:codigo')
            ->setParameter(':codigo', $codigo, Type::STRING);

        if (!is_null($type)) {
            $query->andWhere('tipo=:tipo')
                ->setParameter(':tipo', $type, Type::INTEGER);
        }
        return $query->execute()->fetch() ? true : false;
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
    public static function existSerieDep(string $table, int $idserie, int $iddependencia): bool
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

        return $query->execute()->fetch() ? true : false;
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
        int $codPadre = 0
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

        if ($tipo == 2) {
            $query->andWhere('s.cod_padre=:cod_padre')
                ->setParameter(':cod_padre', $codPadre, Type::INTEGER);
        }
        $response = $query->execute()->fetch();

        if (!$response && $tipo == 1) {

            $query2 = Model::getQueryBuilder()
                ->select('idserie,nombre')
                ->from($table)
                ->where('tipo=1')
                ->andWhere('codigo like :cod_serie')
                ->setParameter(':cod_serie', $codSerie, Type::STRING);
            $response = $query2->execute()->fetch();
        }

        return $response;
    }
}
