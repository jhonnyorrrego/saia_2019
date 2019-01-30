<?php

class ExpedienteDoc extends Model
{
    protected $idexpediente_doc;
    protected $fk_funcionario;
    protected $fk_expediente;
    protected $fk_documento;
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
                'fecha'
            ],
            'date' => [
                'fecha'
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
        $cant = 0;
        $sql = "SELECT COUNT(idexpediente_doc) AS cant FROM expediente_doc ed,documento d WHERE ed.fk_documento=d.iddocumento and d.estado not in ('ELIMINADO') and ed.fk_expediente={$idexpediente}";
        $response = UtilitiesController::ejecutaSelect($sql);
        if ($response['numcampos']) {
            $cant = $response[0]['cant'];
        }
        return $cant;
    }
}