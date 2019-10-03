<?php

use \Doctrine\DBAL\Types\Type;

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
        if (!$data) {
            throw new Exception("No hay datos en la TRD", 1);
        }

        $ids = [0 => 0];
        $addPermiso = [];
        foreach ($data as $SerieTemp) {
            $this->validateRow($SerieTemp->fk_serie_version);

            $attributesSerie = $SerieTemp->getAttributes();
            $attributesSerie['estado'] = 1;
            $attributesSerie['cod_arbol'] = 0;
            $attributesSerie['cod_padre'] = array_search($attributesSerie['cod_padre'], $ids);

            if ($id = Serie::newRecord($attributesSerie)) {
                $ids[$id] = $SerieTemp->getPK();
                $addPermiso[$id] = $SerieTemp->permiso;
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

            if ($idSerieDep = SerieDependencia::newRecord($attributesDep)) {
                if ($addPermiso[$attributesDep['fk_serie']]) {

                    $dataFun = Model::getQueryBuilder()
                        ->select('DISTINCT idfuncionario')
                        ->from('vfuncionario_dc')
                        ->where('estado=1 and estado_dc=1')
                        ->andWhere('iddependencia=:iddependencia')
                        ->setParameter(':iddependencia', $attributesDep['fk_dependencia'], Type::INTEGER)
                        ->execute()->fetchAll();

                    foreach ($dataFun as $row) {
                        if (!Acceso::newRecord([
                            'tipo_relacion' => Acceso::TIPO_SERIE_DEPENDENCIA,
                            'id_relacion' => $idSerieDep,
                            'fk_funcionario' => $row['idfuncionario'],
                            'accion' => Acceso::ACCION_VER,
                            'fecha' => date('Y-m-d H:i:s')
                        ])) {
                            $this->errorException("Error al dar permisos al funcionario ID:{$row['idfuncionario']}");
                        }
                    }
                }
            } else {
                $this->errorException("Error al guardar la vinculacion Serie/Dependencia ID:{$SerieDependencia->getPK()}");
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
