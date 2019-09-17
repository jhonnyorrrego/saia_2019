<?php

use \Doctrine\DBAL\Types\Type;

trait TRDTrait
{
    /**
     * Valida que el codigo de la serie no este vinculada
     * a la dependencia
     *
     * @param integer $tipo
     * @param string $codSerie
     * @param integer $iddep
     * @param integer $codPadre
     * @return void
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public function validateDependenciaSerie(int $tipo, string $codSerie, int $iddep, int $codPadre = 0)
    {
        $query = Model::getQueryBuilder()
            ->select('idserie,nombre');

        switch (get_class($this)) {

            case 'TRDLoadController':
                $query->from('serie_temp', 's')
                    ->innerJoin('s', 'dependencia_serie_temp', 'd', 's.idserie=d.fk_serie');
                break;

            default: //SerieController //Serie
                $query->from('serie', 's')
                    ->innerJoin('s', 'dependencia_serie', 'd', 's.idserie=d.fk_serie');
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

        return $query->execute()->fetch();
    }
}
