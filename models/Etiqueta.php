<?php

class Etiqueta extends Model
{
    protected $idetiqueta;
    protected $nombre;
    protected $fk_funcionario;
    protected $estado;
    protected $nucleo;
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
            'nombre',
            'fk_funcionario',
            'estado',
            'nucleo'
        ];
        // set the date attributes on the schema
        $dateAttributes = [];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public static function getUserTrashId($userId)
    {
        $Etiqueta = self::findByAttributes([
            'fk_funcionario' => $userId,
            'nombre' => 'Archivados',
            'nucleo' => 1
        ]);

        if (!$Etiqueta) {
            $pk = self::newRecord([
                'nombre' => 'Archivados',
                'fk_funcionario' => $userId,
                'estado' => 1,
                'nucleo' => 1
            ]);
        } else {
            $pk = $Etiqueta->getPK();
        }

        return $pk;
    }

}