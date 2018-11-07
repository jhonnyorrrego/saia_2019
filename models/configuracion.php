<?php
require_once $ruta_db_superior . 'models/model.php';

class Configuracion extends Model
{
    protected $idconfiguracion;
    protected $nombre;
    protected $valor;
    protected $tipo;
    protected $fecha;
    protected $encrypt;
    protected $table = 'configuracion';
    protected $primary = 'idconfiguracion';

    function __construct($id){
        return parent::__construct($id);
    }

    public static function findByName($name){
        global $conn;

        $data = busca_filtro_tabla('idconfiguracion', 'configuracion', 'nombre="'.$name.'"', '', $conn);

        return new Configuracion($data[0]['idconfiguracion']);
    }

    public function setValue($value){
        $this->valor = $value;
    }
}
