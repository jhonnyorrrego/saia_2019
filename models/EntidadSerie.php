<?php

require_once $ruta_db_superior . 'controllers/autoload.php';

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
            $PermisoSerie = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $this->getPK()]);
            if ($PermisoSerie) {
                foreach ($PermisoSerie as $instance) {
                    $instance->deletePermisoSerie();
                }
            }
        }
        return true;
    }

    /**
     * Crea la entidad serie con sus correspondientes vinculaciones (expedientes)
     * NO utilizar save() para crear una entidad serie
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
        $existEntSer = busca_filtro_tabla("identidad_serie", "entidad_serie", "fk_serie={$this->fk_serie} and fk_dependencia={$this->fk_dependencia} and estado=0", "", $conn);
        if ($existEntSer['numcampos']) {
            $instance = new self($existEntSer[0]['identidad_serie']);
            $instance->estado = 1;
            $instance->update();
            $response['exito'] = 1;
        } else {
            if ($this->save()) {
                $ValidArbolExp = $this->validArbolExp();

                if ($ValidArbolExp['exito']) {
                    $Serie = $this->getSerieFk();
                    if ($Serie) {
                        $Serie = $Serie[0];
                        if ($Serie->tipo == 1) {
                            $codPadreExp = end($ValidArbolExp['data']['idexpediente']);
                        } else {
                            $consPadre = busca_filtro_tabla("idexpediente", "expediente", "fk_dependencia={$this->fk_dependencia} and fk_serie={$Serie->cod_padre} and nucleo=1 and estado=1", "", $conn);
                            if ($consPadre['numcampos']) {
                                $codPadreExp = $consPadre[0]['idexpediente'];
                            }
                        }
                        $existExp = busca_filtro_tabla(
                            "idexpediente",
                            "expediente",
                            "fk_dependencia={$this->fk_dependencia} and fk_serie={$this->fk_serie} 
                                and nucleo=1 and estado=1 and agrupador=2",
                            "",
                            $conn
                        );
                        if (!$existExp['numcampos']) {
                            $Expediente = new Expediente();
                            $attributes = [
                                'fecha' => date('Y-m-d H:i:s'),
                                'nombre' => $Serie->nombre,
                                'fondo' => $Serie->nombre,
                                'descripcion' => $Serie->nombre,
                                'codigo' => $Serie->codigo,
                                'codigo_numero' => $Serie->codigo,
                                'cod_padre' => $codPadreExp,
                                'fk_idcaja' => 0,
                                'propietario' => 0,
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
        $this->update();
        $response['exito'] = 1;
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
        $Dependencia = $this->getDependenciaFk();
        if ($Dependencia) {
            $Dependencia = $Dependencia[0];

            $idsDep = explode('.', $Dependencia->codigo_arbol);
            $idsExp = [];
            foreach ($idsDep as $key => $idDependencia) {
                //TODO: El estado de expediente solo debe cambiarse cuando se elimine la serie que hace relacion
                $existDep = busca_filtro_tabla(
                    "idexpediente",
                    "expediente",
                    "fk_dependencia={$idDependencia} and nucleo=1 and estado=1 and agrupador=1",
                    "",
                    $conn
                );
                if ($existDep['numcampos']) {
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
                        'codigo' => $DependenciaData->codigo,
                        'codigo_numero' => $DependenciaData->codigo,
                        'cod_padre' => $codPadreExp,
                        'fk_idcaja' => 0,
                        'propietario' => 0,
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
            if (count($idsDep) == count($idsExp)) {
                $response['exito'] = 1;
                $response['data']['idexpediente'] = $idsExp;
            } else {
                $response['message'] = 'Error, No se crearon todos los expedientes';
            }
        } else {
            $response['message'] = 'Error, la dependencia NO existe! id:' . $this->fk_dependencia;
        }
        return $response;
    }
    /**
     * Obtiene la serie vinculada a la entidad serie
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getSerieFk(int $instance = 1)
    {
        $data = null;
        $response = Serie::findAllByAttributes(['idserie' => $this->fk_serie]);
        if ($response) {
            if ($instance) {
                $data = $response;
            } else {
                $data = UtilitiesController::getIdsInstance($response);
            }
        }
        return $data;
    }
    /**
     * Obtiene la dependencia vinculada a la entidad serie
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getDependenciaFk(int $instance = 1)
    {
        $data = null;
        $response = Dependencia::findAllByAttributes(['iddependencia' => $this->fk_dependencia]);
        if ($response) {
            if ($instance) {
                $data = $response;
            } else {
                $data = UtilitiesController::getIdsInstance($response);
            }
        }
        return $data;
    }
    /**
     * Obtiene los expedientes vinculados a la entidad serie
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteFk(int $instance = 1)
    {
        $data = null;
        $response = Expediente::findAllByAttributes(['fk_entidad_serie' => $this->identidad_serie]);
        if ($response) {
            if ($instance) {
                $data = $response;
            } else {
                $data = UtilitiesController::getIdsInstance($response);
            }
        }
        return $data;
    }

    /**
     * Obtiene los permisos vinculados a la entidad serie
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getPermisoSerieFk(int $instance = 1)
    {
        $data = null;
        $response = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $this->identidad_serie]);
        if ($response) {
            if ($instance) {
                $data = $response;
            } else {
                $data = UtilitiesController::getIdsInstance($response);
            }
        }
        return $data;
    }

}