<?php

class EntidadSerie extends Model
{
    protected $identidad_serie;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $estado;
    protected $fecha_creacion;
    protected $fecha_eliminacion;
    protected $dbAttributes;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_serie',
                'fk_dependencia',
                'estado',
                'fecha_creacion',
                'fecha_eliminacion'
            ],
            'date' => [
                'fecha_creacion',
                'fecha_eliminacion'
            ]
        ];
    }
    /**
     * Se ejecuta posterior al editar la Entidad Serie
     * elimina los permisos vinculados
     * 
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterUpdate()
    {
        if (!$this->estado) {
            $PermisoSerie = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $this->identidad_serie]);
            if ($PermisoSerie) {
                foreach ($PermisoSerie as $instance) {
                    $instance->deletePermisoSerie();
                }
            }
            $CajaEntidadserie= CajaEntidadserie::findAllByAttributes(['fk_entidad_serie' => $this->identidad_serie]);
            if ($CajaEntidadserie) {
                foreach ($CajaEntidadserie as $instance) {
                    $instance->delete();
                }
            }
        }
        return true;
    }

    /**
     * Crea la entidad serie con sus correspondientes vinculaciones (expedientes)
     * NO utilizar save/create para crear una entidad serie
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function CreateEntidadSerie() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];
        $sql = "SELECT identidad_serie FROM entidad_serie WHERE fk_serie={$this->fk_serie} and fk_dependencia={$this->fk_dependencia} and estado=0";
        $existEntSer = $this->search($sql);
        if ($existEntSer) {
            $instance = new self($existEntSer[0]['identidad_serie']);
            $instance->estado = 1;
            if ($instance->update()) {
                $response['exito'] = 1;
            } else {
                $response['message'] = 'Error al actualizar la entidad serie';
            }
        } else {
            if ($this->create()) {
                $ValidArbolExp = $this->validArbolExp();
                if ($ValidArbolExp['exito']) {
                    $Serie = $this->getRelationFk('Serie');
                    if ($Serie) {
                        for ($i = 1; $i < 4; $i++) {
                            $codPadreExp = end($ValidArbolExp['data']['idexpediente'][$i]);
                            $ok = 1;
                            if ($Serie->tipo != 1) {
                                $sql = "SELECT idexpediente FROM expediente WHERE fk_dependencia={$this->fk_dependencia} and fk_serie={$Serie->cod_padre} and nucleo=1 and estado=1 and estado_archivo={$i}";
                                $consPadre = $this->search($sql);
                                if ($consPadre) {
                                    $codPadreExp = $consPadre[0]['idexpediente'];
                                } else {
                                    $SeriePadre = $Serie->getCodPadre();
                                    $sql = "SELECT idexpediente FROM expediente WHERE fk_dependencia={$this->fk_dependencia} and fk_serie={$SeriePadre->cod_padre} and nucleo=1 and estado=1 and estado_archivo={$i}";
                                    $ExpPad = $this->search($sql);
                                    if ($ExpPad) {
                                        $Expediente = new Expediente();
                                        $attributes = [
                                            'fecha' => date('Y-m-d H:i:s'),
                                            'nombre' => $SeriePadre->nombre,
                                            'fondo' => $SeriePadre->nombre,
                                            'descripcion' => $SeriePadre->nombre,
                                            'codigo_numero' => $SeriePadre->codigo,
                                            'cod_padre' => $ExpPad[0]['idexpediente'],
                                            'estado_archivo' => $i,
                                            'fk_caja' => 0,
                                            'propietario' => 0,
                                            'responsable' => 0,
                                            'fk_serie' => $SeriePadre->getPK(),
                                            'fk_dependencia' => $this->fk_dependencia,
                                            'cod_arbol' => 0,
                                            'agrupador' => 2,
                                            'fk_entidad_serie' => $this->identidad_serie,
                                            'nucleo' => 1
                                        ];
                                        $Expediente->SetAttributes($attributes);
                                        $infoExpediente = $Expediente->CreateExpediente();
                                        if ($infoExpediente['exito']) {
                                            $codPadreExp = $Expediente->getPK();
                                        }
                                    } else {
                                        $ok = 0;
                                    }
                                }
                            }

                            if ($ok) {
                                $sql = "SELECT idexpediente FROM expediente WHERE fk_dependencia={$this->fk_dependencia} and fk_serie={$this->fk_serie} and nucleo=1 and estado=1 and agrupador=2 and estado_archivo={$i}";
                                $existExp = $this->search($sql);
                                if (!$existExp) {
                                    $Expediente = new Expediente();
                                    $attributes = [
                                        'fecha' => date('Y-m-d H:i:s'),
                                        'nombre' => $Serie->nombre,
                                        'fondo' => $Serie->nombre,
                                        'descripcion' => $Serie->nombre,
                                        'codigo_numero' => $Serie->codigo,
                                        'cod_padre' => $codPadreExp,
                                        'estado_archivo' => $i,
                                        'fk_caja' => 0,
                                        'propietario' => 0,
                                        'responsable' => 0,
                                        'fk_serie' => $this->fk_serie,
                                        'fk_dependencia' => $this->fk_dependencia,
                                        'cod_arbol' => 0,
                                        'agrupador' => 2,
                                        'fk_entidad_serie' => $this->identidad_serie,
                                        'nucleo' => 1
                                    ];
                                    $Expediente->SetAttributes($attributes);
                                    $infoExpediente = $Expediente->CreateExpediente();
                                    if ($infoExpediente['exito']) {
                                        $response['data']['idexpediente'] = $Expediente->getPK();
                                        $response['exito'] = 1;
                                    }
                                } else {
                                    $response['data']['idexpediente'] = $existExp[0]['idexpediente'];
                                    $response['exito'] = 1;
                                }
                            } else {
                                $response['message'] = 'Error al crear el expediente padre';
                                break;
                            }
                        }
                    } else {
                        $response['message'] = 'NO se encontro la serie a vincular';
                    }
                } else {
                    $response['message'] = 'NO se pudo crear la jerarquia de expedientes';
                }

            } else {
                $response['message'] = 'Error al guardar la Entidad Serie';
            }
        }
        return $response;
    }
    /**
     * Encargado de inactivar la entidad serie, NO utilizar update()
     *
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function inactiveEntidadSerie() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];

        $this->estado = 0;
        $this->fecha_eliminacion = date('Y-m-d H:i:s');
        if ($this->update()) {
            $response['exito'] = 1;
        } else {
            $response['message'] = 'Error al inactivar la entidad serie';
        }
        return $response;
    }
    /**
     * Encargado de generar la jerarquia de expedientes
     *
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    private function validArbolExp() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => ''
        ];
        $Dependencia = $this->getRelationFk('Dependencia');

        if ($Dependencia) {
            $idsDep = explode('.', $Dependencia->codigo_arbol);
            $idsCreate = [];
            for ($i = 1; $i < 4; $i++) {
                $idsExp = [];
                foreach ($idsDep as $key => $idDependencia) {
                //TODO: El estado de expediente solo debe cambiarse cuando se elimine la serie que hace relacion
                    $sql = "SELECT idexpediente FROM expediente WHERE fk_dependencia={$idDependencia} and estado_archivo={$i} and nucleo=1 and estado=1 and agrupador=1";
                    $existDep = $this->search($sql);
                    if ($existDep) {
                        $idsExp[$key] = $existDep[0]['idexpediente'];
                    } else {
                        $DependenciaData = new Dependencia($idDependencia);
                        if ($key == 0) {
                            $codPadreExp = $key;
                        } else {
                            $codPadreExp = $idsExp[$key - 1];
                        }
                        $Expediente = new Expediente();
                        $attributes = [
                            'fecha' => date('Y-m-d H:i:s'),
                            'nombre' => $DependenciaData->nombre,
                            'fondo' => $DependenciaData->nombre,
                            'descripcion' => $DependenciaData->nombre,
                            'codigo_numero' => $DependenciaData->codigo,
                            'cod_padre' => $codPadreExp,
                            'estado_archivo' => $i,
                            'fk_caja' => 0,
                            'propietario' => 0,
                            'responsable' => 0,
                            'fk_serie' => 0,
                            'fk_dependencia' => $idDependencia,
                            'cod_arbol' => 0,
                            'agrupador' => 1,
                            'fk_entidad_serie' => 0,
                            'nucleo' => 1
                        ];
                        $Expediente->SetAttributes($attributes);
                        $infoExpediente = $Expediente->CreateExpediente();
                        if ($infoExpediente['exito']) {
                            $idsExp[$key] = $Expediente->getPK();
                        }
                    }
                }
                $idsCreate[$i] = $idsExp;
            }
            if (count($idsDep) == count($idsCreate[3])) {
                $response['exito'] = 1;
                $response['data']['idexpediente'] = $idsCreate;
            } else {
                $response['message'] = 'Error, No se crearon todos los expedientes';
            }
        } else {
            $response['message'] = 'Error, la dependencia NO existe! id:' . $this->fk_dependencia;
        }
        return $response;
    }

    /**
     * Obtiene los expedientes vinculados a la entidad serie
     *
     * @param int $instance : 1, retorna las instancias; 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteFk(int $instance = 1)
    {
        if ($instance) {
            $data = Expediente::findAllByAttributes(['fk_entidad_serie' => $this->identidad_serie]);
        } else {
            $data = Expediente::findColumn('idexpediente', ['fk_entidad_serie' => $this->identidad_serie]);
        }
        return $data;
    }

    /**
     * Obtiene los permisos vinculados a la entidad serie
     *
     * @param int $instance : 1, retorna las instancias; 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getPermisoSerieFk(int $instance = 1)
    {
        if ($instance) {
            $data = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $this->identidad_serie]);
        } else {
            $data = PermisoSerie::findColumn('idpermiso_serie', ['fk_entidad_serie' => $this->identidad_serie]);
        }
        return $data;
    }

}