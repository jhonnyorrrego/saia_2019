<?php

use \Doctrine\DBAL\Types\Type;

class Expediente extends LogModel
{
    protected $idexpediente;
    protected $nombre;
    protected $codigo;
    protected $descripcion;
    protected $fecha_creacion;

    protected $indice_uno;
    protected $indice_dos;
    protected $indice_tres;

    protected $fecha_extrema_i;
    protected $fecha_extrema_f;
    protected $consecutivo_inicial;
    protected $consecutivo_final;

    protected $ruta_qr;
    protected $estado_archivo;
    protected $estado_cierre;

    protected $tomo_padre;
    protected $tomo_no;

    protected $fk_propietario;
    protected $fk_responsable;

    protected $fk_serie_dependencia;
    protected $fk_dependencia;
    protected $fk_serie;
    protected $fk_subserie;
    protected $fk_caja;

    protected $estado;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }


    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'idexpediente',
                'nombre',
                'codigo',
                'descripcion',
                'fecha_creacion',
                'indice_uno',
                'indice_dos',
                'indice_tres',
                'fecha_extrema_i',
                'fecha_extrema_f',
                'consecutivo_inicial',
                'consecutivo_final',
                'ruta_qr',
                'estado_archivo',
                'estado_cierre',
                'tomo_padre',
                'tomo_no',
                'fk_propietario',
                'fk_responsable',
                'fk_serie_dependencia',
                'fk_dependencia',
                'fk_serie',
                'fk_subserie',
                'fk_caja',
                'estado',
            ],
            'date' => [
                'fecha_creacion',
                'fecha_extrema_i',
                'fecha_extrema_f'
            ]
        ];
    }

    public function afterCreate()
    {
        parent::afterCreate();

        if (!$this->addPermissionResponsable()) {
            throw new Exception("Error al otorgar permisos al responsable", 1);
        }

        if (!$this->addPermission()) {
            throw new Exception("Error al otorgar permisos sobre el expediente", 1);
        }
    }

    /**
     * adiciona o actualiza el permiso 
     * al reponsable del expediente
     *
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    protected function addPermissionResponsable(): bool
    {
        if ($ExpedientePermiso = ExpedientePermiso::findByAttributes([
            'responsable' => 1,
            'fk_expediente' => $this->getPK()
        ])) {
            $response = true;

            if ($ExpedientePermiso->fk_funcionario != $this->fk_responsable) {
                $ExpedientePermiso->setAttributes([
                    'fk_funcionario' => $this->fk_responsable
                ]);
                $response = $ExpedientePermiso->update();
            }
        } else {
            $response = ExpedientePermiso::newRecord([
                'fk_funcionario' => $this->fk_responsable,
                'fk_expediente' => $this->getPK(),
                'responsable' => 1
            ]);
        }

        return $response;
    }

    /**
     * Adiciona el permiso del expediente
     * a los funcionarios
     *
     * @return boolean
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    protected function addPermission(): bool
    {
        $retorno = true;

        $data = $this->getQueryBuilder()
            ->select('DISTINCT fk_funcionario')
            ->from('acceso')
            ->where('estado=1')
            ->andWhere('tipo_relacion=:tipo_relacion')
            ->andWhere('id_relacion=:id_relacion')
            ->andWhere('fk_funcionario<>:fk_funcionario')
            ->setParameters([
                ':tipo_relacion' => Acceso::TIPO_SERIE_DEPENDENCIA,
                ':id_relacion' => $this->fk_serie_dependencia,
                ':fk_funcionario' => $this->fk_responsable
            ], [
                ':tipo_relacion' => Type::INTEGER,
                ':id_relacion' => Type::INTEGER,
                ':fk_funcionario' => Type::INTEGER,
            ])
            ->execute()->fetchAll();

        if ($data) {
            foreach ($data as $row) {
                if (!ExpedientePermiso::newRecord([
                    'fk_funcionario' => $row['fk_funcionario'],
                    'fk_expediente' => $this->getPK(),
                    'resposable' => 0
                ])) {
                    $retorno = false;
                    break;
                }
            }
        }

        return $retorno;
    }

    /**
     * obtiene los datos del expediente
     * utilizados para el front
     *
     * @param integer $id
     * @return array
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function getDataId(int $id): array
    {
        return ($data = self::getAllData(['idexpediente' => $id]))
            ? $data[0] : [];
    }

    /**
     * obtiene todos los datos de los expedientes
     * utilizado para el front
     *
     * @param array $conditions
     * @param integer $offset
     * @param integer $limit
     * @return array
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public static function getAllData(
        array $conditions = [],
        int $offset = null,
        int $limit = null
    ): array {

        $fields = [
            'v.idexpediente',
            'v.expediente',
            'v.fecha',
            'v.nom_estado_archivo',
            'v.estado_cierre',
            'v.nom_estado_cierre',
            'v.nombre_responsable',
            'v.nombre_creador',
            'v.descripcion',
            'v.tomo_no'
        ];

        $QueryBuilder = self::getQueryBuilder()
            ->select($fields)
            ->from('vexpedientes', 'v');

        $QueryBuilder = self::callBuilderMethod($conditions, $QueryBuilder, 'andWhere');

        if ($limit) {
            $QueryBuilder
                ->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        return $QueryBuilder->execute()->fetchAll() ?? [];
    }



    //



    /**
     * Se ejecuta posterior al eliminar un expediente
     * Elimina las documentos y el historial de cierre vinculadoa al expediente
     *
     * @return void
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function afterDelete()
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
     * Obtiene el icono del expediente
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getIcon(): string
    {
        $icon = [
            0 => 'fa fa-folder',
            1 => 'fa fa-group',
            2 => 'fa fa-barcode',
            3 => 'fa fa-briefcase',
        ];
        if ($this->estado_cierre == 1) {
            $icon[0] = 'fa fa-folder-open';
        }
        return $icon[$this->agrupador];
    }

    /**
     * Crea el expediente con sus correspondientes vinculados
     * NO utlizar save/create
     * 
     * @return array
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function CreateExpediente(): array
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
    public function updateResponsable(int $responAnt): array
    {
        $response = [
            'exito' => 0,
            'message' => '',
        ];
        if ($this->responsable == $responAnt) {
            $response['exito'] = 1;
        } else {
            if ($this->update()) {
                $sql = "SELECT identidad_expediente FROM entidad_expediente 
                WHERE tipo_funcionario=2 AND fk_expediente={$this->idexpediente}";
                //$idEnt = //ejecuta la busqueda
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
    public function getEstado(): string
    {
        $data = $this->keyValueField('estado');
        return $data[$this->estado] ?? '';
    }

    /**
     * retorna la etiqueta del estado de cierre del expediente
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstadoCierre(): string
    {
        $data = $this->keyValueField('estado_cierre');
        return $data[$this->estado_cierre] ?? '';
    }

    /**
     * Retorna el nombre del propietario
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getPropietario(): string
    {
        $propietario = 'GENERADO POR EL SISTEMA';
        if ($this->propietario) {
            $data = $this->getRelationFk('Funcionario', 'propietario');
            $propietario = $data ? $data->nombres . ' ' . $data->apellidos : '';
        }
        return $propietario;
    }
    /**
     * Retorna el nombre del funcionario responsable
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getResponsable(): string
    {
        $data = $this->getRelationFk('Funcionario', 'responsable');
        return $data ? $data->nombres . ' ' . $data->apellidos : '';
    }

    /**
     * retorna la etiqueta del campo estado_archivo
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getEstadoArchivo(): string
    {
        $data = $this->keyValueField('estado_archivo');
        return $data[$this->estado_archivo] ?? '';
    }

    /**
     * Retorna el codigo de la caja vinculada
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getCaja(): string
    {
        $data = $this->getRelationFk('Caja');
        return $data ? $data->codigo : '';
    }

    public function getSoporte()
    {
        $data = $this->keyValueField('soporte');
        return $data[$this->soporte] ?? '';
    }

    public function getFrecuenciaConsulta()
    {
        $data = $this->keyValueField('frecuencia_consulta');
        return $data[$this->frecuencia_consulta] ?? '';
    }

    /**
     * Cuenta la cantidad de tomos de un expediente
     *
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countTomos(): int
    {
        if ($this->tomo_padre) {
            $sql = "SELECT count(idexpediente) as cant FROM expediente 
            WHERE tomo_padre={$this->tomo_padre}";
            //$data = //ejecuta la busqueda
        } else {
            $sql = "SELECT count(idexpediente) as cant FROM expediente 
            WHERE tomo_padre={$this->idexpediente}";
            //$data = //ejecuta la busqueda
        }
        return $data ? $data[0]['cant'] + 1 : 1;
    }
    /**
     * Cuenta los documentos que existen en un expediente
     *
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function countDocuments(): int
    {
        return ExpedienteDoc::countDocumentsExp($this->idexpediente);
    }

    /**
     * Cuenta los expedientes que existen dentro de una caja
     * incluye expedientes inferiores
     * 
     * @param integer $idcaja : identificador de la caja
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function countAllExpedienteCaja(int $idcaja = null): int
    {
        $sql = "SELECT COUNT(idexpediente) as cant FROM expediente 
        WHERE agrupador=0 AND fk_caja={$idcaja} AND estado=1";
        //$response =//ejecutaba el sql
        return $response ? $response[0]['cant'] : 0;
    }

    /**
     * Cuenta los expedientes que existen dentro de una caja
     * NO incluye expedientes inferiores
     * 
     * @param integer $idcaja : identificador de la caja
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function countExpedienteCaja(int $idcaja = null): int
    {
        return 0;
    }

    /**
     * obtiene la etiqueta del agraupdor
     *
     * @return string
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getAgrupador(): string
    {
        $data = $this->keyValueField('agrupador');
        return $data[$this->agrupador] ?? '';
    }
    /**
     * Valida si el funcionario es reponsable de un expediente
     *
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function isResponsable(): bool
    {
        $userId = SessionController::getValue('idfuncionario');
        return in_array($userId, [$this->propietario, $this->responsable]);
    }

    /**
     * valida si un expediente se puede cerrar
     *
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function canClose(): bool
    {
        $sql = "SELECT count(idexpediente) as cant FROM expediente
        WHERE cod_arbol like '{$this->cod_arbol}.%' AND agrupador=0 
        AND estado=1 AND estado_cierre=1";
        //$cant = //buscar con querybuilder
        return (!$cant[0]['cant']) ? true : false;
    }

    public function infoRetencion(): string
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
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
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
        $sql = "SELECT permiso FROM permiso_expediente 
        WHERE fk_expediente={$this->idexpediente} and fk_funcionario={$idfuncionario}";
        //$consPermiso = //ejecuta la busqueda
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
     * v: ver expediente (utilizado para navegar dentro de expedientes sin permisos)
     * d: eliminar expediente
     * 
     * @return boolean
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public function getAccessUser(string $permiso): bool
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
            $data = ExpedienteDoc::findAllByAttributes(
                ['idexpediente' => $this->idexpediente]
            );
        } else {
            $data = ExpedienteDoc::findColumn(
                'idexpediente_doc',
                ['idexpediente' => $this->idexpediente]
            );
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
            $data = ExpedienteCierre::findAllByAttributes(
                ['fk_expediente' => $this->idexpediente],
                [],
                'idexpediente_cierre desc'
            );
        } else {
            $data = ExpedienteCierre::findColumn(
                'idexpediente_cierre',
                ['fk_expediente' => $this->idexpediente]
            );
        }
        return $data;
    }

    public static function getHtmlCaja(Expediente $Expediente = null): string
    {
        $html = '';
        if ($Expediente) {
            $sql = "SELECT c.idcaja,c.codigo FROM caja_entidadserie ce,caja c, entidad_serie e 
            WHERE ce.fk_caja=c.idcaja AND ce.fk_entidad_serie=e.identidad_serie AND e.estado=1 
            AND c.estado=1 AND c.estado_archivo={$Expediente->estado_archivo} 
            AND ce.fk_entidad_serie={$Expediente->fk_entidad_serie}";
            //$records = //ejecutaba el select
            if ($records) {
                foreach ($records as $record) {
                    if ($Expediente->fk_caja == $record['idcaja']) {
                        $html .= "<option value='{$record['idcaja']}' selected>{$record['codigo']}</option>";
                    } else {
                        $html .= "<option value='{$record['idcaja']}'>{$record['codigo']}</option>";
                    }
                }
            }
        }
        return $html;
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
    public static function getHtmlField(string $campo, string $etiqHtml, $selected = 0): string
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
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function keyValueField(string $campo): array
    {
        $response['estado'] = [
            0 => 'INACTIVO',
            1 => 'ACTIVO'
        ];

        $response['estado_archivo'] = [
            1 => 'Gestion',
            2 => 'Central',
            3 => 'Historico'
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




    /*
    public function massiveAssigned()
    {
        if ($this->idexpediente) {
            $this->permiso = [
                'a' => false,
                'l' => false,
                'e' => false,
                'c' => false,
                'd' => false,
                'v' => false
            ];
            $userId = SessionController::getValue('idfuncionario');
            $this->setAccessUser($userId);
        }
    }*/
}
