<?php
require_once $ruta_db_superior . 'models/model.php';

class Etiqueta extends Model
{
    protected $idetiqueta;
    protected $nombre;
    protected $fk_funcionario;
    protected $estado;
    protected $table = 'etiqueta';
    protected $primary = 'idetiqueta';
    protected $safeDbAttributes = [
        'nombre',
        'fk_funcionario',
        'estado'
    ];

    function __construct($id){
        return parent::__construct($id);
    }

    public static function findActiveByUser($userId){
        global $conn;

        $findTags = busca_filtro_tabla('*', 'etiqueta', 'estado = 1 and fk_funcionario =' . $userId, '', $conn);
        unset($findTags['tabla'], $findTags['sql'], $findTags['numcampos']);
        
        return $findTags;
    }

}
