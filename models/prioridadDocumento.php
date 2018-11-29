<?php
require_once $ruta_db_superior . 'models/model.php';

class PrioridadDocumento extends Model
{
    protected $idprioridad_documento;
    protected $documento_iddocumento;
    protected $funcionario_idfuncionario;
    protected $fecha_asignacion;
    protected $prioridad;
    protected $table = 'prioridad_documento';
    protected $primary = 'idprioridad_documento';

    function __construct($id){
        return parent::__construct($id);
    }

    static function findByDocument($id){
        global $conn;

        if($id){
            $Instance = new self;
            $record = busca_filtro_tabla('*', $Instance->table, 'documento_iddocumento = '. $id, '', $conn);

            if($record['numcampos']){
                $Instance->setAttributes($record[0]);
            }
            return $Instance;
        }else{
            return NULL;
        }
    }
    
}
