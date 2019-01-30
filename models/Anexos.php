<?php

class Anexos extends Model
{
    protected $idanexos;
    protected $documento_iddocumento;
    protected $ruta;
    protected $etiqueta;
    protected $tipo;
    protected $formato;
    protected $campos_formato;
    protected $idbinario;
    protected $fecha_anexo;
    protected $fecha;
    protected $dbAttributes;

    function __construct($id = null) {
        return parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes(){
        $this->dbAttributes = (object) [
            'safe' => [
                'documento_iddocumento',
                'ruta',
                'etiqueta',
                'tipo',
                'formato',
                'campos_formato',
                'idbinario',
                'fecha_anexo',
                'fecha'
            ],
            'date' => ['fecha_anexo','fecha']
        ];
    }
}