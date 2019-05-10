<?php

class RutaAprobacion extends Model
{
    const TIPO_VISTO_BUENO = 1;
    const TIPO_APROBAR = 2;

    protected $idruta_aprobacion;
    protected $orden;
    protected $fk_ruta_documento;
    protected $fk_funcionario;
    protected $tipo_accion;
    protected $ejecucion;
    protected $fecha_ejecucion;
    protected $dbAttributes;

    //relations
    protected $user;

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
                'orden',
                'fk_ruta_documento',
                'fk_funcionario',
                'tipo_accion',
                'ejecucion',
                'fecha_ejecucion',
            ],
            'date' => ['fecha_ejecucion']
        ];
    }

    /**
     * obtiene una instancia del funcionario relacionado
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-04
     */
    public function getUser()
    {
        if (!$this->user) {
            $this->user = self::getRelationFk('Funcionario');
        }

        return $this->user;
    }

    /**
     * obtiene las instancias de la ruta 
     * vigente de aprobacion para un documento
     * 
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-05-04
     */
    public static function findActivesByDocument($documentId)
    {
        $sql = <<<SQL
            SELECT a.*
            FROM 
                ruta_aprobacion a JOIN
                ruta_documento b ON
                    b.idruta_documento = a.fk_ruta_documento
            WHERE
                b.estado = 1 AND
                b.fk_documento = {$documentId}                
SQL;

        return self::findBySql($sql);
    }
}
