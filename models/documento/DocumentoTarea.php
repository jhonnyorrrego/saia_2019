<?php

class DocumentoTarea extends Model
{
    protected $iddocumento_tarea;
    protected $fk_tarea;
    protected $fk_documento;
    protected $fk_funcionario;
    protected $fecha;
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
                'fk_tarea',
                'fk_documento',
                'fk_funcionario',
                'fecha',
                'estado'
            ],
            'date' => ['fecha']
        ];
    }

    public static function getTotalByDocument($documentId){
        global $conn;

        $findTotal = busca_filtro_tabla('count(*) as total', 'documento_tarea', 'fk_documento =' . $documentId, '', $conn);
        return $findTotal[0]['total'];
    }

    public static function findTaskByDocument($documentId){
        global $conn;

        $findTotal = busca_filtro_tabla('a.*', 'tarea a, documento_tarea b', 'a.idtarea = b.fk_tarea and b.fk_documento =' . $documentId, '', $conn);

        return Tarea::convertToObjectCollection($findTotal);
    }
}