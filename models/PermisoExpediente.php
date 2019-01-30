<?php

class PermisoExpediente extends Model
{
    protected $idpermiso_expediente;
    protected $fk_funcionario;
    protected $fk_entidad;
    protected $llave_entidad;
    protected $fk_entidad_serie;
    protected $tipo_permiso;
    protected $tipo_funcionario;
    protected $permiso;
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
                'fk_funcionario',
                'fk_entidad',
                'llave_entidad',
                'fk_entidad_serie',
                'tipo_permiso',
                'tipo_funcionario',
                'permiso',
                'fk_expediente'
            ]
        ];
    }

    /**
     * Elimina los permisos sobre los expedientes
     *
     * @param integer $fkEntidadSerie 
     * @param integer $llaveEntidad
     * @param integer $fkEntidad
     * @param integer $tipoPermiso
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function deleteAllPermisoExpediente(int $fkEntidadSerie, int $llaveEntidad, int $fkEntidad, int $tipoPermiso)
    {
        $sql = "DELETE FROM permiso_expediente WHERE fk_entidad_serie={$fkEntidadSerie} AND llave_entidad={$llaveEntidad} AND fk_entidad={$fkEntidad} AND tipo_permiso={$tipoPermiso} and tipo_funcionario=0";
        phpmkr_query($sql);
        return;
    }
    /**
     * Inserta los permisos sobre los expedientes
     *
     * @param integer $fkEntidadSerie 
     * @param integer $llaveEntidad
     * @param integer $fkEntidad
     * @param integer $tipoPermiso
     * @param string $Permiso
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function insertAllPermisoExpediente(int $fkEntidadSerie, int $llaveEntidad, int $fkEntidad, int $tipoPermiso, string $permiso)
    {
        switch ($fkEntidadSerie) {
            case 1:
                $sql = "INSERT INTO permiso_expediente (fk_funcionario,fk_entidad,llave_entidad,fk_entidad_serie,tipo_permiso,permiso,tipo_funcionario,fk_expediente)
                SELECT {$llaveEntidad},{$fkEntidad},{$llaveEntidad},{$fkEntidadSerie},{$tipoPermiso},'{$permiso}',0,idexpediente FROM expediente WHERE fk_entidad_serie={$fkEntidadSerie}";
                phpmkr_query($sql);
                break;
            case 2:
                $funcionarios = busca_filtro_tabla("DISTINCT idfuncionario", "vfuncionario_dc", "estado=1 and estado_dc=1 and iddependencia={$llaveEntidad}", "", $conn);
                if ($funcionarios['numcampos']) {
                    for ($i = 0; $i < $funcionarios['numcampos']; $i++) {
                        $sql = "INSERT INTO permiso_expediente (fk_funcionario,fk_entidad,llave_entidad,fk_entidad_serie,tipo_permiso,permiso,tipo_funcionario,fk_expediente)
                        SELECT {$funcionarios[$i]['idfuncionario']},{$fkEntidad},{$llaveEntidad},{$fkEntidadSerie},{$tipoPermiso},'{$permiso}',0,idexpediente FROM expediente WHERE fk_entidad_serie={$fkEntidadSerie}";
                        phpmkr_query($sql);
                    }
                }
                break;

            case 4:
                $funcionarios = busca_filtro_tabla("DISTINCT idfuncionario", "vfuncionario_dc", "estado=1 and estado_dc=1 and idcargo={$llaveEntidad}", "", $conn);
                if ($funcionarios['numcampos']) {
                    for ($i = 0; $i < $funcionarios['numcampos']; $i++) {
                        $sql = "INSERT INTO permiso_expediente (fk_funcionario,fk_entidad,llave_entidad,fk_entidad_serie,tipo_permiso,permiso,tipo_funcionario,fk_expediente)
                        SELECT {$funcionarios[$i]['idfuncionario']},{$fkEntidad},{$llaveEntidad},{$fkEntidadSerie},{$tipoPermiso},'{$permiso}',0,idexpediente FROM expediente WHERE fk_entidad_serie={$fkEntidadSerie}";
                        phpmkr_query($sql);
                    }
                }
                break;
        }
        return;
    }

    /**
     * retorna las instancia de funcionarios vinculadas al permiso del expediente
     * 
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */

    public function getFuncionariofk(int $instance = 1)
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
     * retorna las instancia de entidad vinculadas al permiso del expediente
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
     * retorna las instancia de entidad serie vinculadas al permiso del expediente
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
     * retorna las instancia de expediente vinculadas al permiso del expediente
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