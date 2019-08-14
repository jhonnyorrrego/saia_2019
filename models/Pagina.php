<?php
class Pagina extends Model
{
    protected $id_documento;
    protected $imagen;
    protected $pagina;
    protected $ruta;
    protected $fecha_pagina;
    protected $consecutivo;

    function __construct($id = null)
    {
        parent::__construct($id);
    }

    /**
     * define values for dbAttributes
     */
    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'id_documento',
                'imagen',
                'pagina',
                'ruta',
                'fecha_pagina'
            ],
            'date' => ['fecha_pagina'],
            'primary' => 'consecutivo'
        ];
    }

    /**
     * crea la pagina en el temporal del usuario
     *
     * @return mixed
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function getTemporalRoute()
    {
        $prefix = 'pagina' . $this->getPK();
        $image = TemporalController::createTemporalFile($this->ruta, $prefix, true);
        return $image->success ? $image->route : false;
    }
}
