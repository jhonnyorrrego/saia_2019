<?php

class SerieDependencia extends Model
{
    use TSerieDependencia;

    protected $idserie_dependencia;
    protected $fk_serie;
    protected $fk_dependencia;
    protected $estado;

    protected $dbAttributes;


    function __construct($id = null)
    {
        parent::__construct($id);

        $this->classSerieDependencia = 'SerieDependencia';
        $this->classSerie = 'Serie';
    }

    protected function defineAttributes()
    {
        $this->dbAttributes = (object) [
            'safe' => [
                'fk_serie',
                'fk_dependencia',
                'estado'
            ],
            'primary' => 'idserie_dependencia'
        ];
    }

    public function beforeDelete()
    {
        throw new Exception("La acción de eliminar NO esta permitida en las series", 1);
    }

    /**
     * Retonar la instancia de Serie
     *
     * @return Serie|null
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */
    public function getSerieFk()
    {
        return Serie::findByAttributes(
            ['idserie' => $this->fk_serie]
        );
    }

    /**
     * Retonar la instancia de Serie
     *
     * @return Dependencia|null
     * @author Andres Agudelo <andres.agudelo@cerok.com>
     * @date 2019
     */

    public function getDependenciaFk()
    {
        return Dependencia::findByAttributes(
            ['iddependencia' => $this->fk_dependencia]
        );
    }
}
