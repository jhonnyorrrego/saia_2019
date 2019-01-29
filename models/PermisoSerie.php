<?php

class PermisoSerie extends Model
{
    protected $idpermiso_serie;
    protected $fk_entidad;
    protected $llave_entidad;
    protected $permiso;
    protected $fk_entidad_serie;

    protected $dbAttributes;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_entidad',
                'llave_entidad',
                'permiso',
                'fk_entidad_serie'
            ]
        ];
    }

    /**
     * Crea el permiso de la serie con sus correspondientes vinculaciones (Permiso expediente)
     * NO utilizar save() para crear una permiso de serie
     *
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public function createPermisoSerie() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => ''
        ];
        if ($this->save()) {
            PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
            PermisoExpediente::insertAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1, $this->permiso);

            $response['data']['id'] = $this->idpermiso_serie;
            $response['exito'] = 1;
        }
        return $response;
    }
    /**
     * Actualiza el permiso y sus correspondientes vinculados (permiso expedientes)
     * NO utilizar update() para actualizar un permiso
     * 
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function updatePermisoSerie()
    {
        $this->update();
        PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
        PermisoExpediente::insertAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1, $this->permiso);
    }
    /**
     * Elimina el permiso sobre la serie y sus correspondientes vinculados (permiso expediente)
     *
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function deletePermisoSerie() : bool
    {
        $response = false;
        if ($this->delete()) {
            PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
            $response = true;
        }
        return $response;
    }

    /**
     * retorna las instancia de entidad serie vinculadas al permiso
     * 
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEntidadSerieFk(int $instance = 1)
    {
        $data = null;
        $response = EntidadSerie::findAllByAttributes(['identidad_serie' => $this->fk_entidad_serie]);
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
     * retorna las instancia de entidad vinculadas al permiso
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
}