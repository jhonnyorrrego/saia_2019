<?php
require_once $ruta_db_superior . 'models/model.php';

class Modulo extends Model
{
    protected $idmodulo;
    protected $pertenece_nucleo;
    protected $nombre;
    protected $tipo;
    protected $imagen;
    protected $etiqueta;
    protected $enlace;
    protected $cod_padre;
    protected $orden;
    protected $table = 'modulo';
    protected $primary = 'idmodulo';
    protected $safeDbAttributes = [
        'pertenece_nucleo',
        'nombre',
        'tipo',
        'imagen',
        'etiqueta',
        'enlace',
        'cod_padre',
        'orden'
    ];

    function __construct($id){
        return parent::__construct($id);
    }
}
