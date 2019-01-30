<?php

class EtiquetaTarea extends Model
{
    protected $idetiqueta_tarea;
    protected $fk_tarea;
    protected $fk_funcionario;
    protected $fk_etiqueta;
    protected $estado;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [
                'idetiqueta_tarea',
                'fk_tarea',
                'fk_funcionario',
                'fk_etiqueta',
                'estado'
            ],
            'date' => []
        ];
    }

    /**
     * define si la relacion de una tarea
     * y una etiqueta está activa
     *
     * @param int $tagId id etiqueta
     * @param int $taskId id tarea
     * @return boolean
     */
    public static function isActive($tagId, $taskId){
        $EtiquetaTarea = self::findByAttributes([
            'fk_tarea' => $taskId,
            'fk_etiqueta' => $tagId,
            'estado' => 1
        ]);

        return $EtiquetaTarea ? 1 : 0;
    }

    public function toggleRelaction($state){
        $this->estado = $state;

        if($this->save()){
            $response = $this->getPK();
        }else{
            $response = 0;
        }

        return $response;
    }
}