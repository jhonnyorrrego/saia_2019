<?php

class Municipio extends Model
{
    protected $idmunicipio;
    protected $nombre;
    protected $departamento_iddepartamento;
    protected $estado;


    //relations
    protected $Departamento;

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
                'nombre',
                'estado',
                'departamento_iddepartamento'
            ],
            'date' => []
        ];
    }

    /**
     * retorna el departamento padre
     *
     * @return object
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-18
     */
    public function getState()
    {
        if (!$this->Departamento) {
            $this->Departamento = $this->getRelationFk(
                'Departamento',
                'departamento_iddepartamento'
            );
        }

        return $this->Departamento;
    }

    /**
     * buscador para autocompletar por nombre
     *
     * @param string $term palabra a buscar
     * @return void
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-06-18
     */
    public static function findAllByTerm($term, $parentId)
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('idmunicipio,nombre,estado')
            ->from('municipio')
            ->where('departamento_iddepartamento = :parentId')
            ->andWhere('nombre like :like')
            ->setParameter(':like', "%{$term}%")
            ->orderBy('nombre', 'asc');

        return self::findByQueryBuilder($QueryBuilder);
    }
}
