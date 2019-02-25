<?php

class Ejecutor extends Model {

    protected $tabla = 'ejecutor';
    protected $idejecutor;
    protected $identificacion;
    protected $nombre;
    protected $fecha_ingreso;
    protected $estado;
    protected $tipo_ejecutor;
    protected $datosEjecutor;

    const TIPO_PERSONA_NATURAL = 1;
    const TIPO_PERSONA_JURIDICA = 2;
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
                    "safe" => [
                        "identificacion",
                        "nombre",
                        "fecha_ingreso",
                        "estado",
                        "tipo_ejecutor"
                    ],
                    "table" => "ejecutor",
                    "primary" => "idejecutor"
        ];
    }

    public function setDatosEjecutor($datosEjecutor) {
        $this->datosEjecutor = $datosEjecutor;
    }

    public function getDatosEjecutor() {
        return $this->datosEjecutor;
    }

    public static function findByIdentificacion($identificacion) {
        if(!empty($identificacion)) {
            $sql = <<<SQL
                select t.*
                from ejecutor t
                join datos_ejecutor dt
                    on t.idejecutor = dt.ejecutor_idejecutor
                where
                    t.estado = {self::ESTADO_ACTIVO}
                    AND t.identificacion = '{$identificacion}'
SQL;
            $records = StaticSql::search($sql);

            $total = isset($records['numcampos']) ? $records['numcampos'] : count($records);

            $data = [];
            for($row = 0; $row < $total; $row++) {
                $tercero = new self();
                $datosTercero = new DatosEjecutor();
                $tercero->idejecutor = $records[$row]['idejecutor'];
                $datosTercero->iddatos_ejecutor = $records[$row]['iddatos_ejecutor'];
                $tercero->setAttributes($records[$row]);
                $datosTercero->setAttributes($records[$row]);
                $tercero->setDatosEjecutor($datosTercero);
                $data[] = $tercero;
            }

            return $data;
        }
        return null;
    }

    public static function findByIdentificacionTipo($identificacion, $tipo) {
        if(!in_array($tipo, [self::TIPO_PERSONA_NATURAL, self::TIPO_PERSONA_JURIDICA])) {
            return null;
        }
        if(!empty($identificacion) && !empty($tipo)) {
            $sql = <<<SQL
                select t.*
                from ejecutor t
                join datos_ejecutor dt
                    on t.idejecutor = dt.ejecutor_idejecutor
                where
                    t.estado = {self::ESTADO_ACTIVO}
                    AND t.identificacion = '{$identificacion}'
                    AND t.tipo = {$tipo}
SQL;
            $records = StaticSql::search($sql);

            $total = isset($records['numcampos']) ? $records['numcampos'] : count($records);

            $data = [];
            for($row = 0; $row < $total; $row++) {
                $tercero = new self();
                $datosTercero = new DatosEjecutor();
                $tercero->idejecutor = $records[$row]['idejecutor'];
                $datosTercero->iddatos_ejecutor = $records[$row]['iddatos_ejecutor'];
                $tercero->setAttributes($records[$row]);
                $datosTercero->setAttributes($records[$row]);
                $tercero->setDatosEjecutor($datosTercero);
                $data[] = $tercero;
            }

            return $data;
        }
        return null;
    }

    public function consultarDatos() {
        $posibles = DatosEjecutor::findByEjecutor($this->getPK());
        if(count($posibles)) {
            $this->setDatosEjecutor($posibles[0]);
        }
    }
}
