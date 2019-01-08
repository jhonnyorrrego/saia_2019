<?php
require_once $ruta_db_superior . 'models/model.php';

class NotaPagina extends Model {
    protected $table = 'nota_pagina';
    protected $primary = 'idnota_pagina';
    protected $fecha_creacion;
    protected $observacion;
    protected $fk_funcionario;
    protected $fk_pagina;
    protected $json;
    protected $posicion;
    protected $safeDbAttributes = [
    'fecha_creacion',
    'observacion',
    'fk_funcionario',
    'fk_pagina',
    'posicion',
    'json'];

    function __construct($id) {
        parent::__construct($id);
    }

    /**
     * @return string valor del atributo observacion
     * @author Andres.Agudelo
     */

    public function getPosicion() {
        return $this -> posicion;
    }

    /**
     * @return string valor del atributo observacion
     * @author Andres.Agudelo
     */

    public function getObservacion() {
        return $this -> observacion;
    }

    /**
     * @return string valor del atributo json
     * @author Andres.Agudelo
     */

    public function getJson() {
        return $this -> json;
    }

    /**
     * @return string Nombre del funcionario creador de la nota
     * @author Andres.Agudelo
     */
    public function getNameFuncionario() {
        $nombre = '';
        $funcionario = busca_filtro_tabla("nombres,apellidos", "funcionario", "idfuncionario=" . $this -> fk_funcionario, "", $this -> conn);
        if ($funcionario["numcampos"]) {
            $nombre = $funcionario[0]["nombres"] . ' ' . $funcionario[0]["apellidos"];
        }
        return $nombre;
    }

    /**
     * @param int $idpagina identificacion de la pagina
     * @param string $order es el order by de la consulta
     * @return Array coleccion de datos de las notas de la pagina (instancias de nota)
     * @author Andres.Agudelo
     * */

    public static function getAllResultPagina($idpagina, $order = "") {
        global $conn;
        $retorno = array();
        $data = busca_filtro_tabla("idnota_pagina", "nota_pagina", "fk_pagina=" . $idpagina, $order, $conn);
        if ($data["numcampos"]) {
            $retorno["numcampos"] = $data["numcampos"];
            for ($i = 0; $i < $data["numcampos"]; $i++) {
                $retorno["data"][$i] = new NotaPagina($data[$i]['idnota_pagina']);
            }
        }
        return $retorno;
    }

}
