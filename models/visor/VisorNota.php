<?php

class VisorNota extends Model
{
    protected $idvisor_nota;
    protected $fk_funcionario;
    protected $fecha;
    protected $tipo_relacion;
    protected $idrelacion;
    protected $type;
    protected $x;
    protected $y;
    protected $class;
    protected $uuid;
    protected $page;
    protected $dbAttributes;

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
            'fecha',
            'tipo_relacion',
            'idrelacion',
            'type',
            'x',
            'y',
            'class',
            'uuid',
            'page'
        ];

        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public static function findByDocument($type, $typeId)
    {
        $data = new stdClass();
        $data->comments = [];

        $data->notes = self::findAllByAttributes([
            'tipo_relacion' => $type,
            'idrelacion' => $typeId
        ]);

        foreach ($data->notes as $key => $VisorNota) {
            $comments = VisorComentario::findAllByAttributes([
                'fk_visor_nota' => $VisorNota->getPK()
            ]);
            $data->comments = array_merge($data->comments, $comments);
        }
        return $data;
    }
}
