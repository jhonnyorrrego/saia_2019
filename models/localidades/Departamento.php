<?php

class Departamento extends Model
{
    protected $iddepartamento;
    protected $nombre;
    protected $estado;
    protected $pais_idpais;


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
                'pais_idpais'
            ],
            'date' => []
        ];
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
            ->select('iddepartamento,nombre,estado')
            ->from('departamento')
            ->where('pais_idpais = :parentId')
            ->andWhere('nombre like :like')
            ->setParameter(':like', "%{$term}%")
            ->orderBy('nombre', 'asc');

        return self::findByQueryBuilder($QueryBuilder);
    }
}
