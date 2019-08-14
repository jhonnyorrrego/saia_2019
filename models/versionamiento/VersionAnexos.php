<?php

class VersionAnexos extends Model
{
    protected $idversion_anexos;
    protected $documento_iddocumento;
    protected $ruta;
    protected $fk_idversion_documento;
    protected $anexos_idanexos;

    //relations
    protected $Anexos;

    function __construct($id = null)
    {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'documento_iddocumento',
                'ruta',
                'fk_idversion_documento',
                'anexos_idanexos',
            ],
            'date' => []
        ];
    }

    /**
     * obtiene la instancia del anexo relacionado
     *
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-08-14
     */
    public function getFile()
    {
        if (!$this->Anexos) {
            $this->Anexos = $this->getRelationFk('Anexos', 'anexos_idanexos');
        }

        return $this->Anexos;
    }
}
