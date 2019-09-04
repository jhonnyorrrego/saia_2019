<?php

class EntidadExpediente extends Model
{
    protected $identidad_expediente;
    protected $fk_funcionario;
    protected $permiso;
    protected $tipo_funcionario;
    protected $fecha;
    protected $fk_expediente;
    
    

    protected $accessPermits;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->massiveAssigned();
    }

    public function massiveAssigned(){
        if ($this->identidad_expediente) {
            $this->accessPermits = [
                'd' => false,
                'e' => false,
                'c' => false,
                'v' => false
            ];
            $perm = explode(',', $this->permiso);
            foreach ($perm as $value) {
                $this->accessPermits[$value] = true;
            }
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
     * Se ejecuta despues de eliminar una entidadExpediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function afterDelete()
    {
        $sql = "SELECT idpermiso_expediente FROM permiso_expediente WHERE fk_entidad=1 AND tipo_permiso=2 AND tipo_funcionario={$this->tipo_funcionario} AND fk_expediente={$this->fk_expediente}";
        $records = PermisoExpediente::findByQueryBuilder($sql);
        if ($records) {
            foreach ($$records as $instance) {
                $instance->delete();
            }
        }
        return true;
    }

    /**
     * Setea los permisos
     *
     * @param string $permiso :
     * e: editar expediente
     * c: Compartir expediente
     * d: eliminar expediente
     * @param bool $estado: true para dar el permiso, false para quitar
     * @return boolean
     */
    public function setAccessPermits(string $permiso = null, bool $estado = true) : bool
    {
        $response = false;
        if ($permiso) {
            if (array_key_exists($permiso, $this->accessPermits)) {
                $this->accessPermits[$permiso] = $estado;
                $perm = [];
                foreach ($this->accessPermits as $key => $value) {
                    if ($value) {
                        $perm[$key] = $key;
                    }
                }
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
            $response['message'] = 'Entidad expediente actualizado!';
            $sql = "SELECT idpermiso_expediente FROM permiso_expediente WHERE tipo_permiso=2 AND fk_entidad=1 AND tipo_funcionario={$this->tipo_funcionario} AND fk_expediente={$this->fk_expediente}";
            $record = $this->search($sql);
            if ($record) {
                $PermisoExpediente = new PermisoExpediente($record[0]['idpermiso_expediente']);
                $PermisoExpediente->permiso = $this->permiso;
                $PermisoExpediente->fk_funcionario = $this->fk_funcionario;
                $PermisoExpediente->llave_entidad = $this->fk_funcionario;
                if (!$PermisoExpediente->update()) {
                    $response['exito'] = 0;
                    $response['message'] = 'No se pudo actualizar el permiso del expediente2';
                }
            } else {
                $response['exito'] = 0;
                $response['message'] = 'No se pudo actualizar el permiso del expediente1';
                $this->delete();
            }

        }
        return $response;
    }

    /**
     * Crea la Entidad expediente con sus correspondientes vinculados
     * NO utlizar create/save
     *
     * @param boolean $updatePermisos : true para recargar los permisos, 
     * utilizado cuando es un expediente nuevo
     * @return array
     */
    public function createEntidadExpediente(bool $updatePermisos = true) : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];
        if ($this->create()) {
            $response['exito'] = 1;
            $response['data']['id'] = $this->identidad_expediente;

            $Expediente = $this->getRelationFk('Expediente');
            if ($Expediente) {
                $attributes = [
                    'fk_funcionario' => $this->fk_funcionario,
                    'fk_entidad' => 1,
                    'llave_entidad' => $this->fk_funcionario,
                    'fk_entidad_serie' => $Expediente->fk_entidad_serie,
                    'tipo_permiso' => 2,
                    'tipo_funcionario' => $this->tipo_funcionario,
                    'permiso' => $this->permiso,
                    'fk_expediente' => $this->fk_expediente
                ];
                $PermisoExpediente = new PermisoExpediente();
                $PermisoExpediente->setAttributes($attributes);
                if (!$PermisoExpediente->create()) {
                    $response['exito'] = 0;
                    $response['message'] = 'Error al vincular los permisos al expediente';
                    $this->delete();
                } else {
                    if ($this->tipo_funcionario != 1 && $Expediente->getCodPadre()) {
                        if ($Expediente->getCodPadre()->agrupador != 1) {
                            //Se valida que el funcionario tenga permisos sobre los expedientes padres
                            $sql = "SELECT identidad_expediente FROM entidad_expediente WHERE tipo_funcionario={$this->tipo_funcionario} AND fk_funcionario={$this->fk_funcionario} AND fk_expediente={$Expediente->cod_padre}";
                            if (!$this->search($sql)) {
                                $attributes = [
                                    'fk_funcionario' => $this->fk_funcionario,
                                    'fecha' => date('Y-m-d H:i:s'),
                                    'tipo_funcionario' => $this->tipo_funcionario,
                                    'permiso' => 'v',
                                    'fk_expediente' => $Expediente->cod_padre
                                ];
                                $EntidadExpediente = new EntidadExpediente();
                                $EntidadExpediente->setAttributes($attributes);
                                $info = $EntidadExpediente->createEntidadExpediente(false);
                            }
                        }
                    }
                    if ($updatePermisos) {
                        //Se asgina el permiso a todos los funcionarios del nuevo expediente
                        $data = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $Expediente->fk_entidad_serie]);
                        if ($data) {
                            foreach ($data as $ins) {
                                PermisoExpediente::deleteAllPermisoExpediente($ins->fk_entidad_serie, $ins->llave_entidad, $ins->fk_entidad, 1);
                                PermisoExpediente::insertAllPermisoExpediente($ins->fk_entidad_serie, $ins->llave_entidad, $ins->fk_entidad, 1, $ins->permiso);
                            }
                        }
                    }
                }
            }
        } else {
            $response['message'] = 'Error al guardar la entidad expediente';
        }
        return $response;
    }
}
