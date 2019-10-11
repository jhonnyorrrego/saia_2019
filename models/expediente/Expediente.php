<?php

use \Doctrine\DBAL\Types\Type;

class Expediente extends LogModel
{
    protected $idexpediente;
    protected $nombre;
    protected $descripcion;
    protected $fecha_creacion;

    protected $indice_uno;
    protected $indice_dos;
    protected $indice_tres;

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
    protected $consecutivo;

    //VARIABLES PARA GUARDAR OBSERVACIONES EN LOG
    public $descripcion_estado_cierre;

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
                'descripcion',
                'fecha_creacion',
                'indice_uno',
                'indice_dos',
                'indice_tres',
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
                'consecutivo'
            ],
            'date' => [
                'fecha_creacion'
            ],
            'labels' => [
                'estado_cierre' => [
                    'label' => 'Estado cierre',
                    'values' => [
                        0 => 'INACTIVO',
                        1 => 'ACTIVO'
                    ]
                ]
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

    public function afterUpdate()
    {
        parent::afterUpdate();
        $this->descripcion_estado_cierre = null;
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


    public static function getMaxConsecutivoSerieDep(int $id): int
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('max(consecutivo) as consecutivo')
            ->from('expediente')
            ->where('fk_serie_dependencia=:fk_serie_dependencia')
            ->setParameter(':fk_serie_dependencia', $id, Type::INTEGER)
            ->execute()->fetch();

        return $QueryBuilder ? (int) $QueryBuilder['consecutivo'] : 0;
    }
}
