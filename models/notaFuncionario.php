<?php
require_once $ruta_db_superior . 'models/model.php';

class NotaFuncionario extends Model{
    protected $idnota_funcionario;
    protected $nombre;
    protected $contenido;
    protected $fk_funcionario;
    protected $fecha;
    protected $estado;
    protected $table = 'nota_funcionario';
    protected $primary = 'idnota_funcionario';
    protected $safeDbAttributes = [
        'nombre',
        'contenido',
        'fk_funcionario',
        'fecha',
        'estado'
    ];

    function __construct($id){
        return parent::__construct($id);
    }

    public static function findActiveByUser($userId){
        $notes = busca_filtro_tabla('*', 'nota_funcionario', 'estado=1 and fk_funcionario =' . $userId, '', $conn);
        unset($notes['numcampos'], $notes['sql'], $notes['tabla']);
        
        return $notes;
    }

    public static function deleteByPk($idnota){
        if($idnota){
            $update = 'update nota_funcionario set estado=0 where idnota_funcionario=' . $idnota;
            return phpmkr_query($update);
        }else{
            return false;
        }            
    }
}
