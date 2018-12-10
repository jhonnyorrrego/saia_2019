<?php
require_once $ruta_db_superior . 'models/model.php';

class EtiquetaDocumento extends Model
{
    protected $iddocumento_etiqueta;
    protected $fk_etiqueta;
    protected $fk_documento;
    protected $table = 'etiqueta_documento';
    protected $primary = 'idetiqueta_documento';
    protected $safeDbAttributes = [
        'fk_etiqueta',
        'fk_documento'
    ];

    function __construct($id){
        return parent::__construct($id);
    }

    public static function defineCheckboxType($tagId, $documentIds){
        global $conn;

        $findIncluded = busca_filtro_tabla("count(*) as total", "etiqueta_documento", "fk_etiqueta =" . $tagId . " and fk_documento in(".$documentIds.")", "", $conn);
        
        $totalDocuments = substr_count($documentIds, ',') + 1;
        if($findIncluded[0]['total'] ==  $totalDocuments){
            $response = 1;
        }else if ($findIncluded[0]['total'] == 0){
            $response = 0;
        }else{
            $response = 2;
        }

        return $response;
    }

    public static function deleteByTag($tagId){
        global $conn;

        if($tagId){
            $delete = 'delete from etiqueta_documento where fk_etiqueta =' . $tagId;
            $response = phpmkr_query($delete);
        }else{
            $response = false;
        }

        return $response;
    }
}