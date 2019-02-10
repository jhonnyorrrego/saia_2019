<?php

class Expediente extends Model
{
    protected $idexpediente;
    protected $nombre;
    protected $fecha;
    protected $descripcion;
    protected $cod_padre;
    protected $propietario;
    protected $responsable;
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
    protected $nucleo;
    protected $estado;
    protected $fk_expediente_eli;
    protected $fk_caja;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $fk_entidad_serie;

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
                'e' => false,
                'c' => false,
                'd' => false,
                'v' => false
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
                'nucleo',
                'estado',
                'fk_expediente_eli'
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
        return $this->update();
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

        $ExpedienteCierre = ExpedienteCierre::findAllByAttributes(['fk_expediente' => $this->getPK()]);
        if ($ExpedienteCierre) {
            foreach ($ExpedienteCierre as $instance) {
                $instance->delete();
            }
        }
        return true;
    }
    /**
     * Crea el expediente con sus correspondientes vinculados
     * NO utlizar save/create
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
        if ($this->create()) {
            if (!$this->nucleo) {
                $instance = new EntidadExpediente();
                $attributes = [
                    'fk_funcionario' => $this->propietario,
                    'tipo_funcionario' => 1,
                    'permiso' => 'e,d,c',
                    'fecha' => date('Y-m-d H:i:s'),
                    'fk_expediente' => $this->idexpediente
                ];
                $instance->setAttributes($attributes);
                $instance->createEntidadExpediente();
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
     * Actualiza el reponsable del expediente
     *
     * @param integer $responAnt : idfuncionario del Responsable anterior
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function updateResponsable(int $responAnt) : array
    {
        $response = [
            'exito' => 0,
            'message' => '',
        ];
        if ($this->responsable == $responAnt) {
            $response['exito'] = 1;
        } else {
            if ($this->update()) {
                $sql = "SELECT identidad_expediente FROM entidad_expediente WHERE tipo_funcionario=2 AND fk_expediente={$this->idexpediente}";
                $idEnt = $this->search($sql);
                if ($idEnt) {
                    $EntidadExpediente = new EntidadExpediente($idEnt[0]['identidad_expediente']);
                    $EntidadExpediente->fk_funcionario = $this->responsable;
                    $EntidadExpediente->fecha = date('Y-m-d H:i:s');
                    $response = $EntidadExpediente->updateEntidadExpediente();
                } else {
                    $attributes = [
                        'fk_funcionario' => $this->responsable,
                        'fk_expediente' => $this->idexpediente,
                        'permiso' => 'c,d,e',
                        'tipo_funcionario' => 2,
                        'fecha' => date('Y-m-d H:i:s')
                    ];
                    $EntidadExpediente = new EntidadExpediente();
                    $EntidadExpediente->setAttributes($attributes);
                    $response = $EntidadExpediente->createEntidadExpediente(false);
                }
            }
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
        $data = $this->keyValueField('estado');
        return $data[$this->estado];
    }

    /**
     * retorna la etiqueta del estado de cierre del expediente
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstadoCierre() : string
    {
        $data = $this->keyValueField('estado_cierre');
        return $data[$this->estado_cierre];
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
        $data = $this->getRelationFk('Funcionario', 'propietario');
        if ($data) {
            $response = $data->nombres . ' ' . $data->apellidos;
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
        $data = $this->getRelationFk('Funcionario', 'responsable');
        if ($data) {
            $response = $data->nombres . ' ' . $data->apellidos;
        }
        return $response;
    }

    public function getSoporte()
    {
        $data = $this->keyValueField('soporte');
        return $data[$this->soporte];
    }

    public function getFrecuenciaConsulta()
    {
        $data = $this->keyValueField('frecuencia_consulta');
        return $data[$this->frecuencia_consulta];
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
            $sql = "SELECT count(idexpediente) as cant FROM expediente WHERE tomo_padre={$this->tomo_padre}";
            $data = $this->search($sql);
            $cant = $data[0]['cant'] + 1;
        } else {
            $sql = "SELECT count(idexpediente) as cant FROM expediente WHERE tomo_padre={$this->idexpediente}";
            $data = $this->search($sql);
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
        $response = $this->search($sql);
        if ($response) {
            $cant = $response[0]['cant'];
        }
        return $cant;
    }

    public function getAgrupador()
    {
        $data = $this->keyValueField('agrupador');
        return $data = $data[$this->agrupador];
    }
    /**
     * Valida si el funcionario es reponsable de un expediente
     *
     * @return boolean
     * @author Name <email@email.com>
     */
    public function isResponsable() : bool
    {
        $response = false;
        if ($this->propietario == $_SESSION['idfuncionario'] || $this->responsable == $_SESSION['idfuncionario']) {
            $response = true;
        }
        return $response;
    }

    /**
     * valida si un expediente se puede cerrar
     *
     * @return boolean
     */
    public function canClose() : bool
    {
        $response = false;
        $sql = "SELECT count(idexpediente) as cant FROM expediente WHERE cod_arbol like '{$this->cod_arbol}.%' AND agrupador=0 AND estado=1 AND estado_cierre=1";
        $cant = $this->search($sql);
        if (!$cant[0]['cant']) {
            $response = true;
        }
        return $response;
    }

    public function infoRetencion() : string
    {
        $response = '';
        if ($this->estado_cierre == 2) {
            $infoSerie = $this->getRelationFk('Serie');
            if ($infoSerie) {
                $tiempo = 'P' . $infoSerie->retencion_gestion . 'M';
                $fecha = new DateTime($this->fecha_cierre);
                $fecha->add(new DateInterval($tiempo));
                $intervalo = $fecha->diff(new DateTime(date('Y-m-d')));

                if ($intervalo->y) {
                    $texto = $intervalo->format('y% años, %m meses, %d días');
                } elseif ($intervalo->m) {
                    $texto = $intervalo->format('%m meses, %d días');
                } else {
                    $texto = $intervalo->format('%d días');
                }
                if ($intervalo->invert) {
                    $response = 'Faltan ' . $texto;
                } else {
                    $response = 'Se ha superado el tiempo de retención en ' . $texto;
                }
            } else {
                $response = 'No se encuentra la serie';
            }
        }

        return $response;
    }

    /**
     * setea los permisos del funcionario logueado
     *
     * @param integer $idfuncionario : usuario logueado
     * @return void
     */
    private function setAccessUser(int $idfuncionario)
    {
        //DESCOMENTAR CUAMBIAR CUANDO TERMINE EL DESARROLLO
        /*if (UtilitiesController::permisoModulo('expediente_admin')) {
            $this->permiso = [
                'a' => true,
                'l' => true,
                'e' => true,    
                'c' => true,
                'd' => true,
                'v' => false
            ];
        } else {*/
        $sql = "SELECT permiso FROM permiso_expediente WHERE fk_expediente={$this->idexpediente} and fk_funcionario={$idfuncionario}";
        $consPermiso = $this->search($sql);
        if ($consPermiso) {
            foreach ($consPermiso as $fila) {
                $permisos = explode(',', $fila['permiso']);
                foreach ($permisos as $permiso) {
                    $this->permiso[$permiso] = true;
                }
            }
        }
        if ($this->isResponsable()) {
            $this->permiso['e'] = true;
            $this->permiso['d'] = true;
            $this->permiso['c'] = true;
            $this->permiso['v'] = false;
        }
        //}
    }
    /**
     * obtiene los permisos del funcionario logueado
     *
     * @param string $permiso : 
     * a: adicion Serie,
     * l: lectura serie,
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
     * retorna las instancias de expediente doc vinculadas al expediente
     *
     * @param int $instance : 1, retorna las instancias; 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteDocFk(int $instance = 1)
    {
        if ($instance) {
            $data = ExpedienteDoc::findAllByAttributes(['idexpediente' => $this->idexpediente]);
        } else {
            $data = ExpedienteDoc::findColumn('idexpediente_doc', ['idexpediente' => $this->idexpediente]);
        }

        return $data;
    }

    /**
     * retorna las instancias de Expediente cierre vinculadas al expediente
     *
     * @param int $instance : 1, retorna las instancias; 0, retorna solo los ids
     * @return array|null
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getExpedienteCierreFk(int $instance = 1)
    {
        if ($instance) {
            $data = ExpedienteCierre::findAllByAttributes(['fk_expediente' => $this->idexpediente], [], 'idexpediente_cierre desc');
        } else {
            $data = ExpedienteCierre::findColumn('idexpediente_cierre', ['fk_expediente' => $this->idexpediente]);
        }
        return $data;
    }

    /**
     * Crea el HTML de un campo
     *
     * @param string $campo : Nombre del campo en la DB
     * @param string $etiqHtml : Etiqueta HTML
     * @param integer $selected : ID del cual desea este checkeado/seleccionado
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function getHtmlField(string $campo, string $etiqHtml, $selected = 0) : string
    {
        $html = '';
        switch ($etiqHtml) {
            case 'select':
                $data = self::keyValueField($campo);
                foreach ($data as $key => $value) {
                    if ($selected == $key) {
                        $html .= "<option value='{$key}' selected>{$value}</option>";
                    } else {
                        $html .= "<option value='{$key}'>{$value}</option>";
                    }
                }
                break;
        }
        return $html;
    }


    /**
     * Obtiene los datos de los campos key y value
     *
     * @param string $campo : nombre del campo en la db
     * @return array
     */
    public static function keyValueField(string $campo) : array
    {
        $response['estado'] = [
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        ];

        $response['estado_cierre'] = [
            1 => 'Abierto',
            2 => 'Cerrado'
        ];

        $response['soporte'] = [
            1 => 'CD - ROM',
            2 => 'DISKETE',
            3 => 'DVD',
            4 => 'DOCUMENTO',
            5 => 'FAX',
            6 => 'REVISTA O LIBRO',
            7 => 'VIDEO',
            8 => 'OTROS ANEXOS'
        ];
        $response['frecuencia_consulta'] = [
            1 => 'Alta',
            2 => 'Media',
            3 => 'Baja'
        ];

        $response['agrupador'] = [
            0 => 'Expediente',
            1 => 'Dependencia',
            2 => 'Serie',
            3 => 'Separador'
        ];

        return $response[$campo];
    }
}
