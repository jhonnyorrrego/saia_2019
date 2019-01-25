<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class EntidadExpediente extends Model
{
    protected $identidad_expediente;
    protected $llave_entidad;
    protected $permiso;
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
     * NO utlizar save()
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
        if ($this->save()) {
            $instance = $this->getExpedienteFk();
            if ($instance) {
                PermisoExpediente::deleteAllPermisoExpediente($instance[0]->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 2);
                PermisoExpediente::insertAllPermisoExpediente($instance[0]->fk_entidad_serie, $this->llave_entidad, $this->fk_entidad, 2, $this->permiso);
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
