<?php

class Ruta extends Model
{
    protected $idruta;
    protected $transferencia_idtransferencia;
    protected $tipo_origen;
    protected $tipo_destino;
    protected $tipo;
    protected $restrictivo;
    protected $origen;
    protected $orden;
    protected $obligatorio;
    protected $idtipo_documental;
    protected $idenlace_nodo;
    protected $firma_externa;
    protected $fecha;
    protected $documento_iddocumento;
    protected $destino;
    protected $condicion_transferencia;
    protected $clase;
    protected $dbAttributes;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object)[
            'safe' => [
                'transferencia_idtransferencia',
                'tipo_origen',
                'tipo_destino',
                'tipo',
                'restrictivo',
                'origen',
                'orden',
                'obligatorio',
                'idtipo_documental',
                'idruta',
                'idenlace_nodo',
                'firma_externa',
                'fecha',
                'documento_iddocumento',
                'destino',
                'condicion_transferencia',
                'clase',
            ],
            'date' => ['fecha']
        ];
    }

    /**
     * obtiene una instancia del funcionario origen
     * basado en su tipo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-03
     */
    public function getOrigin()
    {
        switch ($this->tipo_origen) {
            case 1: // Funcionario
                $response = Funcionario::findByAttributes([
                    'funcionario_codigo' => $this->origen
                ]);
                break;
            case 5: //dependencia_cargo
                $sql = <<<SQL
                    SELECT b.*
                    FROM
                        dependencia_cargo a JOIN
                        funcionario b ON
                            b.idfuncionario = a.funcionario_idfuncionario
                    WHERE
                        a.iddependencia_cargo = {$this->origen}
SQL;
                $response = Funcionario::findBySql($sql)[0];
                break;
            default:
                $response = null;
                break;
        }

        return $response;
    }

    /**
     * obtiene una instancia del funcionario destino
     * basado en su tipo
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-03
     */
    public function getDestination()
    {
        switch ($this->tipo_destino) {
            case 1: // Funcionario
                $response = Funcionario::findByAttributes([
                    'funcionario_codigo' => $this->origen
                ]);
                break;
            case 5: //dependencia_cargo
                $sql = <<<SQL
                    SELECT b.*
                    FROM
                        dependencia_cargo a JOIN
                        funcionario b ON
                            b.idfuncionario = a.funcionario_idfuncionario
                    WHERE
                        a.iddependencia_cargo = {$this->destino}
SQL;
                $response = Funcionario::findBySql($sql)[0];
                break;
            default:
                $response = null;
                break;
        }

        return $response;
    }

    /**
     * busca la ruta de radicacion vigente del documento
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-07
     */
    public static function findActiveRoute($documentId)
    {
        $type = RutaDocumento::TIPO_RADICACION;
        $sql = <<<SQL
            SELECT a.*
            FROM
                ruta a JOIN
                ruta_documento b ON
                    a.fk_ruta_documento = b.idruta_documento
            WHERE
                b.fk_documento = {$documentId} AND
                b.estado = 1 AND
                b.tipo = {$type}
SQL;

        return self::findBySql($sql);
    }
}
