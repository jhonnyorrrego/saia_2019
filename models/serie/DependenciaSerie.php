<?php

use \Doctrine\DBAL\Types\Type;

class DependenciaSerie extends Model
{
    protected $iddependencia_serie;
    protected $fk_serie;
    protected $fk_dependencia;

    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_serie',
                'fk_dependencia'
            ]
        ];
    }

    public static function getDataDependenciaSerie(int $iddep, int $tipo, int $codPadre = null): array
    {
        $idVersion = SerieVersion::getCurrentVersion()->getPK();

        $QueryBuilder = self::getQueryBuilder()
            ->select('s.idserie,s.nombre,s.codigo')
            ->from('dependencia_serie', 'ds')
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
}
