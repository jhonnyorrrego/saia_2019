<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class AnexoTarea extends Model
{
    protected $idanexo_tarea;
    protected $fk_tarea;
    protected $fk_funcionario;
    protected $ruta;
    protected $estado;
    protected $dbAttributes;

    function __construct($id){
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_funcionario',
                'fk_tarea',
                'ruta',
                'estado'
            ],
            'date' => []
        ];
    }
    
    public static function uploadTemporalFiles($temporalRoutes, $taskId){
        global $ruta_db_superior;

        $data = [];
        foreach($temporalRoutes as $route){
            $content = file_get_contents($ruta_db_superior . $_SESSION["ruta_temp_funcionario"] . $route);
            $route = $taskId . '/' . $route;
            
            $dbRoute = UtilitiesController::createFileDbRoute($route, 'anexos_tareas', $content);
            
            $data[] = self::newRecord([
                'fk_funcionario' => $_SESSION['idfuncionario'],
                'fk_tarea' => $taskId,
                'estado' => 1,
                'ruta' => $dbRoute
            ]);
        }

        return $data;
    }
}