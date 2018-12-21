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
    protected $dbAttributes;

    function __construct($id){
        return parent::__construct($id);
    }

     /**
     * define the values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'nombre',
            'valor',
            'tipo',
            'fecha',
            'encrypt'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
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
