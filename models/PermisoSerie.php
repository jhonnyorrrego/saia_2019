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

    public function afterDelete(){
        return PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
    }

    /**
     * Crea el permiso de la serie con sus correspondientes vinculaciones (Permiso expediente)
     * NO utilizar save/create para crear una permiso de serie
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
        if ($this->create()) {
            $okDel = PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
            $okIns = PermisoExpediente::insertAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1, $this->permiso);
            if ($okDel && $okIns) {
                $response['data']['id'] = $this->idpermiso_serie;
                $response['exito'] = 1;
            } else {
                $response['message'] = 'No se pudo crear los permiso sobre los expedientes';
                $this->delete();
            }
        }
        return $response;
    }
    /**
     * Actualiza el permiso y sus correspondientes vinculados (permiso expedientes)
     * NO utilizar update() para actualizar un permiso
     * 
     * @return bool
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function updatePermisoSerie()
    {
        $response = false;
        if ($this->update()) {
            $okDel = PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
            $okIns = PermisoExpediente::insertAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1, $this->permiso);
            if ($okDel && $okIns) {
                $response = true;
            }else{
                $this->delete();
            }
        }
        return $response;
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