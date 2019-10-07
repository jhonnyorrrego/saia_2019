<?php

class Tercero extends Model
{
    const TIPO_NATURAL = 1;
    const TIPO_JURIDICA = 2;

    protected $idtercero;
    protected $nombre;
    protected $identificacion;
    protected $tipo_identificacion;
    protected $tipo;
    protected $telefono;
    protected $correo;
    protected $direccion;
    protected $titulo;
    protected $empresa;
    protected $sede;
    protected $ciudad;
    protected $cargo;
    protected $estado;

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
                'nombre',
                'identificacion',
                'tipo_identificacion',
                'tipo',
                'telefono',
                'correo',
                'direccion',
                'titulo',
                'empresa',
                'sede',
                'ciudad',
                'cargo',
                'estado',
            ],
            'date' => []
        ];
    }

    /**
     * realiza una busqueda en por un termino
     * en los campos indentificacion y nombre
     *
     * @param string $term
     * @return array
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019-10-07
     */
    public static function findAllByTerm($term)
    {
        $QueryBuilder = self::getQueryBuilder()
            ->select('idtercero', 'nombre', 'identificacion')
            ->from('tercero')
            ->where("
                LOWER(
                    CONCAT(
                        identificacion,
                        CONCAT(
                            ' ',
                            nombre
                        )
                    )
                ) like :like
            ")
            ->andWhere('estado = 1')
            ->setParameter(':like', "%{$term}%")
            ->setFirstResult(0)
            ->setMaxResults(20);

        return self::findByQueryBuilder($QueryBuilder);
    }
}
