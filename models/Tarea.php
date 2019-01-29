<?php

class Tarea extends Model
{
    protected $idtarea;
    protected $nombre;
    protected $fecha_inicial;
    protected $fecha_final;
    protected $descripcion;
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
            'fecha_inicial',
            'fecha_final',
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
     * @return DateTime
     */
    public function getInitialDate(){
        return $this->fecha_inicial;
    }

    /**
     * retorna la fecha final
     *
     * @return DateTime
     */
    public function getFinalDate(){
        return $this->fecha_final;
    }

    public function getColor(){
        $Limit = new DateTime($this->fecha_final);
        $Today = new DateTime();

        $diference = DateController::dias_habiles_entre_fechas($Today, $Limit);

        if($diference < 3){
            $color = '#dc3545';
        }elseif($diference >= 3 && $diference <= 8){
            $color = '#ffc107';
        }else{
            $color = '#17a2b8';
        }

        return $color;
    }

    /**
     * busca las tareas entre fechas
     * segun el tipo de funcionario
     *
     * @param int $userId idfuncionario
     * @param DateTime $initialDate fecha inicial
     * @param DateTime $finalDate fecha final
     * @param int $type tipo de relacion 1,responsable.2,seguidor.3,creador
     * @return array objetos de la clase tarea
     */
    public static function findBetweenDates($userId, $initialDate, $finalDate, $type){
        global $conn;

        $tables = self::getTableName() . ' a,' . FuncionarioTarea::getTableName() . ' b';
        $findRecords = busca_filtro_tabla('a.*', $tables, "a.idtarea = b.fk_tarea and b.estado=1 and b.fk_funcionario =" . $userId . " and b.tipo= " . $type . " and " . fecha_db_obtener('a.fecha_inicial', 'Y-m-d H:i:s') . ">='" . $initialDate . "' and " . fecha_db_obtener('a.fecha_final', 'Y-m-d H:i:s') . "<='". $finalDate . "'", '', $conn);

        return self::convertToObjectCollection($findRecords);
    }
}