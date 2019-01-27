<?php

class Configuracion extends Model
{
    protected $idconfiguracion;
    protected $nombre;
    protected $valor;
    protected $tipo;
    protected $fecha;
    protected $encrypt;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

     /**
     * define values for dbAttributes
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
        return Configuracion::findAllByAttributes(["nombre" => $name]);
    }

    /**
     * Recibe una lista de nombres y devuelve un arreglo de objetos
     * @param array $nombres
     * @return Configuracion[]
     */
     public static function findByNames($nombres) {
         global $conn;
         $cond = implode("','", $nombres);
         $data = busca_filtro_tabla('nombre,valor', 'configuracion', "nombre IN('" . $cond . "')", '', $conn);
         return self::convertToObjectCollection($data);
    }

    public function setValue($value){
        $this->valor = $value;
    }
}
