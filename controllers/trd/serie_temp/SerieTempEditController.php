<?php

class SerieTempEditController
{
    public $request;
    public $Serie;
    public $delete = [];
    public $insert = [];

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->Serie = new SerieTemp($request['idserie']);

        $this->validateFields();
    }

    public function validateFields()
    {

        if ($this->Serie->tipo != 3) {

            if ($this->request['onlytype'] == 1 || $this->Serie->tipo == 2) {

                if (!$iddep = $this->request['dependencia']) {
                    throw new Exception('Dependencia invalida', 1);
                }

                if (!$idSerieDependencia = $this->request['idserie_dependencia']) {
                    throw new Exception("Error Processing Request", 1);
                }

                $this->SerieDependencia = new SerieDependenciaTemp($idSerieDependencia);
                if (
                    $this->SerieDependencia->fk_dependencia != $this->request['old_dependencia']
                    ||
                    $this->SerieDependencia->fk_serie != $this->request['idserie']
                ) {
                    throw new Exception("Error Processing Request", 1);
                }

                if ($iddep == $this->request['old_dependencia']) {
                    if ($this->Serie->codigo != $this->request['codigo']) {
                        $this->validSerieDependencia();
                    }
                } else {
                    $this->validChangeDependencia();
                }
            } elseif ($this->Serie->codigo != $this->request['codigo']) {
                $this->request['dependencia'] = $this->request['old_dependencia'];
                $this->validSerieDependencia();
            }
        }
    }

    public function validSerieDependencia(int $idExclude = 0)
    {

        if (HelperSerie::validateSerieDependencia(
            'serie_temp',
            $this->Serie->tipo,
            $this->request['codigo'],
            $this->request['dependencia'],
            $this->Serie->cod_padre ? $this->Serie->cod_padre : 0,
            $idExclude
        )) {
            throw new Exception("El código ingresado: ({$this->request['codigo']}) ya existe o ya encuentra asignado a la dependencia", 1);
        }
    }

    public function validChangeDependencia()
    {
        $this->delete[] = $this->request['idserie_dependencia'];
        $this->insert[] = [
            'fk_dependencia' => $this->request['dependencia'],
            'fk_serie' => $this->request['idserie']
        ];

        if ($this->Serie->tipo == 2) {

            if ($data = HelperSerie::querySerieDep(
                'serie_temp',
                $this->Serie->cod_padre,
                $this->request['old_dependencia']
            )) {
                $this->delete[] = $data['idserie_dependencia'];
                $this->insert[] = [
                    'fk_dependencia' => $this->request['dependencia'],
                    'fk_serie' => $this->Serie->cod_padre
                ];
            } else {
                throw new Exception("No se encuentra la relacion de la serie padre", 1);
            }
        }

        $this->validSerieDependencia($this->request['idserie']);
    }

    public function updateSerieTemp()
    {
        unset($this->request['idserie']);
        unset($this->request['old_dependencia']);
        unset($this->request['onlytype']);
        unset($this->request['key']);
        unset($this->request['token']);

        if (!empty($this->delete)) {
            foreach ($this->delete as $idSerieDependencia) {
                if (!(new SerieDependenciaTemp($idSerieDependencia))->delete()) {
                    throw new Exception("Error al eliminar los registros", 1);
                }
            }
        }

        if (!empty($this->insert)) {
            foreach ($this->insert as $dataSerieDep) {
                if (!SerieDependenciaTemp::newRecord($dataSerieDep)) {
                    throw new Exception("Error al vincular los registros", 1);
                }
            }
        }

        $data = $this->request;

        if (isset($this->request['disposicion'])) {
            $data['dis_eliminacion'] = ($this->request['disposicion'] == 'E') ? 1 : 0;
            $data['dis_conservacion'] = ($this->request['disposicion'] == 'CT') ? 1 : 0;
            $data['dis_seleccion'] = ($this->request['disposicion'] == 'S') ? 1 : 0;
            $data['dis_microfilma'] = (empty($this->request['dis_microfilma'])) ? 0 : 1;
        }

        if (isset($this->request['soporte'])) {
            $data['sop_papel'] = (in_array('P', $this->request['soporte']) !== false)
                ? 1 : 0;
            $data['sop_electronico'] = (in_array('EL', $this->request['soporte']) !== false)
                ? 1 : 0;
        }

        $this->Serie->setAttributes($data);
        if ($this->Serie->update()) {
            return true;
        }
        return false;
    }
}
