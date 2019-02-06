<?php

class EntidadExpediente extends Model
{
    protected $identidad_expediente;
    protected $fk_funcionario;
    protected $permiso;
    protected $tipo_funcionario;
    protected $fecha;
    protected $fk_expediente;
    protected $dbAttributes;

    protected $accessPermits;
    protected $updateAccess;

    public function __construct($id = null)
    {
        parent::__construct($id);
        if ($id) {
            $this->updateAccess = false;
            $this->accessPermits = [
                'd' => false,
                'e' => false,
                'c' => false
            ];
        }
    }


    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_funcionario',
                'permiso',
                'tipo_funcionario',
                'fecha',
                'fk_expediente'
            ],
            'date' => [
                'fecha'
            ]
        ];
    }

    /**
     * Setea los permisos
     *
     * @param string $permiso :
     * e: editar expediente
     * c: Compartir expediente
     * d: eliminar expediente
     * @return boolean
     */
    public function setAccessPermits(string $permiso = null) : bool
    {
        $response = false;
        if ($permiso) {
            if (array_key_exists($permiso, $this->accessPermits)) {
                $this->accessPermits[$permiso] = true;
                $perm = [];
                foreach ($this->accessPermits as $key => $value) {
                    if ($value) {
                        $perm[] = $key;
                    }
                }
                $this->updateAccess = true;
                $this->permiso = implode(',', $perm);
                $response = true;
            }
        }
        return $response;
    }

    /**
     * Actualiza la Entidad expediente con nuevos permisos
     * NO utlizar update/save
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function updateEntidadExpediente() : array
    {
        $response = [
            'exito' => 0,
            'message' => '',
        ];
        if ($this->update()) {
            $response['exito'] = 1;
            if ($this->updateAccess) {
                $sql = "SELECT idpermiso_expediente FROM permiso_expediente WHERE tipo_permiso=2  AND fk_entidad=1 AND tipo_funcionario={$this->tipo_funcionario} AND fk_funcionario={$this->fk_funcionario} AND fk_expediente={$this->fk_expediente}";
                $record = $this->search($sql);
                if ($record) {
                    $PermisoExpediente = new PermisoExpediente($record[0]['idpermiso_expediente']);
                    $PermisoExpediente->permiso = $this->permiso;
                    if (!$PermisoExpediente->update()) {
                        $response['exito'] = 0;
                        $response['message'] = 'No se pudo actualizar el permiso del expediente';
                    }
                }else{
                    $response['exito'] = 0;
                    $response['message'] = 'No se pudo actualizar el permiso del expediente';
                    $this->delete();
                }
            }
        }
        return $response;
    }

    /**
     * Crea la Entidad expediente con sus correspondientes vinculados
     * NO utlizar create/save
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function createEntidadExpediente() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];
        if ($this->create()) {
            $response['exito'] = 1;
            $response['data']['id'] = $this->identidad_expediente;

            $instance = $this->getExpedienteFk();
            if ($instance) {
                $Expediente = $instance[0];
                if ($this->tipo_funcionario == 1) {
                    $idfun = $Expediente->propietario;
                } elseif($this->tipo_funcionario == 2) {
                    $idfun = $Expediente->responsable;
                }else{
                    $idfun = $this->fk_funcionario;
                }
                $attributes = [
                    'fk_funcionario' => $idfun,
                    'fk_entidad' => 1,
                    'llave_entidad' => $idfun,
                    'fk_entidad_serie' => $Expediente->fk_entidad_serie,
                    'tipo_permiso' => 2,
                    'tipo_funcionario' => $this->tipo_funcionario,
                    'permiso' => $this->permiso,
                    'fk_expediente' => $this->fk_expediente
                ];
                $PermisoExpediente = new PermisoExpediente();
                $PermisoExpediente->setAttributes($attributes);
                if(!$PermisoExpediente->create()){
                    $response['exito'] = 0;
                    $response['message'] = 'Error al vincular los permisos al expediente';
                    $this->delete();
                }else{
                    $data = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $Expediente->fk_entidad_serie]);
                    if ($data) {
                        foreach ($data as $ins) {
                            PermisoExpediente::deleteAllPermisoExpediente($ins->fk_entidad_serie, $ins->llave_entidad, $ins->fk_entidad, 1);
                            PermisoExpediente::insertAllPermisoExpediente($ins->fk_entidad_serie, $ins->llave_entidad, $ins->fk_entidad, 1, $ins->permiso);
                        }
                    }
                }
            }
        } else {
            $response['message'] = 'Error al guardar la entidad expediente';
        }
        return $response;
    }

    /**
     * retorna las instancia de funcionario vinculada a la entidad expediente
     * 
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getFuncionarioFk(int $instance = 1)
    {
        $data = null;
        $response = Funcionario::findAllByAttributes(['idfuncionario' => $this->fk_funcionario]);
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
     * retorna las instancia de expediente vinculada a la entidad expediente
     * 
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteFk(int $instance = 1)
    {
        $data = null;
        $response = Expediente::findAllByAttributes(['idexpediente' => $this->fk_expediente]);
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
