<?php

class ComentarioDocumento extends Model
{
    protected $idcomentario_documento;
    protected $fk_funcionario;
    protected $fk_documento;
    protected $comentario;
    protected $fecha;

    //relations
    public $Funcionario;

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
            'fk_funcionario',
            'fk_documento',
            'comentario',
            'fecha'
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
     * obtiene la instancia del funcionario relacionado
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getUser()
    {
        if (!$this->Funcionario) {
            $this->Funcionario = new Funcionario($this->fk_funcionario);
        }

        return $this->Funcionario;
    }

    /**
     * crea el registro de rastro sobre la 
     * creacion de un comentario
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-07-09
     */
    public function addTraceability()
    {
        return DocumentoRastro::newRecord([
            'fk_documento' => $this->fk_documento,
            'accion' => DocumentoRastro::ACCION_CREACION_COMENTARIO,
            'titulo' => 'Se le ha creado un comentario'
        ]);
    }
}
