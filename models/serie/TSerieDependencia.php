<?php

use \Doctrine\DBAL\Types\Type;

trait TSerieDependencia
{
    public $classSerieDependencia;
    public $classSerie;

    /**
     * retorna la instancia de la dependencia
     *
     * @return Dependencia
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getDependenciaFk(): Dependencia
    {
        return new Dependencia($this->fk_dependencia);
    }

    public static function getDataSerieDependencia(...$params)
    {
        return (get_called_class() == 'SerieDependenciaTemp') ?
            self::findSerieDependenciaTemp(...$params) : self::findSerieDependencia(...$params);
    }

    private static function findSerieDependencia(
        int $iddep,
        int $tipo,
        int $codPadre = null
    ) {
        $idVersion = SerieVersion::getCurrentVersion()->getPK();

        $QueryBuilder = self::getQueryBuilder()
            ->select('s.idserie,s.nombre,s.codigo')
            ->from('serie_dependencia', 'ds')
            ->innerJoin('ds', 'serie', 's', 's.idserie=ds.fk_serie')
            ->where('ds.estado=1 and s.estado=1 and ds.fk_dependencia=:iddependencia')
            ->andWhere('s.tipo=:tipo')
            ->andWhere('s.fk_serie_version=:idversion')
            ->setParameters(
                [
                    ':iddependencia' => $iddep,
                    ':tipo' =>  $tipo,
                    ':idversion' =>  $idVersion
                ],
                [
                    ':iddependencia' => Type::INTEGER,
                    ':tipo' => Type::INTEGER,
                    ':idversion' =>  Type::INTEGER
                ]
            )
            ->orderBy('s.nombre', 'ASC');

        if (!is_null($codPadre)) {
            $QueryBuilder
                ->andWhere('s.cod_padre=:cod_padre')
                ->setParameter(':cod_padre', $codPadre, Type::INTEGER);
        }

        return $QueryBuilder
            ->execute()->fetchAll();
    }

    private static function findSerieDependenciaTemp(
        int $iddep,
        int $tipo,
        int $codPadre = null
    ) {

        $QueryBuilder = self::getQueryBuilder()
            ->select('s.idserie,s.nombre,s.codigo')
            ->from('serie_dependencia_temp', 'ds')
            ->innerJoin('ds', 'serie_temp', 's', 's.idserie=ds.fk_serie')
            ->where('ds.fk_dependencia=:iddependencia')
            ->andWhere('s.tipo=:tipo')
            ->setParameters(
                [
                    ':iddependencia' => $iddep,
                    ':tipo' =>  $tipo
                ],
                [
                    ':iddependencia' => Type::INTEGER,
                    ':tipo' => Type::INTEGER
                ]
            )
            ->orderBy('s.nombre', 'ASC');

        if (!is_null($codPadre)) {
            $QueryBuilder
                ->andWhere('s.cod_padre=:cod_padre')
                ->setParameter(':cod_padre', $codPadre, Type::INTEGER);
        }

        return $QueryBuilder
            ->execute()->fetchAll();
    }
}
