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

    public function afterDelete()
    {
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
            $response['data']['id'] = $this->idpermiso_serie;
            if ($this->getRelationFk('EntidadSerie')->getRelationFk('Serie')->tipo != 3) {
                $okDel = PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
                $okIns = PermisoExpediente::insertAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1, $this->permiso);
                if ($okDel && $okIns) {
                    $response['exito'] = 1;
                } else {
                    $response['message'] = 'No se pudo crear los permiso sobre los expedientes';
                    $this->delete();
                }
            } else {
                $response['exito'] = 1;
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
            if ($this->getRelationFk('EntidadSerie')->getRelationFk('Serie')->tipo != 3) {
                $okDel = PermisoExpediente::deleteAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1);
                $okIns = PermisoExpediente::insertAllPermisoExpediente($this->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 1, $this->permiso);
                if ($okDel && $okIns) {
                    $response = true;
                } else {
                    $this->delete();
                }
            } else {
                $response = true;
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

    public static function hasAccessUser(int $fk_dependencia, int $fk_serie, string $permiso = 'a') : bool
    {
        $sql = "SELECT permiso FROM vpermiso_serie WHERE idserie={$fk_serie} AND fk_dependencia={$fk_dependencia} AND permiso like '%{$permiso}%' AND idfuncionario={$_SESSION['idfuncionario']}";
        return self::findBySql($sql,false) ? true : false;
    }

}