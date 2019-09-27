<?php

class TRDSaveController
{
    public $idserieVersion;

    public function __construct(int $idserieVersion)
    {
        $this->idserieVersion = $idserieVersion;
        $this->saveSerie();
    }

    private function saveSerie()
    {
        $sql = SerieTemp::getQueryBuilder()
            ->select('*')
            ->from('serie_temp')
            ->orderBy('idserie', 'ASC');

        $data = SerieTemp::findByQueryBuilder($sql);

        $ids = [0 => 0];
        foreach ($data as $SerieTemp) {
            $this->validateRow($SerieTemp->fk_serie_version);

            $attributesSerie = $SerieTemp->getAttributes();
            $attributesSerie['estado'] = 1;
            $attributesSerie['cod_arbol'] = 0;
            $attributesSerie['cod_padre'] = array_search($attributesSerie['cod_padre'], $ids);

            if ($id = Serie::newRecord($attributesSerie)) {
                $ids[$id] = $SerieTemp->getPK();
            } else {
                $this->errorException("Error al guardar la serie ID:{$SerieTemp->getPK()}");
            }
        }

        $sql = SerieDependenciaTemp::getQueryBuilder()
            ->select('*')
            ->from('serie_dependencia_temp')
            ->orderBy('idserie_dependencia', 'ASC');

        $data = SerieDependenciaTemp::findByQueryBuilder($sql);

        foreach ($data as $SerieDependencia) {

            $attributesDep = $SerieDependencia->getAttributes();
            $attributesDep['fk_serie'] = array_search($attributesDep['fk_serie'], $ids);

            if (!SerieDependencia::newRecord($attributesDep)) {
                $this->errorException("Error al guardar la vinculacion Dependencia/Serie ID:{$SerieDependencia->getPK()}");
            }
        }
        TRDVersionController::removeTemporalFile(1);
        TRDVersionController::removeTemporalFile(2);
    }

    private function validateRow($idVersion)
    {
        if ($this->idserieVersion != $idVersion) {
            $this->errorException("Error al validar la version de la TRD");
        }
    }

    private function errorException($message)
    {
        throw new Exception($message, 1);
    }
}
