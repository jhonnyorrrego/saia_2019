<?php

class BuzonEntrada extends Model
{
    protected $idtransferencia;
    protected $archivo_idarchivo;
    protected $nombre;
    protected $destino;
    protected $tipo_destino;
    protected $fecha;
    protected $respuesta;
    protected $origen;
    protected $tipo_origen;
    protected $notas;
    protected $transferencia_descripcion;
    protected $tipo;
    protected $activo;
    protected $ruta_idruta;
    protected $ver_notas;
    

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
                'archivo_idarchivo',
                'nombre',
                'destino',
                'tipo_destino',
                'fecha',
                'respuesta',
                'origen',
                'tipo_origen',
                'notas',
                'transferencia_descripcion',
                'tipo',
                'activo',
                'ruta_idruta',
                'ver_notas'
            ],
            'date' => [
                'fecha',
                'respuesta'
            ],
            'primary' => 'idtransferencia'
        ];
    }

    /**
     * busca los registros en buzon entrada de la ruta activa
     *
     * @param integer $documentId
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-09
     */
    public static function findActiveRoute($documentId)
    {
        $type = RutaDocumento::TIPO_RADICACION;
        $sql = <<<SQL
            SELECT a.*
            FROM
                buzon_entrada a 
                JOIN ruta b ON 
                    a.ruta_idruta = b.idruta
                JOIN ruta_documento c ON
                    b.fk_ruta_documento = c.idruta_documento
            WHERE
                c.fk_documento = {$documentId} AND
                c.estado = 1 AND
                c.tipo = {$type}
            ORDER BY a.idtransferencia ASC
SQL;

        return self::findByQueryBuilder($sql);
    }
}
