<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class ComentarioDocumento extends Model
{
    protected $idcomentario_documento;
    protected $fk_funcionario;
    protected $fk_documento;
    protected $comentario;
    protected $fecha;
    protected $dbAttributes;
    public $user;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'fk_funcionario',
            'fk_documento',
            'comentario',
            'fecha'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public static function getTotalByDocument($documentId){
        global $conn;

        $findTotal = busca_filtro_tabla('count(*) as total', 'comentario_documento', 'fk_documento =' . $documentId, '', $conn);
        return $findTotal[0]['total'];
    }

    public function getUser(){
        if(!$this->user){
            $this->user = new Funcionario($this->fk_funcionario);
        }
        
        return $this->user;
    }

    public function getDate($format = 'Y-m-d'){
        $DateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->fecha);
        return $DateTime->format($format);
    }

    public function getComment(){
        return $this->comentario;
    }
}
