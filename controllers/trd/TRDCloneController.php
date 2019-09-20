<?php

use \Doctrine\DBAL\Types\Type;

class TRDCloneController
{
    protected $newFkSerieVersion;

    public function __construct(int $newFkSerieVersion)
    {
        $this->newFkSerieVersion = $newFkSerieVersion;
        $this->cloneSerie();
    }

    protected function cloneSerie()
    {
        if ($CurrentVersion = SerieVersion::getCurrentVersion()) {

            $QueryBuilder = Serie::getQueryBuilder()
                ->select('*')
                ->from('serie')
                ->where('estado=1 AND fk_serie_version=:old')
                ->orderBy('tipo', 'ASC')
                ->addOrderBy('idserie', 'ASC')
                ->setParameter(':old', $CurrentVersion->getPK(), Type::INTEGER);

            $data = Serie::findByQueryBuilder($QueryBuilder);
            $ids = [0 => 0];

            foreach ($data as $SerieClone) {
                $attributesSerie = $SerieClone->getAttributes();
                $attributesSerie['fk_serie_version'] = $this->newFkSerieVersion;

                $idpadre = array_search($attributesSerie['cod_padre'], $ids);
                if ($idpadre !== false) {
                    $attributesSerie['cod_padre'] = $idpadre;
                } else {
                    $this->errorException("La serie ID: {$SerieClone->getPK()}, es una serie huerfana no se puede seguir con la clonacion");
                }

                if ($id = SerieTemp::newRecord($attributesSerie)) {
                    $ids[$id] = $SerieClone->getPK();

                    $QueryBuilder = SerieDependencia::getQueryBuilder()
                        ->select('*')
                        ->from('serie_dependencia')
                        ->where('estado=1 AND fk_serie=:idserie')
                        ->orderBy('idserie_dependencia', 'ASC')
                        ->setParameter(':idserie', $SerieClone->getPK(), Type::INTEGER);

                    $data = SerieDependencia::findByQueryBuilder($QueryBuilder);

                    foreach ($data as $SerieDependenciaClone) {
                        $attributesDep = $SerieDependenciaClone->getAttributes();
                        $attributesDep['fk_serie'] = $id;
                        if (!SerieDependenciaTemp::newRecord($attributesDep)) {
                            $this->errorException("Error al guardar la vinculacion Dependencia/Serie ID:{$SerieDependenciaClone->getPK()}");
                        }
                    }
                } else {
                    $this->errorException("Error al clonar la serie ID:{$SerieClone->getPK()}");
                }
            }
        } else {
            $this->errorException("Error al consultar la TRD actual");
        }
        return $this;
    }

    private function errorException($message)
    {
        throw new Exception($message);
    }
}
