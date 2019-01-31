<?php

class EntidadExpediente extends Model
{
    protected $identidad_expediente;
    protected $llave_entidad;
    protected $permiso;
    protected $tipo_funcionario;
    protected $fecha;
    protected $fk_entidad;
    protected $fk_expediente;

    protected $dbAttributes;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }


    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'llave_entidad',
                'permiso',
                'tipo_funcionario',
                'fecha',
                'fk_entidad',
                'fk_expediente'
            ],
            'date' => [
                'fecha'
            ]
        ];
    }

    /**
     * Crea la Entidad expediente con sus correspondientes vinculados
     * NO utlizar create/save
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function CreateEntidadExpediente() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];
        if ($this->create()) {
            $instance = $this->getExpedienteFk();
            if ($instance) {
                $permisoExp= $instance[0];
                if ($this->tipo_funcionario) {
                    if ($this->tipo_funcionario == 1) {
                        $idfun = $permisoExp->propietario;
                    } else {
                        $idfun = $permisoExp->responsable;
                    }
                    $attributes = [
                        'fk_funcionario' => $idfun,
                        'fk_entidad' => 1,
                        'llave_entidad' => $idfun,
                        'fk_entidad_serie' => $permisoExp->fk_entidad_serie,
                        'tipo_permiso' => 2,
                        'tipo_funcionario' => $this->tipo_funcionario,
                        'permiso' => $this->permiso,
                        'fk_expediente' => $this->fk_expediente
                    ];
                    $PermisoExpediente = new PermisoExpediente();
                    $PermisoExpediente->setAttributes($attributes);
                    $PermisoExpediente->create();
                }
                $data = PermisoSerie::findAllByAttributes(['fk_entidad_serie' => $permisoExp->fk_entidad_serie]);
                if($data){
                    foreach ($data as $ins) {
                        PermisoExpediente::deleteAllPermisoExpediente($ins->fk_entidad_serie, $ins->llave_entidad, $ins->fk_entidad, 1);
                        PermisoExpediente::insertAllPermisoExpediente($ins->fk_entidad_serie, $ins->llave_entidad, $ins->fk_entidad, 1, $ins->permiso);
                    }
                }
            }
            $response['exito'] = 1;
            $response['data']['id'] = $this->idexpediente;
        } else {
            $response['message'] = 'Error al guardar la entidad expediente';
        }
        return $response;
    }

    /**
     * retorna las instancia de entidad vinculadas a la entidad expediente
     * 
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEntidadFk(int $instance = 1)
    {
        $data = null;
        $response = Entidad::findAllByAttributes(['identidad' => $this->fk_entidad]);
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
