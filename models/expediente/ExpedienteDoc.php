<?php

class ExpedienteDoc extends Model
{
    protected $idexpediente_doc;
    protected $fk_funcionario;
    protected $fk_expediente;
    protected $fk_documento;
    protected $tipo;
    protected $fecha_indice;
    protected $fecha;

    protected $dbAttributes;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'fk_funcionario',
                'fk_expediente',
                'fk_documento',
                'tipo',
                'fecha',
                'fecha_indice'
            ],
            'date' => [
                'fecha',
                'fecha_indice'
            ]
        ];
    }
    
    /**
     * Retorna la cantidad de documentos de un expediente
     *
     * @param integer $idexpediente :identificador del expediente
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function countDocumentsExp(int $idexpediente) : int
    {
        $sql = "SELECT COUNT(idexpediente_doc) AS cant FROM expediente_doc ed,documento d WHERE ed.fk_documento=d.iddocumento AND d.estado NOT IN ('ELIMINADO') AND ed.fk_expediente={$idexpediente}";
        $response = StaticSql::search($sql);
        return $response ? $response[0]['cant'] : 0;
    }

    /**
     * Retorna la cantidad de documentos que tiene una caja
     *
     * @param integer $idcaja :identificador de la caja
     * @return integer
     * @author Andres.Agudelo <andres.agudelo@cerok.com>
     */
    public static function countDocumentsCaja(int $idcaja) : int
    {
        $sql = "SELECT COUNT(idexpediente_doc) AS cant FROM expediente e,expediente_doc ed,documento d WHERE e.idexpediente=ed.fk_expediente AND ed.fk_documento=d.iddocumento AND d.estado NOT IN ('ELIMINADO') AND e.estado=1 AND e.fk_caja={$idcaja}";
        $response = StaticSql::search($sql);
        return $response ? $response[0]['cant'] : 0;
    }

}