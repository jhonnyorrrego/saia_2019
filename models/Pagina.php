<?php

use function GuzzleHttp\json_decode;

class Pagina extends Model
{
    protected $id_documento;
    protected $imagen;
    protected $pagina;
    protected $ruta;
    protected $fecha_pagina;
    protected $consecutivo;
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
        // set the safe attributes to update and consult
        $safeDbAttributes = [
            'id_documento',
            'imagen',
            'pagina',
            'ruta',
            'fecha_pagina'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha_pagina'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes,
            'primary' => 'consecutivo'
        ];
    }

    /**
     * @param string $campo nombre del campo (DB) de la imagen
     * @param string $sufijo para agregarle un sufijo al nombre, util cuando las imagenes se llaman iguales
     * @param string $nameFile Nombre de la imagen
     * @param boolean $force para sobreescribir la imagen
     * @return string/boolean false en caso de error o string de la ruta de la imagen en completa
     * @author Andres.Agudelo
     *
     * */
    public function getTemporalRoute()
    {
        $prefix = 'pagina' . $this->getPK();
        $image = UtilitiesController::createTemporalFile($this->ruta, $prefix, true);
        return $image->success ? $image->route : false;
    }
}
