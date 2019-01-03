<?php
require_once $ruta_db_superior . 'controllers/autoload.php';

class NotaFuncionario extends Model{
    protected $idnota_funcionario;
    protected $nombre;
    protected $contenido;
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
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'nombre',
            'contenido',
            'fk_funcionario',
            'fecha',
            'estado'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
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
