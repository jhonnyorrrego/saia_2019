<?php

class Expediente extends Model
{
    protected $idexpediente;
    protected $fecha;
    protected $nombre;
    protected $descripcion;
    protected $cod_padre;
    protected $fk_caja;
    protected $propietario;
    protected $responsable;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $cod_arbol;
    protected $codigo_numero;
    protected $fondo;
    protected $proceso;
    protected $fecha_extrema_i;
    protected $fecha_extrema_f;
    protected $no_unidad_conservacion;
    protected $no_folios;
    protected $no_carpeta;
    protected $soporte;
    protected $frecuencia_consulta;
    protected $ruta_qr;
    protected $estado_archivo;
    protected $estado_cierre;
    protected $fecha_cierre;
    protected $funcionario_cierre;
    protected $notas_transf;
    protected $tomo_padre;
    protected $tomo_no;
    protected $agrupador;
    protected $indice_uno;
    protected $indice_dos;
    protected $indice_tres;
    protected $consecutivo_inicial;
    protected $consecutivo_final;
    protected $fk_entidad_serie;
    protected $nucleo;
    protected $dbAttributes;

    protected $expedientePadre;
    public $permiso;

    public function __construct($id = null)
    {
        parent::__construct($id);
        if ($id) {
            $this->permiso = [
                'a' => false,
                'l' => false,
                'v' => false,
                'e' => false,
                'c' => false,
                'd' => false
            ];
            $this->setAccessUser($_SESSION['idfuncionario']);
        }
    }


    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fecha',
                'nombre',
                'descripcion',
                'cod_padre',
                'fk_caja',
                'propietario',
                'responsable',
                'fk_serie',
                'fk_dependencia',
                'cod_arbol',
                'codigo_numero',
                'fondo',
                'proceso',
                'fecha_extrema_i',
                'fecha_extrema_f',
                'no_unidad_conservacion',
                'no_folios',
                'no_carpeta',
                'soporte',
                'frecuencia_consulta',
                'ruta_qr',
                'estado_archivo',
                'estado_cierre',
                'fecha_cierre',
                'funcionario_cierre',
                'notas_transf',
                'tomo_padre',
                'tomo_no',
                'agrupador',
                'indice_uno',
                'indice_dos',
                'indice_tres',
                'consecutivo_inicial',
                'consecutivo_final',
                'fk_entidad_serie',
                'nucleo'
            ],
            'date' => [
                'fecha',
                'fecha_extrema_i',
                'fecha_extrema_f',
                'fecha_cierre'
            ]
        ];
    }

    /**
     * Se ejecuta despues de crear el expediente
     * Actualiza el cod_arbol del expediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterCreate()
    {
        $cod_arbol = $this->idexpediente;
        $padre = $this->getCodPadre();
        if ($padre) {
            $cod_arbol = $padre->cod_arbol . '.' . $this->idexpediente;
        }
        $this->cod_arbol = $cod_arbol;
        $this->update();
        return true;
    }
    /**
     * Se ejecuta posterior al eliminar un expediente
     * Elimina las documentos y el historial de cierre vinculadoa al expediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    protected function afterDelete()
    {
        $ExpedienteDoc = ExpedienteDoc::findAllByAttributes(['fk_expediente' => $this->getPK()]);
        if ($ExpedienteDoc) {
            foreach ($ExpedienteDoc as $instance) {
                $instance->delete();
            }
        }

        $ExpedienteAbce = ExpedienteAbce::findAllByAttributes(['fk_expediente' => $this->getPK()]);
        if ($ExpedienteAbce) {
            foreach ($ExpedienteAbce as $instance) {
                $instance->delete();
            }
        }
        return true;
    }
    /**
     * Crea el expediente con sus correspondientes vinculados
     * NO utlizar save()
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function CreateExpediente() : array
    {
        $response = [
            'data' => [],
            'exito' => 0,
            'message' => '',
        ];
        if ($this->save()) {
            if (!$this->nucleo) {
                $instance = new EntidadExpediente();
                $attributes = [
                    'llave_entidad' => $this->propietario,
                    'tipo_funcionario' => 1,
                    'permiso' => 'v,e,c,d',
                    'fecha' => date('Y-m-d H:i:s'),
                    'fk_entidad' => 1,
                    'fk_expediente' => $this->idexpediente
                ];
                $instance->setAttributes($attributes);
                $instance->CreateEntidadExpediente();
            }
            $response['exito'] = 1;
            $response['message'] = 'Datos guardados correctamente';
            $response['data']['id'] = $this->idexpediente;
        } else {
            $this->delete();
            $response['message'] = 'Error al guardar el Expediente';
        }
        return $response;
    }
    /**
     * retorna la etiqueta del estado del expediente
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstado() : string
    {
        $estado = array(
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        );
        return $estado[$this->estado];
    }
    /**
     * retorna la instancia del expediente padre
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getCodPadre()
    {
        if ($this->cod_padre) {
            if (!$this->expedientePadre) {
                $this->expedientePadre = new self($this->cod_padre);
            }
        } else {
            $this->expedientePadre = null;
        }
        return $this->expedientePadre;
    }
    /**
     * Retorna el nombre del propietario
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getPropietario() : string
    {
        $response = '';
        $data = $this->getFuncionarioFk();
        if ($data) {
            $response = $data[0]->nombres . ' ' . $data[0]->apellidos;
        }
        return $response;
    }
    /**
     * Retorna el nombre del funcionario responsable
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getResponsable() : string
    {
        $response = '';
        $data = $this->getFuncionarioFk(1, 'responsable');
        if ($data) {
            $response = $data[0]->nombres . ' ' . $data[0]->apellidos;
        }
        return $response;
    }

    public function getSoporte()
    {
        $soporte = [
            1 => 'CD - ROM',
            2 => 'DISKETE',
            3 => 'DVD',
            4 => 'DOCUMENTO',
            5 => 'FAX',
            6 => 'REVISTA O LIBRO',
            7 => 'VIDEO',
            8 => 'OTROS ANEXOS'
        ];
        return $soporte[$this->soporte];
    }

    public function getFrecuenciaConsulta()
    {
        $frecuencia = [
            1 => 'Alta',
            2 => 'Media',
            3 => 'Baja'
        ];
        return $frecuencia[$this->frecuencia_consulta];
    }

    /**
     * Cuenta la cantidad de tomos de un expediente
     *
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countTomos() : int
    {
        $cant = 1;
        if ($this->tomo_padre) {
            $data = busca_filtro_tabla("count(idexpediente) as cant", "expediente", "tomo_padre={$this->tomo_padre}", "", $conn);
            $cant = $data[0]['cant'] + 1;
        } else {
            $data = busca_filtro_tabla("count(idexpediente) as cant", "expediente", "tomo_padre={$this->idexpediente}", "", $conn);
            $cant = $data[0]['cant'] + 1;
        }
        return $cant;
    }
    /**
     * Cuenta los documentos que existen en un expediente
     *
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countDocuments() : int
    {
        return ExpedienteDoc::countDocumentsExp($this->idexpediente);
    }

    /**
     * Cuenta los expedientes que existen dentro de un expediente
     *
     * @param integer $tipoAg : identificador del agrupador (expediente,separador, serie, dependencia)
     * @return integer
     */
    public function countExpediente(int $tipoAg = 0) : int
    {
        $cant = 0;
        $sql = "SELECT COUNT(idexpediente) as cant FROM expediente WHERE agrupador={$tipoAg} and cod_padre={$this->idexpediente}";
        $response = UtilitiesController::ejecutaSelect($sql);
        if ($response['numcampos']) {
            $cant = $response[0]['cant'];
        }
        return $cant;
    }

    public function getAgrupador()
    {
        $data = [
            0 => 'Expediente',
            1 => 'Dependencia',
            2 => 'Serie',
            3 => 'Separador'
        ];
        return $tipoAgrupador = $data[$this->agrupador];
    }

    /**
     * setea los permisos del funcionario logueado
     *
     * @param integer $idfuncionario : usuario logueado
     * @return void
     */
    private function setAccessUser(int $idfuncionario)
    {
        if (UtilitiesController::permisoModulo('expediente_admin')) {
            $this->permiso = [
                'a' => true,
                'l' => true,
                'v' => true,
                'e' => true,
                'c' => true,
                'd' => true
            ];
        } else {
            $consPermiso = busca_filtro_tabla(
                "permiso",
                "permiso_expediente",
                "fk_expediente={$this->idexpediente} and fk_funcionario={$idfuncionario}",
                "",
                $conn
            );
            if ($consPermiso['numcampos']) {
                for ($i = 0; $i < $consPermiso['numcampos']; $i++) {
                    $permisos = explode(',', $consPermiso[$i]['permiso']);
                    foreach ($permisos as $permiso) {
                        $this->permiso[$permiso] = true;
                    }
                }
            }
            if ($this->propietario == $_SESSION['idfuncionario'] || $this->responsable == $_SESSION['idfuncionario']) {
                $this->permiso = [
                    'v' => true,
                    'e' => true,
                    'c' => true,
                    'd' => true
                ];
            }
        }
    }
    /**
     * obtiene los permisos del funcionario logueado
     *
     * @param string $permiso : 
     * a: adicion Serie,
     * l: lectura serie,
     * v: ver expediente
     * e: editar expediente
     * c: Compartir expediente
     * d: eliminar expediente
     * @return boolean
     */
    public function getAccessUser(string $permiso) : bool
    {
        $response = false;
        if (in_array($permiso, $this->permiso)) {
            $response = $this->permiso[$permiso];
        }
        return $response;
    }

    /**
     * retorna las instancias de expedientes_doc vinculadas al expediente
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteDocFk(int $instance = 1)
    {
        $data = null;
        $response = ExpedienteDoc::findAllByAttributes(['idexpediente' => $this->idexpediente]);
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
     * retorna las instancias de la serie vinculadas al expediente
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
     * retorna las instancias de la dependencia vinculadas al expediente
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
     * retorna las instancias de la entidad serie vinculadas al expediente
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
     * retorna las instancia del funcionario (creador,responsable) vinculada al expediente
     *
     * @param int $instance : 1, retorna las instancias, 0, retorna solo los ids
     * @param string $campo :  Nombre del campo (propietario - responsable)
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getFuncionarioFk(int $instance = 1, string $campo = "propietario")
    {
        $data = null;
        $response = Funcionario::findAllByAttributes(['idfuncionario' => $this->$campo]);
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
