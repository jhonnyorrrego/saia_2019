<?php

class CamposFormato extends Model
{
    protected $idcampos_formato;
    protected $formato_idformato;
    protected $autoguardado;
    protected $fila_visible;
    protected $longitud_vis;
    protected $valor;
    protected $ayuda;
    protected $obligatoriedad;
    protected $orden;
    protected $acciones;
    protected $nombre;
    protected $etiqueta;
    protected $tipo_dato;
    protected $longitud;
    protected $predeterminado;
    protected $etiqueta_html;
    protected $mascara;
    protected $adicionales;
    protected $placeholder;
    protected $estilo;
    protected $opciones;
    protected $banderas;

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
            'idcampos_formato',
            'formato_idformato',
            'autoguardado',
            'fila_visible',
            'longitud_vis',
            'valor',
            'ayuda',
            'obligatoriedad',
            'orden',
            'acciones',
            'nombre',
            'etiqueta',
            'tipo_dato',
            'longitud',
            'predeterminado',
            'etiqueta_html',
            'mascara',
            'adicionales',
            'placeholder',
            'estilo',
            'opciones',
            'banderas'
        ];

        $this->dbAttributes = (object) [
            'safe' => $safeDbAttributes,
            'date' => []
        ];
    }
}
