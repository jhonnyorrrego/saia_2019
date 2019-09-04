<?php

class TRDCloneController
{
    protected $fk_serie_version;
    protected $old_fk_serie_version;

    public function __construct(int $fk_serie_version, int $old_fk_serie_version)
    {
        $this->fk_serie_version = $fk_serie_version;
        $this->old_fk_serie_version = $old_fk_serie_version;
        $this->cloneSerie();
    }


    protected function cloneSerie()
    {
        if ($this->old_fk_serie_version) {

            $sql = "SELECT * FROM serie WHERE estado=1 AND fk_serie_version={$this->old_fk_serie_version} ORDER BY tipo ASC, idserie ASC";
            $data = Serie::findByQueryBuilder($sql);
            $ids = [0 => 0];

            foreach ($data as $SerieClone) {

                $attributesSerie = $SerieClone->getAttributes();
                $attributesSerie['cod_arbol'] = 0;
                $attributesSerie['fk_serie_version'] = $this->fk_serie_version;
                $idpadre = array_search($attributesSerie['cod_padre'], $ids);

                if ($idpadre !== false) {
                    $attributesSerie['cod_padre'] = $idpadre;
                } else {
                    $this->errorException("La serie ID: {$SerieClone->getPK()}, es una serie huerfana no se puede seguir con la clonacion");
                }

                $Serie = new Serie();
                $Serie->setAttributes($attributesSerie);

                if ($id = $Serie->createSerie(0)) {
                    $ids[$id] = $SerieClone->getPK();

                    $sql = "SELECT * FROM dependencia_serie WHERE fk_serie={$SerieClone->getPK()} AND estado=1 ORDER BY iddependencia_serie ASC";
                    $data = DependenciaSerieTemp::findByQueryBuilder($sql);

                    foreach ($data as $DependenciaSerie) {
                        $attributesDep = $DependenciaSerie->getAttributes();
                        $attributesDep['fk_serie'] = $id;
                        if (!DependenciaSerie::newRecord($attributesDep)) {
                            $this->errorException("Error al guardar la vinculacion Dependencia/Serie ID:{$DependenciaSerie->getPK()}");
                        }
                    }
                } else {
                    $this->errorException("Error al clonar la serie ID:{$SerieClone->getPK()}");
                }
            }
        } else {
            $this->errorException("No existe una version anterior");
        }
        return $this;
    }

    private function errorException($message)
    {
        $SerieVersion = new SerieVersion($this->fk_serie_version);
        $SerieVersion->delete();
        throw new Exception($message);
    }
}
