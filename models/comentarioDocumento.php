<?php
require_once $ruta_db_superior . 'models/model.php';

class ComentarioDocumento extends Model
{
    protected $idcomentario_documento;
    protected $fk_funcionario;
    protected $fk_documento;
    protected $comentario;
    protected $fecha;
    protected $table = 'comentario_documento';
    protected $primary = 'idcomentario_documento';
    protected $safeDbAttributes = [
        'fk_funcionario',
        'fk_documento',
        'comentario',
        'fecha'
    ];

    function __construct($id){
        return parent::__construct($id);
    }

    public static function findByDocument($documentId){
        global $conn;

        $findComments = busca_filtro_tabla('*', 'comentario_documento', 'fk_documento =' . $documentId, '', $conn);
        unset($findComments['tabla'], $findComments['sql'], $findComments['numcampos']);
        return $findComments;
    }

    public static function getTotalByDocument($documentId){
        global $conn;

        $findTotal = busca_filtro_tabla('count(*) as total', 'comentario_documento', 'fk_documento =' . $documentId, '', $conn);
        return $findTotal[0]['total'];
    }
}
