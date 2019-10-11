<?php

class Vexpedientes extends Model
{
    protected $idexpediente;
    protected $expediente;
    protected $descripcion;
    protected $fecha_creacion;
    protected $fecha;
    protected $indice_uno;
    protected $indice_dos;
    protected $indice_tres;
    protected $ruta_qr;
    protected $fk_serie_dependencia;
    protected $tomo_no;
    protected $nom_expediente_tomo;
    protected $estado_archivo;
    protected $nom_estado_archivo;
    protected $estado_cierre;
    protected $nom_estado_cierre;
    protected $fk_responsable;
    protected $nombre_responsable;
    protected $fk_propietario;
    protected $nombre_creador;
    protected $fk_dependencia;
    protected $dependencia;
    protected $cod_dependencia;
    protected $fk_serie;
    protected $serie;
    protected $cod_serie;
    protected $fk_serie_version;
    protected $fk_subserie;
    protected $subserie;
    protected $cod_subserie;
    protected $consecutivo;

    protected $SerieReference;
    protected $nom_tipo_serie;
    protected $codigo;

    public function __construct(int $id = null)
    {
        parent::__construct($id);
        $this->init();
    }

    protected function defineAttributes()
    {

        $safeDbAttributes = [
            'idexpediente',
            'expediente',
            'descripcion',
            'fecha_creacion',
            'fecha',
            'indice_uno',
            'indice_dos',
            'indice_tres',
            'ruta_qr',
            'fk_serie_dependencia',
            'tomo_no',
            'nom_expediente_tomo',
            'estado_archivo',
            'nom_estado_archivo',
            'estado_cierre',
            'nom_estado_cierre',
            'fk_responsable',
            'nombre_responsable',
            'fk_propietario',
            'nombre_creador',
            'fk_dependencia',
            'dependencia',
            'cod_dependencia',
            'fk_serie',
            'serie',
            'cod_serie',
            'fk_serie_version',
            'fk_subserie',
            'subserie',
            'cod_subserie',
            'consecutivo'
        ];

        $dateAttributes = [
            'fecha_creacion'
        ];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes,
            'primary' => 'idexpediente',
            'table' => 'vexpedientes'
        ];
    }

    private function init()
    {
        if ($this->fk_serie_dependencia) {

            $idserie = $this->fk_subserie ? $this->fk_subserie : $this->fk_serie;
            $this->SerieReference = new Serie($idserie);
        }
        $this->nom_tipo_serie = $this->getNameTipoSerie();
        $this->codigo = $this->getCodigo();
    }

    private function getNameTipoSerie()
    {
        return $this->SerieReference
            ? $this->SerieReference->nombre : "No Clasificada";
    }

    private function getCodigo()
    {
        return $this->SerieReference
            ? "{$this->cod_dependencia}-{$this->SerieReference->codigo}-{$this->consecutivo}" : "N/A";
    }

    public function getInfoExpediente(): array
    {
        $response = [
            'idexpediente' => $this->getPK(),
            'expediente' => $this->expediente,
            'nombre_responsable' => $this->nombre_responsable,
            'nombre_creador' => $this->nombre_creador,
            'fecha' => $this->fecha,
            'descripcion' => $this->descripcion,
            'estado_cierre' => $this->estado_cierre,
            'nom_estado_cierre' => $this->nom_estado_cierre,
            'nom_estado_archivo' => $this->nom_estado_archivo,
            'nom_tipo_serie' => $this->nom_tipo_serie,
            'codigo' => $this->codigo
        ];

        $response['fecha_update'] = "PENDIENTE";
        $response['compartido'] = "PENDIENTE";
        $response['indice'] = "PENDIENTE";

        return $response;
    }

    public function getDataRowList(): array
    {
        return  [
            'idexpediente' => $this->getPK(),
            'expediente' => $this->expediente,
            'nombre_responsable' => $this->nombre_responsable,
            'fecha' => $this->fecha,
            'nom_estado_cierre' => $this->nom_estado_cierre
        ];
    }

    public static function getDataAllRowList(): array
    {
        $fields = [
            'idexpediente',
            'expediente',
            'nombre_responsable',
            'fecha',
            'nom_estado_cierre'
        ];

        return self::getDataExpediente([], $fields);
    }


    public static function getDataExpediente(
        array $conditions = [],
        array $fields = [],
        int $offset = null,
        int $limit = null
    ): array {

        if (!$fields) {
            $fields = '*';
        }
        $QueryBuilder = self::getQueryBuilder()
            ->select($fields)
            ->from('vexpedientes', 'v');

        $QueryBuilder = self::callBuilderMethod($conditions, $QueryBuilder, 'andWhere');

        if ($limit) {
            $QueryBuilder
                ->setFirstResult($offset)
                ->setMaxResults($limit);
        }
        $data = $QueryBuilder->execute()->fetchAll();

        return ($data) ? $data : [];
    }
}
