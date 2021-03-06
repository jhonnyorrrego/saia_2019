<?php

class Respuesta extends Model
{
    protected $idrespuesta;
    protected $fecha;
    protected $destino;
    protected $origen;
    protected $idbuzon;
    protected $plantilla;

    //relations
    protected $Origin;
    protected $Destination;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'fecha',
            'destino',
            'origen',
            'idbuzon',
            'plantilla'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    /**
     * funcionalidad a ejecutar posterior a crear un registro
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    protected function afterCreate()
    {
        return $this->addTraceability();
    }

    /**
     * obtiene la instancia del documento origen
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public function getOrigin()
    {
        if (!$this->Origin) {
            $this->Origin = $this->getRelationFk('Documento', 'origen');
        }

        return $this->Origin;
    }

    /**
     * obtiene la instancia del documento destino
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-04-30
     */
    public function getDestination()
    {
        if (!$this->Destination) {
            $this->Destination = $this->getRelationFk('Documento', 'destino');
        }

        return $this->Destination;
    }

    /**
     * crea el registro de rastro sobre la vinculacion
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    public function addTraceability()
    {
        return DocumentoRastro::newRecord([
            'fk_documento' => $this->origen,
            'accion' => DocumentoRastro::ACCION_VINCULACION_DOCUMENTO,
            'titulo' => 'Se le ha vinculado un documento'
        ]) && DocumentoRastro::newRecord([
            'fk_documento' => $this->destino,
            'accion' => DocumentoRastro::ACCION_VINCULACION_DOCUMENTO,
            'titulo' => 'Se ha vinculado a un documento'
        ]);
    }
}
