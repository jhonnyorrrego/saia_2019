<?php
require_once $ruta_db_superior . 'models/model.php';

class EtiquetaDocumento extends Model
{
    protected $iddocumento_etiqueta;
    protected $fk_etiqueta;
    protected $fk_documento;
    protected $table = 'documento_etiqueta';
    protected $primary = 'iddocumento_etiqueta';

    function __construct($id){
        return parent::__construct($id);
    }
}