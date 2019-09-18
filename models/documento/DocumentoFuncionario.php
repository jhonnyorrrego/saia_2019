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

        $this->dbAttributes = (object) [
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

    /**
     * verifica si tiene permiso para eliminar
     *
     * @param integer $userId
     * @return integer
     * @author jhon sebastian valencia <jhon.valencia@cerok.com>
     * @date 2019
     */
    public function deleteAccess($userId)
    {
        if ($this->fk_funcionario == $userId) {
            $response = 1;
        } else {
            $query = self::getQueryBuilder()
                ->select('count(*) as total')
                ->from('buzon_salida', 'a')
                ->join('a', 'funcionario', 'b', 'a.origen = b.funcionario_codigo')
                ->where('a.nombre = "APROBADO"')
                ->andWhere('b.idfuncionario = :userId')
                ->andWhere('a.archivo_idarchivo = :documentId')
                ->setParameter('userId', $userId, \Doctrine\DBAL\Types\Type::INTEGER)
                ->setParameter(':documentId', $this->fk_documento, \Doctrine\DBAL\Types\Type::INTEGER)
                ->execute()->fetch();

            $response = $query['total'];
        }

        return (int) $response;
    }
}
