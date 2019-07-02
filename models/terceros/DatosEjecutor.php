<?php

class DatosEjecutor extends Model {

    protected $tabla = 'datos_ejecutor';
    protected $iddatos_ejecutor;
    protected $ejecutor_idejecutor;
    protected $direccion;
    protected $telefono;
    protected $cargo;
    protected $ciudad;
    protected $titulo;
    protected $empresa;
    protected $fecha;
    protected $email;
    protected $codigo;

    function __construct($id = null) {
        parent::__construct($id);
    }

    protected function defineAttributes() {
        $this->dbAttributes = (object) [
            "safe" => [
                "ejecutor_idejecutor",
                "direccion",
                "telefono",
                "cargo",
                "ciudad",
                "titulo",
                "empresa",
                "fecha",
                "email",
                "codigo"
            ],
            "table" => "datos_ejecutor",
            "primary" => "iddatos_ejecutor"
        ];
    }

        public static function findByEjecutor($idejecutor) {
        if(!empty($idejecutor)) {
            $sql = <<<SQL
                select dt.*
                from ejecutor t
                join datos_ejecutor dt
                    on t.idejecutor = dt.ejecutor_idejecutor
                where
                    t.estado = {Ejecutor::ESTADO_ACTIVO}
                    AND dt.ejecutor_idejecutor = '{$idejecutor}'
                    ORDERY BY dt.iddatos_ejecutor desc
SQL;
            $records = StaticSql::search($sql);

            $total = isset($records['numcampos']) ? $records['numcampos'] : count($records);

            $data = [];
            for($row = 0; $row < $total; $row++) {
                $datosTercero = new DatosEjecutor();
                $datosTercero->iddatos_ejecutor = $records[$row]['iddatos_ejecutor'];
                $datosTercero->setAttributes($records[$row]);
                $data[] = $datosTercero;
            }

            return $data;
        }
        return null;
    }

}