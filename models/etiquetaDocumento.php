<?php
require_once $ruta_db_superior . 'models/model.php';

class EtiquetaDocumento extends Model
{
    protected $iddocumento_etiqueta;
    protected $fk_etiqueta;
    protected $fk_documento;
    protected $table = 'documento_etiqueta';
    protected $primary = 'iddocumento_etiqueta';
    protected $safeDbAttributes = [
        'fk_etiqueta',
        'fk_documento'
    ];

    function __construct($id){
        return parent::__construct($id);
    }
}