<?php

class DocumentoFuncionario extends Model
{
    const CREADOR = 1;
    const SEGUIDOR = 2;

    protected $iddocumento_funcionario;
    protected $fk_funcionario;
    protected $fk_documento;
    protected $tipo;
    protected $fecha;
    protected $estado;
    protected $user;
    

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
            'fk_documento',
            'tipo',
            'fecha',
            'estado'
        ];
        // set the date attributes on the schema
        $dateAttributes = ['fecha'];

        $this->dbAttributes = (object)[
            'safe' => $safeDbAttributes,
            'date' => $dateAttributes
        ];
    }

    public function getUser()
    {
        if (!$this->user) {
            $this->user = $this->getRelationFk('Funcionario');
        }

        return $this->user;
    }

    /**
     * activa la ralacion entre
     * el funcionario y la tarea
     *
     * @return int idtarea_funcionario
     */
    public function toggleRelation($newState)
    {
        $this->estado = $newState;

        return $this->save();
    }

    public function deleteAccess($userId)
    {
        if ($this->fk_funcionario == $userId) {
            $response = 1;
        } else {
            $sql = <<<SQL
            select
                count(*) as total
            from
                buzon_salida a join
                funcionario b
            on 
                a.origen = b.funcionario_codigo
            where 
                a.nombre = 'APROBADO' and 
                b.idfuncionario = {$userId} and
                a.archivo_idarchivo = {$this->fk_documento}
SQL;
            $query = self::search($sql);
            $response = $query[0]['total'];
        }

        return (int) $response;
    }
}
