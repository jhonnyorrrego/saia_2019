<?php
require_once $ruta_db_superior . 'models/model.php';

class Tarea extends Model
{
    protected $idtarea;
    protected $nombre;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $prioridad;
    protected $descripcion;

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
            'fecha_inicial',
            'fecha_final',
            'prioridad',
            'descripcion',
        ];
    
        // set the date attributes on the schema
        $dateAttributes = [ 'fecha_inicial','fecha_final'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * retorna el nombre
     *
     * @return string
     */
    public function getName(){
        return ucfirst(trim(strtolower($this->nombre)));
    }

    /**
     * retorna la fecha inicial
     *
     * @return date
     */
    public function getInitialDate(){
        return $this->fecha_inicial;
    }

    /**
     * retorna la fecha final
     *
     * @return date
     */
    public function getFinalDate(){
        return $this->fecha_final;
    }

    /**
     * Undocumented function
     *
     * @param [type] $userId
     * @param [type] $initialDate
     * @param [type] $finalDate
     * @return void
     */
    public static function findBetweenDates($userId, $initialDate, $finalDate){
        global $conn;

        $tables = self::getTableName() . ' a,' . FuncionarioTarea::getTableName() . ' b';
        $findRecords = busca_filtro_tabla('*', $tables, "a.idtarea = b.fk_tarea and b.fk_funcionario =" . $userId . " and " . fecha_db_obtener('a.fecha_inicial', 'Y-m-d H:i:s') . ">='" . $initialDate . "' and " . fecha_db_obtener('a.fecha_final', 'Y-m-d H:i:s') . "<='". $finalDate . "'", '', $conn);
        
        return self::convertToObjectCollection($findRecords);
    }
}